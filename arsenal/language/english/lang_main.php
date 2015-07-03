<?php
/*	Project:	EQdkp-Plus
 *	Package:	Awards Plugin
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

if (!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
	'titles' => array(
		1	=> 'Private ',
		2	=> 'Corporal ',
		3	=> 'Sergeant ',
		4	=> 'Master Sergeant ',
		5	=> 'Sergeant Major ',
		6	=> 'Knight ',
		7	=> 'Knight-Lieutenant ',
		8	=> 'Knight-Captain ',
		9	=> 'Knight-Champion ',
		10	=> 'Lieutenant Commander ',
		11	=> 'Commander ',
		12	=> 'Marshal ',
		13	=> 'Field Marshal ',
		14	=> 'Grand Marshal ',
		15	=> 'Scout ',
		16	=> 'Grunt ',
		17	=> 'Sergeant ',
		18	=> 'Senior Sergeant ',
		19	=> 'First Sergeant ',
		20	=> 'Stone Guard ',
		21	=> 'Blood Guard ',
		22	=> 'Legionnaire ',
		23	=> 'Centurion ',
		24	=> 'Champion ',
		25	=> 'Lieutenant General ',
		26	=> 'General ',
		27	=> 'Warlord ',
		28	=> 'High Warlord ',
		29	=> 'Gladiator ',
		30	=> 'Duelist ',
		31	=> 'Rival ',
		32	=> 'Challenger ',
		33	=> 'Scarab Lord ',
		34	=> 'Conqueror ',
		35	=> 'Justicar ',
		36	=> ' Champion of the Naaru',
		37	=> 'Merciless Gladiator ',
		38	=> ' of the Shattered Sun',
		39	=> ' Hand of A\'dal',
		40	=> 'Vengeful Gladiator ',
		41	=> 'Battlemaster ',
		42	=> ' the Seeker',
		43	=> 'Elder ',
		44	=> 'Flame Warden ',
		45	=> 'Flame Keeper ',
		46	=> ' the Exalted',
		47	=> ' the Explorer',
		48	=> ' the Diplomat',
		49	=> 'Brutal Gladiator ',
		50	=> 'Arena Master ',
		51	=> 'Salty ',
		52	=> 'Chef ',
		53	=> ' the Supreme',
		54	=> ' of the Ten Storms',
		55	=> ' of the Emerald Dream',
		56	=> 'Deadly Gladiator ',
		57	=> 'Prophet ',
		58	=> ' the Malefic',
		59	=> 'Stalker ',
		60	=> ' of the Ebon Blade',
		61	=> 'Archmage ',
		62	=> 'Warbringer ',
		63	=> 'Assassin ',
		64	=> 'Grand Master Alchemist ',
		65	=> 'Grand Master Blacksmith ',
		66	=> 'Iron Chef ',
		67	=> 'Grand Master Enchanter ',
		68	=> 'Grand Master Engineer ',
		69	=> 'Doctor ',
		70	=> 'Grand Master Angler ',
		71	=> 'Grand Master Herbalist ',
		72	=> 'Grand Master Scribe ',
		73	=> 'Grand Master Jewelcrafter ',
		74	=> 'Grand Master Leatherworker ',
		75	=> 'Grand Master Miner ',
		76	=> 'Grand Master Skinner ',
		77	=> 'Grand Master Tailor ',
		78	=> ' of Quel\'Thalas',
		79	=> ' of Argus',
		80	=> ' of Khaz Modan',
		81	=> ' of Gnomeregan',
		82	=> ' the Lion Hearted',
		83	=> ' Champion of Elune',
		84	=> ' Hero of Orgrimmar',
		85	=> 'Plainsrunner ',
		86	=> ' of the Darkspear',
		87	=> ' the Forsaken',
		88	=> ' the Magic Seeker',
		89	=> 'Twilight Vanquisher ',
		90	=> ' Conqueror of Naxxramas',
		91	=> ' Hero of Northrend',
		92	=> ' the Hallowed',
		93	=> 'Loremaster ',
		94	=> ' of the Alliance',
		95	=> ' of the Horde',
		96	=> ' the Flawless Victor',
		97	=> ' Champion of the Frozen Wastes',
		98	=> 'Ambassador ',
		99	=> ' the Argent Champion',
		100	=> ' Guardian of Cenarius',
		101	=> 'Brewmaster ',
		102	=> 'Merrymaker ',
		103	=> ' the Love Fool',
		104	=> 'Matron ',
		105	=> 'Patron ',
		106	=> 'Obsidian Slayer ',
		107	=> ' of the Nightfall',
		108	=> ' the Immortal',
		109	=> ' the Undying',
		110	=> ' Jenkins',
		111	=> 'Bloodsail Admiral ',
		112	=> ' the Insane',
		113	=> ' of the Exodar',
		114	=> ' of Darnassus',
		115	=> ' of Ironforge',
		116	=> ' of Stormwind',
		117	=> ' of Orgrimmar',
		118	=> ' of Sen\'jin',
		119	=> ' of Silvermoon',
		120	=> ' of Thunder Bluff',
		121	=> ' of the Undercity',
		122	=> ' the Noble',
		123	=> 'Crusader ',
		124	=> ' Death\'s Demise',
		125	=> ' the Celestial Defender',
		126	=> ' Conqueror of Ulduar',
		127	=> ' Champion of Ulduar',
		128	=> 'Vanquisher ',
		129	=> 'Starcaller ',
		130	=> ' the Astral Walker',
		131	=> ' Herald of the Titans',
		132	=> 'Furious Gladiator ',
		133	=> ' the Pilgrim',
		134	=> 'Relentless Gladiator ',
		135	=> 'Grand Crusader ',
		136	=> ' the Argent Defender',
		137	=> ' the Patient',
		138	=> ' the Light of Dawn',
		139	=> ' Bane of the Fallen King',
		140	=> ' the Kingslayer',
		141	=> ' of the Ashen Verdict',
		142	=> 'Wrathful Gladiator ',
		143	=> ' the Camel-Hoarder',
		144	=> 'Warbringer ',
		145	=> 'Warbound ',
		146	=> ' Blessed Defender of Nordrassil',
		147	=> ' Slayer of Stupid, Incompetent and Disappointing Minions',
		148	=> 'Assistant Professor ',
		149	=> 'Associate Professor ',
		150	=> 'Professor ',
		151	=> ' of the Four Winds',
		152	=> ' Veteran of the Alliance',
		153	=> ' Veteran of the Horde',
		154	=> 'Private ',
		155	=> 'Corporal ',
		156	=> 'Sergeant ',
		157	=> 'Master Sergeant ',
		158	=> 'Sergeant Major ',
		159	=> 'Knight ',
		160	=> 'Knight-Lieutenant ',
		161	=> 'Knight-Captain ',
		162	=> 'Knight-Champion ',
		163	=> 'Lieutenant Commander ',
		164	=> 'Commander ',
		165	=> 'Marshal ',
		166	=> 'Field Marshal ',
		167	=> 'Grand Marshal ',
		168	=> 'Scout ',
		169	=> 'Grunt ',
		170	=> 'Sergeant ',
		171	=> 'Senior Sergeant ',
		172	=> 'First Sergeant ',
		173	=> 'Stone Guard ',
		174	=> 'Blood Guard ',
		175	=> 'Legionnaire ',
		176	=> 'Centurion ',
		177	=> 'Champion ',
		178	=> 'Lieutenant General ',
		179	=> 'General ',
		180	=> 'Warlord ',
		181	=> 'High Warlord ',
		182	=> ' Hero of the Alliance',
		183	=> ' Hero of the Horde',
		184	=> ' The Bloodthirsty',
		185	=> ' Defender of a Shattered World',
		186	=> 'Dragonslayer ',
		187	=> ' Blackwing\'s Bane',
		188	=> ' Avenger of Hyjal',
		189	=> ' the Flamebreaker',
		190	=> 'Firelord ',
		191	=> 'Vicious Gladiator ',
		192	=> 'Ruthless Gladiator ',
		193	=> 'Cataclysmic Gladiator ',
		194	=> ' Savior of Azeroth',
		196	=> ' Destroyer\'s End',
	),



);
?>