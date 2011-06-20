<?php 
// add the admin options page
add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('Simple Open Graph', 'Simple Open Graph Settings', 'manage_options', 'simpleopengraph', 'simple_open_graph_page');
}
?>

<?php 
// display the admin options page
function simple_open_graph_page() {
?>
<div class="wrap">
<h2>Simple Open Graph Settings</h2>

<form action="options.php" method="post">
<?php settings_fields('plugin_options'); ?>
<?php do_settings_sections('simpleopengraph'); ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

<?php
}?>
<?php 
// add the admin settings and such
add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init(){
register_setting( 'plugin_options', 'fbadmin');
register_setting('plugin_options', 'fbimage');
register_setting('plugin_options', 'fbappid');
add_settings_section('plugin_main', 'Main Settings', 'plugin_section_text', 'simpleopengraph');
add_settings_field('fbadmins', 'FB Admins (comma separated):', 'fbadmin', 'simpleopengraph', 'plugin_main');
add_settings_field('fbapp', 'FB App ID:', 'fbapp', 'simpleopengraph', 'plugin_main');
add_settings_field('fallbackimage', 'Fallback Image URL (50px X 50px):', 'fallback_url', 'simpleopengraph', 'plugin_main');
}?>
<?php function plugin_section_text() {
echo '<p>Edit the fallback options below.</p>';
} ?>
<?php
/*
Define the fbadmin value.
*/
?>
<?php function fbadmin() {
$options = get_option('fbadmin');
echo "<input id='fbadmins' name='fbadmin[fbadmins]' size='40' type='text' value='{$options['fbadmins']}' /><br>";
$fbadmins = $options['fbadmins'];
echo "Current Value: ";
echo $fbadmins;
}
?>
<?php
/*
Define the fb:app_id
*/
?>
<?php function fbapp() {
$options = get_option('fbappid');
echo "<input id='fbapp' name='fbappid[fbapp]' size='40' type='text' value='{$options['fbapp']}' /><br>";
$fbapp = $options['fbapp'];
echo "Current Value: ";
echo $fbapp;
}
?>
<?php
/*
Define the og:image fallback
*/
?>
<?php function fallback_url(){
$fallback = get_option('fbimage');
echo "<input id='fallbackimage' name='fbimage[fallbackimage]' size='100' type='text' value='{$fallback['fallbackimage']}' /><br>";
echo "Current Value: ";
echo $fallback['fallbackimage'];
}
?>