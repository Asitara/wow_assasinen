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
 
define('EQDKP_INC', true);
$eqdkp_root_path = './../../../';
include_once($eqdkp_root_path.'common.php');

class charImporter extends page_generic {
	
	public function __construct() {
		parent::__construct(false, array(
			#'massupdate'		=> array('process' => 'perform_massupdate'),
			#'resetcache'		=> array('process' => 'perform_resetcache'),
			#'ajax_massupdate'	=> array('process' => 'ajax_massupdate'),
			#'ajax_mudate'		=> array('process' => 'ajax_massupdatedate'),
		), array());
		
		
		$this->this_game = $this->game->get_game();
		$this->pdh->get_read_modules();
		
		$this->user->check_auth('u_member_add');
		$this->user->check_auth('u_member_man');
		$this->process();
	}

	protected $this_game;


	public function perform_step0(){
		$this->tpl->js_file($this->root_path.'games/'.$this->this_game.'/arsenal/arsenal_charimporter.js');
		$this->tpl->add_css('
			#drag-drop-area-single {
				border: 4px dashed #BBB;
				height: 100px;
			}
			.drag-drop-inside {
				margin: 15px auto 0px;
				width: 250px;
			}
			.drag-drop-inside p {
				color: #AAA;
				display: none;
				font-size: 14px;
				margin: 5px 0px;
				text-align: center;
			}
			.drag-drop-inside p, .drag-drop-inside p.drag-drop-buttons {
				display: block;
			}
			.drag-drop-inside p.drag-drop-info {
				font-size: 20px;
			}
			#plupload-browse-button [
				position: relative;
				z-index: 1;
			}
		');
		
		$hmtlout = '
			<!-- The file input field used as target for the file upload widget -->
			<div id="drag-drop-area-single" style="position: relative;">
				<div class="drag-drop-inside">
					<p class="drag-drop-info">{ L_mc_drop_file }</p>
					<p>{ L_mc_or }</p>
					<p class="drag-drop-buttons">
						<input type="button" class="button" value="{L_mc_select_file}" id="plupload-browse-button" onclick="$(\'#chardump_file\').trigger(\'click\')" />
						<input id="chardump_file" type="file" name="file[]" multiple="multiple" style="display:none;" onchange="readChardump(event);" />
					</p>
				</div>
			</div>
			<div id="read_chardump"></div>
			<ul id="list_chardump"></ul>
			</br>
			<p style="margin: 15px auto 0px; width: 250px; text-align: center;">
				<button type="submit" name="submit" align="center"><i class="fa fa-download"></i> '.$this->game->glang('uc_import_forw').'</button>
			</p>
		';
		return $hmtlout;
	}



	public function perform_step1(){
		if(!count($this->in->getArray('chardump', 'string')) >= 1) return;
		foreach($this->in->getArray('chardump', 'string') as $dumps){
			$arrData = $this->arsenal->parse_chardump($dumps);
			
			/*$arrMemberIDs = $this->pdh->aget('member', 'name', 0, array($this->pdh->get('member', 'id_list')));
			foreach($arrMemberIDs as $id => $name){
				if($arrData['unit']['name'] != $name){
					$this->pdh->put('arsenal_character', 'add', array(
						$id,
						$arrData['unit']['name'],
						$arrData['unit']['race'],		// convert to raceID
						$arrData['unit']['gender'],
						$arrData['unit']['class'],		// convert to classID
						$arrData['unit']['level'],
						$arrData['unit']['name'],
						'',								// empty to get current time
						$arrData['title'],				// convert to json --> parse before name to lang_var
						$arrData['rep'],				// convert to json --> parse before name to lang_var
						$arrData['currency'],			// convert to json --> parse before name to lang_var
						$arrData['spells'],				// unset cause chardump error
						$arrData['glyphs'],				// unset cause chardump error
						$arrData['mounts'],				// build new array from data['creature']
						$arrData['critters'],			// build new array from data['creature']
						$arrData['awards']				// build new array from data['awards']  --- see awards_achievements, it beware new methods
					));
				}
				
			}*/
			
			d('___________________________________________________________________________________________________');
			d($arrData);
		}
		
		
		/*
		if($this->in->get('member_id', 0) > 0){
			// We'll update an existing one...
			$isindatabase	= $this->in->get('member_id', 0);
			$isMemberName	= $this->pdh->get('member', 'name', array($isindatabase));
			$isServerName	= $this->config->get('servername');
			$is_mine		= ($this->pdh->get('member', 'userid', array($isindatabase)) == $this->user->data['user_id']) ? true : false;
		}else{
			// Check for existing member name
			$isindatabase	= $this->pdh->get('member', 'id', array($this->in->get('charname'), array('servername' => $this->in->get('servername'))));
			$hasuserid		= ($isindatabase > 0) ? $this->pdh->get('member', 'userid', array($isindatabase)) : 0;
			$isMemberName	= $this->in->get('charname');
			$isServerName	= $this->in->get('servername');
			if($this->user->check_auth('a_charmanager_config', false)){
				$is_mine	= true;			// We are an administrator, its always mine..
			}else{
				$is_mine	= (($hasuserid > 0) ? (($hasuserid == $this->user->data['user_id']) ? true : false) : true);	// we are a normal user
			}
		}
		
		if($is_mine){
			// Load the Armory Data
			$chardata	= $this->game->obj['daybreak']->character($isMemberName, $isServerName, true);
			$cdata = $chardata['character_list'][0];

			// Basics
			$hmtlout	.= new hhidden('member_id', array('value'=>$isindatabase));
			$hmtlout	.= new hhidden('member_name', array('value'=>$isMemberName));
			$hmtlout	.= new hhidden('member_level', array('value'=>$cdata['type']['level']));
			$hmtlout	.= new hhidden('gender', array('value' => ucfirst($cdata['type']['gender'])));
			$hmtlout	.= new hhidden('member_race_id', array('value'=>$this->game->obj['daybreak']->ConvertID((int)$cdata['type']['raceid'], 'int', 'races')));
			$hmtlout	.= new hhidden('member_class_id', array('value'=>$this->game->obj['daybreak']->ConvertID((int)$cdata['type']['classid'], 'int', 'classes')));
			$hmtlout	.= new hhidden('guild', array('value'=>$cdata['guild']['name']));
			$hmtlout	.= new hhidden('picture', array('value'=>$cdata['id']));
			$hmtlout	.= new hhidden('servername', array('value' => $cdata['locationdata']['world']));
			
			
			// viewable Output
			if(!isset($chardata['status'])){
				$charicon = $this->game->obj['daybreak']->characterIcon($cdata['id']);
				if ($charicon == "") $charicon = $this->server_path.'images/global/avatar-default.svg';
				$hmtlout	.= '
				<div class="infobox infobox-large infobox-red clearfix">
					<i class="fa fa-exclamation-triangle fa-4x pull-left"></i> '.$this->game->glang('uc_charfound3').'</div>
				</div>

				<fieldset class="settings mediumsettings">
					<dl>
						<dt><label><img src="'.$charicon.'" name="char_icon" alt="icon" height="100" align="middle" /></label></dt>
						<dd>
							'.sprintf($this->game->glang('uc_charfound'), $isMemberName).'
						</dd>
					</dl>
					<dl>';
				if(!$isindatabase){
					if($this->user->check_auth('u_member_conn', false)){
						$hmtlout	.= '<dt>'.$this->user->lang('overtake_char').'</dt><dd>'.new hradio('overtakeuser', array('value' => 1)).'</dd>';
					}else{
						$hmtlout	.= '<dt>'.$this->user->lang('overtake_char').'</dt><dd>'.new hradio('overtakeuser', array('value' => 1, 'disabled' => true)).'</dd>';
						$hmtlout	.= new hhidden('overtakeuser', array('value' => '1'));
					}
				}
				$hmtlout	.= '
					</dl>
					</fieldset>';
				$hmtlout		.= '<center>
										<button type="submit" name="submiti"><i class="fa fa-refresh"></i> '.$this->game->glang('uc_prof_import').'</button>
									</center>';
			}else{
				$hmtlout		.= '<div class="errorbox roundbox">
										<i class="fa fa-exclamation-triangle fa-4x pull-left"></i><b>WARNING: </b> '.$chardata['reason'].'</div>
									</div>';
			}
		}else{
			$hmtlout	.= '<div class="errorbox roundbox">
								<i class="fa fa-exclamation-triangle fa-4x pull-left"></i>'.$this->game->glang('uc_notyourchar').'</div>
							</div>';
		}*/
		return $hmtlout;
	}

	public function perform_step2(){
		$data = array(
			'name'				=> $this->in->get('member_name'),
			'level'				=> $this->in->get('member_level', 0),
			'gender'			=> $this->in->get('gender', 'male'),
			'race'				=> $this->in->get('member_race_id', 0),
			'class'				=> $this->in->get('member_class_id', 0),
			'guild'				=> $this->in->get('guild',''),
			'picture'			=> $this->in->get('picture',''),
			'servername'		=> $this->in->get('servername', ''),
		);
		$info		= $this->pdh->put('member', 'addorupdate_member', array($this->in->get('member_id', 0), $data, $this->in->get('overtakeuser')));
		$this->pdh->process_hook_queue();
		if($info){
			$hmtlout	= '<div class="infobox infobox-large infobox-green clearfix">
								<i class="fa fa-check fa-4x pull-left"></i> '.$this->game->glang('uc_armory_updated').'
							</div>';
		}else{
			$hmtlout	= '<div class="infobox infobox-large infobox-red clearfix">
								<i class="fa fa-exclamation-triangle fa-4x pull-left"></i> '.$this->game->glang('uc_armory_updfailed').'
							</div>';
		}
		return $hmtlout;
	}







	public function display(){
		$stepnumber		= ($this->config->get('servername') && $this->config->get('uc_server_loc') && $this->in->get('member_id',0) > 0 && $this->in->get('step',0) == 0) ? 1 : $this->in->get('step',0);
		$urladdition	 = ($this->in->get('member_id',0)) ? '&amp;member_id='.$this->in->get('member_id',0) : '';
		$funcname		 = 'perform_step'.$stepnumber;
		$this->tpl->assign_vars(array(
			'DATA'		=> $this->$funcname(),
			'STEP'		=> ($stepnumber+1).$urladdition
		));

		$this->core->set_vars(array(
			'page_title'		=> $this->user->lang('raidevent_raid_guests'),
			'header_format'		=> 'simple',
			'template_file'		=> 'importer.html',
			'display'			=> true
		));
	}
}

registry::register('charImporter');
?>
