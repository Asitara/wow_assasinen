<?php
infotooltip_js(); // init infotooltip

// das kommt später raus, wenn alles sauber aufgeteilt und verabeitet ist......
$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/profile.css');
$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/summary.css');

$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/pet.css');
$this->tpl->css_file($this->root_path.'games/wow_assasinen/profiles/templates/zone.css');
//---------


// fetch and prepare arsenal data
$arrData = $this->pdh->get('arsenal_character', 'data', array($this->url_id));
$arrData['stats']		= json_decode($arrData['stats'], true);
$arrData['titles']		= json_decode($arrData['titles'], true);
$arrData['reputation']	= json_decode($arrData['reputation'], true);
$arrData['currencies']	= json_decode($arrData['currencies'], true);
$arrData['talents']		= json_decode($arrData['talents'], true);
$arrData['professions']	= json_decode($arrData['professions'], true);
$arrData['mounts']		= json_decode($arrData['mounts'], true);	// sollte doch eig als "companions" mit critters gemerged sein??!!
$arrData['critters']	= json_decode($arrData['critters'], true);
$arrData['inventory']	= json_decode($arrData['inventory'], true);

$arrData['faction']	= ( in_array($arrData['race'], array(0,5,6,7,8,10,12)) )? 'horde' : 'alliance';


// Arsenal Page Controller
switch($page_name = $this->in->get('page')){
	case 'professions':
		break;
	default:
		$content = $this->arsenal->character_main_page($arrData);
		$page_name = 'overview';
}

// Build sidebar-menu
$disablePages = array(
	'overview'		=> false,
	'achievements'	=> true,
	'companions'	=> true,
	'professions'	=> true,
	'reputation'	=> true,
	'pvp'			=> true,
	'guild'			=> false,
);
foreach($disablePages as $page => $disabled){
	$link = $this->pdh->get('member', 'memberlink', array($this->url_id, $this->routing->simpleBuild('character'), '', true)).'&page='.$page;
	if($page == 'overview') $link = $this->pdh->get('member', 'memberlink', array($this->url_id, $this->routing->simpleBuild('character'), '', true));
	if($page == 'guild') $link = $this->routing->simpleBuild('roster');
	
	$this->tpl->assign_block_vars('sidebar_menu', array(
		'NAME'		=> $this->user->lang('character_pages')[$page],
		'URL'		=> $link,
		'DISABLED'	=> $disabled,
		'ACTIVE'	=> ($page == $page_name)? true : false,
	));
}




$this->tpl->assign_vars(array(
	'CHAR_TITLE_NAME'	=> $this->user->lang('ars_data_titles')[$arrData['title']],
	'CHAR_GUILD'		=> $this->pdh->get('member', 'profile_field', array($this->url_id, 'guild')),
	'CHAR_LEVEL'		=> $arrData['level'],
	'CHAR_RACE_NAME'	=> $this->user->lang('ars_data_races')[$arrData['race'].'_'.$arrData['gender']],
	'CHAR_CLASS'		=> $arrData['class'],
	'CHAR_CLASS_NAME'	=> $this->user->lang('ars_data_classes')[$arrData['class'].'_'.$arrData['gender']],
	'CHAR_CURRENT_SPEC_NAME'=> $this->user->lang('ars_data_talents')[$arrData['talents']['selected']],
	'CHAR_REALM'		=> $this->pdh->get('member', 'profile_field', array($this->url_id, 'servername')),
	'CHAR_FACTION'		=> $arrData['faction'],
	'MEMBERLINK'			=> $this->pdh->get('member', 'memberlink', array($this->url_id, $this->routing->simpleBuild('character'), '', true)),
	'EQDKP_ROSTER_URL'		=> $this->routing->simpleBuild('roster'),
	
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