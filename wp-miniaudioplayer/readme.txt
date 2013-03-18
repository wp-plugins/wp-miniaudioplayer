=== mb.miniAudioPlayer - an HTML5 audio player for your mp3 files ===

Contributors: Pupunzi (Matteo Bicocchi)
Tags: audio player, mp3, HTML5 audio, audio, music, podcast, jquery, pupunzi, mb.components
Requires at least: 3.3
Tested up to: 3.5
Stable tag: 1.2.6
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DSHAHSJJCQ53Y

Transform your mp3 audio files into a nice, small light HTML5 player

== Description ==

**This plug-in let you transform any mp3 file uploaded inside a post into an essential small HTML5 audio player with:**

* volume control
* seeking control
* title bar
* rewind button
* mute button
* play button

[youtube http://www.youtube.com/watch?v=B8Dr4aUNGgo]

Links:

* demo: http://pupunzi.com/mb.components/mb.miniAudioPlayer/demo/demo.html
* video: http://youtu.be/B8Dr4aUNGgo
* pupunzi blog: http://pupunzi.open-lab.com
* pupunzi site: http://pupunzi.com

If you are using others HTML5 audio plugins (like Haiku) there could be conflicts with mb.miniAudioPlayer. You should deactivete the others befor using it.

Other WP plugins:

* **wp-YTPlayer.** A Chromeless video player to play your Youtube videos as background of any WP page or post.
http://wordpress.org/extend/plugins/wpmbytplayer/

== Installation ==

Extract the zip file and upload the contents to the wp-content/plugins/ directory of your WordPress® installation, and then activate the plugin from the plugins page.

== Screenshots ==

1. The settings panel.
2. The player closed with a black skin.
3. The player opened with a green skin.
4. The edit properties button available in the post editor toolbar.
5. The properties window in the post editor.

== How it works: ==

1. Activate the mb.miniAudioPlayer plugin via the WP plugin panel;
2. Edit a post or a page, click on the Upload/Insert media link and choose an mp3 file;
3. place it into the post wherever you want to show the player.
4. save the post and browse it; the player will show instead of the link at the file.

to change the player default settings go to the mb.miniAudioPlayer settings panel (you can find it under the "settings" section of the WP backend).

**Options:**

* @ width = (int) the width in pixel of the player once opened.
* @ skin = the color of the player interface (black, blue, orange, red, gray and green).
* @ volume = (int) the initial volume of the player.
* @ showVolumeLevel = a boolean to show or hide the volume control.
* @ showTime = a boolean to show or hide the time counter.
* @ showRew = a boolean to show or hide the rewind control.
* @ autoPlay = (available only for the TinyMCE editor plugin) a boolean to set in play the player once the page is loaded.
* @ downloadable = a boolean to show the download button next to the player.
* @ excluded = a string containing the CSS class for audio links that should not be converted into player.

== Changelog ==

= 1.2.6 =
* Bug fix: If the player was instanced inside a table, the table disappear once the player was stopped.

= 1.2.5 =
* Removed the base64 encoding from the TinyMCE parameters; this should fix the false positive malicious advice from server that someone had.

= 1.2.2 =
* Bug fix:
	Fixed a bug that prevents the player works on IE.
	Added the "loop" option in the player customization.
	Setting the width to 0 the player will show in compact mode.

= 1.2.1 =
* Bug fix:
	Fixed a bug that prevents the player works if the "downloadable" option was setted to false.

= 1.2 =
* Features added:
	Added a new "Get title from metadata" option that will retrieve the title of the audio file from the id3 meta data; it works only if the file is on the same domain and it falls back to the default content if failed.

= 1.1.1 =
* Bug fix:
	Fixed a bug in the settings page that prevent the "animate" property to be set.

* Features added:
	Added the possibility to remove the customization button in the post editor TinyMCE (in some installations this generate a permission bug preventing the post editor to work).

= 1.1 =
* Features added:
	1. Added a new parameter to allow download only for registered users (available both on the general settings window and on the post editor player customization window).
	2. Added a new parameter to set the player always opened (available both on the general settings window and on the post editor player customization window).

= 1.0.1 =
* Bug fix: solved the inconsistent playing on iOs devices with multiple audio files.

= 1.0 =
* Fixed a bug that disabled seeking by clicking on the time bar..

= 0.9.9 =
* Updated for jQuery 1.9 compatibility.

= 0.9.8 =
* Fixed a potential bug for servers that doesn't allow Camel-case for folders in path.

= 0.9.7 =
* general bugfix (donate window in TinyMCE)

= 0.9.6 =
* bug fix: Solved a problem on changing the title of the audio player via the TinyMCE editor window.

= 0.9.5 =
* Improve: Now you can set the with of the player as percentage; it is not a liquid behaviour as the width will be transformed into pixel unit but it allow a responsive behavior cross devices.

= 0.9.4 =
* Fix: The name of the downloadable file is now the one of the original file.

= 0.9.3 =
* bug fix: Prevent conflicts with other components using jPlayer.

= 0.9.2 =
* bug fix: IE8 didn't read the controls Font face.

= 0.9 =
* bug fix: solved a major bug that was preventing the correct behaviour within the TinyMCE editor window.

= 0.8 =
* bug fix: the donate pop up was showing even after the donation.
* bug fix: the Tiny popup setting didn't work in certain cases.

= 0.7 =
* added tweet and FB share on plugin settings.

= 0.6 =
* Better TinyMce Editor (the toolbar button get active only if the cursor is on a .mp3 link.
* Better download icon.

= 0.5 =
* Added download action that directly download the audiofile.

= 0.4 =
* Added "downloadable" property to let download the audio file via a little arrow next to the player.
* Added "exclude" property to exclude a link from the rendering of the player.
Both are available as general options or as specific option via the popup window in the post editor TinyMCE.
* refined the appearance of the player.

= 0.3 =
* Major bug-fix for the TinyMCE editor plugin --- important update!!

= 0.2 =
* Added a customize tool in the post/page editor. You can customize the properties for each player by selecting it in the post editor and clicking on the miniAudioPlayer button to edit properties.

= 0.1.2 =
* Fixed a bug for preferences checks (always true).

= 0.1.1 =
* Fixed a wrong path for the settings file in the plugin list.

= 0.1 =
* First release
