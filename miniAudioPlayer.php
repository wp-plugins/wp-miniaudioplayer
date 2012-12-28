<?php
/*
Plugin Name: mb.miniAudioPlayer
Plugin URI: http://wordpress.org/support/plugin/wp-miniaudioplayer
Description: Transform your mp3 audio file link into a nice, small light player
Author: Pupunzi (Matteo Bicocchi)
Version: 0.9.4
Author URI: http://pupunzi.com
*/

define("MINIAUDIOPLAYER_VERSION", "0.9.4");

register_activation_hook( __FILE__, 'miniAudioPlayer_install' );

function miniAudioPlayer_install() {
// add and update our default options upon activation
    update_option('miniAudioPlayer_version', MINIAUDIOPLAYER_VERSION);
    add_option('miniAudioPlayer_donate','false');
    add_option('miniAudioPlayer_width','200');
    add_option('miniAudioPlayer_skin','black');
    add_option('miniAudioPlayer_volume','.5');
    add_option('miniAudioPlayer_autoplay','false');
    add_option('miniAudioPlayer_showVolumeLevel','true');
    add_option('miniAudioPlayer_showTime','true');
    add_option('miniAudioPlayer_showRew','true');
    add_option('miniAudioPlayer_excluded','noPlayer');
    add_option('miniAudioPlayer_download','false');
}

$miniAudioPlayer_donate = get_option('miniAudioPlayer_donate');
$miniAudioPlayer_version = get_option('miniAudioPlayer_version');
$miniAudioPlayer_width = get_option('miniAudioPlayer_width');
$miniAudioPlayer_skin = get_option('miniAudioPlayer_skin');
$miniAudioPlayer_volume = get_option('miniAudioPlayer_volume');
$miniAudioPlayer_autoplay = get_option('miniAudioPlayer_autoplay');
$miniAudioPlayer_showVolumeLevel = get_option('miniAudioPlayer_showVolumeLevel');
$miniAudioPlayer_showTime = get_option('miniAudioPlayer_showTime');
$miniAudioPlayer_showRew = get_option('miniAudioPlayer_showRew');
$miniAudioPlayer_excluded = get_option('miniAudioPlayer_excluded');
$miniAudioPlayer_download = get_option('miniAudioPlayer_download');

//set up defaults if these fields are empty
if ($miniAudioPlayer_version != MINIAUDIOPLAYER_VERSION) {$miniAudioPlayer_version = MINIAUDIOPLAYER_VERSION;}
if (empty($miniAudioPlayer_donate)) {$miniAudioPlayer_donate = "false";}
if (empty($miniAudioPlayer_width)) {$miniAudioPlayer_width = "200";}
if (empty($miniAudioPlayer_skin)) {$miniAudioPlayer_skin = "black";}
if (empty($miniAudioPlayer_volume)) {$miniAudioPlayer_volume = ".5";}
if (empty($miniAudioPlayer_autoplay)) {$miniAudioPlayer_autoplay = "false";}
if (empty($miniAudioPlayer_showVolumeLevel)) {$miniAudioPlayer_showVolumeLevel = "false";}
if (empty($miniAudioPlayer_showTime)) {$miniAudioPlayer_showTime = "false";}
if (empty($miniAudioPlayer_showRew)) {$miniAudioPlayer_showRew = "false";}
if (empty($miniAudioPlayer_excluded)) {$miniAudioPlayer_excluded = "map_excluded";}
if (empty($miniAudioPlayer_download)) {$miniAudioPlayer_download = "false";}

function miniAudioPlayer_action_links($links, $file) {
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    // check to make sure we are on the correct plugin
    if ($file == $this_plugin) {
        // the anchor tag and href to the URL we want. For a "Settings" link, this needs to be the url of your settings page
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=wp-miniaudioplayer/miniAudioPlayer-admin.php">Settings</a>';
        // add the link to the list
        array_unshift($links, $settings_link);
    }

    return $links;
}
add_filter('plugin_action_links', 'miniAudioPlayer_action_links', 10, 2);

// scripts to go in the header and/or footer
function miniAudioPlayer_init() {
    global $miniAudioPlayer_version;

    if(isset($_COOKIE['mapdonate']) && $_COOKIE['mapdonate'] === "true"){
//        setcookie('mapdonate', "", time() - 3600);
        echo '
            <script type="text/javascript">
                expires = "; expires= -10000";
                document.cookie = "mapdonate=false" + expires + "; path=/";
            </script>
        ';

        update_option('miniAudioPlayer_donate', "true" );
    }

    if ( !is_admin()) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('metadata', plugins_url( '/js/jquery.metadata.js', __FILE__ ), false, '1.2', false);
        wp_enqueue_script('jplayer', plugins_url( '/js/jquery.jplayer.min.js', __FILE__ ), false, '2.1.0', false);
        wp_enqueue_script('mb.miniPlayer', plugins_url( '/js/jquery.mb.miniPlayer.js', __FILE__ ), false, $miniAudioPlayer_version, false);
        wp_enqueue_style('miniAudioPlayer', plugins_url( 'css/miniplayer.css', __FILE__ ), false, $miniAudioPlayer_version, 'screen');
    }
}
add_action('init', 'miniAudioPlayer_init');

function miniAudioPlayer_player_head() {
    global $miniAudioPlayer_width,$miniAudioPlayer_skin,$miniAudioPlayer_volume,$miniAudioPlayer_autoplay,$miniAudioPlayer_showVolumeLevel,$miniAudioPlayer_showTime,$miniAudioPlayer_showRew,$miniAudioPlayer_download,$miniAudioPlayer_excluded;
    echo '
	<!-- start miniAudioPlayer initializer -->
	<script type="text/javascript">

    if(!map) var map={};
    map.downloadUrl = "'.plugins_url( 'map_download.php', __FILE__ ).'";

	jQuery(function(){
           	jQuery("a[href*=\'.mp3\']")'.getExcluded().'mb_miniPlayer({
				inLine:true,
                width:'.$miniAudioPlayer_width.',
				skin:"'.$miniAudioPlayer_skin.'",
				volume:'.$miniAudioPlayer_volume.',
				autoplay:'.$miniAudioPlayer_autoplay.',
				showVolumeLevel:'.$miniAudioPlayer_showVolumeLevel.',
				showTime:'.$miniAudioPlayer_showTime.',
				showRew:'.$miniAudioPlayer_showRew.',
				downloadable:'.$miniAudioPlayer_download.',
				swfPath:"'.plugins_url( '/js/', __FILE__ ).'"
			});
	});

	</script>
	<!-- end miniAudioPlayer initializer -->
	';
};
function getExcluded(){
    global $miniAudioPlayer_excluded;
    if(!empty($miniAudioPlayer_excluded)){
        return '.not(".'.$miniAudioPlayer_excluded.'").';
    }else{
        return '.';
    }
}
// ends miniAudioPlayer_player_head function

add_action('wp_head', 'miniAudioPlayer_player_head');


add_action('admin_init', 'setup_maplayer_button');


// TinyMCE Button ***************************************************

// Set up our TinyMCE button
function setup_maplayer_button()
{
    if (get_user_option('rich_editing') == 'true' && current_user_can('edit_posts')) {
        add_filter('mce_external_plugins', 'add_maplayer_button_script');
        add_filter('mce_buttons','register_maplayer_button');
    }
}

// Register our TinyMCE button
function register_maplayer_button($buttons) {
    array_push($buttons, '|', 'maplayerbutton');
    return $buttons;
}

// Register our TinyMCE Script
function add_maplayer_button_script($plugin_array) {
    $plugin_array['maplayer'] = plugins_url('mapTinyMCE/tinymcemaplayer.js.php?params='.get_maplayer_pop_up_params(), __FILE__);
    return $plugin_array;
}

function get_maplayer_pop_up_params(){
    global $miniAudioPlayer_version,$miniAudioPlayer_donate;

    return urlencode(base64_encode(
        'plugin_version='.$miniAudioPlayer_version.'&'.
            'includes_url='.urlencode(includes_url()).'&'.
            'plugins_url='.urlencode(plugins_url()).'&'.
            'charset='.urlencode(get_option('blog_charset')).'&'.
            'exclude_class='.urlencode(get_option('miniAudioPlayer_excluded')).'&'.
            'showVolumeLevel='.urlencode(get_option('miniAudioPlayer_showVolumeLevel')).'&'.
            'showTime='.urlencode(get_option('miniAudioPlayer_showTime')).'&'.
            'showRew='.urlencode(get_option('miniAudioPlayer_showRew')).'&'.
            'width='.urlencode(get_option('miniAudioPlayer_width')).'&'.
            'skin='.urlencode(get_option('miniAudioPlayer_skin')).'&'.
            'volume='.urlencode(get_option('miniAudioPlayer_volume')).'&'.
            'donate='.$miniAudioPlayer_donate

    ));
}

if ( is_admin() ) {
    require('miniAudioPlayer-admin.php');
}

?>