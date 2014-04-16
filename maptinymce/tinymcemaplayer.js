(function() {
	tinymce.create('tinymce.plugins.maplayer', {

		init : function(ed, url) {

			var popUpURL = url + '/maplayertinymce.php';

			ed.addCommand('maplayerpopup', function() {
				if(ed.canOpenPopUp)
					ed.windowManager.open({
						url : popUpURL,
						width : 900,
						height : 680,
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

				var btnId = typeof ed.controlManager.buttons != "undefined" ? ed.controlManager.buttons.maplayerbutton._id : ed.controlManager.get("maplayerbutton").id;

				var disable = false;
				ed.canOpenPopUp = false;

				jQuery("#"+btnId).css({opacity:.5, border:"1px solid transparent"});
				if (jQuery(selection).is("a[href *= '.mp3']") || jQuery(selection).find("a[href *= '.mp3']").lenght>0 || jQuery(selection).prev().is("a[href *= '.mp3']")) {
					ed.canOpenPopUp = true;
					disable = false;
					jQuery("#"+btnId).css({border:"1px solid gray", opacity:1});
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
