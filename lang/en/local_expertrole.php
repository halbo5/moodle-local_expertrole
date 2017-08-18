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

$string['pluginname'] = 'Expert Role';
$string['setting_completeinterface'] = 'Interface choice';
$string['setting_rolesimple'] = "Role with simple interface";
$string['setting_rolesimple_desc'] = "Role with simple interface : for example the editing teacher role but with less capacities (remove some addinstance)";
$string['setting_rolecomplete'] = "Role with complete interface";
$string['setting_rolecomplete_desc'] = "Role with complete interface : can be a very simple role with only the capacities you removed from the simple role";
$string['setting_coursecreator'] = "System Role for course creators";
$string['setting_coursecreator_desc'] = "System Role where you find the course creators. This parameter is used by the task that assigns simple role after plugin installation.";
$string['setting_updateall'] = "Complete role for all";
$string['setting_updateall_desc'] = "Activate this setting if you want to assign the omplete role to all creators, for example before uninstalling this plugin. Once this setting activated, execute the task assign_completerole.";
$string['chooserole'] = "Choose a role";
$string['interface'] = "Choose interface";
$string['enablecompleteinterface'] = 'Enable complete interface';
$string['configenablecompleteinterface'] = 'By default, you have a limited interface (no much choice for activities), but easier to use. Select the setting to activate the complete interface with all functionalities. Moodle will be more complex, but you will have all its potential in your hands.';
$string['eventinterfaceupdated'] = "Interface updated";
$string['interfacetitle'] = 'Expert role';
$string['taskassignrole'] = "Assign simple role";
$string['taskassigncompleterole'] = "Assign complete role to all";