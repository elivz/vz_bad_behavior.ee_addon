VZ Bad Behavior
===============

Uses the open-source [Bad Behavior](http://bad-behavior.ioerror.us/) script to block potential spammers, not only from submitting forms, but from even seeing your website. This also helps prevent email-harvesting and server overloads.

Optionally, it will also check requests against [Project Honey Pot's http:BL](http://www.projecthoneypot.org/services_overview.php), a blacklist of known spammers. To use that feature, you will need to sign up for an API key.

The extension settings page also displays detailed logs for the past week (which is as long as Bad Behavior stores log data). This can be useful in resolving false-positives.

Installation
------------

Download and unzip the extension. Upload the "vz_bad_behavior" folder to your /system/expression_engine/third_party/ folder. Finally, enable the extension in your control panel. There are some settings you can use to fine-tune the script, but generally it will work well out of the box.

Configuration
-------------

All options are configurable through the extension's control panel page. If you prefer, you may also set the options via your configuration file (for example, if you want different settings on your development vs. you production server). Settings in config.php will override anything you have set through the control panel. All of the available options are listed here:

    $config['vz_bad_behavior']['enabled'] = 'y';
    $config['vz_bad_behavior']['logging'] = 'y';
    $config['vz_bad_behavior']['strict'] = 'n';
    $config['vz_bad_behavior']['offsite_forms'] = 'n';
    $config['vz_bad_behavior']['whitelisted_ips'] = '';
    $config['vz_bad_behavior']['whitelisted_urls'] = '';
    $config['vz_bad_behavior']['reverse_proxy'] = 'n';
    $config['vz_bad_behavior']['reverse_proxy_header'] = 'X-Forwarded-For';
    $config['vz_bad_behavior']['reverse_proxy_addresses'] = '127.0.0.1';
    $config['vz_bad_behavior']['httpbl_key'] => '';
    $config['vz_bad_behavior']['httpbl_threat'] = '25';
    $config['vz_bad_behavior']['httpbl_maxage'] = '30';