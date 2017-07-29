<?php
/// This file is part of Moodle - http://moodle.org/
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
 * Local plugin "Expert Role" - Event's observer
 *
 * @package    local_expertrole
 * @copyright  2017 Alain Bolli, <alain.bolli@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
global $CFG;
require_once($CFG->dirroot . '/local/expertrole/lib.php');

/**
 * Event observer for local_expertrole.
 */
class local_expertrole_observer {

    /**
     * Observer for role_assigned event.
     *
     * @param \core\event\role_assigned $event
     * @return void
     */
    public static function course_created(\core\event\course_created $event) {
        global $USER,$DB;

        $context_id = $event->contextid;
        $context = context::instance_by_id($context_id, MUST_EXIST);

        if ($context->contextlevel != CONTEXT_COURSE) {
            return;
        }
        $config = get_config('local_expertrole');

        if (has_capability('moodle/course:create', $context) && isset($config->rolesimple) && isset($config->rolecomplete)) {
            $rolesimple = $config->rolesimple;
            $rolecomplete = $config->rolecomplete;
            $user = $DB->get_record('user', array('id' => $event->userid));
            $usernew = get_user_interface_preference($user);

            // If role is the one identified in plugin parameters and if user enabled the complete interface.
            if ($usernew->pref == 1){
            role_assign($rolecomplete, $event->userid, $context->id);
            }
        }
    }

    public static function interface_updated(local_expertrole\event\interface_updated $event){

        global $PAGE,$DB;
        $config = get_config('local_expertrole');
        $userid = $event->relateduserid;
        $context = $PAGE->context;
        // If user has course:create capacity and plugin expertrole is enabled, we assign the complete role.
        if (has_capability('moodle/course:create', $context, $userid) && isset($config->rolesimple) && isset($config->rolecomplete)) {
            $rolesimple = $config->rolesimple;
            $rolecomplete = $config->rolecomplete;
            // Get user courses.
            $courses = enrol_get_users_courses($userid);
            $user = $DB->get_record('user', array('id' => $userid));
            // Get user preferences for the interface.
            $usernew = get_user_interface_preference($user);
            // We assign the "complete" role in courses where the user has the "simple" role (editing teacher mostly). 
            expert_role_assign($courses, $usernew, $rolesimple, $rolecomplete);
        }
    }
}
