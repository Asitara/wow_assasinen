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
	die('Do not access this file directly.');
}

/*+----------------------------------------------------------------------------
  | pdh_w_arsenal_character
  +--------------------------------------------------------------------------*/
if(!class_exists('pdh_w_arsenal_character')){
  class pdh_w_arsenal_character extends pdh_w_generic{

	/*
	* Add or Update a new/exist Character/Member
	* @param: Integer $id			--the member id else 0
	* @param: Array $arrData		--chardump data
	* @param: Array $member_data	-- it implements => overtakechar, picture, notes  
	*/
    public function add_upd($id, $arrData=array(), $member_data=array()){
		$changes = false;
		$is_in_arsenal = false;
		
		//check if the array have all information
		if(is_array($arrData)){
			if(!is_array($arrData['global'])
				|| !isset($arrData['global']['name'])
				|| $arrData['global']['race'] == 0
				|| $arrData['global']['class'] == 0
			) return false;
		}else{ return false; }
		
		//prepare the core required $member_data to call pdh->put('member')
		switch($arrData['global']['class']){
			case 1:		$power_type = 'runic-power'; break;
			case 2:		$power_type = 'mana'; break;
			case 3:		$power_type = 'focus'; break;
			case 4:		$power_type = 'mana'; break;
			case 5:		$power_type = 'mana'; break;
			case 6:		$power_type = 'mana'; break;
			case 7:		$power_type = 'energy'; break;
			case 8:		$power_type = 'mana'; break;
			case 9:		$power_type = 'mana'; break;
			case 10:	$power_type = 'rage'; break;
			default: $power_type = 'mana';
		}
		
		$professions = array();
		foreach($arrData['professions']['primary'] as $prof_id => $prof_val){
			$professions[] = array('name' => $prof_id, 'value' => $prof_val);
		}
		
		$member_data = array_merge($member_data, array(
			'name'			=> $arrData['global']['name'],
			'faction'		=> '',
			'race'			=> $arrData['global']['race'],
			'class'			=> $arrData['global']['class'],
			'talent1'		=> $arrData['talents']['primary'],
			'talent2'		=> $arrData['talents']['secondary'],
			'guild'			=> (isset($arrData['guild']['name']))? $arrData['guild']['name'] : $this->config->get('guildtag'),
			'servername'	=> (isset($arrData['global']['realm']))? $arrData['global']['realm'] : $this->config->get('servername'),
			'gender'		=> $arrData['global']['gender'],
			'level'			=> (isset($arrData['global']['level']))? $arrData['global']['level'] : 85,
			'health_bar'	=> $arrData['global']['health'],
			'second_bar'	=> $arrData['global']['power'],
			'second_name'	=> $power_type,
			'prof1_name'	=> (isset($professions[0]['name']))?  $professions[0]['name']  : '',
			'prof1_value'	=> (isset($professions[0]['value']))? $professions[0]['value'] : '',
			'prof2_name'	=> (isset($professions[1]['name']))?  $professions[1]['name']  : '',
			'prof2_value'	=> (isset($professions[1]['value']))? $professions[1]['value'] : '',
		));
		
		//prepare the arsenal required $arrData to import
		$arrData['stats']			= json_encode($arrData['stats']);
		$arrData['titles']			= json_encode($arrData['titles']);
		$arrData['reputation']		= json_encode($arrData['reputation']);
		$arrData['currencies']		= json_encode($arrData['currencies']);
		$arrData['talents']			= json_encode($arrData['talents']);
		$arrData['professions']		= json_encode($arrData['professions']);
		$arrData['mounts']			= json_encode($arrData['mounts']);
		$arrData['critters']		= json_encode($arrData['critters']);
		$arrData['inventory']		= json_encode($arrData['inventory']);
	#	$arrData['achievements']	= json_encode($arrData['achievements']);
		
		//check old character/member on changes
		if($id > 0) {
			$old = $this->pdh->get('arsenal_character', 'data', array($id));
			if($old){
				$is_in_arsenal = true;
				foreach($old as $type => $val){
					if(!isset($arrData[$type])){
						$arrData[$type] = $val;
					}elseif($arrData[$type] != $val) $changes = true;
				}
			}else{ $changes = true; }
		}else{ $changes = true; }
		
		// add new _or_ update exist character
		if($id > 0 && $is_in_arsenal){
			if(!$changes) return true;
			
			$member_id = $this->pdh->put('member', 'addorupdate_member', array($id, $member_data, $member_data['overtakechar']));
			if($member_id){
				$arrQuery = array(
					'id'			=> $member_id,
					'name'			=> $arrData['global']['name'],
					'title'			=> $arrData['global']['title'],
					'gender'		=> $arrData['global']['gender'],
					'race'			=> $arrData['global']['race'],
					'class'			=> $arrData['global']['class'],
					'level'			=> $arrData['global']['level'],
					'last_update'	=> $arrData['global']['date'],
					'stats'			=> $arrData['stats'],
					'titles'		=> $arrData['titles'],
					'reputation'	=> $arrData['reputation'],
					'currencies'	=> $arrData['currencies'],
					'talents'		=> $arrData['talents'],
					'professions'	=> $arrData['professions'],
					'mounts'		=> $arrData['mounts'],
					'critters'		=> $arrData['critters'],
					'inventory'		=> $arrData['inventory'],
					'achievements'	=> $arrData['achievements']
				);
				$objQuery = $this->db->prepare("UPDATE __arsenal_character :p WHERE id = ?;")->set($arrQuery)->execute($member_id);
			}
		}else{
			$member_id = $this->pdh->put('member', 'addorupdate_member', array($id, $member_data, $member_data['overtakechar']));
			if($member_id){
				$arrQuery = array(
					'id'			=> $member_id,
					'name'			=> $arrData['global']['name'],
					'title'			=> $arrData['global']['title'],
					'gender'		=> $arrData['global']['gender'],
					'race'			=> $arrData['global']['race'],
					'class'			=> $arrData['global']['class'],
					'level'			=> $arrData['global']['level'],
					'last_update'	=> $arrData['global']['date'],
					'stats'			=> $arrData['stats'],
					'titles'		=> $arrData['titles'],
					'reputation'	=> $arrData['reputation'],
					'currencies'	=> $arrData['currencies'],
					'talents'		=> $arrData['talents'],
					'professions'	=> $arrData['professions'],
					'mounts'		=> $arrData['mounts'],
					'critters'		=> $arrData['critters'],
					'inventory'		=> $arrData['inventory'],
					'achievements'	=> $arrData['achievements']
				);
				$objQuery = $this->db->prepare("INSERT INTO __arsenal_character :p;")->set($arrQuery)->execute();
				if(!$objQuery) $this->pdh->put('member', 'delete_member', array($member_id, true));
			}
		}
		
		//check if import succes
		if($objQuery){
			#$pdh->enqueue_hook('member_update');
			#$pdh->enqueue_hook('arsenal_character_update');
			return true;
		}else{
			return false;
		}
    }



  }//end class
}//end if
?>