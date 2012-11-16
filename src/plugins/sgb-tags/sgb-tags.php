<?php
/*
Plugin Name: SG Bottwartal Tag Editor
Plugin URI: http://www.sg-bottwartal.de
Description: Masseditor for Tags
Version: 0.1
Author: Bernhard Rode
Author URI: http://bernhardrode.de
License: GPL3

Copyright 2012 - Bernhard RODE (mail@bernhardrode.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
*/
?>
<?php

define( 'SGB_TAGS_VERSION', 					'1.0' );
define( 'SGB_TAGS_OPTIONS_NAME', 			'sgbtags' ); // Option name for save settings
define( 'SGB_TAGS_OPTIONS_NAME_AUTO', 'sgbtags-auto' ); // Option name for save settings auto terms
define( 'SGB_TAGS_FOLDER', 						'sgb-tags' );

// Init Simple Tags
function sgb_tags_init() {
	global $sgb_tags;
}

function sgb_add_pages() {
	add_management_page('Tags', 'Tags', 'manage_options', 'sgb_tags_page_id', 'sgb_tags_page');
}

function sgb_tags_page() {
    ?>

		<div class="wrap">
			<?php    echo "<h2>" . __( 'Tag Editor', 'sgb_tags' ) . "</h2>"; ?>
			<hr />
	
    <?php
    	global $wpdb;
			$query = $_POST['sgb_tags_query'];
    	#$results = $wpdb->get_results( "SELECT post_title FROM wp_posts WHERE post_title LIKE '" . $query ."%' AND post_type = 'post'" );
    	$results = $wpdb->get_results( "SELECT * FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish'" );
    	$total = count($results);
			echo ""
			?>
      	<h5>There are  <?php _e($total, 'sgb_tags_total' ) ?> of Posts to be edited.</h5>
				<table class="wp-list-table widefat fixed pages" cellspacing="0">
					<thead>
						<tr>
							<th scope="col" id="" class="manage-column" style="">#</th>
							<th scope="col" id="" class="manage-column" style="">Title</th>
							<th scope="col" id="" class="manage-column" style="">Tags</th>
						</tr>
					</thead>
					<?php
						$counter = 1;
						foreach ($results as $post) {
    					list($tag,$title) = explode(':',$post->post_title,2);
    					if ($title == '') {
    						$title = $tag;
    						$tag = '';
    					}

    					$tags = array();

    					$tag = strtolower($tag);
    					$tag = str_replace('-','',$tag);
    					$tag = str_replace(' ','',$tag);
    					$tag = str_replace('jugend','',$tag);
    					$tag = str_replace('männer','herren',$tag);

    					switch ($tag) {
						    case 'herren1':
						      array_push($tags,'aktive');
						      array_push($tags,$tag);
       		 				break;
						    case 'herren2':
						      array_push($tags,'aktive');
						      array_push($tags,$tag);
       		 				break;
						    case 'herren3':
						      array_push($tags,'aktive');
						      array_push($tags,$tag);
       		 				break;
						    case 'herren4':
						      array_push($tags,'aktive');
						      array_push($tags,$tag);
       		 				break;
						    case 'damen1':
						      array_push($tags,'aktive');
						      array_push($tags,$tag);
       		 				break;
						    case 'damen2':
						      array_push($tags,'aktive');
						      array_push($tags,$tag);
						      break;
						    case 'ah':
						      array_push($tags,'aktive');
						      array_push($tags,$tag);
       		 				break;
						    case 'ah40':
						      array_push($tags,'aktive');
						      array_push($tags,'ah');
       		 				break;
						    case 'wa':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'wb':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'wc':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'wd':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'we':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'ma':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'mb':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'mc':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'md':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
						    	break;
						    case 'me':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'minis':
						      array_push($tags,'jugend');
						      array_push($tags,$tag);
       		 				break;
						    case 'mz':
						      array_push($tags,'zeitung');
						      array_push($tags,$tag);
       		 				break;
						    case 'stimme':
						      array_push($tags,'zeitung');
						      array_push($tags,$tag);
       		 				break;
						    case 'lkz':
						      array_push($tags,'zeitung');
						      array_push($tags,$tag);
       		 				break;
       		 		}

       		 		if ( count($tags) == 0 ) {
       		 			$lcTitle = strtolower($post->post_title);

       		 			if ( preg_match('/hbl/', $lcTitle) ) {
						      array_push($tags,'habul');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/bundesliga/', $lcTitle) ) {
						      array_push($tags,'habul');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/fotoalbum/', $lcTitle) ) {
						      array_push($tags,'fotoalbum');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/bilder/', $lcTitle) ) {
						      array_push($tags,'fotoalbum');
       		 			}
       		 			if ( preg_match('/förderverein/', $lcTitle) ) {
						      array_push($tags,'fv');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/sponsor/', $lcTitle) ) {
						      array_push($tags,'sponsoren');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/damen/', $lcTitle) ) {
						      array_push($tags,'aktive');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/herren/', $lcTitle) ) {
						      array_push($tags,'aktive');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/männer/', $lcTitle) ) {
						      array_push($tags,'aktive');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/spieltag/', $lcTitle) ) {
						      array_push($tags,'jugend');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/party/', $lcTitle) ) {
						      array_push($tags,'fest');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/party/', $lcTitle) ) {
						      array_push($tags,'fest');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/kw/', $lcTitle) ) {
						      //array_push($tags,'automatisch');
       		 			}
       		 			if ( preg_match('/weiblich/', $lcTitle) ) {
						      array_push($tags,'jugend');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/weibl/', $lcTitle) ) {
						      array_push($tags,'jugend');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/männlich/', $lcTitle) ) {
						      array_push($tags,'jugend');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/männl/', $lcTitle) ) {
						      array_push($tags,'jugend');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/jugend/', $lcTitle) ) {
						      array_push($tags,'jugend');
						      array_push($tags,'bericht');
       		 			}
       		 			if ( preg_match('/binokel/', $lcTitle) ) {
						      array_push($tags,'fv');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/frühjahrswanderung/', $lcTitle) ) {
						      array_push($tags,'fv');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/herbstwanderung/', $lcTitle) ) {
						      array_push($tags,'fv');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/fv/', $lcTitle) ) {
						      array_push($tags,'fv');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/jgd/', $lcTitle) ) {
						      array_push($tags,'jugend');
       		 			}
       		 			if ( preg_match('/fest/', $lcTitle) ) {
						      array_push($tags,'fest');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/feier/', $lcTitle) ) {
						      array_push($tags,'fest');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/hocketse/', $lcTitle) ) {
						      array_push($tags,'fest');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/schmotzig/', $lcTitle) ) {
						      array_push($tags,'fest');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/markt/', $lcTitle) ) {
						      array_push($tags,'fest');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/medikooperation/', $lcTitle) ) {
						      array_push($tags,'sponsoren');
						      array_push($tags,'neuigkeiten');
       		 			}
       		 			if ( preg_match('/bei der geburt/', $lcTitle) ) {
						      array_push($tags,'spass');
       		 			}
       		 			if ( preg_match('/aktive/', $lcTitle) ) {
						      array_push($tags,'aktive');
       		 			}
       		 			if ( preg_match('/hänk/', $lcTitle) ) {
						      array_push($tags,'spass');
       		 			}
       		 			if ( preg_match('/kempa/', $lcTitle) ) {
						      array_push($tags,'sponsoren');
       		 			}
       		 			if ( preg_match('/stapler/', $lcTitle) ) {
						      array_push($tags,'sponsoren');
       		 			}
       		 			if ( preg_match('/schnupper/', $lcTitle) ) {
						      array_push($tags,'jugend');
       		 			}
       		 			if ( preg_match('/schiedsrichter/', $lcTitle) ) {
						      array_push($tags,'schiedsrichter');
       		 			}
       		 			if ( preg_match('/black beauti/', $lcTitle) ) {
						      array_push($tags,'schiedsrichter');
       		 			}
       		 			if ( preg_match('/pfeife/', $lcTitle) ) {
						      array_push($tags,'schiedsrichter');
       		 			}
       		 			if ( preg_match('/elternabend/', $lcTitle) ) {
						      array_push($tags,'jugend');
       		 			}
       		 			if ( preg_match('/vorbericht/', $lcTitle) ) {
						      array_push($tags,'herren1');
						      array_push($tags,'aktive');
       		 			}
       		 			if ( preg_match('/senioren/', $lcTitle) ) {
						      array_push($tags,'ah');
						      array_push($tags,'aktive');
       		 			}
       		 			if ( preg_match('/ah40/', $lcTitle) ) {
						      array_push($tags,'ah');
						      array_push($tags,'aktive');
       		 			}
       		 			if ( preg_match('/marbacher zeitung/', $lcTitle) ) {
						      array_push($tags,'zeitung');
						      array_push($tags,$tag);
       		 			}
       		 			if ( preg_match('/großfeld/', $lcTitle) ) {
						      array_push($tags,'aktive');
						      array_push($tags,'bericht');
       		 			}

       		 		} else {
						      array_push($tags,'bericht');
       		 		}

       		 		if ( count($tags) == 0 ) {
       		 			array_push($tags,'neuigkeiten');
    					}

    					$tags = array_unique($tags);

    					$post->tags_input = $tags;
							wp_update_post($post);

	    					echo "<tr>";
	    					echo "<td>{$counter}</td>";
	    					echo "<td>{$post->ID}</td>";
	    					echo "<td>{$post->post_title}</td>";
	    					#echo "<td>{$title}</td>";
	    					#echo "<td>{$tag}</td>";
	    					echo "<td>";
	    					echo implode(',',$tags);
	    					echo "</td>";
	    					echo "<td>";
	    					echo "</td>";
	    					echo "</tr>";
	    					$counter = $counter + 1;
						}
					?>
				</table>
				</div>
			<?
    };
	add_action( 'plugins_loaded', 'sgb_tags_init' );
	add_action('admin_menu', 'sgb_add_pages');
?>