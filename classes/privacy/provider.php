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

namespace local_mawanquizpasswordchanger\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\user_preference_provider;
use core_privacy\local\request\writer;

/**
 * Privacy Subsystem implementation for local_mawanquizpasswordchanger.
 *
 * @package    local_mawanquizpasswordchanger
 * @copyright  2025 Mawan Agus Nugroho <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\user_preference_provider {

    /**
     * Returns metadata about this plugin's privacy features.
     *
     * @param collection $collection The initialised collection to add items to.
     * @return collection A listing of user data stored through this system.
     */
    public static function get_metadata(collection $collection): collection {
        $collection->add_external_location('mawan_quiz_password', [
            'serial_number' => 'privacy:metadata:serialnumber',
            'valid_until' => 'privacy:metadata:validuntil',
        ], 'privacy:metadata:mawanquizpasswordchanger');
        return $collection;
    }

    /**
     * Export all user preferences for the plugin.
     *
     * @param int $userid The userid of the user whose data is to be exported.
     */
    public static function export_user_preferences(int $userid) {
        // No user preferences are stored in this plugin.
    }
}
