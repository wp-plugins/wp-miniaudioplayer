<?php

// create the admin menu
// hook in the action for the admin options page
add_action('admin_menu', 'add_miniAudioPlayer_option_page');

function add_miniAudioPlayer_option_page(){
    // hook in the options page function
    add_options_page('miniAudioPlayer', 'mb.miniAudioPlayer', 'manage_options', __FILE__, 'miniAudioPlayer_options_page');
    add_action( 'admin_init', 'register_miniAudioPlayerSettings' );
}


function register_miniAudioPlayerSettings() {
    //register miniAudioPlayer settings
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_donate' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_getMetadata' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_version' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_width' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_skin' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_animate' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_volume' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_showVolumeLevel' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_showTime' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_showRew' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_excluded' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_download' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_download_security' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_customizer' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_custom_skin_css' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_custom_skin_name' );
    register_setting( 'miniAudioPlayer-settings-group', 'miniAudioPlayer_add_gradient' );
}

function miniAudioPlayer_options_page(){ // Output the options page
    ?>

    <!--DONATE POPUP-->
    <style>
        #donate {
            position: fixed;
            top: 20%;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 30px;
            text-align: center;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            z-index: 10000;
            display: none
        }

        #donateContent {
            position: relative;
            margin: 30px auto;
            background: rgba(77, 71, 61, 0.88);
            color: white;
            padding: 30px;
            text-align: center;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            width: 450px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5)
        }

        #donate h2 {
            font-size: 30px;
            line-height: 33px;
        }

        #donate p {
            margin: 30px;
            font-size: 16px;
            line-height: 22px;
            display: block;
            float: none;
        }

        #donate p#follow {
            margin: 30px;
            font-size: 16px;
            line-height: 33px;
        }

        #donate p#timer {
            padding: 5px;
            font-size: 20px;
            line-height: 33px;
            background: #231d0c;
            border-radius: 30px;
            color: #ffffff;
            width: 30px;
            margin: auto;
        }

        #donateTxt {
            display: none;
        }

        hr {
            border: none;
            height: 1px;
            background: #dfd490
        }
    </style>
    <div id="donate">
        <div id="donateContent">
            <h2>mb.miniAudioPlayer</h2>

            <p><?php _e('If you like it and you are using it then you should consider a donation <br> (€15,00 or more) :-)', 'mbMiniAudioPlayer'); ?></p>

            <p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=V6ZS8JPMZC446&lc=GB&item_name=mb%2eideas&item_number=MBIDEAS&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG_global%2egif%3aNonHosted"
                  target="_blank" onclick="donate()">
                    <img border="0" alt="PayPal" src="https://www.paypalobjects.com/en_US/IT/i/btn/btn_donateCC_LG.gif">
                </a></p>

            <p id="timer">&nbsp;</p>
            <br>
            <br>
            <button onclick="donate()"><?php _e('I already donate', 'mbMiniAudioPlayer'); ?></button>
        </div>
    </div>
    <script type="text/javascript">

        function donate() {
            jQuery("input[name=miniAudioPlayer_donate]").val("true");
            jQuery("#optionsForm").submit();
        }

        jQuery(function () {

            if (<?php echo get_option('miniAudioPlayer_donate');?>) {
                jQuery("#donate").remove();
                jQuery("#inlineDonate").remove();
                jQuery("#donateTxt").show()
            } else {
                jQuery("#donate").show();
                var timer = 5;
                var closeDonate = setInterval(function () {
                    timer--;
                    jQuery("#timer").html(timer);
                    if (timer == 0) {
                        clearInterval(closeDonate);
                        jQuery("#donate").fadeOut(600, jQuery(this).remove)
                    }
                }, 1000)
            }
        });

    </script>
    <!--END DONATE POPUP-->

    <style>
        #wpwrap {
            background: #ebf2f4 url("<?php echo plugins_url( 'images/bgnd.jpg', __FILE__ );?>");
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .form-table th {
            font-weight: bold !important;
            border-bottom: 1px solid gray;
        }

        .form-table td {
            border-bottom: 1px solid gray;
        }

        .submit {
            text-align: right;
        }
    </style>

    <div class="wrap" style="width:800px">

    <a href="http://pupunzi.com"><img style="margin-top:30px;"
                                      src="<?php echo plugins_url('images/logo.png', __FILE__);?>"
                                      alt="Made by Pupunzi"/></a>

    <h2><?php _e('mb.miniAudioPlayer Settings', 'mbMiniAudioPlayer'); ?></h2>

    <p><?php printf( __( 'You’re using mb.miniAudioPlayer v. %s', 'mbMiniAudioPlayer' ), get_option('miniAudioPlayer_version') ); ?> <?php _e('by', 'mbMiniAudioPlayer'); ?> <a href="http://pupunzi.com">Pupunzi</a>.</p>

    <div id="share" style="position: absolute; left:650px; top:20px">

        <a href="https://twitter.com/share" class="twitter-share-button"
           data-url="http://wordpress.org/extend/plugins/wp-miniaudioplayer/"
           data-text="I'm using the mb.miniAudioPlayer WP plugin" data-via="pupunzi"
           data-hashtags="HTML5,wordpress,plugin">Tweet</a>
        <script>!function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, "script", "twitter-wjs");</script>

        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/it_IT/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="http://wordpress.org/extend/plugins/wp-miniaudioplayer" data-send="false"
             data-layout="button_count" data-width="450" data-show-faces="true" data-font="arial"></div>
    </div>

    <div class="updated fade">
        <p style="line-height: 1.4em;"><?php _e('Thanks for downloading mb.miniAudioPlayer!', 'mbMiniAudioPlayer'); ?></p>

        <p id="inlineDonate" style="position: relative; display:block" class="alignrightt">
            <?php _e('If you like it and you are using it<br>then you should consider a donation (€15,00 or more) :-)', 'mbMiniAudioPlayer'); ?><br><br>
            <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=V6ZS8JPMZC446&lc=GB&item_name=mb%2eideas&item_number=MBIDEAS&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG_global%2egif%3aNonHosted"
               target="_blank" onclick="donate()"><img border="0" alt="PayPal"
                                                       src="https://www.paypalobjects.com/en_US/IT/i/btn/btn_donateCC_LG.gif"></a>
            <br><br><i><?php _e('If you donate, the start popup will nevermore display', 'mbMiniAudioPlayer'); ?>.</i><br><br>
        </p>
        <hr>
        <p><?php _e('Don’t forget to follow me on twitter', 'mbMiniAudioPlayer'); ?>: <a href="https://twitter.com/pupunzi">@pupunzi</a></p>
        <p><?php _e('Visit my site', 'mbMiniAudioPlayer'); ?>: <a href="http://pupunzi.com">http://pupunzi.com</a></p>
        <p><?php _e('Visit my blog', 'mbMiniAudioPlayer'); ?>: <a href="http://pupunzi.open-lab.com">http://pupunzi.open-lab.com</a></p>

        <p id="donateTxt"><?php _e('Paypal', 'mbMiniAudioPlayer'); ?>: <a
                href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=V6ZS8JPMZC446&lc=GB&item_name=mb%2eideas&item_number=MBIDEAS&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG_global%2egif%3aNonHosted"
                target="_blank"><?php _e('donate', 'mbMiniAudioPlayer'); ?></a></p>
    </div>

    <div class="highlight fade" style="padding: 10px; margin: 0">
        <!-- Begin MailChimp Signup Form -->
        <form action="http://pupunzi.us6.list-manage2.com/subscribe/post?u=4346dc9633&amp;id=91a005172f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <label for="mce-EMAIL" style="font-weight: bold"><?php _e('Subscribe to my mailing list<br>to stay in touch', 'mbMiniAudioPlayer'); ?>.</label>
            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="<?php _e('your email address', 'mbMiniAudioPlayer'); ?>" required>
            <input type="submit" value="<?php _e('Subscribe', 'mbMiniAudioPlayer'); ?>" name="subscribe" id="mc-embedded-subscribe" class="button">
        </form>
        <!--End mc_embed_signup-->
    </div>


    <form id="optionsForm" method="post" action="options.php">

    <?php settings_fields( 'miniAudioPlayer-settings-group' ); ?>
    <?php do_settings_sections( 'miniAudioPlayer-settings-group' ); ?>

    <h2><?php _e('Default settings', 'mbMiniAudioPlayer'); ?>:</h2>

    <p><?php _e('Here you define the default settings for all the audio links in your Wordpress site', 'mbMiniAudioPlayer'); ?>.</p>

    <p><?php _e('You can overwrite the single player settings by selecting the audio link in the post editor and clicking on the mb.miniAudioPlayer button on the top of the TinyMCE editor toolbar', 'mbMiniAudioPlayer'); ?>.</p>
    <hr>
    <input type="hidden" name="miniAudioPlayer_donate" value="<?php echo esc_attr( get_option('miniAudioPlayer_donate') ); ?>"/>
    <table class="form-table">

    <tr valign="top">
        <th scope="row"><?php _e('Get the title from meta-data', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="checkbox" name="miniAudioPlayer_getMetadata"
                   value="true" <?php if (get_option('miniAudioPlayer_getMetadata') == "true") {echo' checked="checked"';}?>/>

            <p><?php _e('Check to retrieve the title from meta-data', 'mbMiniAudioPlayer'); ?></p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row">

            <?php  _e( 'Set or edit your custom skin' ,'mbMiniAudioPlayer'); ?>:
            <p><?php _e('You can upload a CSS file generated from the SkinMaker tool', 'mbMiniAudioPlayer'); ?>. </p>
            <button onclick="jQuery('#fileToLoad').click(); return false;">upload a saved skin</button>
            <p><?php _e('Or you can copy the code generated from the SkinMaker tool and paste it into the textarea', 'mbMiniAudioPlayer'); ?>. </p>
            <a href="http://pupunzi.com/mb.components/mb.miniAudioPlayer/demo/skinMaker.html" target="_blank">online miniAudioPlayer skinMaker</a>
            <input type="file" id="fileToLoad" accept="text/css" onchange="jQuery.file.loadText(this,'css',setVarFromLoad)" style="display: none">
            <script>

                function setVarFromLoad(textFromFileLoaded) {

                    var re = /\/\*{(.*)}\*\//;
                    var m = textFromFileLoaded.match(re);

                    if(!m){
                        alert("this is not a miniAudioPlayer skin, sorry.");
                        return;
                    }

                    var paramsString = "{" + m[1] + "}";
                    var params = JSON.parse( paramsString );


                    jQuery("#miniAudioPlayer_custom_skin_name").val(params.skinName);
                    jQuery("#skinNameOption").val(params.skinName).html(params.skinName + " (customizable)");
                    jQuery(".customSkinName").html(params.skinName);


                    jQuery("#customSkinCss").val(textFromFileLoaded);

                }

                jQuery.file = {
                    defaults:{
                        type: "txt,html,css"
                    },
                    save: function(targetID, defaultExtension, fileName){

                        function getFileExtension ( url ) {
                            return url.split('.').pop().split(/\#|\?/)[0];
                        }

                        var fileContent,
                            textFileAsBlob,
                            fileNameToSaveAs,
                            fileExtension,
                            mimeType,
                            elToSave = jQuery("#" + targetID);

                        if(elToSave.is("img")) {
                            fileContent = elToSave.attr("src");
                            fileExtension = getFileExtension(fileContent);
                        }else if(elToSave.is("textarea")) {
                            fileContent = elToSave.val();
                            fileExtension = defaultExtension || "txt";

                            switch (defaultExtension){
                                case "txt":
                                    mimeType = "text/plain";
                                    break;
                                case "html":
                                    mimeType = "text/html";
                                    break;
                                case "css":
                                    mimeType = "text/css";
                                    break;
                            }

                            textFileAsBlob = new Blob([fileContent], {type: mimeType});
                        }

                        fileNameToSaveAs = (fileName || "untitled")+"."+fileExtension;
                        var downloadLink = document.createElement("a");
                        downloadLink.download = fileNameToSaveAs;
                        downloadLink.innerHTML = "Download File";
                        if (window.webkitURL != null) {
                            // Chrome allows the link to be clicked
                            // without actually adding it to the DOM.
                            downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
                        } else {
                            // Firefox requires the link to be added to the DOM
                            // before it can be clicked.
                            downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
                            downloadLink.onclick = jQuery.file.destroyClickedElement;
                            downloadLink.style.display = "none";
                            document.body.appendChild(downloadLink);
                        }
                        downloadLink.click();
                    },

                    destroyClickedElement : function(event){
                        document.body.removeChild(event.target);
                    },

                    loadText: function(el, types, callback){

                        var fileName;

                        function test(obj,filter){
                            var file = obj.value.match(/[^\/\\]+$/gi)[0];
                            fileName = file.split(".")[0];
                            var filters = filter.split(",");

                            for (var x in filters){
                                var newFilter = filters[x].trim();

                                var rx = new RegExp('\\.(' + (newFilter?newFilter:'') + ')$','gi');
                                var canUpload = false;
                                if(newFilter && file && file.match(rx)){
                                    canUpload = true;
                                    break;
                                }
                            }
                            return canUpload;
                        }

                        var fileToLoad = el;
                        var canLoad = test(fileToLoad, types);
                        if(!canLoad){
                            alert("check the file types, only "+types+" is accepted");
                            fileToLoad.value = "";
                            return;
                        }

                        fileToLoad = fileToLoad.files[0];
                        var fileReader = new FileReader();
                        fileReader.onload = function(fileLoadedEvent){
                            var textFromFileLoaded = fileLoadedEvent.target.result;

                            if(typeof callback == "function")
                                callback(textFromFileLoaded);
                        };
                        fileReader.readAsText(fileToLoad, "UTF-8");
                    }
                };


            </script>

        </th>
        <td>
            <p><?php printf( __( 'Customize the below CSS to modify the "<span class="customSkinName">%1$s</span>" appearance' ), get_option('miniAudioPlayer_custom_skin_name') ); ?>.</p>
            <br>
            <p><?php _e('Custom skin name:', 'mbMiniAudioPlayer'); ?>. </p>
            <input type="text" readonly id="miniAudioPlayer_custom_skin_name" name="miniAudioPlayer_custom_skin_name" value="<?php echo get_option('miniAudioPlayer_custom_skin_name') ?>">
            <br>
            <textarea  id="customSkinCss"
                       class="meta_skin_css"
                       name="miniAudioPlayer_custom_skin_css"
                       cols="50"
                       value="<?php esc_html_e( get_option('miniAudioPlayer_custom_skin_css ') ); ?>"
                       style="height: 450px; width: 580px; font-size: 12px"
                ><?php esc_html_e( get_option('miniAudioPlayer_custom_skin_css ') ); ?></textarea>

        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Choose the skin color', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <select name="miniAudioPlayer_skin">
                <option value="black" <?php if (get_option('miniAudioPlayer_skin') == "black") {
                    echo' selected';
                }?> ><?php _e('black', 'mbMiniAudioPlayer'); ?>
                </option>
                <option value="blue" <?php if (get_option('miniAudioPlayer_skin') == "blue") {
                    echo' selected';
                }?>><?php _e('blue', 'mbMiniAudioPlayer'); ?>
                </option>
                <option value="orange" <?php if (get_option('miniAudioPlayer_skin') == "orange") {
                    echo' selected';
                }?>><?php _e('orange', 'mbMiniAudioPlayer'); ?>
                </option>
                <option value="red" <?php if (get_option('miniAudioPlayer_skin') == "red") {
                    echo' selected';
                }?>><?php _e('red', 'mbMiniAudioPlayer'); ?>
                </option>
                <option value="gray" <?php if (get_option('miniAudioPlayer_skin') == "gray") {
                    echo' selected';
                }?>><?php _e('gray', 'mbMiniAudioPlayer'); ?>
                </option>
                <option value="green" <?php if (get_option('miniAudioPlayer_skin') == "green") {
                    echo' selected';
                }?>><?php _e('green', 'mbMiniAudioPlayer'); ?>
                </option>
                <option value='-' disabled>______________</option>
                <option id="skinNameOption" value="<?php echo get_option('miniAudioPlayer_custom_skin_name') ?>" <?php if (get_option('miniAudioPlayer_skin') == get_option('miniAudioPlayer_custom_skin_name')) {
                    echo' selected';
                }?>><?php echo get_option('miniAudioPlayer_custom_skin_name') ?> <?php _e('(customizable)', 'mbMiniAudioPlayer'); ?></option>
            </select>

            <p><?php _e('Set the palyer skin', 'mbMiniAudioPlayer'); ?>.</p>
            <p><?php printf( __( 'The "<span class="customSkinName">%1$s</span>" option let you customize the aspect of the player modifying the below CSS or uploading a skin CSS file' ), get_option('miniAudioPlayer_custom_skin_name') ); ?>.</p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Player should have a gradient appearance', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="checkbox" name="miniAudioPlayer_add_gradient" value="true" <?php if (get_option('miniAudioPlayer_add_gradient') == "true") {
                echo' checked="checked"';
            }?>/>

            <p><?php _e('Check to add a gradient to the player skin', 'mbMiniAudioPlayer'); ?>.</p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Player animation', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="checkbox" name="miniAudioPlayer_animate"
                   value="true" <?php if (get_option('miniAudioPlayer_animate') == "true") {
                echo' checked="checked"';
            }?>/>

            <p><?php _e('Check to activate the opening / closing animation', 'mbMiniAudioPlayer'); ?>.</p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Set the width', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="text" name="miniAudioPlayer_width" style="width:80px"
                   value="<?php echo esc_attr( get_option('miniAudioPlayer_width') ); ?>"/>

            <p><?php _e('Set the player width in pixel', 'mbMiniAudioPlayer'); ?>.</p>
            <p><?php _e('The size is relative to the inner part of the player; if you want you can set the with as percentage, in that case the player will be adaptive for different screen resolutions, included mobile devices', 'mbMiniAudioPlayer'); ?>.</p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Set the volume', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <select name="miniAudioPlayer_volume">
                <option value=".2" <?php if (get_option('miniAudioPlayer_volume') == ".2") {
                    echo' selected';
                }?> >2
                </option>
                <option value=".4" <?php if (get_option('miniAudioPlayer_volume') == ".4") {
                    echo' selected';
                }?>>4
                </option>
                <option value=".6" <?php if (get_option('miniAudioPlayer_volume') == ".6") {
                    echo' selected';
                }?>>6
                </option>
                <option value=".8" <?php if (get_option('miniAudioPlayer_volume') == ".8") {
                    echo' selected';
                }?>>8
                </option>
                <option value="1" <?php if (get_option('miniAudioPlayer_volume') == "1") {
                    echo' selected';
                }?>>10
                </option>
            </select>

            <p><?php _e('Set the default volume for the player', 'mbMiniAudioPlayer'); ?></p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('show volume level', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="checkbox" name="miniAudioPlayer_showVolumeLevel"
                   value="true" <?php if (get_option('miniAudioPlayer_showVolumeLevel') == "true") {
                echo' checked="checked"';
            }?>/>

            <p><?php _e('Check to show the volume levels', 'mbMiniAudioPlayer'); ?></p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('show time info', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="checkbox" name="miniAudioPlayer_showTime"
                   value="true" <?php if (get_option('miniAudioPlayer_showTime') == "true") {
                echo' checked="checked"';
            }?>/>

            <p><?php _e('Check to show the time info', 'mbMiniAudioPlayer'); ?></p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Show the Rewind button', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="checkbox" name="miniAudioPlayer_showRew"
                   value="true" <?php if (get_option('miniAudioPlayer_showRew') == "true") {
                echo' checked="checked"';
            }?>/>

            <p><?php _e('Check to show the Rewind button', 'mbMiniAudioPlayer'); ?></p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Exclude audio links with class', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="text" name="miniAudioPlayer_excluded" style="width:140px" value="<?php echo esc_attr( get_option('miniAudioPlayer_excluded', 'map_excluded') ); ?>"/>

            <p><?php _e('Define the class name for the audio links you don’t want to render as player; By default is "map_excluded"', 'mbMiniAudioPlayer'); ?></p>
            <p><i><?php _e('You can either manually add this class to the audio links you want to exclude or select the link and check the "Don’t render" checkbox of the popup window in the editor page', 'mbMiniAudioPlayer'); ?>.</i></p>
            <img style="margin-top:10px;" src="<?php echo plugins_url('images/excludeimg.png', __FILE__);?>"
                 alt="exclude image"/>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Allow downloads', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <script>
                function manageSecurity(el){

                    var security = jQuery('[name=miniAudioPlayer_download_security]');
                    if(jQuery(el).is(":checked")){
                        security.removeAttr('disabled');
                    }else{
                        security.attr('disabled','disabled');
                        security.removeAttr('checked');
                    }
                }
            </script>
            <input type="checkbox" name="miniAudioPlayer_download" onclick="manageSecurity(this)"
                   value="true" <?php if (get_option('miniAudioPlayer_download') == "true") {
                echo' checked="checked"';
            }?>/>

            <p><?php _e('Check to add a download button closed to the player', 'mbMiniAudioPlayer'); ?></p>

            <input type="checkbox" name="miniAudioPlayer_download_security" id="miniAudioPlayer_download_security"
                   value="true" <?php if (get_option('miniAudioPlayer_download_security') == "true") {
                echo' checked="checked" ';
            }
            if (get_option('miniAudioPlayer_download') != "true") {
                echo' disabled="disabled"';
            }?>/><label for="miniAudioPlayer_download_security" style="color:gray"><?php _e('Only for registered users', 'mbMiniAudioPlayer'); ?></label>
            <p><?php _e('Check to allow downloads only for registered user', 'mbMiniAudioPlayer'); ?></p>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e('Activate the player customizer in the post editor', 'mbMiniAudioPlayer'); ?>:</th>
        <td>
            <input type="checkbox" name="miniAudioPlayer_customizer" value="true" <?php if (get_option('miniAudioPlayer_customizer') == "true") {echo' checked="checked"';}?>/>
            <p><?php _e('Check to activate the customization window in the posts and pages TinyMce editor"', 'mbMiniAudioPlayer'); ?></p>
        </td>
    </tr>

    </table>

    <p><?php _e('If you are using others HTML5 audio player plug-ins (like Haiku) there could be conflicts with mb.miniAudioPlayer. You should deactivete the others befor using this', 'mbMiniAudioPlayer'); ?>.</p>

    <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/></p>

    </form>
    </div>
<?php } ?>
