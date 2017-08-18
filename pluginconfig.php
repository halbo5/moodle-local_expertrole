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

$pluginconfig = new StdClass();
// Shall we search for "advanced" teachers and change preference for them ?
// If 0 => do nothing.
$pluginconfig->updatepreference = 1;
// Activity to search to decide if teacher is "advanced".
$pluginconfig->activities = array('choice', 'data', 'glossary', 'lesson', 'scorm', 'workshop', 'hotpot', 'choicegroup', 'attendance');
// Roleid for the course creators. In a default install it is 2.
$pluginconfig->roleid = 14;