<?php
infotooltip_js(); // init infotooltip
/*----------------------------------------------------*/

/* Arsenal Page Controller */
if($this->in->exists('professions')){
	$this->arsenal->fetch_guild_progress();
}
elseif($this->in->exists('talents')){
	
}
else{
	$content = $this->arsenal->character_main_page();
}


$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/profile.css');
$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/summary.css');

$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/pet.css');
$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/zone.css');


$this->tpl->assign_var('ARSENAL_CHARACTER_CONTENT', $content);



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