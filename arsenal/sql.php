<?php
/*	Project:	EQdkp-Plus
 *	Package:	World of Warcraft @Assasinen game package
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}

$arsenalSQL = array(

	'uninstall' => array(
		1     => 'DROP TABLE IF EXISTS `__arsenal_char`',
		2     => 'DROP TABLE IF EXISTS `__arsenal_guild`',
	),

	'install'   => array(
		1 => "CREATE TABLE `__arsenal_char` (
			`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			`name` TEXT COLLATE utf8_bin NOT NULL,
			`description` TEXT COLLATE utf8_bin NULL,
			`sort_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',
			`active` TINYINT(3) UNSIGNED NULL DEFAULT '0',
			`special` TINYINT(3) UNSIGNED NULL DEFAULT '0',
			`points` INT(10) NULL DEFAULT '0',
			`dkp` FLOAT(11,2) NULL DEFAULT NULL,
			`icon` TEXT NULL COLLATE 'utf8_bin',
			`icon_colors` TEXT NULL COLLATE 'utf8_bin',
			`module` TEXT NULL COLLATE 'utf8_bin',
			`module_set` TEXT NULL COLLATE 'utf8_bin',
			`event_id` INT(10) UNSIGNED NULL DEFAULT '0',
			PRIMARY KEY (`id`)
		) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
		",
		2 => "CREATE TABLE `__arsenal_guild` (
			`data` varchar(120) COLLATE utf8_bin NOT NULL,
			`flag` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT 'global',
			`value` text COLLATE utf8_bin,
			PRIMARY KEY (`data`, `key`)
		
		
		
		
		
			`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			`date` INT(11) NOT NULL DEFAULT '0',
			`achievement_id` INT(10) UNSIGNED NOT NULL,
			`adj_id` VARCHAR(255) NULL DEFAULT NULL,
			`adj_group_key` VARCHAR(32) NULL DEFAULT NULL,
			PRIMARY KEY (`id`)
		) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
		",
	)
);

?>