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

function parseDump(str){
	return String(str)
			.slice(16, -3)				// delete the .lua code at the start & end
			.replace(/\\\\'/g, '&#39;') // now we validate the string cause 
			.replace(/'/g, '&#39;')		// we have vars like: "name" => ""ESSENSSCHLACHT!"" or "name" => 'Die Seh'her'
			
			.replace(/\\\"/g, '"')	// last validate the bindings between index and value of each entry
			.replace(/\\/g, ''); // stripslashes() -- cause the .lua json escaped the string
}

function parseDump2Array(str){
	objJSONdump = jQuery.parseJSON( str );
	return objJSONdump;
}

function readChardump(files){
	for (var i = 0, f; f = files[i]; i++){
		if (!f.name.substr(-3).match('lua')){ continue; }
		
		var oFReader = new FileReader();
		
		oFReader.onload = (function(theFile){
			return function(e){
				chardump = e.target.result;
				
				
				chardump = parseDump(chardump);
				
				$('#read_chardump').append('<input name="chardump['+i+']" type="input" />');
				$('#read_chardump input[name="chardump['+i+']"]').val(chardump);
				
				objJSONdump = parseDump2Array(chardump)
				$('#list_chardump').append('<li><strong>'+objJSONdump.global.name+'</strong>, erstellt am '+objJSONdump.global.date+'</li>');
			};
		})(f);
		
		oFReader.readAsText(f);
	}
	//preg_match_all("/(.*)\/games\/wow_assasinen\/import\//", $(location).attr('href'), $base_url);
	//setTimeout(function(){ i_time=5; alert(i_time); i_time--; }, 1000);
	//$(location).attr('href', $base_url+'charimporter.php?s=&step=1');
}

$(document).ready(function(){ $('#read_chardump').val(''); 
	$('#chardump_file').on('change', function(evt){
		var files = evt.target.files;
		readChardump(files);
	});
	
	$('#drag-drop-area-single').on('dragover', function(evt){
		evt.preventDefault();
	});
	$('#drag-drop-area-single').on('drop', function(evt){
		evt.preventDefault();
		var files = evt.originalEvent.dataTransfer.files;
		readChardump(files);
	});
});



