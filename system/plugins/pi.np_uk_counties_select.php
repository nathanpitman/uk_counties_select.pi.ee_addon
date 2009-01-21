<?php

$plugin_info = array(
	'pi_name'			=> 'UK Counties Select',
	'pi_version'		=> '1.2',
	'pi_author'			=> 'Nathan Pitman',
	'pi_author_url'		=> 'http://www.nathanpitman.com/',
	'pi_description'	=> 'Displays a drop down select of UK Counties',
	'pi_usage'			=> np_uk_counties_select::usage()
);

class np_uk_counties_select {

	var $name 		= "";
	var $selected 	= "";
	var $style		= "";
	
	function np_uk_counties_select()
	{
		global $TMPL;
		
		$ukcounties = array("Aberdeenshire","Anglesey","Angus","Antrim","Argyllshire","Armagh","Ayrshire","Banffshire","Bedfordshire","Berkshire","Berwickshire","Brecknockshire","Buckinghamshire","Buteshire","Caernarfonshire","Caithness","Cambridgeshire","Cardiganshire","Carmarthenshire","Cheshire","Clackmannanshire","Cornwall","Cromartyshire","Cumberland","Denbighshire","Derbyshire","Devon","Dorset","Down","Dumfriesshire","Dunbartonshire","Durham","East Lothian","Essex","Fermanagh","Fife","Flintshire","Glamorgan","Gloucestershire","Hampshire","Herefordshire","Hertfordshire","Huntingdonshire","Inverness-shire","Kent","Kincardineshire","Kinross","Kirkcudbrightshire","Lanarkshire","Lancashire","Leicestershire","Lincolnshire","London (Greater)","Londonderry","Manchester (Greater)","Merioneth","Middlesex","Midlothian","Monmouthshire","Montgomeryshire","Morayshire","Nairnshire","Norfolk","Northamptonshire","Northumberland","Nottinghamshire","Orkney","Oxfordshire","Pembrokeshire","Peeblesshire","Perthshire","Radnorshire","Renfrewshire","Ross-shire","Roxburghshire","Rutland","Selkirkshire","Shetland","Shropshire","Somerset","Staffordshire","Stirlingshire","Suffolk","Surrey","Sussex","Sutherland","Tyrone","Warwickshire","West Lothian","Westmorland","Wigtownshire","Wiltshire","Worcestershire","Yorkshire");

		// Get target from template
		
		$name = $TMPL->fetch_param('name');
		$all = $TMPL->fetch_param('all');
		$selected = $TMPL->fetch_param('selected');
		$style = $TMPL->fetch_param('style');
        
		if ($name != "") {
			
			if ($style != "") {
				$style_string = " style='".$style."'";
			} else {
				$style_string = "";
			}
			
			$string = "<select class='select' name='".$name."'".$style_string.">";
			if ($all == "true") {
				$string .= "<option value=''>All</option>";
			}
			foreach ($ukcounties as $value) {
				if ($value == $selected) {
					$sel_string = " selected='selected'";
				} else {
					$sel_string = "";
				}
				$string .= "<option value='".$value."'".$sel_string.">".$value."</option>";
			}
			$string .= "</select>";
			$this->return_data = $string;
		} else {
			$this->return_data = "Error: The name parameter is required!";
			return;
		}	
	}
	

// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>
This plug-in is designed to return a drop down select of UK counties. You must specify a 'name' for the select element.

BASIC USAGE:

{exp:np_uk_counties_select name="myname" selected="Berkshire"}

PARAMETERS:

name = 'myname' (no default - must be specified)
 - The name you want to apply to the select element
 
all = 'true' (default - false)
 - Specify a parameter of 'all="true"' if you want to include an 'all' option at the top of the select
 
selected = 'Berkshire' (no default)
 - Specify the value of the County you want to be pre-selected in the select

	
RELEASE NOTES:

1.2 - Added 'Greater London' and 'Greater Manchester' to counties array.
1.1 - Added 'selected' parameter to specify selected value.
1.0 - Initial Release.

For updates and support check the developers website: http://nathanpitman.com/journal/


<?php
$buffer = ob_get_contents();
	
ob_end_clean(); 

return $buffer;
}


}
?>