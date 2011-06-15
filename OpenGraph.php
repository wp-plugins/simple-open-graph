<?php
/*
    Plugin Name: Simple OpenGraph
    Plugin URI: http://analteredreality.com/opengraph
    Description: Plugin displays simple open graph data
    Author: K. Bowers
    Version: 0.5
    Author URI: http://analteredreality.com
    License: GPL2
    */			
	/*  Copyright 2011  Kevin Bowers  (email : pcfrk256@gmail.com)

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
function opengraph(){
?>
    <meta property="og:site_name" content="<?php echo get_bloginfo('name');?>"/>
    <meta property="og:title" content="
    <?php
		global $post;
		if (is_home()) $title = get_bloginfo('name');
		elseif
		(is_singular()) $title = the_title();
		echo $title;
	?>"/>
    <meta property="og:type" content="
    <?php
		if ( is_home() ) $type = 'website';
		elseif (empty($type)) $type = 'article';
		echo $type;
	?>"/>
    <meta property="og:url" content="
    <?php
	if (is_home()) $url = home_url();
	elseif (is_singular()) $url= the_permalink();
	echo $url
	?>"/>
    <?php
    global $post;
	if (is_singular() && empty($image) && has_post_thumbnail($post->ID)){
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail');
	if ($thumbnail) {
		$image = $thumbnail[0];
	}}
	if (empty($image))
	echo "";
	else
	echo  '<meta property="og:image" content="'.$image.'"/>';
	?>
    
    <?php
    $excerpt = get_the_excerpt();
	if (is_single()) $description = strip_tags($excerpt);
	elseif (is_home()) $description = get_bloginfo('description');
	if (empty($description))
	echo "";
	else
	echo '<meta property="og:description" content="'.$description.'"/>'
	?>
<?php
};
add_action('wp_head', 'opengraph');
?>