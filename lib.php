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

/**
 * This function assigns / unassigns the complete role (with complete interface) to users that have a simple role
 * (editingteacher mostly but without some addinstance capacities).
 * If 'interface' preference is 1 it assigns, if not it unassigns.
 *
 */

function expert_role_assign($courses, $user, $rolesimple, $rolecomplete) {
    foreach ($courses as $course) {
        $result = '';
        $contextcourse = context::instance_by_id($course->ctxid, MUST_EXIST);
        $roles = get_user_roles($contextcourse, $user->id);
        $config = get_config('local_expertrole');
        if ($config->updateall == 1) {
            $user->pref = 1;
        }
        foreach ($roles as $role) {
            if ($role->roleid == $rolecomplete) {
                if ($user->pref != 1) {// We don't want the complete interface, thus we unassign the role.
                    $result = role_assign($rolesimple, $user->id, $contextcourse->id);
                    role_unassign($rolecomplete, $user->id, $contextcourse->id);
                } else {
                    break;// The role for complete interface exists and we want it. Thus we do nothing.
                }
            }
            if ($role->roleid == $rolesimple && $user->pref == 1) {
                $result = role_assign($rolecomplete, $user->id, $contextcourse->id);
                role_unassign($rolesimple, $user->id, $contextcourse->id);
                break;
            }
        }
    }
    return $result;
}

/**
 * Add a user preference to choose complete interface or not
 */
function local_expertrole_extend_navigation_user_settings($navigation, $user) {
    global $USER, $PAGE;

    // Don't bother doing needless calculations unless we are on the relevant pages and if no capacity to create courses.
    $onpreferencepage = $PAGE->url->compare(new moodle_url('/user/preferences.php'), URL_MATCH_BASE);
    $onexpertpage = $PAGE->url->compare(new moodle_url('/local/expertrole/pref.php'), URL_MATCH_BASE);
    $systemcontext = context_system::instance();
    if (!has_capability('moodle/course:create', $systemcontext, $USER->id)) {
        return null;
    }
    if (!$onpreferencepage && !$onexpertpage) {
        return null;
    }

    // Don't show the setting if the event monitor isn't turned on. No access to other peoples subscriptions.
    if (get_config('local_expertrole', 'rolecomplete') && $USER->id == $user->id) {
        // Now let's check to see if the user has any courses / site rules that they can subscribe to.
        // We skip doing a check here if we are on the event monitor page as the check is done internally on that page.
        $node = navigation_node::create(get_string('interfacetitle', 'local_expertrole'), null,
                navigation_node::TYPE_CONTAINER, null, 'interfacetitle');

        if (isset($node) && !empty($navigation)) {
            $navigation->add_node($node);
        }

        $url = new moodle_url('/local/expertrole/pref.php');
        $subsnode = navigation_node::create(get_string('interface', 'local_expertrole'), $url,
                navigation_node::TYPE_SETTING, null, 'interface', new pix_icon('i/settings', ''));

        if (isset($subsnode) && !empty($navigation)) {
            $node->add_node($subsnode);
        }
    }
}

/**
 * Validating the new preference
 */

function local_expertrole_user_preferences() {
    $preferences = array();
    $preferences['completeinterface'] = array(
        'type' => PARAM_INT,
        'null' => NULL_NOT_ALLOWED,
        'default' => 0,
        'choices' => array(0, 1)
    );
    return $preferences;
}

function get_user_interface_preference($user) {
    // We look for the interface preference and add it to the user object.
    $pref = get_user_preferences('completeinterface', false, $user->id);
    $user->pref = $pref;
    return $user;
}