(function() {
	tinymce.create('tinymce.plugins.maplayer', {

		init : function(ed, url) {

			var popUpURL = url + '/maplayertinymce.php';

			ed.addCommand('maplayerpopup', function() {
				if(ed.canOpenPopUp)
					ed.windowManager.open({
						url : popUpURL,
						width : 600,
						height : 620,
						inline : 1
					});
				else
					alert("You must select a link to an .mp3 file first.")
			});

			ed.addButton('maplayerbutton', {
				title : 'Modify a miniAudioPlayer',
				image : url + '/maplayerbutton.png',
				cmd : 'maplayerpopup'
			});

			ed.onNodeChange.add(function(ed) {
				var selection = ed.selection.getNode();
				var btn = ed.controlManager.get("maplayerbutton");
				var disable = false;
				ed.canOpenPopUp = false;

				jQuery("#"+btn.id).css({opacity:.5, border:"1px solid transparent"});
				if (jQuery(selection).is("a[href *= '.mp3']") || jQuery(selection).find("a[href *= '.mp3']").lenght>0 || jQuery(selection).prev().is("a[href *= '.mp3']")) {
					ed.canOpenPopUp = true;
					disable = false;
					jQuery("#"+btn.id).css({border:"1px solid gray", opacity:1});
				}
				ed.controlManager.setDisabled("maplayerbutton", disable);

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
