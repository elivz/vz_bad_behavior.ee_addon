<?php

/**
 * VZ Bad Behavior Add-On Setup File
 *
 * @author    Eli Van Zoeren <eli@elivz.com>
 * @copyright Copyright (c) 2010-2016 Eli Van Zoeren
 * @license   http://opensource.org/licenses/MIT
 */

if ( ! defined('VZ_BAD_BEHAVIOR_VERSION'))
{
    define('VZ_BAD_BEHAVIOR_VERSION', '2.1.0');
}

return array(
    'author'         => 'Eli Van Zoeren / ilab crossmedia',
    'author_url'     => 'http://elivz.com',
    'name'           => 'VZ Bad Behavior',
    'description'    => 'EE implementation of the spam-blocking Bad Behavior script.',
    'version'        => VZ_BAD_BEHAVIOR_VERSION,
    'namespace'      => 'Vz\Bad_Behavior',
    'settings_exist' => TRUE,
);
