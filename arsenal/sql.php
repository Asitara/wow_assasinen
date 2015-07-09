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
			`id` SMALLINT(5) NOT NULL,
			`name` VARCHAR(30) NOT NULL,
			`title` INT(11) NULL DEFAULT NULL,
			`gender` INT(11) NOT NULL DEFAULT '2',
			`race` SMALLINT(3) NOT NULL DEFAULT '0',
			`class` SMALLINT(3) NOT NULL DEFAULT '0',
			`level` SMALLINT(3) NOT NULL DEFAULT '85',
			`last_update` INT(10) NULL DEFAULT NULL,
			`stats` TEXT NULL,
			`titles` TEXT NULL,
			`reputation` TEXT NULL,
			`currencies` TEXT NULL,
			`talents` TEXT NULL,
			`professions` TEXT NULL,
			`mounts` TEXT NULL,
			`critters` TEXT NULL,
			`inventory` TEXT NULL,
			`achievements` TEXT NULL
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