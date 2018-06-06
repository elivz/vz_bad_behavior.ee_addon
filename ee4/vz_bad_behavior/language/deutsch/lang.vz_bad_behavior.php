<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang = array(

// Settings labels
'config'                => 'Bad Behavior Konfiguration',
'fine_tuning'           => 'Fine Tuning',
'enabled'               => 'Bad Behavior aktivieren?',
'logging'               => 'Logging aktivieren?',
'logging_desc'          => 'Für Seiten unter hoher Last kann diese Funktion ausgeschalten werden um den Datenbank-Server zu entlasten, allerdings können falsche Treffer nicht mehr untersucht werden.',
'strict'                => 'Stricter Modus',
'strict_desc'           => 'Zusätzliche Tests werden durchgeführt, das kann allerdings bei Besuchern aus Firmen- oder Regierungsnetzwerken Probleme verursachen.',
'offsite_forms'         => 'Off-site posting auf Formulare erlauben',
'offsite_forms_desc'    => 'Dieses Feature wird nurmalerweise nur benötigt wenn OpenID unterstützt wird, oder eine API betrieben wird, die Daten von anderen Websites verarbeitet.',
'whitelisted_ips'       => 'Whitelisted IPs',
'whitelisted_ips_desc'  => 'Besucher, die von dieser IP aus zugreifen, werden niemals geblockt. Eine IP-Adresse pro Zeile.',
'whitelisted_urls'      => 'Whitelisted URIs',
'whitelisted_urls_desc' => 'Besucher, die auf diese URLs zugreifen, werden nicht geblockt. Eine URI (or URI-Teil) pro Zeile. Es konen auch reguläre Ausdrücke verwendet werden, z. B. <code>~/blog/\\\d{4}(/\\\d{2})?$~i</code><br/><br/>Anmerkung: der abschließende Slash (falls vorhanden) wird vor dem ausführen entfernt.',

'rev_proxy'                    => 'Reverse Proxy',
'reverse_proxy'                => 'Reverse Proxy erlauben?',
'reverse_proxy_desc'           => 'Falls Bad Behavior hinter einem Reverse Proxy, Load-Balancer, HTTP Beschleuniger oder Content-Cache (oder einer ähnlichen Technologie) ausgeführt wird, ist die Reverse Proxy option zu aktivieren.',
'reverse_proxy_header'         => 'Reverse Proxy Header',
'reverse_proxy_header_desc'    => 'Der eingesetzte Reverse-Proxy-Server muss die IP des Clients, von dem die Anfrage ausging, im HTTP Header setzen. Sollte kein Header angegeben werden wird ein X-Forwarded-For Header verwendet. Die meisten Proxy-Server unterstützen X-Forwarded-For, es muss nur sichergestellt sein, dass diese Einstellung am Proxy-Server aktiviert ist. Andere gebräuchliche Header wären X-Real-Ip (nginx) oder Cf-Connecting-Ip (CloudFlare).',
'reverse_proxy_addresses'      => 'IP Addressen oder CIDR Bereiche des Proxy-Servers',
'reverse_proxy_addresses_desc' => 'Sollten mehrere Reverse-Proxy-Server zwischen dem Webserver und dem öffentlichen internet vorhanden sein, so müssen die Adressbereiche aller Server angegeben werden (im CIDR format). Ansonsten ist Bad Behavior nicht in der Lage die IP-Adresse des Clients zu eruieren. Eine Adresse pro Zeile.',

'httpbl'             => 'http:BL Einstellungen',
'httpbl_key'         => 'http:BL API Key',
'httpbl_key_desc'    => 'Bad Behavior kann optional das Service vom Project Honey Pot\'s http:BL verwenden um IP-Adressen von Besuchern mit einer Liste von bekannten Spammern abzugleichen. Der <a href="http://www.projecthoneypot.org/">API key</a> von Project Honey Pot muss eingegeben werden.',
'httpbl_threat'      => 'http:BL Threat Level',
'httpbl_threat_desc' => 'If the Project Honey Pot rates a given IP address above this level, it will be blocked. <a href="http://www.projecthoneypot.org/threat_info.php">Read more about how this works</a>.',
'httpbl_maxage'      => 'http:BL Maximum Age',
'httpbl_maxage_desc' => 'If no spam activity has been detected in at least this many days, allow traffic from the IP address.',

'num_blocked'  => "Bad Behaviour hat %s Zugriffsversuche in der vergangenen Woche blockiert.",
'display_logs' => "Detaillierte Logs anzeigen",
'date'         => "Datum",
'ip'           => "IP Address",
'uri'          => "Request URI",
'method'       => "Request Methode",
'protocol'     => "Server Protokoll",
'user_agent'   => "User Agent",
'key'          => "Technischer Support Key",

);

/* End of file lang.ilab_bad_behavior.php */
/* Location: /system/user/addons/ilab_bad_behavior/language/english/lang.ee3_bad_behavior.php */
