<?php
/*
Plugin Name: Ultimate Tables
Plugin URI: http://www.extendyourweb.com/ultimate-tables/
Description: Ultimate tables lets you create, manage and professional designs to your tables.
Version: 1.3
Author: extendyourweb.com
Author URI: http://www.extendyourweb.com

Copyright 2014  Webpsilon S.C.P.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
*/

function getYTidultimatetables($ytURL) {
#
 
#
$ytvIDlen = 11; // This is the length of YouTube's video IDs
#
 
#
// The ID string starts after "v=", which is usually right after
#
// "youtube.com/watch?" in the URL
#
$idStarts = strpos($ytURL, "?v=");
#
 
#
// In case the "v=" is NOT right after the "?" (not likely, but I like to keep my
#
// bases covered), it will be after an "&":
#
if($idStarts === FALSE)
#
$idStarts = strpos($ytURL, "&v=");
#
// If still FALSE, URL doesn't have a vid ID
#
if($idStarts === FALSE)
#
die("YouTube video ID not found. Please double-check your URL.");
#
 
#
// Offset the start location to match the beginning of the ID string
#
$idStarts +=3;
#
 
#
// Get the ID string and return it
#
$ytvID = substr($ytURL, $idStarts, $ytvIDlen);
#
 
#
return $ytvID;
#
 
#
}



function ultimatetables_enqueue_scripts() { 


 wp_register_style( 'ultimate-tables-style', plugins_url('/css/ultimate-tables.css', __FILE__) );
 wp_enqueue_style( 'ultimate-tables-style' );

 }

 

function ultimatetables($content){
	$content = preg_replace_callback("/\[ultimatetables ([^]]*)\/\]/i", "ultimatetables_render2", $content);
	return $content;
	
}

function ultimatetables_render2($tag_string){
	return ultimatetables_render($tag_string, "");
}

function ultimatetables_render($tag_string, $instance){
$contador=rand(9, 9999999);

$widthloading="48"; // Set if change loading image

global $wpdb; 	

	
	
	$table_name = $wpdb->prefix . "ultimatetables";
	
if(isset($tag_string[1])) {
	
	
	
	$auxi1=str_replace(" ", "", $tag_string[1]);
	
	}

else {
	
	
	
	$auxi1 = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
	
	}


	
	
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = ".$auxi1.";" );

	if(count($myrows)<1) $myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );
	
	$conta=0;
$id= $myrows[$conta]->id;
	$title = $myrows[$conta]->title;
		$width = $myrows[$conta]->width;
$height = $myrows[$conta]->height;
$values =$myrows[$conta]->ivalues;

$twidth = $myrows[$conta]->width_thumbnail;

$theight = $myrows[$conta]->height_thumbnail;

$number_thumbnails = $myrows[$conta]->number_thumbnails;



$total = $myrows[$conta]->number_thumbnails;

$border = $myrows[$conta]->border;
$round = $myrows[$conta]->round;
$tborder = $myrows[$conta]->thumbnail_border;
$thumbnail_round = $myrows[$conta]->thumbnail_round;

$sizetitle = $myrows[$conta]->sizetitle;
$sizedescription = $myrows[$conta]->sizedescription;
$sizethumbnail = $myrows[$conta]->sizethumbnail;
$font = $myrows[$conta]->font;
$color1 = $myrows[$conta]->color1;
$color2 = $myrows[$conta]->color2;

$color3 = $myrows[$conta]->color3;

$time = $myrows[$conta]->time;

$animation = $myrows[$conta]->animation;

$mode = $myrows[$conta]->mode;

$op1 = $myrows[$conta]->op1;
$op2 = $myrows[$conta]->op2;
$op3 = $myrows[$conta]->op3;
$op4 = $myrows[$conta]->op4;
$op5 = $myrows[$conta]->op5;
$site_url = get_option( 'siteurl' );
$firstisliderimage="";

$items_slider="";
$items_numbers="";
$cont=0;

$output="";
			if($values!="") {

	
/*
 $params = array(
  'id' => $id.$contador,
  'sizethumbnail' => $sizethumbnail,
  'op1' => $op1,
  'op1' => $op2,
  'op1' => $op3
);
 
 
 wp_localize_script( 'ultimatetablesscript', 'object_name', $params );

*/
	//////////////////////////////////////////////////////////////////////
	
	 $items=explode("kh6gfd57hgg", $values);
				
				
	$tableclass="";
	
	if($time!="manual") $tableclass=$time;	
	else 	$tableclass=$op4;	
	  
	  $heighttable="";
	  
	  if($theight!="" && $theight>0) $heighttable='
	    "bScrollInfinite": true,
        "bScrollCollapse": true,
        "sScrollY": "'.((int)$theight).'px",
		';
		
		$ispagination="true";
		$typepagination="full_numbers";
	  
	  if($sizethumbnail=="false") $ispagination="false";
	  if($sizethumbnail=="true" || $sizethumbnail=="") $typepagination="two_button";
	  
	  $output.= '<script type="text/javascript" charset="utf-8">jQuery(document).ready(function() {jQuery(\'#table_'.$id.$contador.'\').dataTable( {"bPaginate": '.$ispagination.',"bLengthChange": '.$op5.',"bFilter": '.$op1.',"bSort": '.$op2.',"bInfo": '.$op3.',"bStateSave": true,"bAutoWidth": '.$sizedescription.',"sPaginationType": "'.$typepagination.'",'.$heighttable.''.$sizetitle.'} );});</script><table id="table_'.$id.$contador.'" width="100%" class="'.$tableclass.'"><thead><tr>';
		
		
		$cc=0;
		$cont=0;
		while($cc<$width) {
			
			if(isset($items[$cont])) {
				$item=explode("t6r4nd", $items[$cont]);
				$output.= '<th>'.$item[0].'</th>';
			}
			else $output.= '<th></th>';
			$cc++;
			$cont++;
		}
	
        $output.= '</tr>
    </thead>
    <tbody>
	';
	
	
		$cr=0;
		while($cr<$height) {
			
			$output.= '<tr>';
			
			$cc=0;
		while($cc<$width) {
			
			if(isset($items[$cont])) {
				$item=explode("t6r4nd", $items[$cont]);
				$output.= '<td>'.$item[0].'</td>';
			}
			else $output.= '<td></td>';
			
			$cont++;
			$cc++;
		}
			
			$output.= '</tr>';
			$cr++;
		}
		
		$output.= '
    </tbody>
</table>';
	
			}
	
	if(isset($tag_string[1])) return $output;
	else echo $output;
}


function add_header_ultimatetables() {


	 
 wp_register_style( 'ultimate-tables-style', plugins_url('', __FILE__).'/css/ultimate-tables.css' );
 wp_enqueue_style( 'ultimate-tables-style' );	
 wp_enqueue_script('jquery');
	
	wp_enqueue_script('ultimatetables', plugins_url('', __FILE__).'/js/jquery.dataTables.js', array('jquery'), '1.0', true);
	//wp_enqueue_script('ultimatetablesscript', plugins_url('', __FILE__).'/js/ultimate-tables.js', array('jquery'), '1.0', true);
	 
	

}

class wp_ultimatetables extends WP_Widget {
	function wp_ultimatetables() {
		$widget_ops = array('classname' => 'wp_ultimatetables', 'description' => 'Select the table to show.' );
		$this->WP_Widget('wp_ultimatetables', 'ULTIMATE TABLES', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		$site_url = get_option( 'siteurl' );


		
		//$instance['hide_is_admin']

		
		
			echo $before_widget;
			
			echo ultimatetables_render("", $instance);
			
			
			echo $after_widget;
		
	}
	function update($new_instance, $old_instance) {
		
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		
		
		
		
		
		
		$instance['values']=$values;
		
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'width' => '240', 'height' => '200', 'border' => '10', 'round' => '1', 'width_thumbnail' => '40', 'height_thumbnail' => '50', 'thumbnail_border' => '6', 'thumbnail_round' => '1', 'number_thumbnails' => '4', 'values'=>'', 'sizetitle'=>'18pt Arial', 'sizedescription'=>'12pt Arial', 'sizethumbnail'=>'10pt Arial', 'font'=>'Verdana', 'color1'=>'#333333', 'color2'=>'#888888', 'color3'=>'#dddddd', 'time'=>'5000', 'animation'=>'0', 'mode'=>'0','op1' => '','op2' => '','op3' => '','op4' => '','op5' => '' ) );
		$title = strip_tags($instance['title']);
		$id=rand(0, 99999);
		$width = strip_tags($instance['width']);
		$height = strip_tags($instance['height']);
		$border = strip_tags($instance['border']);
		$round = strip_tags($instance['round']);
		$title = strip_tags($instance['title']);
		$width_thumbnail = strip_tags($instance['width_thumbnail']);
		$height_thumbnail = strip_tags($instance['height_thumbnail']);
		$thumbnail_border = strip_tags($instance['thumbnail_border']);
		$thumbnail_round = strip_tags($instance['thumbnail_round']);
		$number_thumbnails = strip_tags($instance['number_thumbnails']);
		$values = strip_tags($instance['values']);
		
		$sizetitle = strip_tags($instance['sizetitle']);
		$sizedescription = strip_tags($instance['sizedescription']);
		$sizethumbnail = strip_tags($instance['sizethumbnail']);
		$font = strip_tags($instance['font']);
		$color1 = strip_tags($instance['color1']);
		$color2 = strip_tags($instance['color2']);
		$color3 = strip_tags($instance['color3']);
		
		$time = strip_tags($instance['time']);
		$animation = strip_tags($instance['animation']);
		$mode = strip_tags($instance['mode']);
		
		$op1 = strip_tags($instance['op1']);
		$op2 = strip_tags($instance['op2']);
		$op3 = strip_tags($instance['op3']);
		$op4 = strip_tags($instance['op4']);
		$op5 = strip_tags($instance['op5']);

		
		
		$borderround[$round] = 'checked';
		$tborderround[$thumbnail_round] = 'checked';
		
		

  global $wpdb; 
	$table_name = $wpdb->prefix . "ultimatetables";
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );

if(empty($myrows)) {
	
	echo '
	<p>First create a new table, from the administration of ultimate tables: Settings->ultimate tables.</p>
	';
}

else {
	$contaa1=0;
	$selector='<select name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'">';
	while($contaa1<count($myrows)) {
		
		
		$tt="";
		if($title==$myrows[$contaa1]->id)  $tt=' selected="selected"';
		$selector.='<option value="'.$myrows[$contaa1]->id.'"'.$tt.'>'.$myrows[$contaa1]->id.' '.$myrows[$contaa1]->title.'</option>';
		$contaa1++;
		
	}
	
	$selector.='</select>';




echo 'Table: '.$selector; 

			}
	}
}
function ultimatetables_panel(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "ultimatetables";	
	
	if(isset($_POST['crear'])) {
		$re = $wpdb->query("select * from $table_name");
		
		
//autos  no existe
if(empty($re))
{
	

	
	
  $sql = " CREATE TABLE $table_name(
	id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
	title longtext NOT NULL ,
	width longtext NOT NULL ,
	height longtext NOT NULL ,
	border longtext NOT NULL ,
	round longtext NOT NULL ,
	width_thumbnail longtext NOT NULL ,
	height_thumbnail longtext NOT NULL ,
	thumbnail_border longtext NOT NULL ,
	thumbnail_round longtext NOT NULL ,
	number_thumbnails longtext NOT NULL ,
	ivalues longtext NOT NULL ,
	sizetitle longtext NOT NULL ,
	sizedescription longtext NOT NULL ,
	sizethumbnail longtext NOT NULL ,
	font longtext NOT NULL ,
	color1 longtext NOT NULL ,
	color2 longtext NOT NULL ,
	color3 longtext NOT NULL ,
	time longtext NOT NULL ,
	animation longtext NOT NULL ,
	mode longtext NOT NULL ,
	op1 longtext NOT NULL ,
	op2 longtext NOT NULL ,
	op3 longtext NOT NULL ,
	op4 longtext NOT NULL ,
	op5 longtext NOT NULL ,
	
		PRIMARY KEY ( `id` )	
	) ;";
	$wpdb->query($sql);
	
}

		
	$sql = "INSERT INTO $table_name (`title`, `width`, `height`, `border`, `round`, `width_thumbnail`, `height_thumbnail`, `thumbnail_border`, `thumbnail_round`, `number_thumbnails`, `ivalues`, `sizetitle`, `sizedescription`, `sizethumbnail`, `font`, `color1`, `color2`, `color3`, `time`, `animation`, `mode`, `op1`, `op2`, `op3`, `op4`, `op5`) VALUES('', '3', '1', '', '', '3', '', '', '', '', 'write name columt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndkh6gfd57hggwrite name columnt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndkh6gfd57hggwrite name columnt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndkh6gfd57hggwrite valuet6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndkh6gfd57hggwrite valuet6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndkh6gfd57hggwrite valuet6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndt6r4ndkh6gfd57hgg', '\"oLanguage\": {\r\n			\"sLengthMenu\": \"Display _MENU_ records per page\",\r\n			\"sZeroRecords\": \"Nothing found - sorry\",\r\n			\"sInfo\": \"Showing _START_ to _END_ of _TOTAL_ records\",\r\n			\"sInfoEmpty\": \"Showing 0 to 0 of 0 records\",\r\n                        \"sSearch\": \"Search: \",\r\n			\"sInfoFiltered\": \"(filtered from _MAX_ total records)\"\r\n		}', '', 'true', '', '', '', '', 'display', '', '', 'true', 'true', 'true', '', 'true');";
	$wpdb->query($sql);
	}
	
if(isset($_POST['borrar'])) {
		$sql = "DELETE FROM $table_name WHERE id = ".$_POST['borrar'].";";
	$wpdb->query($sql);
	}
	if(isset($_POST['id'])){	
	
	function sortByOrder($a, $b) {
    if(isset($a['order']) && isset($b['order'])) return intval(intval($a['order']) - intval($b['order']));
}


if(isset($_POST['new'])) {
	 $_POST["height".$_POST['id']]=$_POST["height".$_POST['id']]+1;
		
}

	
	$total = strip_tags($_POST['total']);

$cont=0;
$aum=0;
$salvan=array();
$sorterr=array();
while($cont<$total/$_POST["twidth".$_POST['id']]) {
	
	
	
	$conta=0;
	$valaux=count($sorterr);
	if(isset($_POST['orderc'.$cont])) $sorterr[$valaux]['order']=$_POST['orderc'.$cont];
	$sorterr[$valaux]['cont']=$cont;
	
	
	/*
	while($conta<$total/$_POST["twidth".$_POST['id']]) {
		
		if($_POST['orderc'.$cont]==$_POST['orderc'.$conta] && $cont!=$conta) {
			$aum++;
			$salvan[]=$conta;
		}
		
		$conta++;
	}
	
	if(!in_array($cont, $salvan)) $_POST['orderc'.$cont]+=$aum;
	*/
	
	$cont++;
}


usort($sorterr, 'sortByOrder');
$conta=0;
foreach ($sorterr as &$value) {
	
	$cont = $value['cont'];
	$_POST['orderc'.$cont]=$conta;
	$conta++;
}

$cont=0;
$aum=0;
$salvan2=array();

$maxi=0;

$sorterf=array();

while($cont<$_POST["twidth".$_POST['id']]) {
	
	
	
	$conta=0;
	$valaux=count($sorterf);
	$sorterf[$valaux]['order']=$_POST['order'.$cont];
	$sorterf[$valaux]['cont']=$cont;
	
/*	while($conta<$_POST["twidth".$_POST['id']]) {
		
		if($_POST['order'.$cont]==$_POST['order'.$conta] && $cont!=$conta) {
			$aum++;
			$salvan2[]=$conta;
			if($maxi<$_POST['order'.$conta]) $maxi=$_POST['order'.$conta];
		}
		
		$conta++;
	}
	
	if(!in_array($cont, $salvan2) && $cont<$maxi) $_POST['order'.$cont]+=$aum;
	*/
	$cont++;
}


usort($sorterf, 'sortByOrder');
$conta=0;
foreach ($sorterf as &$value) {
	
	$cont = $value['cont'];
	$_POST['order'.$cont]=$conta;
	$conta++;
}

		
		$cont=0;
		$conta=-1;
		$cont2=0;
		$rest=0;
		
		$sorter=array();
		
		while($cont<$total) {
			
			if((!isset($_POST['dele'.$conta]) && !isset($_POST['del'.$cont2])) || !isset($_POST["deleteitems"])) {
				
				$valaux=count($sorter);
				$aumenc=0;
				if($_POST['order'.$cont2]!=$cont2) $aumenc=$_POST['order'.$cont2]-$cont2;
				if($conta==-1) $sorter[$valaux]['order']=number_format($cont+$aumenc);
				else $sorter[$valaux]['order']=number_format((($_POST['orderc'.$conta]+1)*$_POST['twidth'.$_POST['id']])+$cont2+$aumenc);
				
				
				
				
				
				$sorter[$valaux]['cont']=$cont;
				
				
				
			}
			else {
				 if ($cont2+1>=$_POST["twidth".$_POST['id']] && $_POST['dele'.$conta])  $_POST["height".$_POST['id']]=$_POST["height".$_POST['id']]-1;
				 
				 if ($conta==0 && $_POST['del'.$cont2])  {
					
					 $rest++;
					 
				 }
				 
			}
			
			$cont++;
			$cont2++;
			
			if($cont2>=$_POST["twidth".$_POST['id']]) {
				$conta++;
			
				$cont2=0;
			}
		}
		
		
		 $_POST["width".$_POST['id']]=$_POST["width".$_POST['id']]-$rest;
		$_POST["twidth".$_POST['id']]=$_POST["twidth".$_POST['id']]-$rest;
		
	


usort($sorter, 'sortByOrder');


		$cont=0;
		
		
		$values="";
		
	
		foreach ($sorter as &$value) {
    
	$cont = $value['cont'];

			if(isset($_POST['description'.$cont])) $values.=$_POST['title'.$cont]."t6r4nd".$_POST['description'.$cont]."t6r4nd".$_POST['image'.$cont]."t6r4nd".$_POST['link'.$cont]."t6r4nd".$_POST['video'.$cont]."t6r4nd".$_POST['timage'.$cont]."t6r4nd".$_POST['seo'.$cont]."t6r4nd".$_POST['seol'.$cont]."kh6gfd57hgg";
				
			else $values.=$_POST['title'.$cont]."t6r4nd".""."t6r4nd".""."t6r4nd".""."t6r4nd".""."t6r4nd".""."t6r4nd".""."t6r4nd".""."kh6gfd57hgg";
			
		}
		
		
		


$sql= "UPDATE $table_name SET `ivalues` = '".$values."', `title` = '".$_POST["stitle".$_POST['id']]."', `width` = '".$_POST["width".$_POST['id']]."', `height` = '".$_POST["height".$_POST['id']]."', `round` = '".""."', `width_thumbnail` = '".$_POST["twidth".$_POST['id']]."', `height_thumbnail` = '".$_POST["theight".$_POST['id']]."', `thumbnail_border` = '".""."', `thumbnail_round` = '".""."', `number_thumbnails` = '".""."', `sizetitle` = '".$_POST["sizetitle".$_POST['id']]."', `sizedescription` = '".$_POST["sizedescription".$_POST['id']]."', `sizethumbnail` = '".$_POST["sizethumbnail".$_POST['id']]."', `font` = '".""."', `color1` = '".""."', `color2` = '".""."', `color3` = '".""."', `time` = '".$_POST["time".$_POST['id']]."', `border` = '".""."', `animation` = '".""."', `mode` = '".""."', `op1` = '".$_POST["op1".$_POST['id']]."', `op2` = '".$_POST["op2".$_POST['id']]."', `op3` = '".$_POST["op3".$_POST['id']]."', `op4` = '".$_POST["op4".$_POST['id']]."', `op5` = '".$_POST["op5".$_POST['id']]."' WHERE `id` =  ".$_POST["id"]." LIMIT 1";
		
			
			
			$wpdb->query($sql);
	}
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
$conta=0;


include('template/cabezera_panel.html');
while($conta<count($myrows)) {
	$id= $myrows[$conta]->id;
	$title = $myrows[$conta]->title;
		$width = $myrows[$conta]->width;
$height = $myrows[$conta]->height;
$values =$myrows[$conta]->ivalues;

$twidth = $myrows[$conta]->width_thumbnail;

$theight = $myrows[$conta]->height_thumbnail;

$number_thumbnails = $myrows[$conta]->number_thumbnails;



//$total = $myrows[$conta]->total;

$border = $myrows[$conta]->border;
$round = $myrows[$conta]->round;
$tborder = $myrows[$conta]->thumbnail_border;
$thumbnail_round = $myrows[$conta]->thumbnail_round;

$sizetitle = $myrows[$conta]->sizetitle;
$sizedescription = $myrows[$conta]->sizedescription;
$sizethumbnail = $myrows[$conta]->sizethumbnail;
$font = $myrows[$conta]->font;
$color1 = $myrows[$conta]->color1;
$color2 = $myrows[$conta]->color2;

$color3 = $myrows[$conta]->color3;

$animation = $myrows[$conta]->animation;
$time = $myrows[$conta]->time;
$mode = $myrows[$conta]->mode;
$op1 = $myrows[$conta]->op1;
$op2 = $myrows[$conta]->op2;
$op3 = $myrows[$conta]->op3;
$op4 = $myrows[$conta]->op4;
$op5 = $myrows[$conta]->op5;


	include('template/panel.php');			
	$conta++;
	}
include('template/footer.php');
}





function ultimatetables_add_menu(){	
	if (function_exists('add_options_page')) {
		//add_menu_page
		add_options_page('ultimatetables', 'Ultimate Tables', 'manage_options', 'ultimatetables', 'ultimatetables_panel');
	}
}


if (function_exists('add_action')) {
	add_action('admin_menu', 'ultimatetables_add_menu'); 
}

add_action( 'widgets_init', create_function('', 'return register_widget("wp_ultimatetables");') );
add_action('init', 'add_header_ultimatetables');
add_filter('the_content', 'ultimatetables');
add_action('admin_head', 'ultimatetables_enqueue_scripts');
?>
