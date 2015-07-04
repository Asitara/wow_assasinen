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

if( !defined( 'EQDKP_INC' ) ) {
	die('Do not access this file directly.');
}

/*+----------------------------------------------------------------------------
  | wow_arsenal
  +--------------------------------------------------------------------------*/
if(!class_exists('wow_arsenal')){
	class wow_arsenal extends gen_class {
		public function __construct(){
			$this->this_game	= $this->game->get_game();
			#$this->races= $this->game->glang('races');
			#$this->classes= $this->game->glang('classes');
		}

		protected $this_game	= 'wow_assasinen';
		#private $races= array();
		#protected $classes= array();


		public function add(){}

		public function parse_chardump($jsonChardump){
			//parse to valid json and decode it
			if(!empty($jsonChardump)){
				#$jsonChardump = preg_replace('/\\\"/', '"', $jsonChardump);  // Fixed " \\"ESSENSCHLACHT!\\" "
				#$jsonChardump = stripslashes($jsonChardump);
				$jsonChardump = $this->in->decode_entity($jsonChardump);
				
				$arrData = json_decode($jsonChardump, true);
			}
			
			d($arrData);die;
			
			/*
			
			,\"global\":{ 
			
			\"},\"
			
			*/
			
			
			
			//rebuild arrays and array_values
			$arrData['global']['date']= $this->time->fromformat($arrData['global']['date'], 'M d Y');
			
			switch($rb_race = $arrData['unit']['race']){
				case 'Gnome':	 $rb_race = 1; break;
				case 'Human':	 $rb_race = 2; break;
				case 'Dwarf':	 $rb_race = 3; break;
				case 'NightElf': $rb_race = 4; break;
				case 'Troll':	 $rb_race = 5; break;
				case 'Scourge':	 $rb_race = 6; break;
				case 'Orc':		 $rb_race = 7; break;
				case 'Tauren':	 $rb_race = 8; break;
				case 'Draenei':  $rb_race = 9; break;
				case 'BloodElf': $rb_race = 10; break;
				case 'Worgen':	 $rb_race = 11; break;
				case 'Goblin':	 $rb_race = 12; break;
				default: $rb_race = 0;
			} $arrData['unit']['race'] = $rb_race;
			
			switch($rb_class = $arrData['unit']['class']){
				case 'DEATHKNIGHT': $rb_class = 1; break;
				case 'DRUID':		$rb_class = 2; break;
				case 'HUNTER':		$rb_class = 3; break;
				case 'MAGE':		$rb_class = 4; break;
				case 'PALADIN':		$rb_class = 5; break;
				case 'PRIEST':		$rb_class = 6; break;
				case 'ROGUE':		$rb_class = 7; break;
				case 'SHAMAN':		$rb_class = 8; break;
				case 'WARLOCK':		$rb_class = 9; break;
				case 'WARRIOR':		$rb_class = 10; break;
				default: $rb_race = 0;
			} $arrData['unit']['class'] = $rb_class;
			
			$arrData['title'];
			
			
			
			
			/* ACHTUNG bei den PROPERTIES
				--- beachte index =
					ATTRIBUTE -> http://wowwiki.wikia.com/API_UnitStat
					COMBAT -> http://wow.gamepedia.com/API_GetCombatRating
					RESIST -> http://wowwiki.wikia.com/API_UnitResistance
			
			
			BERUFE -- localization
			
			
			switch($rb_profs = $arrData['professions']){
				case 171: $rb_profs = 1, break;
				case 186: $rb_profs = 2, break;
				case 202: $rb_profs = 3, break;
				case 773: $rb_profs = 4, break;
				case 755: $rb_profs = 5, break;
				case 182: $rb_profs = 6, break;
				case 393: $rb_profs = 7, break;
				case 165: $rb_profs = 8, break;
				case 164: $rb_profs = 9, break;
				case 197: $rb_profs = 10, break;
				case 333: $rb_profs = 11, break;
				case 356: $rb_profs = 12, break;
				case 794: $rb_profs = 13, break;
				case 129: $rb_profs = 14, break;
				case 184: $rb_profs = 15, break;
				default: $rb_profs = 0;
			}
			
			
			*/
			
			
			
			
			
			
			//sort and generate new array
			$data_global	= $arrData['global'];
			$data_unit		= $arrData['unit'];
			$data_title		= $arrData['title'];
			$data_rep 		= $arrData['rep'];
			$data_currency	= $arrData['currency'];
			$data_spells	= $arrData['spells'];
			$data_glyphs 	= $arrData['glyphs'];
			$data_creature	= $arrData['creature'];
			$data_awards	= $arrData['awards'];
			
			unset($arrData);
			$arrData = array(
				'global'	=> $data_global,
				'unit'		=> $data_unit,
				'title'		=> $data_title,
				'rep'		=> $data_rep,
				'currency'	=> $data_currency,
				'spells'	=> $data_spells,
				'glyphs'	=> $data_glyphs,
				'creature'	=> $data_creature,
				'awards'	=> $data_awards,
			);
			return $arrData;
		}
	
			
			
			/*
			// So lesen und verarbeiten wir die direkte Dateieinlese
			$jsonChardump = file_get_contents('http://127.0.0.1/Chardump.json');
			$jsonChardump = preg_replace("/\\\'/", "'", $jsonChardump);
			$jsonChardump = stripslashes($jsonChardump);
			json_decode($jsonChardump, true);
			*/
			
		


		/**
		* Fetch Guild Informations about the progress,.. from Frostmourne
		* @return: Array
		*/
		public function fetch_guild_progress(){
			$arrData = array();
			
			// fetch the ProgressList
			$progressListHTML = $this->urlfetcher->fetch('http://frostmourne.eu/progress/frostberry');
			preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $progressListHTML, $arrProgressList, PREG_SET_ORDER);
			
			foreach ($arrProgressList as $step => $wert) {
					#echo "gefunden: " . $wert[0] . "\n";   // gefunden: <b>fett gedruckter Text</b>
					#echo "Teil 1: " . $wert[1] . "\n";     // Teil 1: <b>
					#echo "Teil 2: " . $wert[2] . "\n";     // Teil 2: b
					#echo "Teil 3: " . $wert[3] . "\n";     // Teil 3: fett gedruckter Text
					#echo "Teil 4: " . $wert[4] . "\n\n";   // Teil 4: </b>
				if($wert[0] == '<a href="/progress/frostberry/view/221202">Assasinen</a>'){
					$arrData['NAME'] = $wert[3];
					$arrData['LEVEL'] = 0;
					$arrData['pr_RANK'] = $arrProgressList[$step-1][3];
					$arrData['pr_POINTS'] = $arrProgressList[$step+7][3];
				}
			}
			
			// fetch the ProgressView
			$progressViewHTML = $this->urlfetcher->fetch('http://frostmourne.eu/progress/frostberry/view/221202');
			preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $progressViewHTML, $arrProgressView, PREG_SET_ORDER);
			
			foreach ($arrProgressView as $step => $wert) {
				switch($wert[1]){
					case '<b data-glevel="">':		$arrData['LEVEL'] = $wert[3]; break;
					case '<span data-glchar="">':	$arrData['gm_NAME'] = $wert[3]; break;
					case '<span data-gllevel="">':	$arrData['gm_LEVEL'] = $wert[3]; break;
					case '<span data-glrace="">':	$arrData['gm_RACE'] = $wert[3]; break;
					case '<span data-glclass="">':	$arrData['gm_CLASS'] = $wert[3]; break;
					
					case '<th data-speak="progress_table-head-name">':
							//split to read each RAID (by bossname)
							switch($arrProgressView[$step+4][3]){
								case 'Argaloth':				// Baradienhold
										for($i=1,$s=4; $i <= 3; $i++){
											$arrData['rd_bh_'.$i] = $arrProgressView[$step+$s][3];			 $s++;
											$arrData['rd_bh_'.$i.'_NORMAL'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_bh_'.$i.'_HEROIC'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_bh_'.$i.'_POINTS'] = $arrProgressView[$step+$s][3]; $s++;
										}
									break;
								case 'Magmaul':					// Blackwing Descent
										for($i=1,$s=4; $i <= 6; $i++){
											$arrData['rd_bwd_'.$i] = $arrProgressView[$step+$s][3];			  $s++;
											$arrData['rd_bwd_'.$i.'_NORMAL'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_bwd_'.$i.'_HEROIC'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_bwd_'.$i.'_POINTS'] = $arrProgressView[$step+$s][3]; $s++;
										}
									break;
								case 'Valiona und Theralion':	// Bastion of Twilight
										for($i=1,$s=4; $i <= 5; $i++){
											$arrData['rd_bot_'.$i] = $arrProgressView[$step+$s][3];			  $s++;
											$arrData['rd_bot_'.$i.'_NORMAL'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_bot_'.$i.'_HEROIC'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_bot_'.$i.'_POINTS'] = $arrProgressView[$step+$s][3]; $s++;
										}
									break;
								case 'Al\'Akir':				// Throne of the Four Winds
										for($i=1,$s=4; $i <= 2; $i++){
											$arrData['rd_tdfw_'.$i] = $arrProgressView[$step+$s][3];		   $s++;
											$arrData['rd_tdfw_'.$i.'_NORMAL'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_tdfw_'.$i.'_HEROIC'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_tdfw_'.$i.'_POINTS'] = $arrProgressView[$step+$s][3]; $s++;
										}
									break;
								case 'Beth\'tilac':				// Firelands
										for($i=1,$s=4; $i <= 7; $i++){
											$arrData['rd_fl_'.$i] = $arrProgressView[$step+$s][3];			 $s++;
											$arrData['rd_fl_'.$i.'_NORMAL'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_fl_'.$i.'_HEROIC'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_fl_'.$i.'_POINTS'] = $arrProgressView[$step+$s][3]; $s++;
										}
									break;
								case 'Morchok':					// Dragonsoul
										for($i=1,$s=4; $i <= 8; $i++){
											$arrData['rd_ds_'.$i] = $arrProgressView[$step+$s][3];			 $s++;
											$arrData['rd_ds_'.$i.'_NORMAL'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_ds_'.$i.'_HEROIC'] = $arrProgressView[$step+$s][3]; $s++;
											$arrData['rd_ds_'.$i.'_POINTS'] = $arrProgressView[$step+$s][3]; $s++;
										}
										
										//fetch Raid History
										for($i=1,$s=44; $i <= 20; $i++){
											$arrData['rd_hs_'.$i] = $arrProgressView[$step+$s][3];				$s++;
											$arrData['rd_hs_'.$i.'_ZONE'] = $arrProgressView[$step+$s][3];		$s++;
											$arrData['rd_hs_'.$i.'_MODE'] = $arrProgressView[$step+$s][3];		$s++;
											$arrData['rd_hs_'.$i.'_DATE'] = $arrProgressView[$step+$s][3];		$s++;
											$arrData['rd_hs_'.$i.'_DURATION'] = $arrProgressView[$step+$s][3];	$s++;
											$arrData['rd_hs_'.$i.'_FASTEST'] = $arrProgressView[$step+$s][3];	$s++;
											$arrData['rd_hs_'.$i.'_TOTAL'] = $arrProgressView[$step+$s][3];		$s++;
											$arrData['rd_hs_'.$i.'_RANK'] = $arrProgressView[$step+$s][3];		$s++;
										}
									break;
							}
				}
			}
			
			return $arrData;
		}





	} //end class
} //end if class not exists
?>