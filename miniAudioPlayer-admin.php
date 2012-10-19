<?php

// create the admin menu
// hook in the action for the admin options page
add_action('admin_menu', 'add_miniAudioPlayer_option_page');

function add_miniAudioPlayer_option_page() {
    // hook in the options page function
    add_options_page('miniAudioPlayer', 'mb.miniAudioPlayer', 'manage_options', __FILE__, 'miniAudioPlayer_options_page');
}
function miniAudioPlayer_options_page() { 	// Output the options page
    global  $miniAudioPlayer_version,$miniAudioPlayer_width, $miniAudioPlayer_skin, $miniAudioPlayer_volume, $miniAudioPlayer_autoPlay, $miniAudioPlayer_showVolumeLevel, $miniAudioPlayer_showTime, $miniAudioPlayer_showRew ?>
<div class="wrap" style="width:800px">
    <style>

        #wpwrap{
            background: #ebf2f4 url("<?php echo plugins_url( 'images/bgnd.jpg', __FILE__ );?>");
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .form-table th{
            font-weight: bold!important;
            border-bottom: 1px solid gray;
        }
        .form-table td{
            border-bottom: 1px solid gray;
        }
        .submit{
            text-align: right;
        }

    </style>

    <form method="post" action="options.php">

        <?php wp_nonce_field('update-options'); ?>

        <h2>mb.miniAudioPlayer Settings</h2>
        <div class="updated fade">
            <p style="line-height: 1.4em;">Thanks for downloading mb.miniAudioPlayer! If you like it...<br /></p>
        </div>

        <!--      <h2>Reference</h2>

        <p>Leave the <b>home video url</b> blank if you don't want to display a background video on your homepage.
        </p>
        <p>You can add a mb.YTPlayer to any of your posts or pages by writing the shortcode
            <br>
            <b>[miniAudioPlayer url="http://www.youtube.com/watch?v=V2rifmjZuKQ" ratio="4/3" mute="false" loop="true" showControls="true" opacity=1]</b>
            into the content editor. Change the parameters into the shortcode to fill your needs.</p>
        <br>
        <h2>Home page background video properties:</h2>
        <p>These settings are used only for the Home istance of the mb.YTPlayer component.</p>
        <br>
        <br>-->
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Choose the skin color:</th>
                <td>
                    <select name="miniAudioPlayer_skin">
                        <option value="black" <?php if ($miniAudioPlayer_skin=="black") {echo' selected'; }?> >black</option>
                        <option value="blue" <?php if ($miniAudioPlayer_skin=="blue") {echo' selected'; }?>>blue</option>
                        <option value="orange" <?php if ($miniAudioPlayer_skin=="orange") {echo' selected'; }?>>orange</option>
                        <option value="red" <?php if ($miniAudioPlayer_skin=="red") {echo' selected'; }?>>red</option>
                        <option value="gray" <?php if ($miniAudioPlayer_skin=="gray") {echo' selected'; }?>>gray</option>
                        <option value="green" <?php if ($miniAudioPlayer_skin=="green") {echo' selected'; }?>>green</option>
                    </select>
                    <p>Set the palyer skin</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">Set the width:</th>
                <td>
                    <input type="text" name="miniAudioPlayer_width" style="width:70%" value="<?php if (!empty($miniAudioPlayer_width)) {echo $miniAudioPlayer_width; }?>"/>
                    <p>Set the player width in pixel</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Set the volume:</th>
                <td>
                    <select name="miniAudioPlayer_volume">
                        <option value=".2" <?php if ($miniAudioPlayer_volume==".2") {echo' selected'; }?> >2</option>
                        <option value=".4" <?php if ($miniAudioPlayer_volume==".4") {echo' selected'; }?>>4</option>
                        <option value=".6" <?php if ($miniAudioPlayer_volume==".6") {echo' selected'; }?>>6</option>
                        <option value=".8" <?php if ($miniAudioPlayer_volume==".8") {echo' selected'; }?>>8</option>
                        <option value="1" <?php if ($miniAudioPlayer_volume=="1") {echo' selected'; }?>>10</option>
                    </select>
                    <p>Set the default volume for the player</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">show volume level:</th>
                <td>
                    <input type="checkbox" name="miniAudioPlayer_showVolumeLevel" value="true" <?php if ($miniAudioPlayer_showVolumeLevel=="true") {echo' checked="checked"'; }?>/>
                    <p>Check to show the volume levels.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">show time info:</th>
                <td>
                    <input type="checkbox" name="miniAudioPlayer_showTime" value="true" <?php if ($miniAudioPlayer_showTime=="true") {echo' checked="checked"'; }?>/>
                    <p>Check to show the time info.</p>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">show the Rewind button:</th>
                <td>
                    <input type="checkbox" name="miniAudioPlayer_showRew" value="true" <?php if ($miniAudioPlayer_showRew=="true") {echo' checked="checked"'; }?>/>
                    <p>Check to show the Rewind button.</p>
                </td>
            </tr>

        </table>

        <p>Rate this plug in: <select onchange="window.open('http://wordpress.org/extend/plugins/wp-miniAudioPlayer/?rate='+this.value+'&topic_id=35600&_wpnonce=087fac79aa', 'rate')">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="5" selected>rate it</option>
        </select></p>


        <input type="hidden" name="page_options" value="miniAudioPlayer_width, miniAudioPlayer_skin, miniAudioPlayer_volume, miniAudioPlayer_showVolumeLevel, miniAudioPlayer_showTime, miniAudioPlayer_showRew" />
        <input type="hidden" name="action" value="update" />
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
        <a style="position: relative; display:block;top:0px;margin-right: -10px" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y"><img border="0" alt="PayPal" src="<?php echo plugins_url( 'images/btn_donateCC_LG_global.gif', __FILE__ );?>" class="alignright"></a>
    </form>

    <p>You're using mb.miniAudioPlayer v. <?php echo $miniAudioPlayer_version;?> by <a href="http://pupunzi.com">Pupunzi</a>.<br>If you like it and you use it then you should consider a donation (€15,00 or more) :-)</p>
    <a href="http://pupunzi.com"><img style="margin-top:30px;" src="<?php echo plugins_url( 'images/logo.png', __FILE__ );?>" alt="Made by Pupunzi" /></a>


</div>
<?php } ?>