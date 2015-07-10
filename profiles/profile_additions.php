<?php
infotooltip_js(); // init infotooltip
/*----------------------------------------------------*/

/* Arsenal Page Controller */
if($this->in->exists('professions')){
	d($this->arsenal->fetch_guild_progress());
}
elseif($this->in->exists('talents')){
	
}
else{ $this->arsenal->character_main_page(); }


$this->tpl->css_file($this->root_path.'games/wow_assasinen/arsenal/style.css');




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