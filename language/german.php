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

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}
$german_array = array(
	'factions' => array(
		'horde'		=> 'Horde',
		'alliance'	=> 'Allianz'
	),
	'races' => array(
		'Unbekannt',
		'Gnom',
		'Mensch',
		'Zwerg',
		'Nachtelf',
		'Troll',
		'Untoter',
		'Ork',
		'Taure',
		'Draenei',
		'Blutelf',
		'Worg',
		'Goblin',
	),
	'classes' => array(
		0	=> 'Unbekannt',
		1	=> 'Todesritter',
		2	=> 'Druide',
		3	=> 'Jäger',
		4	=> 'Magier',
		5	=> 'Paladin',
		6	=> 'Priester',
		7	=> 'Schurke',
		8	=> 'Schamane',
		9	=> 'Hexenmeister',
		10	=> 'Krieger',
	),
	'talents'		=> array(
		0 	=> 'Blut',
		1 	=> 'Frost',
		2 	=> 'Unheilig',
		3 	=> 'Gleichgewicht',
		4 	=> 'Wildheit',
		5 	=> 'Wächter',
		6 	=> 'Wiederherstellung',
		7 	=> 'Tierherrschaft',
		8 	=> 'Treffsicherheit',
		9 	=> 'Überleben',
		10 	=> 'Arkan',
		11 	=> 'Feuer',
		12 	=> 'Frost',
		13 	=> 'Heilig',
		14 	=> 'Schutz',
		15 	=> 'Vergeltung',
		16 	=> 'Disziplin',
		17 	=> 'Heilig',
		18 	=> 'Schatten',
		19 	=> 'Meucheln',
		20 	=> 'Kampf',
		21 	=> 'Täuschung',
		22 	=> 'Elementar',
		23 	=> 'Verstärkung',
		24 	=> 'Wiederherstellung',
		25 	=> 'Gebrechen',
		26 	=> 'Dämonologie',
		27 	=> 'Zerstörung',
		28 	=> 'Waffen',
		29 	=> 'Furor',
		30 	=> 'Schutz',
	),
	'roles' => array(
		1	=> 'Heiler',
		2	=> 'Tank',
		3	=> 'DD Fernkampf',
		4	=> 'DD Nahkampf',
	),
	'professions' => array(
		'trade_alchemy'					=> 'Alchemie',
		'trade_blacksmithing'			=> 'Schmiedekunst',
		'trade_engraving'				=> 'Verzauberkunst',
		'trade_engineering'				=> 'Ingenieurskunst',
		'trade_herbalism'				=> 'Kräuterkunde',
		'inv_inscription_tradeskill01'	=> 'Inschriftenkunde',
		'inv_misc_gem_01'				=> 'Juwelenschleifen',
		'trade_leatherworking'			=> 'Lederverarbeitung',
		'inv_pick_02'					=> 'Bergbau',
		'inv_misc_pelt_wolf_01'			=> 'Kürschnerei',
		'trade_tailoring'				=> 'Schneiderei',
	),
	'lang' => array(
		'wow'			=> 'World of Warcraft',
		'wow_assasinen'	=> 'WoW Assasinen',
		'plate'			=> 'Platte',
		'cloth'			=> 'Stoff',
		'leather'		=> 'Leder',
		'mail'			=> 'Schwere Rüstung',
		'tier_token'	=> 'Token: ',
		'talents_tt_1'	=> 'Primäres Talent',
		'talents_tt_2'	=> 'Sekundäres Talent',
		'caltooltip_itemlvl'	=> 'Item-Level',
		
		// Profile information
		'uc_prof_professions'			=> 'Berufe',
		'skills'						=> 'Talente',
		'corevalues'					=> 'Grundwerte',
		'values'						=> 'Werte',

		// Profile information
		'uc_achievements'				=> 'Erfolge',
		'uc_bosskills'					=> 'Boss Kills',
		'uc_bar_rage'					=> 'Wut',
		'uc_bar_energy'					=> 'Energie',
		'uc_bar_mana'					=> 'Mana',
		'uc_bar_focus'					=> 'Fokus',
		'uc_bar_runic-power'			=> 'Runenmacht',

		'uc_skill1'						=> 'Talente 1',
		'uc_skill2'						=> 'Talente 2',

		'pv_tab_profiles'				=> 'Externe Profile',
		'pv_tab_talents'				=> 'Skillung',

		'uc_guild'						=> 'Gilde',
		'uc_bar_health'					=> 'Gesundheit',
		'uc_bar_2value'					=> 'Wert der 2. Leiste',
		'uc_bar_2name'					=> 'Name der 2. Leiste',

		'uc_gender'						=> 'Geschlecht',
		'uc_male'						=> 'Männlich',
		'uc_female'						=> 'Weiblich',
		'uc_faction'					=> 'Fraktion',
		'uc_faction_help'				=> 'Die Fraktion im Spiel',
		'uc_fact_horde'					=> 'Horde',
		'uc_fact_alliance'				=> 'Allianz',
		'uc_race'						=> 'Rasse',
		'uc_class'						=> 'Klasse',
		'uc_talent1'					=> 'Primäre Talentspezialisierung',
		'uc_talent2'					=> 'Sekundäre Talentspezialisierung',
		'uc_level'						=> 'Level',

		'uc_prof1_value'				=> 'Level des Hauptberufes',
		'uc_prof1_name'					=> 'Name des Hauptberufes',
		'uc_prof2_value'				=> 'Level des Sekundärberufes',
		'uc_prof2_name'					=> 'Name des Sekundärberufs',

		'uc_achievement_tab_default'	=> 'Ungruppiert',
		'uc_achievement_tab_classic'	=> 'Classic',
		'uc_achievement_tab_bc'			=> 'Burning Crusade',
		'uc_achievement_tab_wotlk'		=> 'Wrath of the Lich King',
		'uc_achievement_tab_cataclysm'	=> 'Cataclysm',
		'uc_achievement_tab_mop'		=> 'Mists of Pandaria',
		'uc_achievement_tab_wod'		=> 'Warlords of Draenor',
		
		'challenge'						=> 'Herausforderungsmodus',
		'challenge_title'				=> 'Herausforderungsmodus: Ranglisten',
		'off_realm_toon'				=> 'Dieser Charakter scheint nicht in deiner Gilde zu sein. Da die Herausforderungen realmübergreifend sind, können auch fremde Charakter in dieser Liste auftauchen.',

		// Profile Admin area
		'core_sett_fs_gamesettings'		=> 'WoW Einstellungen',
		'importer_head_txt'				=> 'battle.net Importer',
		'servername_help'				=> 'Servername des Spielservers (z.B. Mal\'Ganis)',
		
		
		'uc_import_guild'				=> 'Importiere ########',
		'uc_import_guild_help'			=> 'Importiere ########',
		
		
		
		
		
		
		'uc_server_loc'					=> 'Server Standort',
		'uc_server_loc_help'			=> 'Der Standort des WoW Game Servers',
		'uc_data_lang'					=> 'Sprache der Daten',
		'uc_data_lang_help'				=> 'In welcher Sprache sollen die Daten vom externen Anbieter geladen werden?',
		'uc_error_head'					=> 'FEHLER',
		'uc_error_noserver'				=> 'Es wurde kein Server in den globalen Einstellungen gefunden. Dieser wird für die Nutzung dieses Features jedoch benötigt. Bitte benachrichtige einen Administrator.',
		'uc_error_nodata_bnet'			=> 'Die battle.net API lieferte unvollständige Datensätze. Bitte versuche es später erneut.',
		
		// Armory Import
		"uc_updat_armory" 				=> "Vom battle.net aktualisieren",
		'uc_charname'					=> 'Charaktername',
		'servername'					=> 'Realm-Name',
		'uc_charfound'					=> "Der Charakter  <b>%1\$s</b> wurde im battle.net gefunden.",
		'uc_charfound2'					=> "Das letzte Update dieses Charakters war am <b>%1\$s</b>.",
		'uc_charfound3'					=> 'ACHTUNG: Beim Import werden bisher gespeicherte Daten überschrieben!',
		'uc_charfound4'					=> 'ACHTUNG: Der Charakter wurde schon im System gefunden. Er wird daher nicht importiert sondern aktualisiert.',
		'uc_armory_imported'			=> 'Charakter erfolgreich importiert',
		'uc_armory_updated'				=> 'Charakter erfolgreich aktualisiert',
		'uc_armory_impfailed'			=> 'Charakter nicht importiert',
		'uc_armory_updfailed'			=> 'Charakter nicht aktualisiert',
		'uc_armory_impfail_reason'		=> 'Grund:',
		'uc_armory_impduplex'			=> 'Charakter ist bereits vorhanden',
		
		// guild importer
		'uc_class_filter'				=> 'Klasse',
		'uc_class_nofilter'				=> 'Nicht filtern',
		'uc_guild_name'					=> 'Name der Gilde',
		'uc_filter_name'				=> 'Filter',
		'uc_level_filter'				=> 'Level größer als',
		'uc_rank_filter1a'				=> 'höher als',
		'uc_rank_filter1b'				=> 'gleich',
		'uc_rank_filter'				=> 'Rang',
		'uc_imp_noguildname'			=> 'Es wurde kein Gildenname angegeben',
		'uc_gimp_loading'				=> 'Gildenmitglieder werden geladen, bitte warten...',
		'uc_massupd_loading'			=> 'Charaktere werden aktualisiert, bitte warten...',
		'uc_gimp_header_fnsh'			=> 'Der Import der Gildenmitglieder wurde beendet. Beim Gildenimport werden nur der Charktername, die Rasse, die Klasse und das Level importiert. Um die restlichen Daten zu importieren, einfach den battle.net Updater benutzen.',
		'uc_cupdt_header_fnsh'			=> 'Die Aktualisierung der Charaktere wurde beendet. Das Fenster kann nun geschlossen werden.',
		'uc_importcache_cleared'		=> 'Der Cache des Importers wurde erfolgreich geleert.',
		'uc_startdkp'					=> 'Start-DKP vergeben',
		'uc_startdkp_adjreason'			=> 'Start-DKP',
		'uc_delete_chars_onimport'		=> 'Charaktere im System löschen, die nicht mehr in der Gilde sind',

		'uc_noprofile_found'			=> 'Kein Profil gefunden',
		'uc_profiles_complete'			=> 'Profile erfolgreich aktualisiert',
		'uc_notyetupdated'				=> 'Keine neuen Daten (Inaktiver Charakter)',
		'uc_notactive'					=> 'Das Mitglied ist im EQDKP auf inaktiv gesetzt und wird daher übersprungen',
		'uc_error_with_id'				=> 'Fehler mit der Member ID, Charakter übersprungen',
		'uc_notyourchar'				=> 'ACHTUNG: Du versuchst gerade einen Charakter hinzuzufügen, der bereits in der Datenbank vorhanden ist und dir nicht zugewiesen ist. Aus Sicherheitsgründen ist diese Aktion nicht gestattet. Bitte kontaktiere einen Administrator zum Lösen dieses Problems oder versuche einen anderen Charakternamen einzugeben.',
		'uc_lastupdate'					=> 'Letzte Aktualisierung',

		'uc_prof_import'				=> 'importieren',
		'uc_prof_update'				=> 'aktualisieren',
		'uc_import_forw'				=> 'Start',
		'uc_imp_succ'					=> 'Die Daten wurden erfolgreich importiert',
		'uc_upd_succ'					=> 'Die Daten wurden erfolgreich aktualisiert',
		'uc_imp_failed'					=> 'Beim Import der Daten trat ein Fehler auf. Bitte versuche es erneut.',
		'uc_sync_ranks'					=> 'Ränge synchronisieren',

		'base'							=> 'Attribute',
		'strength'						=> 'Stärke',
		'agility'						=> 'Beweglichkeit',
		'stamina'						=> 'Ausdauer',
		'intellect'						=> 'Intelligenz',
		'spirit'						=> 'Willenskraft',

		'profilers'						=> 'Externe Profilseiten',
		'profiler_askmrrobot'			=> 'AskMrRobot.com',

		'melee'							=> 'Nahkampf',
		'mainHandDamage'				=> 'Schaden',
		'mainHandDps'					=> 'DPS',
		'mainHandSpeed'					=> 'Geschwindigkeit',
		'power'							=> 'Angriffskraft',
		'hasteRating'					=> 'Tempowertung',
		'hitPercent'					=> 'Trefferwertung',
		'critChance'					=> 'Kritische Trefferwertung',
		'expertise'						=> 'Waffenkundewertung',
		'mastery'						=> 'Meisterschaftswertung',

		'range'							=> 'Distanzkampf',
		'damage'						=> 'Schaden',
		'rangedDps'						=> 'DPS',
		'rangedSpeed'					=> 'Geschwindigkeit',

		'spell'							=> 'Zauber',
		'spellpower'					=> 'Zaubermacht',
		'spellHit'						=> 'Trefferchance',
		'spellCrit'						=> 'Kritische Trefferchance',
		'spellPen'						=> 'Zauberdurchschlagskraft',
		'manaRegen'						=> 'Manaegeneration',
		'combatRegen'					=> 'Kampfregeneration',

		'defenses'						=> 'Verteidigung',
		'armor'							=> 'Rüstung',
		'dodge'							=> 'Ausweichen',
		'parry'							=> 'Parieren',
		'block'							=> 'Blocken',
		'pvpresil'						=> 'PVP-Abhärtung',
		'pvppower'						=> 'PVP-Macht',
		'all'							=> 'Alle Werte',

		'achievements'					=> 'Erfolge',
		'achievement_points'			=> 'Erfolgspunkte',
		'total'							=> 'Gesamt',
		'health'						=> 'Leben',
		'last5achievements'				=> 'Die letzten 5 Erfolge',

		'charnewsfeed'					=> 'Letzte Aktivitäten',
		'charnf_achievement'			=> 'Erfolg %s für %s Punkte errungen.',
		'charnf_achievement_hero'		=> 'Heldentat %s errungen.',
		'charnf_item'					=> 'Erhalten %s',
		'charnf_bosskill'				=> '%s %s',
		'charnf_criteria'				=> 'Schritt %s des Erfolgs %s abgeschlossen.',
		'avg_itemlevel'					=> 'Durchschnittliche Gegenstandsstufe',
		'avg_itemlevel_equiped'			=> 'ausgerüstet',

		// bossprogress
		'bossprogress_normalruns'		=> '%sx normal',
		'normalrun'						=> 'N',
		'bossprogress_heroicruns'		=> '%sx heroisch',
		'heroicrun'						=> 'H',
		'bossprogress_mythicruns'		=> '%sx mystisch',
		'mythicrun'						=> 'M',

		'wotlk'							=> 'Wrath of the Lich King',
		'cataclysm'						=> 'Cataclysm',
		'burning_crusade'				=> 'Burning Crusade',
		'classic'						=> 'Classic',
		
		'misc_guildnews'				=> 'Ankündigung',
		'misc_guildmeeting'				=> 'Besprechung',
		'misc_guildbank'				=> 'Gildenbank',
		'misc_startpoints'				=> 'Startpunkte',
		'cata_bh_normal'				=> 'Baradienfeste',
		'cata_bwd_normal'				=> 'Pechschwingenabstieg',
		'cata_bwd_heroic'				=> 'Pechschwingenabstieg HC',
		'cata_bot_normal'				=> 'Bastion des Zwielichts',
		'cata_bot_heroic'				=> 'Bastion des Zwielichts HC',
		'cata_tot4w_normal'				=> 'Thron der Vier Winde',
		'cata_tot4w_heroic'				=> 'Thron der Vier Winde HC',
		'cata_fl_normal'				=> 'Feuerlande',
		'cata_fl_heroic'				=> 'Feuerlande HC',
		'cata_ds_normal'				=> 'Drachenseele',
		'cata_ds_heroic'				=> 'Drachenseele HC',
		'evnt_pokernacht'				=> '[EVENT] - Pokernacht',
		'evnt_ahnqiraj'					=> '[EVENT] - Erforscht Ahn\'qiraj',
		
		'char_news'						=> 'Char News',
		'no_armory'						=> 'Es konnten keine gültigen Daten für diesen Charakter geladen werden. Die battle.net API meldet folgenden Fehler: "%s".',
		'no_realm'						=> 'Um den vollen Funktionsumfang dieser Seite nutzen zu können, muss in den Administrator-Einstellungen ein gültiger World of Warcraft Server hinterlegt werden.',
		
		'guildachievs_total_completed'	=> 'Vollständig abgeschlossen',
		'latest_guildachievs'			=> 'Kürzlich erhalten',
		'guildnews'						=> 'Gildennews',
		'news_guildCreated'				=> 'Gilde wurde gegründet',
		'news_itemLoot'					=> '%1$s erhielt %2$s',
		'news_itemPurchase'				=> '%1$s erwarb den Gegenstand: %2$s',
		'news_guildLevel'				=> 'Die Gilde hat Level %s erreicht',
		'news_guildAchievement'			=> 'Die Gilde hat den Erfolg %1$s für %2$s Punkte errungen.',
		'news_playerAchievement'		=> '%1$s hat den Erfolg %2$s für %3$s Punkte errungen.',

		'not_assigned'					=> 'Nicht verteilt',
		'empty'							=> 'Leer',
		'major_glyphs'					=> 'Erhebliche Glyphen',
		'minor_glyphs'					=> 'Geringe Glyphen',
	),

	'realmlist' => array('Frostberry','Frostmourne'),
);
?>
