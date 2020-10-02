<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package     mod_courseuserspage
 * @category    admin
 * @copyright   2020 Your Name <you@example.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    
    //$navoptions = courseuserspage_get_nav_types();
    $settings->add(new admin_setting_configmultiselect('courseuserspage/navoptions',
        get_string('navoptions', 'mod_courseuserspage'), get_string('navoptions_desc', 'mod_courseuserspage'),
        array_keys($navoptions), $navoptions));

    // Modedit defaults.

    $settings->add(new admin_setting_heading('courseuserseditmodeditdefaults',
        get_string('modeditdefaults', 'admin'), get_string('condifmodeditdefaults', 'admin')));

    $settings->add(new admin_setting_configselect('courseuserspage/numbering',
        get_string('numbering', 'mod_courseuserspage'), '', BOOK_NUM_NUMBERS, $options));

    $settings->add(new admin_setting_configselect('courseuserspage/navstyle',
        get_string('navstyle', 'mod_courseuserspage'), '', BOOK_LINK_IMAGE, $navoptions));
}