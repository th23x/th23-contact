=== th23 Contact ===
Contributors: th23
Donate link: https://th23.net/th23-contact
Tags: contact, form, block, shortcode
Requires at least: 4.2
Tested up to: 6.7
Stable tag: 3.0.7
Requires PHP: 7.4
License: GPL-3.0-or-later
License URI: https://www.gnu.org/licenses/gpl-3.0.html


Simple contact form via block or legacy shortcode, optional spam and bot protection for messages by not-registered visitors


== Description ==

Provide your users and visitors a **simple and straight forward contact form**.

The **modern design** is very clear, easy to navigate and with light-weight JS and CSS code. One big benefit is its **flexible positioning** in pages and posts as a modern style block or as a classic shortcode.

To keep your website safe, it comes with built in **spam and bot protection**, by using reCaptcha for messages sent by visitors. The plugin is continuously improved and used on live websites since 2012.

See it in action on my [Contact page](https://th23.net/contact/).


= Configuration =

The plugin is configured via its settings page in the admin area. Find all options under `Settings` -> `th23 Contact`. Most options come with a description of the setting and behavior.

For more information on the plugin visit the [plugin website on GitHub](https://github.com/th23x/th23-contact).


== Installation ==

The plugin can be installed most easily through your admin panel (see below example of one of my other plugins):

[youtube https://www.youtube.com/watch?v=voXCzBw13cY]

For a manual installation follow these steps:

1. Download the plugin and extract the ZIP file
1. Upload the plugin files to the `/wp-content/plugins/th23-contact` directory on your webserver
1. Activate the plugin through the `Plugins` screen in the WordPress admin area
1. Use the `Settings` -> `th23 Contact` screen to configure the plugin
1. Embed the `[th23-contact]` shortcode into any page / post you want

That is it - people can now send you messages via the contact form!


== Frequently Asked Questions ==

= Can the plugin be activated on multiple selected pages / posts only? =

You can enable the block / shortcode /for selected pages / posts only to save your users unnecessarily loading JavaScript and CSS files.

But for convenience the `th23 Contact` block / `[th23-contact]` shortcode can also be enabled for `All pages`, `All posts` or an selected set of pages / posts. Simply visit the plugin settings in your admin area. Under 'Pages / Posts' you have the free choice.

To select multiple items on a PC simply keep the 'Ctrl' key pressed any click on the pages / posts you want to select.


== Screenshots ==

1. Contact form (logged in user)
2. Contact form (visitor)
3. Plugin settings


== Changelog ==

= v3.0.7 =
* enhancement: move upgrade handling to separate class loaded if required also from frontend site calls

= v3.0.6 =
* fix: update underlying th23 admin class to properly relate to parent version for plugin version

= v3.0.5 =
* fix: ensure proper update detection with option to handle any required changes automatically after a new version has been installed
* fix: prevent WP warnings upon too early usage of translation functions
* fix: prevent PHP warnings for (potentially) not initiated variable

= v3.0.4 =
* fix: ensure LF line endings to avoid errors on plugin activation

= v3.0.1 =
* fix: ensure settings are properly taken over from previous versions

= v3.0.0 =
* add contact form block for Gutenberg editor
* switch admin basis to common th23 Admin class

= v2.4.0 (first public release) =
* n/a


== Upgrade Notice ==

= v3.0.7 =
* no manual changes required
