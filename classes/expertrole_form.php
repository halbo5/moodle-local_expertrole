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
 * Local plugin "Expert Role" - Preference form
 *
 * @package    local_expertrole
 * @copyright  2017 Alain Bolli, <alain.bolli@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_expertrole;

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');  // It must be included from a Moodle page.
}

require_once($CFG->dirroot.'/lib/formslib.php');

class expertrole_form extends \moodleform {

    /**
     * Define the form.
     */
    public function definition () {
        global $COURSE;

        $mform = $this->_form;

        $mform->addElement('advcheckbox',
            'enablecompleteinterface',
            get_string('enablecompleteinterface', 'local_expertrole'),
            get_string('configenablecompleteinterface', 'local_expertrole'));
        $mform->setDefault('enablecompleteinterface',
            get_user_preferences('completeinterface', false, $this->_customdata['userid']));

        // Add some extra hidden fields.
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'course', $COURSE->id);
        $mform->setType('course', PARAM_INT);

        $this->add_action_buttons(true, get_string('savechanges'));
    }
}