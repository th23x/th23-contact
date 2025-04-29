<?php

// safety
die();

// === Config: plugin information (plugin-info.php) ===

// note: key plugin information are collected from main file plugin header (see above) and thus, these fields linke "name" are empty below - however if not empty, the below specified data "overrule" any other settings

$plugin = array();

// assets_base [recommended]
// note: (external) assets base for banners, icons and screenshots on Github (readme.md) and own updater (update.json)
$plugin['assets_base'] = 'https://raw.githubusercontent.com/th23x/th23-contact/refs/heads/main/';

// slug [mandatory]
$plugin['slug'] = 'th23-contact';

// name [mandatory]
// note: recommended as header "Plugin Name: th23 Specials"
$plugin['name'] = '';

// icons [optional]
// note: relative url, recommended to be combined with "assets_base"
$plugin['icons'] = array(
	'square' => 'assets/icon-128x128.png',
	'horizontal' => 'assets/icon-horizontal.png'
);

// tags [optional]
$plugin['tags'] = array('contact', 'form', 'block', 'shortcode');

// contributors [mandatory]
// note: one (main) as author is required, at least USER ("th23" in example) is required and has to be a valid username on https://profiles.wordpress.org/username which is auto-linked to the WP profile - further contributors can be added via the plugin info file
// note: recommended as header "Author: Thorsten (th23) ..."
$plugin['contributors'] = array();

// homepage [recommended]
// note: recommended as header "Plugin URI: https://github.com/th23x/th23-specials"
$plugin['homepage'] = '';

// donate_link [optional]
// note: if empty, homepage will be used instead for own updater (update.json) and WP.org (readme.txt)
$plugin['donate_link'] = '';

// support_url [optional]
// note: if empty, homepage will be used instead for own updater (update.json)
$plugin['support_url'] = '';

// license_short [mandatory]
// note: recommended as header "License: GPL-3.0"
$plugin['license_short'] = '';

// license_uri [mandatory]
// note: recommended as header "License URI: https://github.com/th23x/th23-specials/blob/main/LICENSE"
$plugin['license_uri'] = '';

// license_description [optional]
// note: if specified, used for Github (README.md) instead of short license
$plugin['license_description'] = 'You are free to use this code in your projects as per the `GNU General Public License v3.0`. References to this repository are of course very welcome in return for my work 😉';

// version [mandatory]
// note: recommended as header "Version: 6.0.1"
$plugin['version'] = '';

// last_updated [optional]
// note: if left empty (recommended), will be filled with current date/time automatically - otherwise expects timestamp in the format "2025-04-25 20:21:15"
$plugin['last_updated'] = '';

// download_link [optional]
// note: mandatory for plugins not hosted on WP.org via own updater (update.json) - note: using {VERSION} in the link will be replaced with latest version upon plugin info creation
$plugin['download_link'] = 'https://github.com/th23x/th23-contact/releases/latest/download/th23-contact-v{VERSION}.zip';

// requires [mandatory]
// note: min WP version
// note: recommended as header "Requires at least: 4.2"
$plugin['requires'] = '';

// tested [mandatory]
// note: max tested WP version
// note: recommended as header "Tested up to: 6.8"
$plugin['tested'] = '';

// requires_php [mandatory]
// note: recommended as header "Requires PHP: 8.0"
$plugin['requires_php'] = '';

// banners [recommended]
// note: sizes are "low" 772px x 250px and "high" 1544 px x 500px - relative url, recommended to be combined with "assets_base"
$plugin['banners'] = array(
	'low' => 'assets/banner-772x250.jpg',
	'high' => 'assets/banner-1544x500.jpg'
);

// summary [mandatory]
// note: max 150 characters (WP.org restriction)
// note: recommended as header "Description: Essentials to customize Wordpress via simple settings, SMTP, title highlight, category selection, more separator, sticky posts, remove clutter, ..."
$plugin['summary'] = '';

// intro [recommended]
// note: key information about the plugin, option to use markdown for structuring, highlighting, links, etc
$plugin['intro'] = 'Provide your users and visitors a **simple and straight forward contact form**.

The **modern design** is very clear, easy to navigate and with light-weight JS and CSS code. One big benefit is its **flexible positioning** in pages and posts as a **modern style block or classic shortcode**.

To keep your website safe, it comes with built in **spam and bot protection**, by using Akisment and reCaptcha for messages sent by visitors. The plugin is continuously improved and used on live websites since 2012.

th23 Contact is built with some few goals in mind:

* **Simple and straight forward** option for user to contact you
* **Light-weight code basis** without overheads and frameworks
* **Easy to adapt styling** to fit any page design and layout
* **Fight spam and bots** without unnecessary hurdles (admittedly it\'s a compromise)

See it in action on my [Contact page](https://thorstenhartmann.de/kontakt/).';

// screenshots [optional]
// note: relative urls, recommended to be combined with "assets_base"
$plugin['screenshots'] = array(
	1 => array('src' => 'assets/screenshot-1.jpg', 'caption' => 'Contact form (logged in user)'),
	2 => array('src' => 'assets/screenshot-2.jpg', 'caption' => 'Contact form (visitor, needs to solve captcha)'),
	3 => array('src' => 'assets/screenshot-3.jpg', 'caption' => 'Plugin settings')
);

// usage [optional]
$plugin['usage'] = 'Simply insert a new `th23 Contact form` block into the post / page using the plus sign in the Gutenberg editor or start typing `/th23 Contact form`.

Alternatively use the `[th23-contact]` shortcode directly in the source code editor view of a post / page or insert it as a **legacy shortcode block**.

> [!NOTE]
> The th23 Contact form block and / or shortcode **can only be used once per post / page**!
>
> Any second instance in the same post / page will be ignored upon frontend rendering and not show up.

> [!TIP]
> Ensure th23 contact form is enabled for the sepcific post / page - see admin area under `Settings` -> `th23 Contact`.';

// setup [optional]
$plugin['setup'] = 'For a manual installation upload extracted `th23-contact` folder to your `wp-content/plugins` directory.

The plugin is **configured via its settings page in the admin area**. Find all options under `Settings` -> `th23 Contact`. The options come with a description of the setting and its behavior directly next to the respective settings field.';

// faq [mandatory]
$plugin['faq'] = array(
	'recaptcha_broken' => array(
		'q' => 'Despite reCaptcha being activated, **I receive many spam contact messages**?',
		'a' => 'reCaptcha is around for a long time and available in various versions. Its version 2 was added to this plugin some years ago. Unfortunately with latest advances in computing, **it has to be considered "broken" by now**.

Since version 3.1.0 of this plugin, there is (additionally) the **option to use Akismet to detect spam**. It uses a much broader approach and thus for now seems to show significatly better detection of spam. **Activate it on the plugins settings page**.',
	),
	'multiple_pages' => array(
		'q' => 'Can the plugin be activated on **multiple selected pages / posts only**?',
		'a' => 'You can enable the block / shortcode for selected pages / posts only to **save your users unnecessarily loading JavaScript and CSS files**.

But for convenience the `th23 Contact` block / `[th23-contact]` shortcode can also be enabled for `All pages`, `All posts` or an selected set of pages / posts. Simply visit the plugin settings in your admin area. Under "Pages / Posts" you have the free choice.

To select multiple items on a PC simply keep the "Ctrl" key pressed any click on the pages / posts you want to select.',
	),
);

// changelog [mandatory]
// note: sorted by version, content can be a string or an array for a list, at least info for current version must be present
$plugin['changelog'] = array(
	'v3.1.1' => array(
		'enhancement: upgrade to th23 Plugin Info class 1.0.0',
		'fix: upgrade to th23 Admin class 1.6.2',
	),
	'v3.1.0' => array(
		'enhancement: add spam detection via Akismet',
		'enhancement: upgrade to th23 Admin class 1.6.1',
		'fix: properly unslash form data',
		'fix: ensure proper markup for some option descriptions',
		'fix: minor changes in plugin description etc',
	),
	'v3.0.7' => array(
		'enhancement: move upgrade handling to separate class loaded if required also from frontend site calls',
	),
	'v3.0.6' => array(
		'fix: update underlying th23 admin class to properly relate to parent version for plugin version',
	),
	'v3.0.5' => array(
		'fix: ensure proper update detection with option to handle any required changes automatically after a new version has been installed',
		'fix: prevent WP warnings upon too early usage of translation functions',
		'fix: prevent PHP warnings for (potentially) not initiated variable',
	),
	'v3.0.4' => array(
		'fix: ensure LF line endings to avoid errors on plugin activation',
	),
	'v3.0.1' => array(
		'fix: ensure settings are properly taken over from previous versions',
	),
	'v3.0.0' => array(
		'enhancement: add contact form block for Gutenberg editor',
		'enhancement: switch admin basis to common th23 Admin class',
	),
);

// upgrade_notice [mandatory]
// note: sorted by version, content can be a string or an array for a list, at least info for current version must be present
$plugin['upgrade_notice'] = array(
	'v3.1.1' => 'n/a',
	'v3.1.0' => 'check plugin settings, especially consider new spam protection option',
	'v3.0.7' => 'n/a',
);

// === Do NOT edit below this line for config ===

// safety
define('ABSPATH', 'defined');

// load class, generate plugin info
require_once(__DIR__ . '/inc/th23-plugin-info-class.php');
$th23_plugin_info = new th23_plugin_info();
$th23_plugin_info->generate($plugin);

?>
