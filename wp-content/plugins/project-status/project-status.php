<?php /*
Plugin Name: Project Status
Plugin URI: http://3.7designs.co/about/workshop
Description: Give clients a visual indication of where their project is.
Version: 1.6
Author: Ross Johnson
Author URI: http://3.7designs.co
License: GPL2
*/

/*  Copyright 2012  Ross Johnson  (email : ross@3.7designs.co)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// =========================
// = Buy me a Beer please! =
// =========================

function panorama_admin_notice() { 
	
	global $pagenow, $typenow, $current_user;
	if ((($pagenow == 'post.php') || ($pagenow == 'edit.php') || ($pagenow == 'post-new.php')) && ($typenow == 'client_projects')) { 
		
		$user_id = $current_user->ID;
		if(!get_user_meta($user_id,'panorama_ignore_notice')) { 
		
	?>

	<div class="updated">
	  
	  <p>Like Project Status? Did you know we have a <a href="http://www.projectpanorama.com" target="_new">new updated version called Project Panorama?</a> Check it out, you might just like it. | <a href="?panorama_nag_ignore=0">Hide Notice</a></p>

	</div>
		<?php } 
		} 
	}
	
add_action('admin_notices', 'panorama_admin_notice');

function panorama_nag_ignore() { 
	global $current_user;
	        $user_id = $current_user->ID;
	        /* If user clicks to ignore the notice, add that to their user meta */
	        if ( isset($_GET['panorama_nag_ignore']) && '0' == $_GET['panorama_nag_ignore'] ) {
	             add_user_meta($user_id, 'panorama_ignore_notice', 'true', true);
	    }
	}

add_action('init', 'projects_register'); 

// ==========================
// = Register the post type =
// ==========================

function projects_register() {
 
	$labels = array(
		'name' => _x('My Projects', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New', 'Project'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
//		'menu_icon' => get_stylesheet_directory_uri() . '/article16.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','comments')
	  ); 
  
	register_post_type( 'client_projects' , $args );
    flush_rewrite_rules();


}

// ===========================
// = Setup the custom fields =
// ===========================

add_action("admin_init", "admin_init");
 
function admin_init(){
  add_meta_box("project_meta", "Project Details", "project_meta", "client_projects", "normal", "low");
  /* add_meta_box("project_update","Notify Client", "project_update","client_projects","normal","low"); */
  add_meta_box("project_status", "Project Status", "project_status", "client_projects","normal","low");
  add_meta_box("project_ms","Project Milestones", "project_ms","client_projects","normal","low");
}

function client_projects_head() {
 	$siteurl = get_option('siteurl');
    $pluginfolder = get_bloginfo('url') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));

	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-slider');
	//wp_enqueue_script('jquery-ui-datepicker,jquery-ui-slider', $pluginfolder . '/js/jquery-ui.js', array('jquery','jquery-ui-core'));
	wp_enqueue_style('jquery.ui.theme', $pluginfolder . '/css/jquery-ui-custom.css');
	
	wp_register_style('admin.css',$pluginfolder . '/admin.css'); 
	wp_enqueue_style('admin.css');
	
}
add_action('admin_head', 'client_projects_head');

function shortcode_head() {
	
	$siteurl = get_option('siteurl');
    $pluginfolder = get_bloginfo('url') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__));
	
	$cssurl = get_bloginfo('url') . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/admin.css';
	$publiccss = get_bloginfo('url') . '/wp-content/plugins/' . basename(dirname(__FILE__)) .'/public-projectstatus.css';
	
	wp_register_style('admin.css', $pluginfolder . '/admin.css');
	wp_register_style('public-projectstatus.css', $pluginfolder . '/public-projectstatus.css');
	wp_enqueue_style('admin.css');
	wp_enqueue_style('public-projectstatus.css');
	
	}
add_action('wp_head','shortcode_head');

function project_update() { 
	
	global $post;
	$custom = get_post_custom($post->ID);	
	  	
	$pjsp_client_email = $custom["pjsp_client_email"][0];
		if(!$pjsp_client_email) { $pjsp_client_email = 'email@domain.com'; }
	$pjsp_email_subject = $custom["pjsp_email_subject"][0];
		if(!$pjsp_email_subject) { $pjsp_email_subject = 'Your Project Has Been Updated'; }
	$pjsp_default_url = $custom["pjsp_default_url"][0];
		if(!$pjsp_default_url) { $pjsp_default_url = get_permalink($post->ID); }
	$pjsp_email_message = $custom["pjsp_email_message"][0];
		if(!$pjsp_email_message) { $pjsp_email_message = 'You can view it online with the link provided below.'; }
	
	?>
		
	<ul class="pjsp_options">
	 		<li><label for="pjsp_client_email">Client E-mail</label> <input type="text" id="pjsp_client_email" name="pjsp_client_email" value="<?php echo $pjsp_client_email; ?>"></li>
	 		<li><label for="pjsp_email_subject">E-mail Subject</label> <input type="text" id="pjsp_email_subject" name="pjsp_email_subject" value="<?php echo $pjsp_email_subject; ?>"</li>
	 		<li><label for="pjsp_default_url">Project Page URL</label> <input type="text" id="pjsp_default_url" name="pjsp_default_url" value="<?php echo $pjsp_default_url; ?>"></li>
	 		<li><label for="pjsp_email_message">Additional Message</label> <textarea id="pjsp_email_message" name="pjsp_email_body"><?php echo $pjsp_email_message; ?></textarea></li>
			<li><label for="pjsp_do_notify">E-mail Client Upon Save</label> <input type="checkbox" name="pjsp_do_notify"></li>
		</ul>
<?php 	
} 
 
function project_ms() { 
	
	global $post;
  	$custom = get_post_custom($post->ID);	
	$twenty_percent_title = $custom["twenty_percent_title"][0];
  	$fourty_percent_title = $custom["fourty_percent_title"][0];
  	$sixty_percent_title = $custom["sixty_percent_title"][0];
  	$eighty_percent_title = $custom["eighty_percent_title"][0];
  	$twenty_percent_desc = $custom["twenty_percent_desc"][0];
  	$fourty_percent_desc = $custom["fourty_percent_desc"][0];
  	$sixty_percent_desc = $custom["sixty_percent_desc"][0];
  	$eighty_percent_desc = $custom["eighty_percent_desc"][0];

	?>
	
	<h4 class="bh4">20% Complete</h4>
	
	<p><label class="big_title">Title:</label> <input type="text" name="twenty_percent_title" value="<?php echo $twenty_percent_title; ?>"></p>
	  <p><label class="big_title">Description:</label> <br>
		<span class="customEditor"><textarea name="twenty_percent_desc" cols="75" rows="10" class="theEditor mce"><?php echo $twenty_percent_desc; ?></textarea></span></p>

	<br>
	<h4 class="bh4">40% Complete</h4>
	
	  <p><label class="big_title">Title:</label> <input type="text" name="fourty_percent_title" value="<?php echo $fourty_percent_title; ?>"></p>
	  <p><label class="big_title">Description:</label> <br>
	  <span class="customEditor"><textarea name="fourty_percent_desc" cols="75" rows="10" class="mce"><?php echo $fourty_percent_desc; ?></textarea></span></p>

	<br>
	<h4 class="bh4">60% Complete</h4>

	  <p><label class="big_title">Title:</label> <input type="text" name="sixty_percent_title" value="<?php echo $sixty_percent_title; ?>"></p>
	  <p><label class="big_title">Description:</label> <br>
	  <span class="customEditor"><textarea name="sixty_percent_desc" cols="75" rows="10" class="mce"><?php echo $sixty_percent_desc; ?></textarea></span></p>

	<br>
	<h4 class="bh4">80% Complete</h4>

	  <p><label class="big_title">Title:</label> <input type="text" name="eighty_percent_title" value="<?php echo $eighty_percent_title; ?>"></p>
	  <p><label class="big_title">Description:</label> <br>
	  <span class="customEditor"><textarea name="eighty_percent_desc" cols="75" rows="10" class="mce"><?php echo $eighty_percent_desc; ?></textarea></span></p>
	
	<?php 

}

function project_status() { 
	
	global $post;
  	$custom = get_post_custom($post->ID);
	$current_tasks = $custom["current_tasks"][0];
  	$current_holds = $custom["current_holds"][0];
  	$progress = $custom["progress"][0];

	?>
	
	 <p><label class="big_title percent_complete">Percentage Complete: <span id="percentage_value"></span></label> 
		
		<div id="progress-slider-wrapper">
			<div id="progress-slider"></div>
		</div>
		
		<input type="text" name="progress" id="slider-input" value="<?php echo $progress; ?>" />
		<script>
			jQuery(document).ready(function() {
				initValue = jQuery('#slider-input').val();
				jQuery('#percentage_value').html(initValue + '%');
				jQuery( "#progress-slider" ).slider({
					range: "min",
				    value: initValue,
				    step: 1,
				    min: 0,
				    max: 100,
				    slide: function( event, ui ) {
				        jQuery( "#slider-input" ).val(ui.value);
						jQuery('#percentage_value').html(ui.value + '%');
				    }
				});
			});
		</script>
	</p>

	<ul>
	  <li><label class="big_title">Current Tasks</label>
	  	  <span class="customEditor"><textarea cols="75" rows="10" name="current_tasks" class="mce"><?php echo $current_tasks; ?></textarea></span>
	  </li>
	  <li><label class="big_title">Current Holds</label>
	  	  <span class="customEditor"><textarea cols="75" rows="10" name="current_holds" class="mce"><?php echo $current_holds; ?></textarea></span></li>
	</ul>
	<?php 
	
	}

function project_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  $client_name = $custom["client_name"][0];
 // $project_name = $custom["project_name"][0];
  $project_description = $custom["project_description"][0];
  $project_start = $custom["project_start"][0];
  $project_end = $custom["project_end"][0];
  $footer_text = $custom["footer_text"][0];
 
 
  
  ?>
	<ul class="pjsp_options">
	 	<li><strong>Project Short Code:</strong> [project id=<?php echo $post->ID; ?>]</li>
  		<li><label class="big_title">Client Name:</label> <input name="client_name" type="text" value="<?php echo $client_name; ?>"></li>
<!--  <p><label>Project Name:</label> <input name="project_name" type="text" value="<?php echo $project_name; ?>"></p> -->
  		<li><label class="big_title">Project Start:</label> <input name="project_start" type="text" class="datepicker" value="<?php echo $project_start; ?>"></li>
  		<li><label class="big_title">Projected Completion:</label> <input name="project_end" class="datepicker" type="text" value="<?php echo $project_end; ?>"></li>
  		<li><label class="big_title">Footer Credit:</label> <input name="footer_text" type="text" value="<?php 
	if ($footer_text == '') { 
		echo "Project Status is a <a href='http://3.7designs.co' target='_new'>3.7 DESIGNS</a> Workshop Project";
	} else { 
		echo $footer_text; 
	}
	
	?>"</li>
	</ul>
	<div class="clear">&nbsp;</div>

<?php 
	
}	

// ==================
// = Save Variables =
// ==================

add_action('save_post', 'save_details');

function save_details(){
  global $post;
 
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    	return $post->ID;
	}
	
 //Project Details
  	update_post_meta($post->ID, "client_name", $_POST["client_name"]);
//  update_post_meta($post->ID, "project_name", $_POST["project_name"]);
//  update_post_meta($post->ID, "project_description", $_POST["project_description"]);
	update_post_meta($post->ID, "project_start", $_POST["project_start"]); 
	update_post_meta($post->ID, "project_end", $_POST["project_end"]); 
 	update_post_meta($post->ID, "current_tasks", $_POST["current_tasks"]);
  	update_post_meta($post->ID, "current_holds", $_POST["current_holds"]);
  	update_post_meta($post->ID, "progress", $_POST["progress"]);

  //Percentage Milestones
  update_post_meta($post->ID, "twenty_percent_title", $_POST["twenty_percent_title"]);
  update_post_meta($post->ID, "fourty_percent_title", $_POST["fourty_percent_title"]);
  update_post_meta($post->ID, "sixty_percent_title", $_POST["sixty_percent_title"]);
  update_post_meta($post->ID, "eighty_percent_title", $_POST["eighty_percent_title"]);
  update_post_meta($post->ID, "twenty_percent_desc", $_POST["twenty_percent_desc"]);
  update_post_meta($post->ID, "fourty_percent_desc", $_POST["fourty_percent_desc"]);
  update_post_meta($post->ID, "sixty_percent_desc", $_POST["sixty_percent_desc"]);
  update_post_meta($post->ID, "eighty_percent_desc", $_POST["eighty_percent_desc"]);
 
  //Footer Text
  update_post_meta($post->ID, "footer_text", $_POST["footer_text"]);

  //Client Contact
  update_post_meta($post->ID, "pjsp_client_email", $_POST["pjsp_client_email"]);
  update_post_meta($post->ID, "pjsp_email_subject", $_POST["pjsp_email_subject"]);
  update_post_meta($post->ID, "pjsp_default_url", $_POST["pjsp_default_url"]);
  update_post_meta($post->ID, "pjsp_email_message", $_POST["pjsp_email_message"]);
  /*
  $pjsp_do_notify = $_POST['pjsp_do_notify'];

  if($pjsp_do_notify) {
	 
	$to = $_POST["pjsp_client_email"];
	$subject = $_POST["pjsp_email_subject"];
	$message = 'Your Project Url:'.$_POST["pjsp_default_url"].'\n\n';
	$message += $_POST["pjsp_email_message"];
	
	wp_mail( $to, $subject, $message);
	add_action('admin_init','pjsp_client_emailed'); 
	}
	*/

} 

// ============================
// = Modify the Projects Page =
// ============================

add_action("manage_posts_custom_column",  "client_projects_custom_columns");
add_filter("manage_edit-client_projects_columns", "client_projects_edit_columns");
 
function client_projects_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Project Name",
    "description" => "Client",
	"shortcode" => "Shortcode",
	"start_date" => "Start Date",
	"end_date" => "Predicted End",
    "progress" => "% Complete"
  );
 
  return $columns;
}
function client_projects_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      $custom = get_post_custom();
	  echo $custom["client_name"][0];
      break;
	case "shortcode":
	  echo "[project id=".$post->ID."]";
	  break;
	case "start_date":
		$custom = get_post_custom();
		echo $custom["project_start"][0];
		break;
	case "end_date":
		$custom = get_post_custom();
		echo $custom["project_end"][0];
		break;
    case "progress":
      $custom = get_post_custom();
      echo '<div class="meter"><span class="progress-'.$custom["progress"][0].'"></span></div>';
      break;
  }
}

// =============================
// = Render the Right Template =
// =============================


function cp_template_include($template) {
	  global $post; 

	  if($post->post_type == 'client_projects') { 
	    return dirname(__FILE__) . '/client_projects.php'; 
	  } else { return $template; } 
}
add_filter('template_include', 'cp_template_include');

add_action('admin_print_footer_scripts','my_admin_print_footer_scripts',99);
function my_admin_print_footer_scripts()
{
    ?><script type="text/javascript">/* <![CDATA[ */
        jQuery(document).ready(function() { 
	
            var i=1;
            jQuery('.customEditor textarea').each(function(e)
            {	
                var id = jQuery(this).attr('id');
 
                if (!id)
                {
                    id = 'customEditor-' + i++;
                    jQuery(this).attr('id',id);
                }
 
                tinyMCE.execCommand('mceAddControl', false, id);
 
            });
        });
    /* ]]> */</script><?php
}

function show_project_list()
{ 
	
	$psp_shortcode = '

	<table class="client_table">
		<tr>
			<th>Project</th>
			<th>Client</th>
			<th>Progress</th>
		</tr> ';
 
	$args = array('post_type' => 'client_projects');
	$loop = new WP_Query( $args );
    $i = 1;
	while ( $loop->have_posts() ) : $loop->the_post();
		
		$baseURL = get_bloginfo('wpurl');
		$postType = 'client_projects';
		
		global $post; 
		
		if($i%2 == 0) { $class = "odd"; } else { $class = ''; }
		
		$psp_shortcode .= '<tr class='.$class.'>';
		$psp_shortcode .= '<td><a href='.get_permalink().'>'.get_the_title().'</a></td>';
		$psp_shortcode .= '<td>'.get_post_meta($post->ID, 'client_name', true).'</td>';
		$psp_shortcode .= '<td><div class="meter"><span class="progress-'.get_post_meta($post->ID, 'progress', true).'"></span></div></td></tr>';
		
		$i++;

	endwhile;
	
	$psp_shortcode .= '</table>';
	
	return $psp_shortcode;
}

add_shortcode('project_list', 'show_project_list');
add_shortcode('project', 'project_page_shortcode');

	function project_page_shortcode($atts) 
	{ 
	wp_reset_query();
	 $thepostid = intval($atts[id]);
	// echo $thepostid; 
			
	$client_project = get_post($thepostid);
	setup_postdata($client_project);
	
	if($client_project):
		
		  $psp_shortcode = '<div class="project-listing" id="project-'.$thepostid.'">';
		  
 		  $psp_shortcode .= '<h2 class="project-title"><strong>Project Status For:</strong>'.get_post_meta($thepostid, 'client_name', true).', '.$client_project->post_title.'</h2>';
		  
		  $psp_shortcode .= '
			<header id="pspin-secondary" class="clearfix">
				<article id="project_details">	
					<h4>Project Description</h4>
					'.get_the_content().'
					
					<h4>Project Timing</h4>
					<ul>
						<li><strong>Start Date:</strong> '.get_post_meta($thepostid, "project_start", true).'</li>
						<li><strong>Predicted End:</strong> '.get_post_meta($thepostid, "project_end", true).'</li>
					</ul>
					
				</article>

				<article id="pspin-project_status" class="clearfix">
					<div class="pspin-current_tasks">
						<h3>Current Tasks</h3>
						'.get_post_meta($thepostid, "current_tasks", true).'
					</div>
					<div class="pspin-current_holds">
						<h3>Current Holds</h3>
						'.get_post_meta($thepostid, "current_holds", true).'
					</div>
				</article><!--/#project_status-->
				<div style="clear:both"></div>
			</header> <!--/header-->

			<section id="pspin-progress_bar">

				<h3>Project Overview and Overall Progress</h3>

				<div class="pspin-meter">
					<span class="pspin-progress-'.get_post_meta($thepostid, "progress", true).'"></span>
				</div>

				<div id="pspin-milestones" class="clearfix">
					<div class="pspin-p20">
						<h4><span><strong>20%</strong></span> <b>20%</b> '.get_post_meta($thepostid, "twenty_percent_title", true).'</h4>
						'.get_post_meta($thepostid, "twenty_percent_desc", true).'
					</div>
					<div class="pspin-p40">
						<h4><span><strong>40%</strong></span> <b>40%</b>'.get_post_meta($thepostid, 'fourty_percent_title', true).'</h4>
						'.get_post_meta($thepostid, 'fourty_percent_desc', true).'
					</div>
					<div class="pspin-p60">
						<h4><span><strong>60%</strong></span> <b>60%</b>'.get_post_meta($thepostid, 'sixty_percent_title', true).'</h4>
						'.get_post_meta($thepostid, 'sixty_percent_desc', true).'
					</div>
					<div class="last pspin-p80">
						<h4><span><strong>80%</strong></span> <b>80%</b>'.get_post_meta($thepostid, 'eighty_percent_title', true).'</h4>
						'.get_post_meta($thepostid, 'eighty_percent_desc', true).'
					</div>
				</div>	

			</section>';
		
		$psp_shortcode .= '</div>';
		
		else: 
			
			$psp_shortcode += '<h2>Sorry, there is no project with that ID</h2>';
			
		endif; 

		 
		return $psp_shortcode;  
		 
		 ?>
<?php } 

function my_admin_footer() { 
	?>
	<script type="text/javascript">
		jQuery(document).ready(function() { 
			jQuery('.datepicker').datepicker({
				dateFormat : 'mm-dd-yy'
			});
			
		});
	</script>
	<?php }
	
	add_action('admin_footer','my_admin_footer');
	
	include( plugin_dir_path( __FILE__ ) . 'includes/widgets.php');
	include( plugin_dir_path( __FILE__ ) . 'includes/clone/duplicate-post.php');
	
?>