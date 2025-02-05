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
 * Plugin upgrade steps are defined here.
 *
 * @package   local_mawanquizpasswordchanger
 * @copyright 2025 Mawan Agus Nugroho <mawan911@yahoo.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Execute local_mawanquizpasswordchanger upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_mawanquizpasswordchanger_upgrade($oldversion) {
    global $DB;

    // Moodle v4.0.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2025020101) {
        // Add new capabilities.
        upgrade_plugin_savepoint(true, 2025020101, 'local', 'mawanquizpasswordchanger');
    }

    return true;
}
