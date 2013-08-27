<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('BB2_CWD', dirname(__FILE__));

/**
 * VZ Bad Behavior Extension
 *
 * @package     ExpressionEngine
 * @subpackage  Addons
 * @category    Extension
 * @author      Eli Van Zoeren
 * @link        http://elivz.com
 */

class Vz_bad_behavior_ext {

    public $settings        = array();
    public $description     = 'EE implementation of the spam-blocking Bad Behavior script.';
    public $docs_url        = 'http://elivz.com/blog/single/bad_behavior/';
    public $name            = 'VZ Bad Behavior';
    public $settings_exist  = 'y';
    public $version         = '1.5';

    private $EE;

    /**
     * Constructor
     */
    public function __construct($settings = '')
    {
        $this->EE =& get_instance();
        $this->settings = $settings;
    }

    private $default_settings = array(
        'enabled' => 'y',
        'verbose' => 'n',
        'logging' => 'y',
        'display_stats' => 'y',
        'strict' => 'n',
        'httpbl_key' => '',
        'httpbl_threat' => '25',
        'httpbl_maxage' => '30',
        'offsite_forms' => 'n',
        'whitelisted_ips' => '',
        'whitelisted_urls' => '',
        'reverse_proxy' => FALSE,
        'reverse_proxy_header' => 'X-Forwarded-For',
        'reverse_proxy_addresses' => '127.0.0.1'
    );

    // ----------------------------------------------------------------------

    /**
     * Activate Extension
     */
    public function activate_extension()
    {
        // Setup custom settings in this array.
        $this->settings = $this->default_settings;
        $this->settings['log_table'] = $this->EE->db->dbprefix.'bad_behavior';

        $data = array(
            'class'     => __CLASS__,
            'method'    => 'bad_behavior',
            'hook'      => 'sessions_start',
            'settings'  => serialize($this->settings),
            'version'   => $this->version,
            'enabled'   => 'y'
        );

        // Enable the extension
        $this->EE->db->insert('extensions', $data);

        // Create the table for BB to store its data
        $this->EE->db->query(
            "CREATE TABLE IF NOT EXISTS `".$this->settings['log_table']."` (
            `id` INT(11) NOT NULL auto_increment,
            `ip` TEXT NOT NULL,
            `date` DATETIME NOT NULL default '0000-00-00 00:00:00',
            `request_method` TEXT NOT NULL,
            `request_uri` TEXT NOT NULL,
            `server_protocol` TEXT NOT NULL,
            `http_headers` TEXT NOT NULL,
            `user_agent` TEXT NOT NULL,
            `request_entity` TEXT NOT NULL,
            `key` TEXT NOT NULL,
            INDEX (`ip`(15)),
            INDEX (`user_agent`(10)),
            PRIMARY KEY (`id`) );"
        );
    }

    /**
     * Update Extension
     */
    public function update_extension($current = '')
    {
        if ($current == '' OR $current == $this->version)
        {
            return FALSE;
        }

        $this->EE->db->where('class', __CLASS__);
        $this->EE->db->update('extensions', array('version' => $this->version));
    }

    /**
     * Disable Extension
     */
    public function disable_extension()
    {
        // Delete the bad_behavior table
        $this->EE->db->query("DROP TABLE IF EXISTS ".$this->EE->db->dbprefix.'bad_behavior');

        // Remove the extension settings
        $this->EE->db->where('class', __CLASS__);
        $this->EE->db->delete('extensions');
    }

    // ----------------------------------------------------------------------

    /**
     * Display Settings Form
     */
    public function settings_form($settings)
    {
        $this->EE->load->helper('form');
        $this->EE->load->library('table');

        // Get the recently blocked list
        $blocked = $this->EE->db
            ->query("SELECT COUNT(*) as count FROM " . $settings['log_table'] . " WHERE `key` NOT LIKE '00000000'")
            ->row('count');

        // Merge with the default settings and anything set in config.php
        $global_settings = (array) $this->EE->config->item('vz_bad_behavior');
        $settings = array_merge($this->default_settings, $settings, $global_settings);

        $data = array(
            'base_url'      => preg_replace("/https?:/", '', $this->EE->functions->fetch_site_index()),
            'settings'      => $settings,
            'blocked_count' => $blocked
        );

        return $this->EE->load->view('index', $data, TRUE);
    }

    /**
     * Save Settings
     */
    public function save_settings()
    {
        if (empty($_POST))
        {
            show_error($this->EE->lang->line('unauthorized_access'));
        }

        unset($_POST['submit']);

        // Otherwise EE strips out the escaping in the regex patterns
        $_POST['whitelisted_urls'] = addslashes($_POST['whitelisted_urls']);

        // Save the settings to the database
        $this->EE->db->where('class', __CLASS__);
        $this->EE->db->update('extensions', array('settings' => serialize($_POST)));

        // Remove logs when they are turned off
        if ($_POST['logging'] != 'y')
        {
            $this->EE->db->truncate($this->EE->db->dbprefix.'bad_behavior');
        }

        $this->EE->session->set_flashdata(
            'message_success',
            $this->EE->lang->line('preferences_updated')
        );
    }

    // ----------------------------------------------------------------------

    /**
     * Start Bad Behavior
     */
    public function bad_behavior($session)
    {
        // Check for the special query string that means we want the log
        if ( isset($_GET['bb_logs']) && AJAX_REQUEST && stristr($_SERVER['HTTP_REFERER'], 'vz_bad_behavior') )
        {
            echo $this->_logs();

            // Kill further processing
            die();
        }
        else
        {
            // Calls inward to Bad Behavor itself.
            $settings = bb2_read_settings();
            if ($settings['enabled']) {
                require_once(BB2_CWD . "/bad-behavior/core.inc.php");
                bb2_start($settings);
            }
        }
    }

    // ----------------------------------------------------------------------

    /**
     * Output the logs
     */
    private function _logs()
    {
        $this->EE->load->library('table');
        $this->EE->lang->loadfile('vz_bad_behavior');

        // Get the recently blocked list
        $blocked = $this->EE->db->query("SELECT * FROM " . $this->settings['log_table'] . " WHERE `key` NOT LIKE '00000000' ORDER BY `date` DESC")->result_array();

        $data = array(
            'blocked' => $blocked
        );

        return $this->EE->load->view('logs', $data, TRUE);
    }
}


// ----------------------------------------------------------------------

// Bad Behavior callback functions.

// Return current time in the format preferred by your database.
function bb2_db_date()
{
    $EE =& get_instance();
    return gmdate('Y-m-d H:i:s', $EE->localize->now);
}

// Return affected rows from most recent query.
function bb2_db_affected_rows()
{
    $EE =& get_instance();
    return $EE->db->affected_rows();
}

// Escape a string for database usage
function bb2_db_escape($string)
{
    $EE =& get_instance();
    return $EE->db->escape_str($string);
}

// Return the number of rows in a particular query.
function bb2_db_num_rows($result)
{
    return $result !== FALSE ? $result->num_rows() : 0;
}

// Run a query and return the results, if any.
// Should return FALSE if an error occurred.
// Bad Behavior will use the return value here in other callbacks.
function bb2_db_query($query)
{
    $EE =& get_instance();
    return $EE->db->query($query);
}

// Return all rows in a particular query.
// Should contain an array of all rows generated by calling mysql_fetch_assoc()
// or equivalent and appending the result of each call to an array.
function bb2_db_rows($result)
{
    if ($result->num_rows() > 0)
    {
        return $results->result_array() ;
    }
}

// Create the SQL query for inserting a record in the database.
function bb2_insert($settings, $package, $key)
{
    $ip = bb2_db_escape($package['ip']);
    $date = bb2_db_date();
    $request_method = bb2_db_escape($package['request_method']);
    $request_uri = bb2_db_escape($package['request_uri']);
    $server_protocol = bb2_db_escape($package['server_protocol']);
    $user_agent = bb2_db_escape($package['user_agent']);
    $headers = "$request_method $request_uri $server_protocol\n";
    foreach ($package['headers'] as $h => $v) {
        $headers .= bb2_db_escape("$h: $v\n");
    }
    $request_entity = "";
    if (!strcasecmp($request_method, "POST")) {
        foreach ($package['request_entity'] as $h => $v) {
            $request_entity .= bb2_db_escape("$h: $v\n");
        }
    }
    return "INSERT INTO `" . bb2_db_escape($settings['log_table']) . "`
        (`ip`, `date`, `request_method`, `request_uri`, `server_protocol`, `http_headers`, `user_agent`, `request_entity`, `key`) VALUES
        ('$ip', '$date', '$request_method', '$request_uri', '$server_protocol', '$headers', '$user_agent', '$request_entity', '$key')";
}

// Return emergency contact email address.
function bb2_email()
{
    $EE =& get_instance();
    return $EE->config->item('webmaster_email');
}

// retrieve settings from database
function bb2_read_settings()
{
    $EE =& get_instance();
    $saved_settings = array();

    // Is the Cookie Consent extension enabled?
    $reject_cookies = FALSE;
    if (isset($EE->extensions->extensions['set_cookie_end']))
    {
        foreach($EE->extensions->extensions['set_cookie_end'] as $priority => $extension)
        {
            if (isset($extension['Cookie_consent_ext']))
            {
                // The extension is enabled, but is it set to reject cookies?
                $reject_cookies = ! $EE->input->cookie('cookies_allowed');
            }
        }
    }

    // Get any config variables that were set in config.php
    $global_settings = (array) $EE->config->item('vz_bad_behavior');

    // Ugh, we have to go through this whole rigamarole to get the settings,
    // since we're not inside the extension's object.
    if (isset($EE->extensions->extensions['sessions_start']))
    {
        foreach($EE->extensions->extensions['sessions_start'] as $priority => $extension)
        {
            if (isset($extension['Vz_bad_behavior_ext']))
            {
                // Retrieve the saved settings
                if ($extension['Vz_bad_behavior_ext']['1'] != '')
                {
                    $settings = unserialize($extension['Vz_bad_behavior_ext']['1']);

                    // Default to enabled
                    if (empty($settings['enabled']) || $settings['enabled'] !== 'n') $settings['enabled'] = 'y';

                    // Convert strings to booleans
                    foreach ($settings as $key => $value)
                    {
                        if ($value === 'y')
                        {
                            $settings[$key] = TRUE;
                        }
                        elseif ($value === 'n')
                        {
                            $settings[$key] = FALSE;
                        }
                    }

                    // If the Cookie Consent module is enabled and set to "no cookies", don't use them
                    $settings['eu_cookie'] = $reject_cookies;

                    // Values in config.php override those in the database
                    $settings = array_merge($settings, $global_settings);

                    return $settings;
                }
            }
        }
    }

    // Couldn't get the settings, oh well
    return FALSE;
}

// retrieve whitelist
function bb2_read_whitelist() {
    $settings = bb2_read_settings();
    return array(
       'ip' => array_filter(explode("\n", $settings['whitelisted_ips'])),
       'url' => array_filter(explode("\n", $settings['whitelisted_urls']))
    );
}

// write settings to database
function bb2_write_settings($settings)
{
    // Not needed, since we have a control panel for changing settings
    return FALSE;
}

// installation
function bb2_install()
{
    // We are creating the table in the extension's "enable" function
    return FALSE;
}

// Screener
// Insert this into the <head> section of your HTML through a template call
// or whatever is appropriate. This is optional we'll fall back to cookies
// if you don't use it.
function bb2_insert_head()
{
    global $bb2_javascript;
    echo $bb2_javascript;
}

// Display stats? This is optional.
function bb2_insert_stats($force = TRUE)
{
    return FALSE;
}

// Return the top-level relative path of wherever we are (for cookies)
// You should provide in $url the top-level URL for your site.
function bb2_relative_path()
{
    $EE =& get_instance();
    return str_replace('//', '/', $EE->config->item('cookie_path').'/');
}

/* End of file ext.vz_bad_behavior.php */
/* Location: /system/expressionengine/third_party/vz_bad_behavior/ext.vz_bad_behavior.php */