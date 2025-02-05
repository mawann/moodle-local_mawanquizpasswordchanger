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
 * Web service definitions for local_mawanquizpasswordchanger
 *
 * @package    local_mawanquizpasswordchanger
 * @copyright  2025 Mawan Agus Nugroho <mawan911@yahoo.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = [
    'local_mawanquizpasswordchanger_change_password' => [
        'classname'   => 'local_mawanquizpasswordchanger\external\change_password',
        'methodname'  => 'execute',
        'description' => 'Changes the password for a specified quiz',
        'type'        => 'write',
        'ajax'        => true,
        'capabilities'=> 'mod/quiz:manage'
    ]
];

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = [
    'Mawan Quiz Password Changer' => [
        'functions' => ['local_mawanquizpasswordchanger_change_password'],
        'restrictedusers' => 0,
        'enabled' => 1
    ]
];
