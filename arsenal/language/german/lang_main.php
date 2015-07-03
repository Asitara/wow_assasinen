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
		1	=> 'Gefreite ',
		2	=> 'Fußknecht ',
		3	=> 'Landsknecht ',
		4	=> 'Feldwebel ',
		5	=> 'Fähnrich ',
		6	=> 'Leutnant ',
		7	=> 'Hauptmann ',
		8	=> 'Kürassier ',
		9	=> 'Ritter der Allianz ',
		10	=> 'Feldkommandantin ',
		11	=> 'Rittmeisterin ',
		12	=> 'Marschall ',
		13	=> 'Feldmarschall ',
		14	=> 'Großmarschall ',
		15	=> 'Späherin ',
		16	=> 'Grunzerin ',
		17	=> 'Waffenträgerin ',
		18	=> 'Schlachtruferin ',
		19	=> 'Rottenmeisterin ',
		20	=> 'Steingardistin ',
		21	=> 'Blutgardistin ',
		22	=> 'Zornbringerin ',
		23	=> 'Klinge der Horde ',
		24	=> 'Feldherrin ',
		25	=> 'Sturmreiterin ',
		26	=> 'Kriegsherrin ',
		27	=> 'Kriegsfürstin ',
		28	=> 'Oberste Kriegsfürstin ',
		29	=> 'Gladiatorin ',
		30	=> 'Duellantin ',
		31	=> 'Rivalin ',
		32	=> 'Herausforderin ',
		33	=> 'Skarabäusfürstin ',
		34	=> 'Eroberin ',
		35	=> 'Vollstreckerin ',
		36	=> ' Champion der Naaru',
		37	=> 'Erbarmungslose Gladiatorin ',
		38	=> ' von der Zerschmetterten Sonne',
		39	=> ' Hand von A\'dal',
		40	=> 'Rachsüchtige Gladiatorin ',
		41	=> 'Kampfmeisterin ',
		42	=> ' die Unermüdliche',
		43	=> 'Älteste ',
		44	=> 'Flammenwächterin ',
		45	=> 'Flammenbewahrerin ',
		46	=> ' die Ehrfurchtgebietende',
		47	=> ' die Entdeckerin',
		48	=> 'Diplomatin ',
		49	=> 'Brutale Gladiatorin ',
		50	=> 'Arenameisterin ',
		51	=> ' Schrecken der Meere',
		52	=> 'Chefköchin ',
		53	=> ' die Große',
		54	=> ' von den zehn Stürmen',
		55	=> ' vom Smaragdgrünen Traum',
		56	=> 'Tödliche Gladiatorin ',
		57	=> 'Prophetin ',
		58	=> ' die Bösartige',
		59	=> 'Pirscherin ',
		60	=> ' von der Schwarzen Klinge',
		61	=> 'Erzmagierin ',
		62	=> 'Kriegshetzerin ',
		63	=> 'Assassine ',
		64	=> ' Großmeisterin der Alchemie',
		65	=> ' Großmeisterin der Schmiedekunst',
		66	=> 'Eiserne Chefköchin ',
		67	=> ' Großmeisterin der Verzauberkunst',
		68	=> ' Ingenieursgroßmeisterin',
		69	=> 'Doktor ',
		70	=> ' Großmeisterin des Angelns',
		71	=> ' Großmeisterin der Kräuterkunde',
		72	=> ' Großmeisterin der Inschriftenkunde',
		73	=> ' Großmeisterin der Juwelierskunst',
		74	=> ' Großmeisterin der Lederverarbeitung',
		75	=> ' Großmeisterin des Bergbaus',
		76	=> ' Großmeisterin der Kürschnerei',
		77	=> ' Großmeisterin der Schneiderei',
		78	=> ' von Quel\'Thalas',
		79	=> ' von Argus',
		80	=> ' von Khaz Modan',
		81	=> ' von Gnomeregan',
		82	=> ' Löwenherz',
		83	=> ' Elunes Champion',
		84	=> ' Heldin von Orgrimmar',
		85	=> 'Ebenenläuferin ',
		86	=> ' von den Dunkelspeeren',
		87	=> ' von den Verlassenen',
		88	=> ' die Magiesuchende',
		89	=> 'Zwielichtbezwingerin ',
		90	=> ' Bezwingerin von Naxxramas',
		91	=> ' Heldin Nordends',
		92	=> 'Nachtschrecken ',
		93	=> 'Meisterin der Lehren ',
		94	=> ' von der Allianz',
		95	=> ' von der Horde',
		96	=> 'Triumphator ',
		97	=> ' Heldin der eisigen Weiten',
		98	=> 'Botschafterin ',
		99	=> ' der Argentumchampion',
		100	=> ' Wächterin des Cenarius',
		101	=> 'Braumeisterin ',
		102	=> 'Winterhauchengel ',
		103	=> 'Liebesgöttin ',
		104	=> 'Matrone ',
		105	=> 'Matrone ',
		106	=> 'Obsidianvernichterin ',
		107	=> 'Nachtherrin ',
		108	=> ' die Unsterbliche',
		109	=> ' die Unverwüstliche',
		110	=> ' Jenkins',
		111	=> 'Blutsegeladmiralin ',
		112	=> ' die Wahnsinnige',
		113	=> ' von der Exodar',
		114	=> ' von Darnassus',
		115	=> ' von Eisenschmiede',
		116	=> ' von Sturmwind',
		117	=> ' von Orgrimmar',
		118	=> ' von Sen\'jin',
		119	=> ' von Silbermond',
		120	=> ' von Donnerfels',
		121	=> ' von Unterstadt',
		122	=> ' die Noble',
		123	=> 'Kreuzfahrerin ',
		124	=> 'Todesbotin ',
		125	=> ' die Himmelsverteidigerin',
		126	=> ' Eroberin von Ulduar',
		127	=> ' Champion von Ulduar',
		128	=> 'Bezwingerin ',
		129	=> 'Sternenruferin ',
		130	=> 'Astralwandlerin ',
		131	=> ' Herold der Titanen',
		132	=> 'Wütende Gladiatorin ',
		133	=> ' die Pilgerin',
		134	=> 'Unerbittliche Gladiatorin ',
		135	=> 'Oberste Kreuzfahrerin ',
		136	=> ' die Argentumverteidigerin',
		137	=> ' die Geduldige',
		138	=> ' das Licht des Morgens',
		139	=> ' Bezwingerin des gefallenen Königs',
		140	=> ' die Königsmörderin',
		141	=> ' vom Äschernen Verdikt',
		142	=> 'Zornerfüllte Gladiatorin ',
		143	=> ' die Kameltreiberin',
		144	=> 'Kriegshetzerin ',
		145	=> 'Kriegstreiberin ',
		146	=> ' gesegnete Verteidigerin von Nordrassil',
		147	=> ' Schlächterin von dummen, inkompetenten und enttäuschenden Lakaien',
		148	=> 'Gastdozentin ',
		149	=> 'Juniorprofessorin ',
		150	=> 'Professorin ',
		151	=> ' von den Vier Winden',
		152	=> ' Veteranin der Allianz',
		153	=> ' Veteranin der Horde',
		154	=> 'Gefreite ',
		155	=> 'Fußknecht ',
		156	=> 'Landsknecht ',
		157	=> 'Feldwebel ',
		158	=> 'Fähnrich ',
		159	=> 'Leutnant ',
		160	=> 'Hauptmann ',
		161	=> 'Kürassier ',
		162	=> 'Ritter der Allianz ',
		163	=> 'Feldkommandantin ',
		164	=> 'Rittmeisterin ',
		165	=> 'Marschall ',
		166	=> 'Feldmarschall ',
		167	=> 'Großmarschall ',
		168	=> 'Späherin ',
		169	=> 'Grunzerin ',
		170	=> 'Waffenträgerin ',
		171	=> 'Schlachtruferin ',
		172	=> 'Rottenmeisterin ',
		173	=> 'Steingardistin ',
		174	=> 'Blutgardistin ',
		175	=> 'Zornbringerin ',
		176	=> 'Klinge der Horde ',
		177	=> 'Feldherrin ',
		178	=> 'Sturmreiterin ',
		179	=> 'Kriegsherrin ',
		180	=> 'Kriegsfürstin ',
		181	=> 'Oberste Kriegsfürstin ',
		182	=> ' Heldin der Allianz',
		183	=> ' Heldin der Horde',
		184	=> ' die Blutrünstige',
		185	=> ' Verteidigerin einer zerschmetterten Welt',
		186	=> 'Drachentöterin ',
		187	=> ' Nemesis der Pechschwingen',
		188	=> ' Rächerin des Hyjal',
		189	=> ' die Flammenbrecherin',
		190	=> 'Feuerfürstin ',
		191	=> 'Boshafte Gladiatorin ',
		192	=> 'Ruchlose Gladiatorin ',
		193	=> 'Kataklysmische Gladiatorin ',
		194	=> ' Retterin von Azeroth',
		196	=> ' der Tod des Zerstörers',
	),



);
?>