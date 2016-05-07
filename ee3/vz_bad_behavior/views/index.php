<?php

$vars = array(
    'base_url' => ee('CP/URL')->make('addons/settings/vz_bad_behavior/save'),
    'cp_page_title' => lang('config'),
    'save_btn_text' => 'btn_save_settings',
    'save_btn_text_working' => 'btn_saving'
);

$vars['sections'] = array(
    array(
        array(
            'title' => 'enabled',
            'fields' => array(
                'enabled' => array(
                    'type' => 'yes_no',
                    'value' => $settings['enabled']
                ),
                'verbose' => array(
                    'type' => 'hidden',
                    'value' => $settings['verbose']
                ),
                'log_table' => array(
                    'type' => 'hidden',
                    'value' => $settings['log_table']
                ),
            ),
        ),
        array(
            'title' => 'logging',
            'desc' => 'logging_desc',
            'fields' => array(
                'logging' => array(
                    'type' => 'yes_no',
                    'value' => $settings['logging']
                ),
            ),
        ),
    ),
    'fine_tuning' => array(
        array(
            'title' => 'strict',
            'desc' => 'strict_desc',
            'fields' => array(
                'strict' => array(
                    'type' => 'yes_no',
                    'value' => $settings['strict']
                ),
            ),
        ),
        array(
            'title' => 'offsite_forms',
            'desc' => 'offsite_forms_desc',
            'fields' => array(
                'offsite_forms' => array(
                    'type' => 'yes_no',
                    'value' => $settings['offsite_forms']
                ),
            ),
        ),
        array(
            'title' => 'whitelisted_ips',
            'desc' => 'whitelisted_ips_desc',
            'fields' => array(
                'whitelisted_ips' => array(
                    'type' => 'textarea',
                    'value' => $settings['whitelisted_ips']
                ),
            ),
        ),
        array(
            'title' => 'whitelisted_urls',
            'desc' => 'whitelisted_urls_desc',
            'fields' => array(
                'whitelisted_urls' => array(
                    'type' => 'textarea',
                    'value' => $settings['whitelisted_urls']
                ),
            ),
        ),
    ),
    'rev_proxy' => array(
        array(
            'title' => 'reverse_proxy',
            'desc' => 'reverse_proxy_desc',
            'fields' => array(
                'reverse_proxy' => array(
                    'type' => 'yes_no',
                    'value' => $settings['reverse_proxy'],
                    'group_toggle' => array(
                        'y' => 'rev_proxy',
                        'n' => '',
                    ),
                ),
            ),
        ),
        array(
            'title' => 'reverse_proxy_header',
            'desc' => 'reverse_proxy_header_desc',
            'group' => 'rev_proxy',
            'fields' => array(
                'reverse_proxy_header' => array(
                    'type' => 'text',
                    'value' => $settings['reverse_proxy_header']
                ),
            ),
        ),
        array(
            'title' => 'reverse_proxy_addresses',
            'desc' => 'reverse_proxy_addresses_desc',
            'group' => 'rev_proxy',
            'fields' => array(
                'reverse_proxy_addresses' => array(
                    'type' => 'textarea',
                    'value' => $settings['reverse_proxy_addresses']
                ),
            ),
        ),
    ),
    'httpbl' => array(
        array(
            'title' => 'httpbl_key',
            'desc' => 'httpbl_key_desc',
            'fields' => array(
                'httpbl_key' => array(
                    'type' => 'text',
                    'value' => $settings['httpbl_key']
                ),
            ),
        ),
        array(
            'title' => 'httpbl_threat',
            'desc' => 'httpbl_threat_desc',
            'fields' => array(
                'httpbl_threat' => array(
                    'type' => 'short-text',
                    'label' => '',
                    'value' => $settings['httpbl_threat']
                ),
            ),
        ),
        array(
            'title' => 'httpbl_maxage',
            'desc' => 'httpbl_maxage_desc',
            'fields' => array(
                'httpbl_maxage' => array(
                    'type' => 'short-text',
                    'label' => '',
                    'value' => $settings['httpbl_maxage']
                ),
            ),
        ),
    )
);

echo ee('View')->make('vz_bad_behavior:form')->render($vars);

ee()->cp->add_js_script(array(
  'file' => array('cp/form_group'),
));

if ($settings['logging'] == 'y') {
    $logs_url = ee('CP/URL')->make('');
    ee()->javascript->output("
        $(function() {
            $('#show_bb_logs').click(function() {
                $(this).remove();
                $('#bb_logs').load(
                    '$logs_url?bb_logs=1',
                    function() {
                        $('#bb_logs table').tablesorter();
                        $('#bb_logs').slideDown();
                    }
                );
                return false;
            });
        });
    ");

    echo '<h2 style="padding:30px 0 10px">' . sprintf(lang('num_blocked'), $blocked_count) . '</h2>';
    echo '<a href="#" id="show_bb_logs" class="btn">' . lang('display_logs') . '</a>';
    echo '<div id="bb_logs" style="display:none"></div>';
}

/* End of file index.php */
/* Location: ./system/user/addons/vz_bad_behavior/views/index.php */