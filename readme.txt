==== Readme for Nona Theme ====
@date: October 9, 2011

=== Contents ===
* To-Do
* Notes
* Review Tickets
* Test Environment

== To-Do ==
[x] Menu - Theme does not currently support sub-menu items off of the main menu, this will be addressed in a future version.
[ ] Editor Style - stylesheet needs to be added/completed; add_editor_style() function can be un-commented afterward.
[ ] Custom Header Images - further work is required to add appropriate code to make use of the existing child themes available from http://buynowshop.com/themes/nona/
[ ] Clean up namespace references on theme specific functions; review generic functions using the 'bns_' namespace
[ ] Clean up widget code in functions.php
[ ] Clean up unnecessary backward compatibility checks
[ ] Clean up internationalization strings ... look at providing a .pot file in future versions

== Notes ==
* Some very light background colors will make the links hard to read when hovering over them. See the CSS element `a:hover { color: #e3e3e3; }` in style.css if you want to change this color.

== Review Tickets ==
* http://themes.trac.wordpress.org/ticket/2582

== Test Environment as reported by BNS Support plugin ==
* Plugin URL: http://wordpress.org/extend/plugins/bns-support/
* WordPress Version: 3.1-RC2-17229
* PHP version: 5.2.15
* Multisite Enabled: False
* Theme: Nona v1.3.1
* Current User Role: administrator