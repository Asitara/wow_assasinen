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
		parent::__construct(false, array(), array());
		
		
		$this->this_game = $this->game->get_game();
		$this->pdh->get_read_modules();
		
		$this->user->check_auth('u_member_add');
		$this->user->check_auth('u_member_man');
		$this->process();
	}

	protected $this_game;
	private $form_build = false;
	public static $shortcuts = array('form' => array('form', array('importchar')));


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
			#plupload-browse-button {
				position: relative;
				z-index: 1;
			}
			
			.importer-main-frame {
				margin: 15px auto 0px;
				width: 250px;
				text-align: center;
			}
			#list_chardump li {
				margin: 5px 0;
				padding: 2px 4px;
				border: 1px solid #666;
				text-align: left;
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
			<div class="importer-main-frame">
				
				<ul id="list_chardump"></ul>
				</br>
				<button type="submit" name="submit" align="center"><i class="fa fa-download"></i> '.$this->game->glang('uc_import_forw').'</button>
			</div>
		';
		return $hmtlout;
	}


	public function perform_step1(){
		$response = array();
		$arrMemberIDs = $this->pdh->aget('member', 'name', 0, array($this->pdh->get('member', 'id_list')));
		
		foreach($this->in->getArray('chardump', 'string') as $dumps){
			$arrData = $this->arsenal->parse_chardump($dumps);
			
			foreach($arrMemberIDs as $id => $name){
				if($arrData['global']['name'] == $name){
					$is_mine = ($this->pdh->get('member', 'userid', array($id)) == $this->user->data['user_id'])? true : false;
					if($is_mine){
						// char upload if is_mine
						// return anything, so we can say uups we got an error^^
						$upload_status = $this->pdh->put('arsenal_character', 'add_upd', array($id, $arrData, array('overtakechar' => 1, 'picture' => '', 'notes' => '')));
					}else{ $upload_status = false; }
				}else{
					// char upload
					$upload_status = $this->pdh->put('arsenal_character', 'add_upd', array($id, $arrData, array('overtakechar' => 1, 'picture' => '', 'notes' => '')));
				}
			}
			
			$response[$arrData['global']['name']] = $upload_status;
		}
		
		// upload sequence done, check the response
		$hmtlout = ' ';
		
		foreach($response as $name => $status){
			if(!$status){
				$hmtlout .= '
					<div class="infobox infobox-large infobox-red clearfix">
						<i class="fa fa-exclamation-triangle fa-2x pull-left"></i> '.$name.', der Charakter konnte nicht importiert werden.</div>
					</div>
				';
			}else{
				$hmtlout .= '
					<div class="infobox infobox-large infobox-green clearfix">
						<i class="fa fa-exclamation-triangle fa-2x pull-left"></i> '.$name.', wurde erfolgreich importiert...</div>
					</div>
				';
			}
		}
		
		return $hmtlout;
	}




################################################################################
#
#			$data = $this->form->return_values();
#
################################################################################


##### HIER könnte man noch eine "sichte und prüfe deine daten" wo dann notiz character bild und die core sachen mitgeliefert werden,.. einbauen..
	public function perform_step3(){
		$response = array();
		$arrMemberIDs = $this->pdh->aget('member', 'name', 0, array($this->pdh->get('member', 'id_list')));
		
		if(!count($this->in->getArray('chardump', 'string')) >= 1) return;
		foreach($this->in->getArray('chardump', 'string') as $dumps){
			$arrData = $this->arsenal->parse_chardump($dumps);
			
			foreach($arrMemberIDs as $id => $name){
				if($arrData['global']['name'] == $name){
					$is_mine = ($this->pdh->get('member', 'userid', array($id)) == $this->user->data['user_id'])? true : false;
					if($is_mine){
						// char upload if is_mine
						// return anything, so we can say uups we got an error^^
						$upload_status = true; //-- Hier ist eig die antwort des uploads
					}else{ $upload_status = false; }
				}else{
					// char upload
					$upload_status = true; //-- Hier ist eig die antwort des uploads
				}
			}
			
			$response[$arrData['global']['name']] = $upload_status;
		}
		
		// upload sequence done, check the response
		$hmtlout = ' ';
		
		foreach($response as $name => $status){
			if(!$status){
				$hmtlout .= '
					<div class="infobox infobox-large infobox-red clearfix">
						<i class="fa fa-exclamation-triangle fa-2x pull-left"></i> '.$name.', der Charakter konnte nicht importiert werden.</div>
					</div>
				';
			}else{
				$hmtlout .= '
					<div class="infobox infobox-large infobox-green clearfix">
						<i class="fa fa-exclamation-triangle fa-2x pull-left"></i> '.$name.', wurde erfolgreich importiert...</div>
					</div>
				';
			}
		}
		
		return $hmtlout;
	}


################################################################################


################################################################################



	public function perform_step4(){
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
