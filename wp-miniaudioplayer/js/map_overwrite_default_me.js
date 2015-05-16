/*******************************************************************************
 *
 * map_overwrite_default_me
 * Author: pupunzi
 * Creation date: 12/05/15
 *
 ******************************************************************************/

function replaceDefault(){

	var me = jQuery(".mejs-container").not(".wp-audio-playlist .mejs-container");
	me.each(function(){
		var audioUrl = jQuery("audio", jQuery(this)).attr("src");
		var id = new Date().getTime();
		var map = jQuery("<a/>").attr({href:audioUrl, id: id }).html("audio");
		jQuery(this).replaceWith(map);
		jQuery("#" + id).mb_miniPlayer();
	});

	var me_pl = jQuery(".wp-audio-playlist");
	me_pl.each(function(){

		var el = jQuery(this);
		var pl = jQuery("<div/>").addClass("map_pl_container");

		el.before(pl);

		var audioUrl = jQuery("audio", jQuery(this)).attr("src");
		var me_pl_player = jQuery(".mejs-container", jQuery(this));
		var id = new Date().getTime();
		var map = jQuery("<a/>").attr({href:audioUrl, id: id }).html("audio");
		pl.append(map);

		jQuery("#" + id).mb_miniPlayer({width: "100%"});

		var me_pl_elements = jQuery(".wp-playlist-item", jQuery(this));

		var me_pl_container = jQuery("<div/>").addClass("pl_items_container");
		pl.append(me_pl_container);

		var counter = 0;
		me_pl_elements.each(function(){
			counter ++;
			var elementsUrl = jQuery("A",this).attr("href");
			var title = jQuery(".wp-playlist-item-title", this).html() || "";
			var author = jQuery(".wp-playlist-item-artist", this).html() || "";

			var pl_el = jQuery("<div/>").addClass("pl_item").html( counter + ". " + title + author).css({cursor: "pointer"});

			if(counter == 1){

				pl_el.addClass("sel");
				jQuery("#" + id).mb_miniPlayer_changeFile({mp3: elementsUrl}, title  +  author);

			}

			pl_el.on("click", function(){

				jQuery(".sel", pl).removeClass("sel");

				jQuery(this).addClass("sel");

				var player = jQuery("#" + id);
				player.mb_miniPlayer_changeFile({mp3: elementsUrl}, title  +  author);
				player.mb_miniPlayer_play();
			});

			me_pl_container.append(pl_el);
		});

		el.remove();

	})

}
