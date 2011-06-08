VZ Bad Behavior
===============

Uses the open-source [Bad Behavior](http://bad-behavior.ioerror.us/) script to block potential spammers, not only from submitting forms, but from even seeing your website. This also helps prevent email-harvesting and server overloads.

Optionally, it will also check requests against [Project Honey Pot's http:BL](http://www.projecthoneypot.org/services_overview.php), a blacklist of known spammers. To use that feature, you will need to sign up for an API key.

The extension settings page also displays detailed logs for the past week (which is as long as Bad Behavior stores log data). This can be useful in resolving false-positives.

Installation
------------

Download and unzip the extension. Upload the "vz_bad_behavior" folder to your /system/expression_engine/third_party/ folder. Finally, enable the extension in your control panel. There are some settings you can use to fine-tune the script, but generally it will work well out of the box.