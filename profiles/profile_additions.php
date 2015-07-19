<?php
infotooltip_js(); // init infotooltip
/*----------------------------------------------------*/

$arrData = $this->pdh->get('arsenal_character', 'data', array($this->url_id));

/* Arsenal Page Controller */
if($this->in->exists('professions')){
	#$this->arsenal->fetch_guild_progress();
}
elseif($this->in->exists('talents')){
	
}
else{
	$content = $this->arsenal->character_main_page($arrData);
}


$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/profile.css');
$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/summary.css');

$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/pet.css');
$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/zone.css');

//------------------------------------------------------

$arrData['talents'] = json_decode($arrData['talents'], true);

// brauchen noch dreingend die faction beim realm name




$this->tpl->assign_vars(array(
	'ARS_CHAR_TITLE_NAME'=> $this->user->lang('titles')[$arrData['title']],
	'ARS_CHAR_GUILD'=> $this->pdh->get('member', 'profile_field', array($this->url_id, 'guild')),
	'ARS_CHAR_LEVEL'=> $arrData['level'],
	'ARS_CHAR_RACE_NAME'=> $this->user->lang('races')[$arrData['race'].'_'.$arrData['gender']],
	'ARS_CHAR_CLASS'=> $arrData['class'],
	'ARS_CHAR_CLASS_NAME'=> $this->user->lang('classes')[$arrData['class'].'_'.$arrData['gender']],
	'ARS_CHAR_CURRENT_SPEC_NAME'=> $this->user->lang('talents')[$arrData['talents']['selected']],
	'ARS_CHAR_REALM'=> $this->pdh->get('member', 'profile_field', array($this->url_id, 'servername')),
	
	'ARS_PAGE_CONTENT' => $content,
));



//class arsenal_profile_pageobject extends pageobject {
//	public function arsenal_controller(){
//		if($this->in->exists('professions')){
//			$this->professions_view();
//		}else{ $this->profile_view(); }
//	}
//	
//	public function profile_view(){
//		d('Ich betrachte die Profil Hauptseite');
//	}
//	
//	public function professions_view(){
//		d('Ich betrachte die Berufe Hauptseite');
//	}
//	
//}
//$objArsenalPage = new arsenal_profile_pageobject();
//$objArsenalPage->arsenal_controller();

?>