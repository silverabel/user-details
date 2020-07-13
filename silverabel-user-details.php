<?php declare(strict_types=1);
/*
Plugin Name: User Details
Author: Silver Abel
Version: 1.0
License:     GPL3

User Details is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

User Details is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with User Details. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
*/
namespace silverabel;

require_once('includes/UserDetailsPlugin.php');

defined('ABSPATH') or die('No script kiddies please!');

UserDetailsPlugin::addHooks();
