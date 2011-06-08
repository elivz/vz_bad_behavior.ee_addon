<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang = array(

    // Settings labels
    'fine_tuning'      => 'Fine Tuning',
	'strict'           => 'Strict Mode',
	'strict_desc'      => 'Runs additional checks, but may block some government or corporate visitors.',
	'offsite_forms'    => 'Allow off-site posting to forms',
	'offsite_desc'     => 'Usually only needed if you support OpenID or are running an API that accepts form data from other websites.',
	
	'httpbl'           => 'http:BL Settings',
	'httpbl_key'       => 'http:BL API Key',
	'httpbl_key_desc'  => 'Bad Behavior can optionally use Project Honey Pot\'s http:BL service to check visitor IP addresses against a known list of spammers. You will need an <a href="http://www.projecthoneypot.org/">API key</a> from Project Honey Pot to enable this feature.',
	'httpbl_threat'    => 'http:BL Threat Level',
	'httpbl_threat_desc' => 'If the Project Honey Pot rates a given IP address above this level, it will be blocked. <a href="http://www.projecthoneypot.org/threat_info.php">Read more about how this works</a>.',
	'httpbl_maxage'    => 'http:BL Maximum Age',
	'httpbl_maxage_desc' => 'If no spam activity has been detected in at least this many days, allow traffic from the IP address.',
    
	'' => ''
);

/* End of file lang.vz_bad_behavior.php */
/* Location: /system/expressionengine/third_party/vz_bad_behavior/language/english/lang.vz_bad_behavior.php */
