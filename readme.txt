==== Nona ====
=== Readme.Txt ===
Last revised February 2016

== Table of Contents ==
* Recent Changelog
* To-Do
* Notes
* Questions & Answers
* Review Tickets

== Recent Changelog ==
== Version 1.9.3 ==
* Released February 2016
* Update copyright year
* Update required version to WordPress 4.1 (no sanity check)
* Added `id` to sidebar widget definitions
* Added sanity check before registering widgets
* Added `screen-reader-text` required CSS definitions
* Remove extraneous/minor comments to clean up code

== Version 1.9.2 ==
Changelog: December 27, 2014
= Code =
* Additional minor code refactoring to better meet WordPress Coding Standards
* Added `nona_content_width` function to be used in `*_head` hooks
* Added sanity check for WordPress 4.1 `add_theme_support( 'title-tag' )`
* Removed call to unused `$wp_version` global in `nona_setup`

= CSS =
* Re-implemented `.hidden` class to use `display: none;` property

= Miscellaneous =
* Added BNS Login compatibility to display dashicons instead of text links
* Cleaned up theme description

/** ------------------------------------------------------------------------- */
== Version 1.9.1 ==
Changelog: August 4, 2014
= Code =
* Minor code refactoring to better meet WordPress Coding Standards

= CSS =
* Added `post-title` class and styles to better handle long titles
* Improved aesthetics of Post Password form display
* Improved aesthetics of Search form display
* Made sure Twitter embeds are not fixed width
* Minor adjustment to child-menu item alignment (now left instead of centered)
* Updated `gallery-caption` class to better handle high quantity column displays
* Updated default Calendar widget styles

= Miscellaneous =
* Documentation clean up and updates
* Update copyright to 2014
* Update Tested Up To version to WordPress 4.0
* Update `screenshot.png` to 880x660 size

/** ------------------------------------------------------------------------- */
== Version 1.9 ==
Changelog: December 28, 2013
= Code =
* Code reformatted to better meet WordPress Coding Standards (see https://gist.github.com/Cais/8023722)
* Remove `nona_login` function - see BNS Login http://wordpress.org/extend/plugins/bns-login
* Removed the unused variable `$sep_location`

/** ------------------------------------------------------------------------- */
For older changelog entries see `changelog.txt`

== To-Do ==
NB: Open To-Do List is now found in 'index.php'

== Notes ==
* Future changelog entries will reflect commits to the GitHub repository: https://github.com/Cais/nona
* Some very light background colors will make the links hard to read when hovering over them. See the CSS element `a:hover { color: #e3e3e3; }` in style.css if you want to change this color.

== Questions & Answers ==
* TBA

== Review Tickets ==
* http://themes.trac.wordpress.org/ticket/2582
* http://themes.trac.wordpress.org/ticket/5740 - version 1.4
* http://themes.trac.wordpress.org/ticket/7530 - version 1.5
* http://themes.trac.wordpress.org/ticket/8575 - version 1.6
* http://themes.trac.wordpress.org/ticket/10307 - version 1.7
* http://themes.trac.wordpress.org/ticket/11704 - version 1.8 - March 2013
* http://themes.trac.wordpress.org/ticket/13448 - version 1.8.1 - July 2013
* http://themes.trac.wordpress.org/ticket/15897 - version 1.9 - December 28, 2013
* https://themes.trac.wordpress.org/ticket/20075 - version 1.9.1 - August 4, 2014
* https://themes.trac.wordpress.org/ticket/22342 - version 1.9.2 - December 27, 2014