<?php

// safety
die();

// === Config: plugin information ===
// note: for further explanations, see comments in th23 Plugin Info class and/or example in class repository
$plugin = array(

	// (external) assets base (optional, only for Github "readme.md" and own updater "update.json")
	'assets_base' => 'https://raw.githubusercontent.com/th23x/th23-contact/refs/heads/main/',

	// plugin basics (mandatory, only "icons" are optional)
	'name' => 'th23 Contact',
	'icons' => array(
		'square' => 'assets/icon-128x128.png',
		'horizontal' => 'assets/icon-horizontal.png',
	),
	'slug' => 'th23-contact',
	'tags' => array(
		'contact',
		'form',
		'block',
		'shortcode',
	),

	// contributors (incl one mandatory author), (mandatory) homepage url, (optional) donate url, (optional) support url
	// note: "user" has to be a valid username on https://profiles.wordpress.org/username which is auto-linked to the WP profile
	'contributors' => array(
		array(
			'user' => 'th23',
			'name' => 'Thorsten',
			'url' => 'https://thorstenhartmann.de',
			'avatar' => 'https://thorstenhartmann.de/avatar.png',
			'author' => true,
		),
	),
	'homepage' => 'https://github.com/th23x/th23-contact',
	// 'donate_link' => '',
	// 'support_url' => '',

	// latest version (mandatory)
	'last_updated' => '2025-04-24 10:15:00',
	'version' => '3.1.0',
	'download_link' => 'https://github.com/th23x/th23-contact/releases/latest/download/th23-contact-v3.1.0.zip',

	// requirements (mandatory)
	'requires_php' => '8.0',
	'requires' => '4.2', // min WP version
	'tested' => '6.8', // max tested WP version

	// license (mandatory, but "description" optional)
	'license' => array(
		'GPL-3.0' => 'https://github.com/th23x/th23-contact/blob/main/LICENSE',
		'description' => 'You are free to use this code in your projects as per the `GNU General Public License v3.0`. References to this repository are of course very welcome in return for my work 😉',
	),

	// header banner (optional)
	'banners' => array(
		'low' => 'https://raw.githubusercontent.com/th23x/th23-contact/refs/heads/main/assets/banner-772x250.jpg',
		'high' => 'https://raw.githubusercontent.com/th23x/th23-contact/refs/heads/main/assets/banner-1544x500.jpg',
	),

	// description
	// - description [json] = summary (mandatory) + intro (optional) + usage (optional)
	// - introduction [git] = intro (optional) + screenshots (mandatory)
	// - description [wp] = intro (optional) + usage (optional)

	// summary (mandatory)
	'summary' => 'Simple contact form via block or legacy shortcode with optional spam protection via Akismet and reCaptcha',
	// intro (optional)
	'intro' => 'Provide your users and visitors a **simple and straight forward contact form**.

The **modern design** is very clear, easy to navigate and with light-weight JS and CSS code. One big benefit is its **flexible positioning** in pages and posts as a **modern style block or classic shortcode**.

To keep your website safe, it comes with built in **spam and bot protection**, by using Akisment and reCaptcha for messages sent by visitors. The plugin is continuously improved and used on live websites since 2012.

th23 Contact is built with some few goals in mind:

* **Simple and straight forward** option for user to contact you
* **Light-weight code basis** without overheads and frameworks
* **Easy to adapt styling** to fit any page design and layout
* **Fight spam and bots** without unnecessary hurdles (admittedly it\'s a compromise)

See it in action on my [Contact page](https://th23.net/contact/).',
	// screenshots (mandatory)
	'screenshots' => array(
		1 => array(
			'src' => 'assets/screenshot-1.jpg',
			'caption' => 'Contact form (logged in user)',
		),
		2 => array(
			'src' => 'assets/screenshot-2.jpg',
			'caption' => 'Contact form (visitor, needs to solve captcha)',
		),
		3 => array(
			'src' => 'assets/screenshot-3.jpg',
			'caption' => 'Plugin settings',
		),
	),
	// usage (optional)
	'usage' => 'Simply insert a new `th23 Contact form` block into the post / page using the plus sign in the Gutenberg editor or start typing `/th23 Contact form`.

Alternatively use the `[th23-contact]` shortcode directly in the source code editor view of a post / page or insert it as a **legacy shortcode block**.

> [!NOTE]
> The th23 Contact form block and / or shortcode **can only be used once per post / page**!
>
> Any second instance in the same post / page will be ignored upon frontend rendering and not show up.

> [!TIP]
> Ensure th23 contact form is enabled for the sepcific post / page - see admin area under `Settings` -> `th23 Contact`.',

	// setup (optional)
	// - installation [wp] = setup [git]
	'setup' => 'For a manual installation upload extracted `th23-contact` folder to your `wp-content/plugins` directory.

The plugin is **configured via its settings page in the admin area**. Find all options under `Settings` -> `th23 Contact`. The options come with a description of the setting and its behavior directly next to the respective settings field.',

	// frequently asked questions (mandatory)
	'faq' => array(
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
	),

	// changelog (mandatory, sorted by version, content can be a string or an array for a list)
	'changelog' => array(
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
	),

	// upgrade_notice (mandatory, sorted by version, content can be a string or an array for a list)
	'upgrade_notice' => array(
		'v3.1.0' => 'check plugin settings, especially consider new spam protection option',
		'v3.0.7' => 'n/a',
	),

);

// === Do NOT edit below this line for config ===

// safety
define('ABSPATH', 'defined');

// load class, generate plugin info
require_once(__DIR__ . '/inc/th23-plugin-info-class.php');
$th23_plugin_info = new th23_plugin_info();
$th23_plugin_info->generate($plugin);

?>
