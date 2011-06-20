<?php
/*
    Plugin Name: Simple OpenGraph
    Plugin URI: http://analteredreality.com/opengraph
    Description: Plugin displays simple open graph data
    Author: K. Bowers
    Version: 1.0
    Author URI: http://analteredreality.com
    License: GPL2
			
	Copyright 2011  Kevin Bowers  (email : pcfrk256@gmail.com)

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
?>
<?php
/*Include the Options Page*/
include('simpleopengraph_options.php');
?>
<?php
function opengraph(){
?>
<?php
/*Add Site_Name from bloginfo*/
?>
<meta property="og:site_name" content="<?php echo get_bloginfo('name');?>"/>
<?php
/*
Add Title Element; If home, then blog name; If page or post, then page/post title
*/
?>
<meta property="og:title" content="<?php if (is_home()) echo get_bloginfo('name'); elseif (is_singular()) echo the_title();?>"/>
<?php
/*
Type = "website" if is_home, otherwise it's "article"
*/
?>
<?php
if (is_home())
echo '<meta property="og:type" content="website"/>';
elseif (is_singular())
echo '<meta property="og:type" content="article"/>';
?>
<?php
/*
URL is the Home_URL if it's the home page, oterwise it's the permalink
*/
?>
<meta property="og:url" content="<?php if (is_home()) echo home_url(); elseif (is_singular()) echo the_permalink();?>"/>
<?php
/*
fb:admins from admin panel
*/
?>
	<?php
	global $options;
	$options = get_option('fbadmin');
	$fbadmins = $options['fbadmins'];
	if (is_home() || is_singular()){
echo '<meta property="fb:admins" content="'.$fbadmins.'"/>';
	}
	?>
<?php
/*
<!-- fb:app_id from admin panel -->
*/
?>
		<?php
	global $options;
	$options = get_option('fbappid');
	$fbapp = $options[fbapp];
	if (empty($fbapp))
	echo "";
	else
	echo '<meta property="fb:app_id" content="'.$fbapp.'"/>';
	?>
<?php
/*
Image is post image if the post has one; otherwise its the defined fallback in the admin panel
*/
?>
    <?php
    global $post;
    $fallback = get_option('fbimage');
    $fbimage = $fallback[fallbackimage];
	if (is_singular() && empty($image) && has_post_thumbnail($post->ID)){
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail');
	if ($thumbnail) {
		$image = $thumbnail[0];
	}}
	if (empty($image))
	echo '<meta property="og:image" content="'.$fbimage.'"/>';
	else
	echo  '<meta property="og:image" content="'.$image.'"/>';
	?>  
<?php
/*	
The excerpt is pulled from the post excerpt, otherwise it's the blog description
*/
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
/*Adding the action to the header*/
add_action('wp_head', 'opengraph');
?>