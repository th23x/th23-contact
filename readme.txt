=== th23 Contact ===
Contributors: th23
Donate link: https://github.com/th23x/th23-contact
Tags: contact, form, block, shortcode
Requires at least: 4.2
Tested up to: 6.8
Stable tag: 3.1.1
Requires PHP: 8.0
License: GPL-3.0
License URI: https://github.com/th23x/th23-contact/blob/main/LICENSE


Simple contact form via block or legacy shortcode with optional spam protection via Akismet and reCaptcha


== Description ==

Provide your users and visitors a **simple and straight forward contact form**.

The **modern design** is very clear, easy to navigate and with light-weight JS and CSS code. One big benefit is its **flexible positioning** in pages and posts as a **modern style block or classic shortcode**.

To keep your website safe, it comes with built in **spam and bot protection**, by using Akisment and reCaptcha for messages sent by visitors. The plugin is continuously improved and used on live websites since 2012.

th23 Contact is built with some few goals in mind:

* **Simple and straight forward** option for user to contact you
* **Light-weight code basis** without overheads and frameworks
* **Easy to adapt styling** to fit any page design and layout
* **Fight spam and bots** without unnecessary hurdles (admittedly it's a compromise)

See it in action on my [Contact page](https://thorstenhartmann.de/kontakt/).

= Usage =

Simply insert a new `th23 Contact form` block into the post / page using the plus sign in the Gutenberg editor or start typing `/th23 Contact form`.

Alternatively use the `[th23-contact]` shortcode directly in the source code editor view of a post / page or insert it as a **legacy shortcode block**.

= NOTE =

The th23 Contact form block and / or shortcode **can only be used once per post / page**!

Any second instance in the same post / page will be ignored upon frontend rendering and not show up.

= TIP =

Ensure th23 contact form is enabled for the sepcific post / page - see admin area under `Settings` -> `th23 Contact`.


== Installation ==

For a manual installation upload extracted `th23-contact` folder to your `wp-content/plugins` directory.

The plugin is **configured via its settings page in the admin area**. Find all options under `Settings` -> `th23 Contact`. The options come with a description of the setting and its behavior directly next to the respective settings field.


== Frequently Asked Questions ==

= Despite reCaptcha being activated, I receive many spam contact messages? =

reCaptcha is around for a long time and available in various versions. Its version 2 was added to this plugin some years ago. Unfortunately with latest advances in computing, **it has to be considered "broken" by now**.

Since version 3.1.0 of this plugin, there is (additionally) the **option to use Akismet to detect spam**. It uses a much broader approach and thus for now seems to show significatly better detection of spam. **Activate it on the plugins settings page**.

= Can the plugin be activated on multiple selected pages / posts only? =

You can enable the block / shortcode for selected pages / posts only to **save your users unnecessarily loading JavaScript and CSS files**.

But for convenience the `th23 Contact` block / `[th23-contact]` shortcode can also be enabled for `All pages`, `All posts` or an selected set of pages / posts. Simply visit the plugin settings in your admin area. Under "Pages / Posts" you have the free choice.

To select multiple items on a PC simply keep the "Ctrl" key pressed any click on the pages / posts you want to select.


== Screenshots ==

1. Contact form (logged in user)
2. Contact form (visitor, needs to solve captcha)
3. Plugin settings


== Changelog ==

= v3.1.1 =

* enhancement: upgrade to th23 Plugin Info class 1.0.0
* fix: upgrade to th23 Admin class 1.6.2

= v3.1.0 =

* enhancement: add spam detection via Akismet
* enhancement: upgrade to th23 Admin class 1.6.1
* fix: properly unslash form data
* fix: ensure proper markup for some option descriptions
* fix: minor changes in plugin description etc

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

* enhancement: add contact form block for Gutenberg editor
* enhancement: switch admin basis to common th23 Admin class


== Upgrade Notice ==

= v3.1.1 =

* n/a

= v3.1.0 =

* check plugin settings, especially consider new spam protection option

= v3.0.7 =

* n/a
