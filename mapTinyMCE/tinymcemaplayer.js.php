<?php
	if (!headers_sent()) {
	    header("Content-Type: application/x-javascript; charset=UTF-8");
	}
?>
(function() {
    tinymce.create('tinymce.plugins.maplayer', {

        init : function(ed, url) {

        	var popUpURL = url + '/maplayertinymce.php?' + '<?php echo base64_decode(urldecode($_GET['params'])); ?>';

			ed.addCommand('maplayerpopup', function() {
				ed.windowManager.open({
					url : popUpURL,
					width : 600,
					height : 550,
					inline : 1
				});
			});

			ed.addButton('maplayerbutton', {
				title : 'miniAudioPlayer TinyMCE',
				image : url + '/maplayerbutton.png',
				cmd : 'maplayerpopup'
			});
		},

		createControl : function() {
            return null;
        },

		getInfo : function() {
            return {};
        }
    });
    tinymce.PluginManager.add('maplayer', tinymce.plugins.maplayer);
}());