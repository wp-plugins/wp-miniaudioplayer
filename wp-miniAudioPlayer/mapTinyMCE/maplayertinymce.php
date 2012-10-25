<?php

$plugin_version = $_GET['plugin_version'];
$includes_url = $_GET['includes_url'];
$plugins_url = $_GET['plugins_url'];
$charset = $_GET['charset'];

if (!headers_sent()) {
    header('Content-Type: text/html; charset='.$charset);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
    <title>mb.miniAudioPlayer</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $plugins_url.'/wpmbytplayer/ytpTinyMCE/bootstrap-1.4.0.min.css?v='.$plugin_version; ?>"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $plugins_url.'/wpmbytplayer/js/jquery.metadata.js?v='.$plugin_version; ?>"></script>
    <script type="text/javascript" src="<?php echo $includes_url.'js/tinymce/tiny_mce_popup.js?v='.$plugin_version; ?>"></script>
    <style>
        fieldset label > span.label{
            display: inline-block;
            width: 100px;
        }
        fieldset label {
            margin: 5px;
        }

        .actions{
            text-align: right;
        }
        .span6{
            width: 100px!important;
        }
        h3{
            color:#404040!important;
        }
    </style>

</head>
<body>
<form class="form-stacked" action="#">

    <fieldset>
        <legend>mb.miniAudioPlayer parameters:</legend>

        <label>
            <span class="label">Audio url <span style="color:red">*</span> : </span>
            <input type="text" name="url" class="span5"/>
            <span class="help-inline">A valid .mp3 url</span>
        </label>

        <label>
            <span class="label">Audio title : </span>
            <input type="text" name="audiotitle" class="span5"/>
            <span class="help-inline">The audio title</span>
        </label>

        <label>
            <span class="label">Skin:</span>
            <select name="skin">
                <option value="black">black</option>
                <option value="blue">blue</option>
                <option value="orange">orange</option>
                <option value="red">red</option>
                <option value="gray">gray</option>
                <option value="green">green</option>
            </select>
            <span class="help-inline">Set the skin color for the player</span>
        </label>

        <label>
            <span class="label">Width: </span>
            <input type="text" name="width" class="span6"/>
            <span class="help-inline">Set the player width</span>
        </label>

        <label>
            <span class="label">Volume: </span>
            <input type="text" name="volume" class="span6"/>
            <span class="help-inline">(from 1 to 10) Set the player initial volume</span>
        </label>

        <label>
            <span class="label">Autoplay: </span>
            <input type="checkbox" name="autoplay" value="true"/>
            <span class="help-inline">check to start playing on page load</span>
        </label>

        <h3>Show/Hide</h3>

        <label>
            <span class="label">Volume control: </span>
            <input type="checkbox" name="showVolumeLevel" value="true"/>
            <span class="help-inline">check to show the volume control</span>
        </label>

        <label>
            <span class="label">Time control: </span>
            <input type="checkbox" name="showTime" value="true"/>
            <span class="help-inline">check to show the time control</span>
        </label>

        <label>
            <span class="label">Rewind control: </span>
            <input type="checkbox" name="showRew" value="true"/>
            <span class="help-inline">check to show the rewind control</span>
        </label>

    </fieldset>

    <div class="actions">
        <input type="submit" value="Insert the code" class="btn primary"/>
        or
        <input class="btn" type="reset" value="Reset settings"/>
    </div>
</form>

<!--[mbYTPlayer url="http://www.youtube.com/watch?v=V2rifmjZuKQ" ratio="4/3" mute="false" loop="true" showcontrols="true" opacity=1]-->
<script type="text/javascript">
    tinyMCEPopup.onInit.add(function(ed) {

        var selection = ed.selection.getNode();
        ed.selection.select(selection,true);
        var $selection = jQuery(selection);


        var url= "";
        var title = "";

        var map_element = $selection.find("a[href *= '.mp3']");

        if($selection.is("a[href *= '.mp3']")){
            url = $selection.attr("href");
            title = $selection.html();
        }else if (map_element.length){
            ed.selection.select(map_element.get(0),true);
            url = map_element.attr("href");
            title = map_element.html();
        }else if($selection.prev().is("a[href *= '.mp3']")){
            ed.selection.select($selection.prev().get(0),true);
            $selection = $selection.prev();
            url = $selection.attr("href");
            title = $selection.html();
        }

        var $desc = $selection.next(".map_params");
        var metadata = $selection.metadata();

        jQuery("[name='url']").val(url);
        jQuery("[name='audiotitle']").val(title);


        for (var i in metadata){

            if(typeof metadata[i] == "boolean"){
                if(metadata[i] == true)
                    jQuery("[name="+i+"]").attr("checked",  "checked");
            }else{
                jQuery("[name="+i+"]").val(metadata[i]);
            }
        }

        var form = document.forms[0];
        var isEmpty = function(value) {
                return (/^\s*$/.test(value));
            },

            encodeStr = function(value) {
                return value.replace(/\s/g, "%20")
                    .replace(/"/g, "%22")
                    .replace(/'/g, "%27")
                    .replace(/=/g, "%3D")
                    .replace(/\[/g, "%5B")
                    .replace(/\]/g, "%5D")
                    .replace(/\//g, "%2F");
            },

            insertCode = function(e){

                var map_params ="";
                if(jQuery("[name='skin']").val().length>0)
                    map_params+="skin:'"+jQuery("[name='skin']").val()+"', ";
                if(jQuery("[name='width']").val().length>0)
                    map_params+="width:"+jQuery("[name='width']").val()+", ";
                if(jQuery("[name='volume']").val().length>0)
                    map_params+="volume:"+ jQuery("[name='volume']").val()/10 +", ";
                map_params+="autoplay:"+(jQuery("[name='autoplay']").is(":checked") ? "true" : "false")+", ";
                map_params+="showVolumeLevel:"+(jQuery("[name='showVolumeLevel']").is(":checked") ? "true" : "false")+", ";
                map_params+="showTime:"+(jQuery("[name='showTime']").is(":checked") ? "true" : "false")+", ";
                map_params+="showRew:"+(jQuery("[name='showRew']").is(":checked") ? "true" : "false")+", ";

                var map_a = "<a id='mbmaplayer_"+new Date().getTime()+"' class= \"{";
                map_a += map_params;
                map_a += "}\" href=\""+jQuery("[name='url']").val()+"\">";
                map_a+=jQuery("[name='audiotitle']").val();
                map_a+="</a>";
                map_a = map_a.replace(", }", "}");
                ed.execCommand('mceInsertContent', 0, map_a);

                if($desc.length)
                    $desc.remove();

                var map_desc="<span class='map_params' style='color:#aaa; text-decoration: none;'><br>map :: ["+map_params+"]</span>";
                ed.execCommand('mceInsertContent', 0, map_desc);

                tinyMCEPopup.close();

                return false;
            };

        form.onsubmit = insertCode;
        tinyMCEPopup.resizeToInnerSize();
    });
</script>
</body>
</html>