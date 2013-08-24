<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang = array(

// Settings labels
'fine_tuning'           => 'Fine Tuning',
'enabled'               => 'Enable Bad Behavior?',
'logging'               => 'Enable Logging?',
'logging_desc'          => 'You can turn this off for very busy sites to decrease your database usage, but you will have no way to troubleshoot false positives.',
'strict'                => 'Strict Mode',
'strict_desc'           => 'Runs additional checks, but may block some government or corporate visitors.',
'offsite_forms'         => 'Allow off-site posting to forms',
'offsite_desc'          => 'Usually only needed if you support OpenID or are running an API that accepts form data from other websites.',
'whitelisted_ips'       => 'Whitelisted IPs',
'whitelist_ips_desc'    => 'Visitors from these IP addresses will always be allowed. One IP address per line.',
'whitelisted_urls'      => 'Whitelisted URIs',
'whitelist_urls_desc'   => 'Visits to these urls will always be allowed. One URI (or partial URI) per line. You may also enclose a pattern with tildes to perform regular expression matching, e.g. <code>~/blog/\\\d{4}(/\\\d{2})?$~i</code><br/><br/>Note that the trailing slash (if there is one) is stripped before matching.',

'rev_proxy'             => 'Reverse Proxy',
'enable_rev_proxy'      => 'Enable Reverse Proxy?',
'rev_proxy_desc'        => 'If you are using Bad Behavior behind a reverse proxy, load balancer, HTTP accelerator, content cache or similar technology, enable the Reverse Proxy option.',
'rev_proxy_header'      => 'Reverse Proxy Header',
'rev_proxy_header_desc' => 'Your reverse proxy servers must set the IP address of the Internet client from which they received the request in an HTTP header. If you don\'t specify a header, X-Forwarded-For will be used. Most proxy servers already support X-Forwarded-For and you would then only need to ensure that it is enabled on your proxy servers. Some other header names in common use include X-Real-Ip (nginx) and Cf-Connecting-Ip (CloudFlare).',
'rev_proxy_ips'         => 'IP Addresses or CIDR Ranges of Proxy Servers',
'rev_proxy_ips_desc'    => 'If you have a chain of two or more reverse proxies between your server and the public Internet, you must specify all of the IP address ranges (in CIDR format) of all of your proxy servers, load balancers, etc. Otherwise, Bad Behavior may be unable to determine the client\'s true IP address. One address per line.',

'httpbl'                => 'http:BL Settings',
'httpbl_key'            => 'http:BL API Key',
'httpbl_key_desc'       => 'Bad Behavior can optionally use Project Honey Pot\'s http:BL service to check visitor IP addresses against a known list of spammers. You will need an <a href="http://www.projecthoneypot.org/">API key</a> from Project Honey Pot to enable this feature.',
'httpbl_threat'         => 'http:BL Threat Level',
'httpbl_threat_desc'    => 'If the Project Honey Pot rates a given IP address above this level, it will be blocked. <a href="http://www.projecthoneypot.org/threat_info.php">Read more about how this works</a>.',
'httpbl_maxage'         => 'http:BL Maximum Age',
'httpbl_maxage_desc'    => 'If no spam activity has been detected in at least this many days, allow traffic from the IP address.',

'num_blocked'           => "Bad Behavior has blocked %s access attempts in the past week.",
'display_logs'          => "Display detailed logs",
'date'                  => "Date",
'ip'                    => "IP Address",
'uri'                   => "Request URI",
'method'                => "Request Method",
'protocol'              => "Server Protocol",
'user_agent'            => "User Agent",
'key'                   => "Technical Support Key",

'' => ''
);

/* End of file lang.vz_bad_behavior.php */
/* Location: /system/expressionengine/third_party/vz_bad_behavior/language/english/lang.vz_bad_behavior.php */
