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
  
  
    public function add($id, $name, $race, $gender, $class, $level=85, $global='',$last_update=time, $title='', $rep='', $currency='', $glyphs='', $mounts='', $critters='', $stistics='', $achievements=''){
		if($id === 0 && $name == 'GILDE'){ $race=0; $gender=0; $class=0; }
		
		$arrQuery = array(
			'id'			=> $id,
			'name'			=> $name,
			'race'			=> $race,
			'gender'		=> $gender,
			'class'			=> $class,
			'level'			=> $level,
			'global'		=> $global,
			'last_update'	=> $last_update,
			'title'			=> $title,
			'rep'			=> $rep,
			'currency'		=> $currency,
			'glyphs'		=> $glyphs,
			'mounts'		=> $mounts,
			'critters'		=> $critters,
			'statistics'	=> $stistics,
			'achievements'	=> $achievements
		);
		
		$objQuery = $this->db->prepare("INSERT INTO __arsenal_character :p")->set($arrQuery)->execute();
		
		if(!$objQuery) return false;
		#$pdh->enqueue_hook('arsenal_character');
		return true;
    }



  }//end class
}//end if
?>