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

if(!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}

if(!class_exists('wow_assasinen')){
	class wow_assasinen extends game_generic {
		
		protected static $apiLevel	= 20;
		public $version				= '1.0.0';
		protected $this_game		= 'wow_assasinen';
		protected $types			= array('factions', 'races', 'classes', 'talents', 'filters', 'realmlist', 'roles', 'classrole', 'professions', 'chartooltip');
		protected $classes			= array();
		protected $roles			= array();
		protected $races			= array();
		protected $factions			= array();
		protected $filters			= array();
		protected $realmlist		= array();
		protected $professions		= array();
		public $objects				= array();
		public $no_reg_obj			= array();
		public $langs				= array('german', 'english');
		public $importers 			= array();
		
		public $character_unique_ids = array('servername');
			
		protected $ArrInstanceCategories = array(
			'classic'	=> array(2717, 2677, 3429, 3428),
			'bc'		=> array(3457, 3836, 3923, 3607, 3845, 3606, 3959, 4075),
			'wotlk'		=> array(4603, 3456, 4493, 4500, 4273, 2159, 4722, 4812, 4987),
			'cataclysm'	=> array(5600, 5094, 5334, 5638, 5723, 5892),
		);
		
		protected $class_dependencies = array(
			array(
				'name'		=> 'faction',
				'type'		=> 'factions',
				'admin' 	=> true,
				'decorate'	=> false,
				'parent'	=> false,
			),
			array(
				'name'		=> 'race',
				'type'		=> 'races',
				'admin'		=> false,
				'decorate'	=> true,
				'parent'	=> array(
					'faction' => array(
						'horde'		=> array(0,5,6,7,8,10,12),
						'alliance'	=> array(0,1,2,3,4,9,11),
					),
				),
			),
			array(
				'name'		=> 'class',
				'type'		=> 'classes',
				'admin'		=> false,
				'decorate'	=> true,
				'primary'	=> true,
				'colorize'	=> true,
				'roster'	=> true,
				'recruitment' => true,
				'parent'	=> array(
					'race' => array(
						0 	=> 'all',							// Unknown
						1 	=> array(1,4,6,7,9,10,11),			// Gnome
						2 	=> array(1,3,4,5,6,7,9,10,11),		// Human
						3 	=> array(1,3,4,5,6,7,8,9,10,11),	// Dwarf
						4 	=> array(1,2,3,4,6,7,10,11),		// Night Elf
						5 	=> array(1,2,3,4,6,7,8,9,10,11),	// Troll
						6 	=> array(1,3,4,6,7,9,10,11),		// Undead
						7 	=> array(1,3,4,7,8,9,10,11),		// Orc
						8 	=> array(1,2,3,5,6,8,10,11),		// Tauren
						9 	=> array(1,3,4,5,6,8,10,11),		// Draenai
						10 	=> array(1,3,4,5,6,7,9,10,11),		// Blood Elf
						11 	=> array(1,2,3,4,6,7,9,10),			// Worgen
						12 	=> array(1,3,4,6,7,8,9,10),			// Goblin
					),
				),
			),
			array(
				'name'		=> 'talent1',
				'type'		=> 'talents',
				'admin'		=> false,
				'decorate'	=> false,
				'recruitment' => true,
				'parent'	=> array(
					'class' => array(
						0 	=> 'all',			// Unknown
						1 	=> array(0,1,2),	// Death Knight
						2 	=> array(3,4,5,6),	// Druid
						3 	=> array(7,8,9),	// Hunter
						4 	=> array(10,11,12),	// Mage
						5 	=> array(13,14,15),	// Paladin
						6 	=> array(16,17,18),	// Priest
						7 	=> array(19,20,21),	// Rogue
						8 	=> array(22,23,24),	// Shaman
						9 	=> array(25,26,27),	// Warlock
						10 	=> array(28,29,30),	// Warrior
					),
				),
			),
			array(
				'name'		=> 'talent2',
				'type'		=> 'talents',
				'admin'		=> false,
				'decorate'	=> false,
				'parent'	=> array(
					'class' => array(
						0 	=> 'all',			// Unknown
						1 	=> array(0,1,2),	// Death Knight
						2 	=> array(3,4,5,6),	// Druid
						3 	=> array(7,8,9),	// Hunter
						4 	=> array(10,11,12),	// Mage
						5 	=> array(13,14,15),	// Paladin
						6 	=> array(16,17,18),	// Priest
						7 	=> array(19,20,21),	// Rogue
						8 	=> array(22,23,24),	// Shaman
						9 	=> array(25,26,27),	// Warlock
						10 	=> array(28,29,30),	// Warrior
					),
				),
			),
		);
		
		public $default_roles = array(
			1	=> array(2, 5, 6, 8, 11),			// Healer
			2	=> array(1, 2, 5, 10, 11),			// Tank
			3	=> array(2, 3, 4, 6, 8, 9),			// DD Distance
			4	=> array(1, 2, 5, 7, 8, 10, 11)		// DD Melee
		);
		
		public $default_classrole = array(
			1	=> 4,	// Death Knight
			2	=> 4,	// Druid
			3	=> 3,	// Hunter
			4	=> 3,	// Mage
			5	=> 4,	// Paladin
			6	=> 3,	// Priest
			7	=> 4,	// Rogue
			8	=> 4,	// Shaman
			9	=> 3,	// Warlock
			10	=> 4,	// Warrior
		);
		
		protected $class_colors = array(
			1	=> '#C41F3B',
			2	=> '#FF7C0A',
			3	=> '#AAD372',
			4	=> '#68CCEF',
			5	=> '#F48CBA',
			6	=> '#FFFFFF',
			7	=> '#FFF468',
			8	=> '#1a3caa',
			9	=> '#9382C9',
			10	=> '#C69B6D',
		);
		
		protected $glang		= array();
		protected $lang_file	= array();
		protected $path			= '';
		public $lang			= false;


		/* Constructor */
		public function __construct() {
			parent::__construct();
			
			$this->pdh->register_read_module($this->this_game, $this->path.'pdh/read/'.$this->this_game);
			
			// Meine Klasse und mein benötigtes PDH Modul
			registry::add_class('wow_arsenal', $this->path.'arsenal/', 'arsenal');
			$this->pdh->register_read_module('arsenal_character', $this->path.'pdh/read/arsenal_character');
			$this->pdh->register_write_module('arsenal_character', $this->path.'pdh/write/arsenal_character');
			
			$this->importers = array(
				'char_import'		=> 'charimporter.php',	// filename of the character import
				'char_update'		=> 'charimporter.php',	// filename of the character update, member_id (POST) is passed
				'guild_import'		=> 'guildimporter.php',	// filename of the guild import
				'guild_imp_rsn'		=> false,				// Guild import & Mass update requires server name
				'import_data_cache'	=> false,				// Is the data cached and requires a reset call?
			);
			
		}


		/* Install Routine */
		public function install($blnEQdkpInstall=false){
			// include arsenalSQL and default configuration data for installation
#			include($this->path.'arsenal/sql.php');
#			for ($i = 1; $i <= count($arsenalSQL['install']); $i++)
#				$this->db->query($arsenalSQL['install'][$i]);
			
			// Gilde -- Events
			$arrEventIDs = $arrDefaultEventIDs = array();
			$arrEventIDs[] = $this->game->addEvent($this->glang('misc_guildnews'), 0, "");
			$arrEventIDs[] = $this->game->addEvent($this->glang('misc_guildmeeting'), 0, "unknown.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('misc_guildbank'), 0, "Achievement_guildperk_mobilebanking.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('misc_startpoints'), 0, "");
			// Raids -- Cataclysm
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_bh_normal'), 0, "mag.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_bwd_normal'), 0, "bd.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_bwd_heroic'), 0, "bd.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_bot_normal'), 0, "bot.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_bot_heroic'), 0, "bot.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_tot4w_normal'), 0, "tfw.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_tot4w_heroic'), 0, "tfw.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_fl_normal'), 0, "fl.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_fl_heroic'), 0, "fl.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_ds_normal'), 0, "ds.png");
			$arrDefaultEventIDs[] = $this->game->addEvent($this->glang('cata_ds_heroic'), 0, "ds.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('evnt_pokernacht'), 0, "Achievement_guildperk_ladyluck_rank2.png");
			$arrEventIDs[] = $this->game->addEvent($this->glang('evnt_ahnqiraj'), 0, "aq10.png");
			
			$this->game->updateDefaultMultiDKPPool('Default', 'Default MultiDKPPool', $arrDefaultEventIDs);

			$intItempoolGilde = $this->game->addItempool("Gilde", "Gilden Itempool");
			$this->game->addMultiDKPPool("Gilde", "Gilden MultiDKPPool", $arrEventIDs, array($intItempoolGilde));
			
			//Links
			#$this->game->addLink('WoW Battle.net', 'http://eu.battle.net/wow/');

			//Columns for Roster
			$this->pdh->add_object_tablepreset('roster', 'hptt_roster',
					array('name' => 'wow_charicon', 'sort' => false, 'th_add' => 'width="52"', 'td_add' => '')
			);
			$this->pdh->add_object_tablepreset('roster', 'hptt_roster',
					array('name' => 'profile_guild', 'sort' => true, 'th_add' => 'width="160"', 'td_add' => '')
			);
			$this->pdh->add_object_tablepreset('roster', 'hptt_roster',
					array('name' => 'wow_achievementpoints', 'sort' => true, 'th_add' => 'width="160"', 'td_add' => '')
			);

			//Ranks
			$this->game->addRank(0, "Gildenmeister");
			$this->game->addRank(1, "Meister");
			$this->game->addRank(2, "Hochassasine");
			$this->game->addRank(3, "Assasine");
			$this->game->addRank(4, "Mörder");
			$this->game->addRank(5, "Spion");
			$this->game->addRank(6, "Schleicher");
			$this->game->addRank(7, "Strafbänkler");
			$this->game->addRank(8, "Novize", true);

		}


		/* Uninstall Routine */
		public function uninstall(){
			// include arsenalSQL data for uninstallation
#			include($this->path.'arsenal/sql.php');
#			for ($i = 1; $i <= count($arsenalSQL['uninstall']); $i++)
#				$this->db->query($arsenalSQL['uninstall'][$i]);
			
			#$this->game->removeLink("WoW Battle.net");
		}


		/* Initialises filters */
		protected function load_filters($langs){
			if(!count($this->classes)) {
				$this->load_type('classes', $langs);
			}
			foreach($langs as $lang) {
				$names = $this->classes[$this->lang];
				$this->filters[$lang] = array(
					array('name' => '-----------', 'value' => false),
					array('name' => $names[0], 'value' => 'class:0'),
					array('name' => $names[1], 'value' => 'class:1'),
					array('name' => $names[2], 'value' => 'class:2'),
					array('name' => $names[3], 'value' => 'class:3'),
					array('name' => $names[4], 'value' => 'class:4'),
					array('name' => $names[5], 'value' => 'class:5'),
					array('name' => $names[6], 'value' => 'class:6'),
					array('name' => $names[7], 'value' => 'class:7'),
					array('name' => $names[8], 'value' => 'class:8'),
					array('name' => $names[9], 'value' => 'class:9'),
					array('name' => $names[10], 'value' => 'class:10'),
					array('name' => '-----------', 'value' => false),
					array('name' => $this->glang('plate', true, $lang), 'value' => 'class:1,5,10'),
					array('name' => $this->glang('mail', true, $lang), 'value' => 'class:3,8'),
					array('name' => $this->glang('leather', true, $lang), 'value' => 'class:2,7'),
					array('name' => $this->glang('cloth', true, $lang), 'value' => 'class:4,6,9'),
					array('name' => '-----------', 'value' => false),
					array('name' => $this->glang('tier_token', true, $lang).$names[3].', '.$names[10].', '.$names[8].', ', 'value' => 'class:3,8,10'),
					array('name' => $this->glang('tier_token', true, $lang).$names[5].', '.$names[6].', '.$names[9], 'value' => 'class:5,6,9'),
					array('name' => $this->glang('tier_token', true, $lang).$names[1].', '.$names[2].', '.$names[4].', '.$names[7], 'value' => 'class:1,2,4,7'),
				);
			}
		}
		

		public function decorate_classes($class_id, $profile=array(), $size=16, $pathonly=false) {
			$big = ($size > 40) ? '_b' : '';
			if(is_file($this->root_path.'games/'.$this->this_game.'/icons/classes/'.$class_id.$big.'.png')){
				$icon_path = $this->server_path.'games/'.$this->this_game.'/icons/classes/'.$class_id.$big.'.png';
				return ($pathonly) ? $icon_path : '<img src="'.$icon_path.'" height="'.$size.'" alt="class '.$class_id.'" class="'.$this->this_game.'_classicon classicon'.'" title="'.$this->game->get_name('classes', $class_id).'" />';
			}
			return false;
		}


		public function profilefields(){
			// Category 'character' is a fixed one! All others are created dynamically!
			$this->load_type('professions', array($this->lang));
			$this->load_type('realmlist', array($this->lang));
			$xml_fields = array(
				'guild'	=> array(
					'type'			=> 'text',
					'category'		=> 'character',
					'lang'			=> 'uc_guild',
					'size'			=> 32,
					'undeletable'	=> true,
					'sort'			=> 1
				),
				'servername'	=> array(
					'category'		=> 'character',
					'lang'			=> 'servername',
					'type'			=> 'text',
					'size'			=> '21',
					'edecode'		=> true,
					'autocomplete'	=> $this->realmlist[$this->lang],
					'undeletable'	=> true,
					'sort'			=> 2
				),
				'gender'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'character',
					'lang'			=> 'uc_gender',
					'options'		=> array(2 => 'uc_male', 3 => 'uc_female'),
					'tolang'		=> true,
					'undeletable'	=> true,
					'sort'			=> 3
				),
				'level'	=> array(
					'type'			=> 'spinner',
					'category'		=> 'character',
					'lang'			=> 'uc_level',
					'max'			=> 100,
					'min'			=> 1,
					'undeletable'	=> true,
					'sort'			=> 4
				),
				'health_bar'	=> array(
					'type'			=> 'int',
					'category'		=> 'character',
					'lang'			=> 'uc_bar_health',
					'undeletable'	=> true,
					'size'			=> 4,
					'sort'			=> 5
				),
				'second_bar'	=> array(
					'type'			=> 'int',
					'category'		=> 'character',
					'lang'			=> 'uc_bar_2value',
					'size'			=> 4,
					'undeletable'	=> true,
					'sort'			=> 6
				),
				'second_name'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'character',
					'lang'			=> 'uc_bar_2name',
					'options'		=> array('rage' => 'uc_bar_rage', 'energy' => 'uc_bar_energy', 'mana' => 'uc_bar_mana', 'focus' => 'uc_bar_focus', 'runic-power' => 'uc_bar_runic-power'),
					'tolang'		=> true,
					'size'			=> 32,
					'undeletable'	=> true,
					'sort'			=> 7
				),
				'prof1_name'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'profession',
					'lang'			=> 'uc_prof1_name',
					'options'		=> $this->professions[$this->lang],
					'undeletable'	=> true,
					'image'			=> "games/".$this->this_game."/profiles/professions/{VALUE}.jpg",
					'options_lang'	=> "professions",
					'sort'			=> 1,
				),
				'prof1_value'	=> array(
					'type'			=> 'int',
					'category'		=> 'profession',
					'lang'			=> 'uc_prof1_value',
					'size'			=> 4,
					'undeletable'	=> true,
					'sort'			=> 2
				),
				'prof2_name'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'profession',
					'lang'			=> 'uc_prof2_name',
					'options'		=> $this->professions[$this->lang],
					'undeletable'	=> true,
					'image'			=> "games/".$this->this_game."/profiles/professions/{VALUE}.jpg",
					'options_lang'	=> "professions",
					'sort'			=> 3,
				),
				'prof2_value'	=> array(
					'type'			=> 'int',
					'category'		=> 'profession',
					'lang'			=> 'uc_prof2_value',
					'size'			=> 4,
					'undeletable'	=> true,
					'sort'			=> 4
				),
			);
			return $xml_fields;
		}


		public function admin_settings() {
			$settingsdata_admin = array(
				'uc_server_loc'	=> array(
					'lang'		=> 'uc_server_loc',
					'type' 		=> 'dropdown',
					'options'	=> array('eu' => 'EU'),
				),
				'uc_data_lang'	=> array(
					'lang'		=> 'uc_data_lang',
					'type' 		=> 'dropdown',
					'options'	=> array(
						'de_DE'	=> 'German',
						'en_US' => 'English',
						'en_GB' => 'English (GB)',
						'ru_RU' => 'Russian',
						'fr_FR' => 'French',
						'es_MX' => 'Mexican',
						'es_ES' => 'Spanish',
						'pt_BR' => 'Brasil',
						'pt_PT'	=> 'Portuguese',
						'ko_KR'	=> 'Korean',
						'zh_TW'	=> 'Taiwanese',
						'zh_CN'	=> 'Chinese'
					),
				),
				'servername'	=> array(
					'lang'			=> 'servername',
					'type'			=> 'text',
					'size'			=> '21',
					'autocomplete'	=> $this->game->get('realmlist'),
				)
			);
			return $settingsdata_admin;
		}


		public function cronjobOptions(){
			$arrOptions = array(
				/*'sync_ranks'	=> array(
						'lang'	=> 'Sync Ranks',
						'name'	=> 'sync_ranks',
						'type'	=> 'radio',
				),
				'delete_chars'	=> array(
						'lang'	=> 'Delete Chars that have left the Guild',
						'name'	=> 'delete_chars',
						'type'	=> 'radio',
				),*/
			);
			return $arrOptions;
		}
		
		public function cronjob($arrParams = array()){
//			$blnSyncRanks = ((int)$arrParams['sync_ranks'] == 1) ? true : false;
//			$blnDeleteChars = ((int)$arrParams['delete_chars'] == 1) ? true : false;
//			
//			$this->game->new_object('bnet_armory', 'armory', array($this->config->get('uc_server_loc'), $this->config->get('uc_data_lang')));
//
//			//Guildimport
//			$guilddata	= $this->game->obj['armory']->guild($this->config->get('guildtag'), $this->config->get('servername'), true);
//			if(!isset($guilddata['status'])){
//				//Suspend all Chars
//				if ($blnDeleteChars){
//					$this->pdh->put('member', 'suspend', array('all'));
//				}
//				
//				
//				foreach($guilddata['members'] as $guildchars){
//					$jsondata = array(
//							'thumbnail'	=> $guildchars['character']['thumbnail'],
//							'name'		=> sanitize($guildchars['character']['name']),
//							'class'		=> $this->game->obj['armory']->ConvertID((int)$guildchars['character']['class'], 'int', 'classes'),
//							'race'		=> $this->game->obj['armory']->ConvertID((int)$guildchars['character']['race'], 'int', 'races'),
//							'level'		=> $guildchars['character']['level'],
//							'gender'	=> $this->game->obj['armory']->ConvertID((int)$guildchars['character']['gender'], 'int', 'gender'),
//							'rank'		=> $guildchars['rank'],
//							'servername'=> sanitize($guildchars['character']['realm']),
//							'guild'		=> sanitize($guildchars['character']['guild']),
//					);
//					
//					//Build Rank ID
//					$intRankID = $this->pdh->get('rank', 'default', array());
//					if ($blnSyncRanks){
//						$arrRanks = $this->pdh->get('rank', 'id_list');
//						$inRankID = (int)$jsondata['rank'];
//						if (isset($arrRanks[$inRankID])) $intRankID = $arrRanks[$inRankID];
//					}
//					
//					//char available
//					$intMemberID = $this->pdh->get('member', 'id', array(sanitize($jsondata['name']), array('servername' => sanitize($jsondata['servername']))));
//								
//					if($intMemberID){
//							
//						//Sync Rank
//						if ($blnSyncRanks){
//							$dataarry = array(
//								'rankid'	=> $intRankID,
//							);
//							$myStatus = $this->pdh->put('member', 'addorupdate_member', array($intMemberID, $dataarry));
//						}
//						
//						//Revoke Char
//						if($blnDeleteChars){
//							$this->pdh->put('member', 'revoke', array($intMemberID));
//							$this->pdh->process_hook_queue();
//						}
//							
//					} else {
//					
//						//Create new char
//						$jsondata['rankid'] = $intRankID;
//
//						$myStatus = $this->pdh->put('member', 'addorupdate_member', array(0, $jsondata));
//					
//						// reset the cache
//						$this->pdh->process_hook_queue();
//					}
//				}
//			}
//
//			//Guildupdate
//			$ratepersecond = 100;
//			$rate 		= 1000000/$ratepersecond;
//			
//			$arrMemberIDs = $this->pdh->get('member', 'id_list', array());
//			shuffle($arrMemberIDs);
//			foreach($arrMemberIDs as $memberID){
//				$strMemberName = $this->pdh->get('member', 'name', array($memberID));
//				if (strlen($strMemberName)){
//					
//					$char_server	= $this->pdh->get('member', 'profile_field', array($memberID, 'servername'));
//					$servername		= ($char_server != '') ? $char_server : $this->config->get('servername');
//					$chardata		= $this->game->obj['armory']->character($membername, unsanitize($servername), true);
//						
//					if(!isset($chardata['status']) && !empty($chardata['name']) && $chardata['name'] != 'none'){
//						$errormsg	= '';
//						$charname	= $chardata['name'];
//					
//						// insert into database
//					
//						$info = $this->pdh->put('member', 'addorupdate_member', array($charid, array(
//								'level'				=> $chardata['level'],
//								'gender'			=> $this->game->obj['armory']->ConvertID($chardata['gender'], 'int', 'gender'),
//								'race'				=> $this->game->obj['armory']->ConvertID($chardata['race'], 'int', 'races'),
//								'class'				=> $this->game->obj['armory']->ConvertID($chardata['class'], 'int', 'classes'),
//								'guild'				=> sanitize($chardata['guild']['name']),
//								'last_update'		=> ($chardata['lastModified']/1000),
//								'prof1_name'		=> $this->game->get_id('professions', $chardata['professions']['primary'][0]['name']),
//								'prof1_value'		=> $chardata['professions']['primary'][0]['rank'],
//								'prof2_name'		=> $this->game->get_id('professions', $chardata['professions']['primary'][1]['name']),
//								'prof2_value'		=> $chardata['professions']['primary'][1]['rank'],
//								'talent1'			=> $this->game->obj['armory']->ConvertTalent($chardata['talents'][0]['spec']['icon']),
//								'talent2'			=> $this->game->obj['armory']->ConvertTalent($chardata['talents'][1]['spec']['icon']),
//								'health_bar'		=> $chardata['stats']['health'],
//								'second_bar'		=> $chardata['stats']['power'],
//								'second_name'		=> $chardata['stats']['powerType'],
//						), 0));
//					
//					}
//					
//					if($rate > 0){
//						usleep($rate);
//					}
//				}
//			}
//
//			$this->pdh->process_hook_queue();
		}


		


		######################################################################
		##																	##
		##							EXTRA FUNCTIONS							##
		##																	##
		######################################################################

		/**
		 *	Content for the Chartooltip
		 *
		 */		
		public function chartooltip($intCharID){
			$template = $this->root_path.'games/'.$this->this_game.'/chartooltip/chartooltip.tpl';
			$content = file_get_contents($template);
			$charicon = $this->pdh->get('wow_assasinen', 'charicon', array($intCharID));
			if ($charicon == '') {
				$charicon = $this->server_path.'images/global/avatar-default.svg';
			}
			$charhtml = '<b>'.$this->pdh->get('member', 'html_name', array($intCharID)).'</b><br />';
			$guild = $this->pdh->get('member', 'profile_field', array($intCharID, 'guild'));
			if (strlen($guild)) $charhtml .= '<br />&laquo;'.$guild.'&raquo;';
			
			$charhtml .= '<br />'.$this->pdh->get('member', 'html_racename', array($intCharID));
			$charhtml .= ' '.$this->pdh->get('member', 'html_classname', array($intCharID));
			$charhtml .= '<br />'.$this->user->lang('level').' '.$this->pdh->get('member', 'level', array($intCharID));
			
			
			$content = str_replace('{CHAR_ICON}', $charicon, $content);
			$content = str_replace('{CHAR_HTML}', $charhtml, $content);
			
			return $content;
		}

		/**
		 * Per game data for the calendar Tooltip
		 */
		public function calendar_membertooltip($memberid){
			$talents			= $this->game->glang('talents');
			$member_data	= $this->pdh->get('member', 'array', array($memberid));

			// itemlevel in tooltip
			$this->game->new_object('bnet_armory', 'armory', array($this->config->get('uc_server_loc'), $this->config->get('uc_data_lang')));
			$char_server	= $this->pdh->get('member', 'profile_field', array($memberid, 'servername'));
			$servername		= ($char_server != '') ? $char_server : $this->config->get('servername');
			$chardata		= $this->game->obj['armory']->character($member_data['name'], unsanitize($servername), true);
			$itemlevel		= (isset($chardata['items']['averageItemLevel'])) ? $chardata['items']['averageItemLevel'] : '--';

			return array(
				$this->game->glang('talents_tt_1').': '.$this->pdh->geth('member', 'profile_field', array($memberid, 'talent1', true)),
				$this->game->glang('talents_tt_2').': '.$this->pdh->geth('member', 'profile_field', array($memberid, 'talent2', true)),
				$this->game->glang('caltooltip_itemlvl').': '.$itemlevel,
			);
		}




	}#class
}
?>
