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
 * External Web Service for Quiz Password Changer
 *
 * @package    local_mawanquizpasswordchanger
 * @copyright  2025 Mawan Agus Nugroho <mawan911@yahoo.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_mawanquizpasswordchanger\external;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');

/**
 * External Web Service for Quiz Password Changer
 *
 * @package    local_mawanquizpasswordchanger
 * @copyright  2025 Mawan Agus Nugroho <mawan911@yahoo.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class change_password extends \external_api {

    /**
     * Returns description of method parameters
     * @return \external_function_parameters
     */
    public static function execute_parameters() {
        return new \external_function_parameters([
            'token' => new \external_value(PARAM_TEXT, 'Authentication token'),
            'quizid' => new \external_value(PARAM_INT, 'Quiz ID to change password for'),
            'newpassword' => new \external_value(PARAM_TEXT, 'New password for the quiz')
        ]);
    }

    /**
     * Returns description of method result value
     * @return \external_description
     */
    public static function execute_returns() {
        return new \external_single_structure([
            'status' => new \external_value(PARAM_TEXT, 'Status of the operation'),
            'message' => new \external_value(PARAM_TEXT, 'Message describing the result')
        ]);
    }

    /**
     * Change quiz password
     *
     * @param string $token Authentication token
     * @param int $quizid Quiz ID to change password for
     * @param string $newpassword New password for the quiz
     * @return array status and message
     */
    public static function execute($token, $quizid, $newpassword) {
        global $DB;

        // Parameter validation
        $params = self::validate_parameters(self::execute_parameters(), [
            'token' => $token,
            'quizid' => $quizid,
            'newpassword' => $newpassword
        ]);

        // Context validation
        $context = \context_system::instance();
        self::validate_context($context);

        // Validate token (you need to implement this based on your token validation logic)
        // This is just a placeholder - implement your actual token validation
        if (!self::validate_token($params['token'])) {
            throw new \moodle_exception('invalidtoken', 'local_mawanquizpasswordchanger');
        }

        try {
            // Get the quiz
            $quiz = $DB->get_record('quiz', ['id' => $params['quizid']], '*', MUST_EXIST);
            $course = $DB->get_record('course', ['id' => $quiz->course], '*', MUST_EXIST);
            $cm = get_coursemodule_from_instance('quiz', $quiz->id, $course->id, false, MUST_EXIST);
            $context = \context_module::instance($cm->id);

            // Check permissions
            require_capability('mod/quiz:manage', $context);

            // Update the quiz password
            $quiz->password = $params['newpassword'];
            $DB->update_record('quiz', $quiz);

            // Trigger event
            $event = \mod_quiz\event\quiz_updated::create([
                'context' => $context,
                'objectid' => $quiz->id
            ]);
            $event->trigger();

            return [
                'status' => 'success',
                'message' => get_string('passwordchanged', 'local_mawanquizpasswordchanger')
            ];

        } catch (\Exception $e) {
            throw new \moodle_exception('errorchangingpassword', 'local_mawanquizpasswordchanger', '', $e->getMessage());
        }
    }

    /**
     * Validate the provided token
     *
     * @param string $token The token to validate
     * @return bool
     */
    private static function validate_token($token) {
        global $DB;
        
        // Implement your token validation logic here
        // This is just a placeholder - replace with your actual validation
        return true;
    }
}
