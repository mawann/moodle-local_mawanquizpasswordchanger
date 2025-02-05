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
 * Unit tests for local_mawanquizpasswordchanger
 *
 * @package   local_mawanquizpasswordchanger
 * @copyright 2025 Mawan Agus Nugroho <mawan911@yahoo.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/local/mawanquizpasswordchanger/lib.php');

/**
 * Unit tests for local_mawanquizpasswordchanger
 *
 * @package   local_mawanquizpasswordchanger
 * @copyright 2025 Mawan Agus Nugroho <mawan911@yahoo.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_mawanquizpasswordchanger_testcase extends advanced_testcase {

    /**
     * Test setup
     */
    public function setUp(): void {
        $this->resetAfterTest();
        $this->setAdminUser();
    }

    /**
     * Test password generation
     */
    public function test_password_generation() {
        // Test that passwords are 6 digits
        $password = local_mawanquizpasswordchanger_generate_password();
        $this->assertEquals(6, strlen($password));
        $this->assertTrue(ctype_digit($password));
    }

    /**
     * Test token validation
     */
    public function test_token_validation() {
        // Test token validation
        $token = 'test_token';
        $result = local_mawanquizpasswordchanger_validate_token($token);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('valid', $result);
    }

    /**
     * Test settings
     */
    public function test_settings() {
        // Test default settings
        $duration = get_config('local_mawanquizpasswordchanger', 'duration');
        $salt = get_config('local_mawanquizpasswordchanger', 'salt');
        
        $this->assertNotEmpty($duration);
        $this->assertNotEmpty($salt);
    }
}
