=== Plugin Name ===
Contributors: perkovich
Donate link: http://strm.se/
Tags: gowalla, location, activity, gps, geo, poi, stream
Requires at least: 2.8 
Tested up to: 2.9.2
Stable tag: 0.5.3

Displays latest activity in a Gowalla Spot as a list in a Wordpress Post or Page.


== Description ==

The plugin displays activity in a [Gowalla](http://gowalla.com) Spot in a Wordpress Post or Page. It uses the [Gowalla API](http://api.gowalla.com/api/explorer) and requires the unique Spot ID saved in a custom field in Wordpress. 

Example: http://www.surdegskartan.se/mellbybagaren/

The last five activities are displayed (API limit).


== Installation ==

1. Upload the folder `gowalla-spotter` to the `/wp-content/plugins/` directory.
2. Add a new custom field named "Gowalla" 
3. Put a Spot ID in the Gowalla field (ie: XXXXX from Gowalla-URI: http://gowalla.com/spots/XXXXX)
4. Add `<?php if (function_exists('gowalla_spotter')) gowalla_spotter(); ?>` inside the loop in a/the page template where you want the list to be displayed
5. Activate the plugin
6. Thats it!

== Frequently Asked Questions ==

= How do I uninstall the plugin? =

Inactivate the plugin and remove the php-line added in the template. If you want you can also remove the Custom Field. 

= How come the feed isnt showing? =

You might have forgotten to add the line of php `<?php if (function_exists('gowalla_spotter')) gowalla_spotter(); ?>` or there is an error in it. Also check that you have a working Spot ID from Gowalla.

= I have a question or suggestion! =

Email me at per@strm.se.

= I have a complaint! =

Email me at per@strm.se (please be nice, its my first plugin).

== Screenshots ==

1. This is Gowalla Spotter displayed below a post above the comments.


== Changelog ==

= 0.5.3 =
* Updated the readme.txt (php code got lost)

= 0.5.2 =
* Updated the readme.txt (php code got lost)

= 0.5.1 =
* Updated the readme.txt

= 0.5 =
* First release!

== Upgrade Notice == 

= 0.53 =
* No changes, just the readme.

= 0.5 =
* First release!