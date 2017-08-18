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

function xmldb_local_expertrole_install() {

    global $CFG, $DB;
    require_once($CFG->dirroot.'/local/expertrole/pluginconfig.php');
    if ($pluginconfig->updatepreference == 1) {

        $roleid = $pluginconfig->roleid;
        $context = context_system::instance();
        $usersid = get_role_users($roleid, $context, false, 'u.id', 'u.id', true);
        foreach ($usersid as $user) {
            $userid = $user->id;
            $courses = enrol_get_all_users_courses($userid, false, 'id', 'visible DESC,sortorder ASC');
            foreach ($courses as $course) {
                $courseid = $course->id;
                $coursecontext = context_course::instance($course->id);
                if (has_capability('moodle/course:update', $coursecontext, $userid)) {
                    $advanced = $pluginconfig->activities;
                    $courseactivities = get_array_of_activities($courseid);
                    $array = array();
                    foreach ($courseactivities as $activity) {
                        $array[] = $activity->mod;
                    }
                    $activities = array_diff($advanced, $array);

                    if ($activities != $advanced) {
                        $table = 'user_preferences';
                        $record = new StdClass();
                        $record->userid = $userid;
                        $record->name = "completeinterface";
                        $record->value = 1;
                        $pref = $DB->get_record($table, array('userid' => $userid, 'name' => 'completeinterface'));

                        if (!$pref) {
                            $DB->insert_record($table, $record, true, false);
                            break;
                        }
                    }
                }
            }
        }
    }
}