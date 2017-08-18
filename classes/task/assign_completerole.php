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

namespace local_expertrole\task;

defined('MOODLE_INTERNAL') || die();

class assign_completerole extends \core\task\scheduled_task {
    public function get_name() {
        // Shown in admin screens.
        return get_string('taskassigncompleterole', 'local_expertrole');
    }

    public function execute() {
        $context = \context_system::instance();
        $config = \get_config('local_expertrole');
        $roleid = $config->coursecreator;
        $usersid = \get_role_users($roleid, $context, false, 'u.id', 'u.id', true);
        foreach ($usersid as $user) {
            $userid = $user->id;
            // Trigger interface updated event.
            \local_expertrole\event\interface_updated::create_from_userid($userid)->trigger();
        }
    }
}