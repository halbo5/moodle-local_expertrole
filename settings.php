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
 * Local plugin "Expert Role"
 *
 * @package    local_expertrole
 * @copyright  2017 Alain Bolli, <alain.bolli@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) . '/lib.php');

if ($hassiteconfig) {
    // New settings page.
    $page = new admin_settingpage('local_expertrole',
            get_string('pluginname', 'local_expertrole', null, true));


    if ($ADMIN->fulltree) {
        // Add remove nodes heading.
        $page->add(new admin_setting_heading('local_expertrole/completeinterface',
                get_string('setting_completeinterface', 'local_expertrole', null, true),
                ''));
        // Choose role with simple interface.
        $defineurl = $CFG->wwwroot . '/' . $CFG->admin . '/roles/define.php';
        $systemcontext = context_system::instance();
        $roles = role_fix_names(get_all_roles(), $systemcontext, ROLENAME_ORIGINAL);
        $name = 'local_expertrole/rolesimple';
        $title = get_string('setting_rolesimple', 'local_expertrole');
        $description = get_string('setting_rolesimple_desc', 'local_expertrole');
        $default = 'default';
        $choices = [];
        $choices['default'] = get_string('chooserole', 'local_expertrole');
        foreach ($roles as $role) {
            $choices[$role->id] = $role->localname;
        }
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $page->add($setting);

        // Choose role with complete interface.
        $name = 'local_expertrole/rolecomplete';
        $title = get_string('setting_rolecomplete', 'local_expertrole');
        $description = get_string('setting_rolecomplete_desc', 'local_expertrole');
        $default = 3;
        $choices = [];
        foreach ($roles as $role) {
            $choices[$role->id] = $role->localname;
        }
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $page->add($setting);

        // Choose course creator role.
        $name = 'local_expertrole/coursecreator';
        $title = get_string('setting_coursecreator', 'local_expertrole');
        $description = get_string('setting_coursecreator_desc', 'local_expertrole');
        $default = 2;
        $choices = [];
        foreach ($roles as $role) {
            $choices[$role->id] = $role->localname;
        }
        $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
        $page->add($setting);

        // Assign complete role to all course creators.
        $name = 'local_expertrole/updateall';
        $title = get_string('setting_updateall', 'local_expertrole');
        $description = get_string('setting_updateall_desc', 'local_expertrole');
        $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
        $page->add($setting);
    }

    // Add settings page to the users settings category.
    $ADMIN->add('users', $page);
}