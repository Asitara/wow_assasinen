<?php
/*
* Project:		EQdkp-Plus
* License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
* Link:			http://creativecommons.org/licenses/by-nc-sa/3.0/
* -----------------------------------------------------------------------
* Began:		2010
* Date:			$Date: 2013-01-29 17:35:08 +0100 (Di, 29 Jan 2013) $
* -----------------------------------------------------------------------
* @author		$Author: wallenium $
* @copyright	2006-2014 EQdkp-Plus Developer Team
* @link			http://eqdkp-plus.eu
* @package		eqdkpplus
* @version		$Rev: 12937 $
*
* $Id: pdh_r_articles.class.php 12937 2013-01-29 16:35:08Z wallenium $
*/

if ( !defined('EQDKP_INC') ){
	die('Do not access this file directly.');
}
				
if ( !class_exists( "pdh_r_arsenal_character" ) ) {
	class pdh_r_arsenal_character extends pdh_r_generic{
		public static function __shortcuts() {
		$shortcuts = array();
		return array_merge(parent::$shortcuts, $shortcuts);
	}				
	
	public $default_lang = 'german';
	public $arsenal_character = NULL;

	public $hooks = array(
		'arsenal_character_update',
	);		
			
	public $presets = array(
		'arsenal_character_id'				=> array('id', array('%id%'), array()),
		'arsenal_character_name'			=> array('name', array('%id%'), array()),
		'arsenal_character_title'			=> array('title', array('%id%'), array()),
		'arsenal_character_gender'			=> array('gender', array('%id%'), array()),
		'arsenal_character_race'			=> array('race', array('%id%'), array()),
		'arsenal_character_class'			=> array('class', array('%id%'), array()),
		'arsenal_character_level'			=> array('level', array('%id%'), array()),
		'arsenal_character_last_update'		=> array('last_update', array('%id%'), array()),
		'arsenal_character_stats'			=> array('stats', array('%id%'), array()),
		'arsenal_character_titles'			=> array('titles', array('%id%'), array()),
		'arsenal_character_reputation'		=> array('reputation', array('%id%'), array()),
		'arsenal_character_currencies'		=> array('currencies', array('%id%'), array()),
		'arsenal_character_talents'			=> array('talents', array('%id%'), array()),
		'arsenal_character_professions'		=> array('professions', array('%id%'), array()),
		'arsenal_character_mounts'			=> array('mounts', array('%id%'), array()),
		'arsenal_character_critters'		=> array('critters', array('%id%'), array()),
		'arsenal_character_inventory'		=> array('inventory', array('%id%'), array()),
		'arsenal_character_achievements'	=> array('achievements', array('%id%'), array()),
	);
				
	public function reset(){
			$this->pdc->del('pdh_arsenal_character_table');
			
			$this->arsenal_character = NULL;
	}
					
	public function init(){
			$this->arsenal_character	= $this->pdc->get('pdh_arsenal_character_table');				
					
			if($this->arsenal_character !== NULL){
				return true;
			}		

			$objQuery = $this->db->query('SELECT * FROM __arsenal_character');
			if($objQuery){
				while($drow = $objQuery->fetchAssoc()){
					//TODO: Check if id Column is available
					$this->arsenal_character[(int)$drow['id']] = array(
						'id'			=> (int)$drow['id'],
						'name'			=> $drow['name'],
						'title'			=> (int)$drow['title'],
						'gender'		=> (int)$drow['gender'],
						'race'			=> (int)$drow['race'],
						'class'			=> (int)$drow['class'],
						'level'			=> (int)$drow['level'],
						'last_update'	=> (int)$drow['last_update'],
						'stats'			=> $drow['stats'],
						'titles'		=> $drow['titles'],
						'reputation'	=> $drow['reputation'],
						'currencies'	=> $drow['currencies'],
						'talents'		=> $drow['talents'],
						'professions'	=> $drow['professions'],
						'mounts'		=> $drow['mounts'],
						'critters'		=> $drow['critters'],
						'inventory'		=> $drow['inventory'],
						'achievements'	=> $drow['achievements'],

					);
				}
				
				$this->pdc->put('pdh_arsenal_character_table', $this->arsenal_character, NULL);
			}

		}	//end init function

		/**
		 * @return multitype: List of all IDs
		 */				
		public function get_id_list(){
			if ($this->arsenal_character === NULL) return array();
			return array_keys($this->arsenal_character);
		}
		
		/**
		 * Get all data of Element with $id
		 * @return multitype: Array with all data
		 */				
		public function get_data($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id];
			}
			return false;
		}
				
		/**
		 * Returns id for $id				
		 * @param integer $id
		 * @return multitype id
		 */
		 public function get_id($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['id'];
			}
			return false;
		}

		/**
		 * Returns name for $id				
		 * @param integer $id
		 * @return multitype name
		 */
		 public function get_name($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['name'];
			}
			return false;
		}

		/**
		 * Returns title for $id				
		 * @param integer $id
		 * @return multitype title
		 */
		 public function get_title($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['title'];
			}
			return false;
		}

		/**
		 * Returns gender for $id				
		 * @param integer $id
		 * @return multitype gender
		 */
		 public function get_gender($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['gender'];
			}
			return false;
		}

		/**
		 * Returns race for $id				
		 * @param integer $id
		 * @return multitype race
		 */
		 public function get_race($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['race'];
			}
			return false;
		}

		/**
		 * Returns class for $id				
		 * @param integer $id
		 * @return multitype class
		 */
		 public function get_class($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['class'];
			}
			return false;
		}

		/**
		 * Returns level for $id				
		 * @param integer $id
		 * @return multitype level
		 */
		 public function get_level($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['level'];
			}
			return false;
		}

		/**
		 * Returns last_update for $id				
		 * @param integer $id
		 * @return multitype last_update
		 */
		 public function get_last_update($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['last_update'];
			}
			return false;
		}

		/**
		 * Returns stats for $id				
		 * @param integer $id
		 * @return multitype stats
		 */
		 public function get_stats($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['stats'];
			}
			return false;
		}

		/**
		 * Returns titles for $id				
		 * @param integer $id
		 * @return multitype titles
		 */
		 public function get_titles($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['titles'];
			}
			return false;
		}

		/**
		 * Returns reputation for $id				
		 * @param integer $id
		 * @return multitype reputation
		 */
		 public function get_reputation($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['reputation'];
			}
			return false;
		}

		/**
		 * Returns currencies for $id				
		 * @param integer $id
		 * @return multitype currencies
		 */
		 public function get_currencies($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['currencies'];
			}
			return false;
		}

		/**
		 * Returns talents for $id				
		 * @param integer $id
		 * @return multitype talents
		 */
		 public function get_talents($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['talents'];
			}
			return false;
		}

		/**
		 * Returns professions for $id				
		 * @param integer $id
		 * @return multitype professions
		 */
		 public function get_professions($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['professions'];
			}
			return false;
		}

		/**
		 * Returns mounts for $id				
		 * @param integer $id
		 * @return multitype mounts
		 */
		 public function get_mounts($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['mounts'];
			}
			return false;
		}

		/**
		 * Returns critters for $id				
		 * @param integer $id
		 * @return multitype critters
		 */
		 public function get_critters($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['critters'];
			}
			return false;
		}

		/**
		 * Returns inventory for $id				
		 * @param integer $id
		 * @return multitype inventory
		 */
		 public function get_inventory($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['inventory'];
			}
			return false;
		}

		/**
		 * Returns achievements for $id				
		 * @param integer $id
		 * @return multitype achievements
		 */
		 public function get_achievements($id){
			if (isset($this->arsenal_character[$id])){
				return $this->arsenal_character[$id]['achievements'];
			}
			return false;
		}

	}//end class
}//end if
?>