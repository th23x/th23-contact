<?php
/*
th23 Contact
Admin area

Coded 2012-2025 by Thorsten Hartmann (th23)
https://th23.net/
*/

// Security - exit if accessed directly
if(!defined('ABSPATH')) {
    exit;
}

class th23_contact_admin extends th23_contact {

	// Extend class-wide variables
	public $i18n;
	private $admin;

	function __construct() {

		parent::__construct();

		// Setup basics (additions for backend)
		$this->plugin['dir_path'] = plugin_dir_path($this->plugin['file']);
		$this->plugin['settings'] = array(
			'base' => 'options-general.php',
			'permission' => 'manage_options',
		);
		// icon: "square" 48 x 48px (footer) / "horizontal" 36px height (header, width irrelevant) / both (resized if larger)
		$this->plugin['icon'] = array('square' => 'img/icon-square.png', 'horizontal' => 'img/icon-horizontal.png');
		$this->plugin['support_url'] = 'https://github.com/th23x/th23-contact/issues';
		$this->plugin['requirement_notices'] = array();

		// Load and setup required th23 Admin class
		if(file_exists($this->plugin['dir_path'] . '/inc/th23-admin-class.php')) {
			require($this->plugin['dir_path'] . '/inc/th23-admin-class.php');
			$this->admin = new th23_admin($this);
		}
		if(class_exists('th23_admin') && !empty($this->admin)) {
			add_action('init', array(&$this, 'setup_admin_class'));
		}
		else {
			add_action('admin_notices', array(&$this, 'error_admin_class'));
		}

		// Load plugin options
		// note: earliest possible due to localization only available at "init" hook
		add_action('init', array(&$this, 'init_options'));

		// Check requirements
		add_action('init', array(&$this, 'requirements'), 100);

		// Install/ uninstall
		add_action('activate_' . $this->plugin['basename'], array(&$this, 'install'));
		add_action('deactivate_' . $this->plugin['basename'], array(&$this, 'uninstall'));

		// Add option to specify title and URL for a legal information page in general admin
		// note: shared across th23 plugins and themes
		add_action('admin_init', array(&$this, 'add_general_options'));

		// Add contact form block
		add_action('enqueue_block_editor_assets', array(&$this, 'register_block_editor_js_css'));

	}

	// Setup th23 Admin class
	function setup_admin_class() {

		// enhance plugin info with generic plugin data
		// note: make sure function exists as it is loaded late only, if at all - see https://developer.wordpress.org/reference/functions/get_plugin_data/
		if(!function_exists('get_plugin_data')) {
			require_once(ABSPATH . 'wp-admin/includes/plugin.php');
		}
		$this->plugin['data'] = get_plugin_data($this->plugin['file']);

		// admin class is language agnostic, except translations in parent i18n variable
		// note: need to populate $this->i18n earliest at init hook to get user locale
		$this->i18n = array(
			'Settings' => __('Settings'),
			/* translators: parses in plugin version number */
			'Version %s' => __('Version %s', 'th23-contact'),
			/* translators: parses in plugin name */
			'Copy from %s' => __('Copy from %s', 'th23-contact'),
			'Support' => __('Support'),
			'Done' => __('Done'),
			'Settings saved.' => __('Settings saved.'),
			'+' => __('+'),
			'-' => __('-'),
			'Save Changes' => __('Save Changes'),
			/* translators: parses in plugin author name / link */
			'By %s' => __('By %s'),
			'Visit plugin site' => __('Visit plugin site'),
			'Error' => __('Error'),
			/* translators: 1: option name, 2: opening a tag of link to support/ plugin page, 3: closing a tag of link */
			'Invalid combination of input field and default value for "%1$s" - please %2$scontact the plugin author%3$s' => __('Invalid combination of input field and default value for "%1$s" - please %2$scontact the plugin author%3$s', 'th23-contact'),
		);

	}
	function error_admin_class() {
		/* translators: parses in names of 1: class which failed to load */
		echo '<div class="notice notice-error"><p style="font-size: 14px;"><strong>' . esc_html($this->plugin['data']['Name']) . '</strong></p><p>' . esc_html(sprintf(__('Failed to load %1$s class', 'th23-contact'), 'th23 Admin')) . '</p></div>';
	}

	// Load plugin options
	function init_options() {

		// Settings: Screen options
		// note: default can handle boolean, integer or string
		$this->plugin['screen_options'] = array(
			'hide_description' => array(
				'title' => __('Hide settings descriptions', 'th23-contact'),
				'default' => false,
			),
		);

		// Settings: Define plugin options
		$this->plugin['options'] = array();

		// post_ids

		$post_ids_description = __('Limit usage of contact shortcode to selected pages / posts, reducing unnecessary CSS loading - leave empty to use on all pages and posts', 'th23-contact');
		/* translators: inserts shortcode */
		$post_ids_description .= '<br />' . sprintf(__('Important: Requires contact shortcode %s placed in page / post to show contact form', 'th23-contact'), '<code style="font-style: normal;">[th23-contact]</code>');
		$post_ids_description .= '<br />' . __('Note: Shortcode can only be used once per page / post', 'th23-contact');

		$this->plugin['options']['post_ids'] = array(
			'title' => __('Pages / Posts', 'th23-contact'),
			'description' => $post_ids_description,
			'element' => 'list',
			'default' => array(
				'multiple' => array(''),
				'pages' => __('All pages', 'th23-contact'),
				'posts' => __('All posts', 'th23-contact'),
			),
			'attributes' => array(
				'size' => 8,
			),
		);

		$pages = get_pages();
		foreach($pages as $page) {
			/* translators: %s is page title */
			$this->plugin['options']['post_ids']['default'][$page->ID] = esc_html(sprintf(__('Page: %s', 'th23-contact'), wp_strip_all_tags($page->post_title)));
		}

		$posts = get_posts(array('numberposts' => -1, 'orderby' => 'post_title', 'order' => 'ASC'));
		foreach($posts as $post) {
			/* translators: %s is post title */
			$this->plugin['options']['post_ids']['default'][$post->ID] = esc_html(sprintf(__('Post: %s', 'th23-contact'), wp_strip_all_tags($post->post_title)));
		}

		// admin_email

		$admin_email = get_option('admin_email');

		$this->plugin['options']['admin_email'] = array(
			'title' =>  __('Recipient', 'th23-contact'),
			/* translators: %1$s / %2$s <a> and </a> tags for link to insert admin mail, %3$s current general admin e-mail address */
			'description' => sprintf(__('Provide mail address for contact form submissions - %1$sclick here%2$s to use your default admin e-mail address (%3$s)', 'th23-contact'), '<a href="" class="copy" data-target="input_admin_email" data-copy="' . esc_attr($admin_email) . '">', '</a>', esc_html($admin_email)),
			'default' => '',
			'shared' => true,
			'save_after' => 'save_admin_email',
		);

		// pre_subject

		$this->plugin['options']['pre_subject'] = array(
			'title' =>  __('Subject prefix', 'th23-contact'),
			'description' => __('Optional prefix to be added before the subject of mails sent from the contact form', 'th23-contact'),
			'default' => '',
		);

		// visitors

		$this->plugin['options']['visitors'] = array(
			'title' => __('Visitors', 'th23-contact'),
			'description' => __('If disabled, unregistered visitors will see a notice requiring them to login for sending a message', 'th23-contact'),
			'element' => 'checkbox',
			'default' => array(
				'single' => 0,
				0 => '',
				1 => __('Enable contact form for unregistered users', 'th23-contact'),
			),
			'attributes' => array(
				'data-childs' => '.option-captcha,.option-terms',
			),
		);

		// captcha

		$this->plugin['options']['captcha'] = array(
			'title' => '<i>reCaptcha</i>',
			/* translators: 1: "reCaptcha v2" as name of the service, 2: "Google" as provider name, 3/4: opening and closing tags for a link to Google reCaptcha website */
			'description' => sprintf(__('Important: %1$s is an external service by %2$s which requires %3$ssigning up for free keys%4$s - usage will embed external scripts and transfer data to %2$s', 'th23-contact'), '<i>reCaptcha v2</i>', '<i>Google</i>', '<a href="https://www.google.com/recaptcha/" target="_blank">', '</a>'),
			'element' => 'checkbox',
			'default' => array(
				'single' => 0,
				0 => '',
				1 => __('Unregistered users need to solve a captcha for better protection against spam and bots', 'th23-contact'),
			),
			'attributes' => array(
				'data-childs' => '.option-captcha_public,.option-captcha_private',
			),
			'save_after' => 'save_captcha',
		);

		// captcha_public

		$this->plugin['options']['captcha_public'] = array(
			'title' => __('Public Key', 'th23-contact'),
			'default' => '',
			'shared' => true,
		);

		// captcha_private

		$this->plugin['options']['captcha_private'] = array(
			'title' => __('Secret Key', 'th23-contact'),
			'default' => '',
			'shared' => true,
		);

		// terms

		$terms = (empty($title = get_option('th23_terms_title'))) ? __('Terms of Usage', 'th23-contact') : $title;
		$terms = (!empty($url = get_option('th23_terms_url'))) ? '<a href="' . esc_url($url) . '" target="_blank">' . esc_html($terms) . '</a>' : esc_html($terms);
		$terms_description = '<a href="" class="toggle-switch">' . __('Show / hide examples', 'th23-contact') . '</a>';
		$terms_description .= '<span class="toggle-show-hide" style="display: none;"><br />' . __('Example:', 'th23-contact');
		/* translators: %s: link with/or title to sites terms & conditions, as defined by admin */
		$terms_description .= '&nbsp;<input type="checkbox" />' . sprintf(__('I accept the %s and agree with processing my data', 'th23-contact'), $terms);
		/* translators: %s: link to general options page in admin */
		$terms_description .= '<br />' . sprintf(__('Note: For changing title and link shown see %s', 'th23-contact'), '<a href="options-general.php#th23_terms">' . __('General Settings') . '</a>');
		$terms_description .= '</span>';

		$this->plugin['options']['terms'] = array(
			'title' => __('Terms', 'th23-contact'),
			'description' => $terms_description,
			'element' => 'checkbox',
			'default' => array(
				'single' => 0,
				0 => '',
				1 => __('Unregistered users are required to accept terms of usage before sending their message', 'th23-contact'),
			),
		);

		// Settings: Define presets for template option values (pre-filled, but changable by user)
		$this->plugin['presets'] = array();

	}

	// Install
	function install() {

		// Prefill values in an option template, keeping them user editable (and therefore not specified in the default value itself)
		// need to check, if items exist(ed) before and can be reused - so we dont' overwrite them (see uninstall with delete_option inactive)
		if(isset($this->plugin['presets'])) {
			if(!isset($this->options) || !is_array($this->options)) {
				$this->options = array();
			}
			$this->options = array_merge($this->plugin['presets'], $this->options);
		}
		// Set option values, including current plugin version (invisibly) to be able to detect updates
		$this->options['version'] = $this->plugin['version'];
		update_option($this->plugin['slug'], $this->admin->get_options($this->options));
		$this->options = (array) get_option($this->plugin['slug']);

	}

	// Uninstall
	function uninstall() {

		// NOTICE: To keep all settings etc in case the plugin is reactivated, return right away - if you want to remove previous settings and data, comment out the following line!
		return;

		// Delete option values
		delete_option($this->plugin['slug']);

	}

	// Requirements - checks
	function requirements() {
		// check requirements only on relevant admin pages
		global $pagenow;
		if(empty($pagenow)) {
			return;
		}
		if('index.php' == $pagenow) {
			// admin dashboard
			$context = 'admin_index';
		}
		elseif('plugins.php' == $pagenow) {
			// plugins overview page
			$context = 'plugins_overview';
		}
		elseif($this->plugin['settings']['base'] == $pagenow && !empty($_GET['page']) && $this->plugin['slug'] == $_GET['page']) {
			// plugin settings page
			$context = 'plugin_settings';
		}
		else {
			return;
		}

		// customization: Check - plugin not designed for multisite setup
		if(is_multisite()) {
			$this->plugin['requirement_notices']['multisite'] = '<strong>' . __('Warning', 'th23-contact') . '</strong>: ' . __('Your are running a multisite installation - the plugin is not designed for this setup and therefore might not work properly', 'th23-contact');
		}

		// customization: Check - e-mail address as recipient for contact form requests must be given
		if(empty($this->options['admin_email']) || !is_email($this->options['admin_email'])) {
			$this->plugin['requirement_notices']['admin_email'] = '<strong>' . __('Error', 'th23-contact') . '</strong>: ' . __('No valid e-mail address is specified as recipient - contact form is disabled until you specify one', 'th23-contact');
		}

		// customization: Check - reCaptcha requires a public and private key to work
		if(!empty($this->options['captcha']) && (empty($this->options['captcha_public']) || empty($this->options['captcha_private']))) {
			$notice = '<strong>' . __('Error', 'th23-contact') . '</strong>: ';
			/* translators: Parses in "reCaptcha v2" as service name */
			$notice .= sprintf(__('%s requires a public and a private key to work - despite your settings it will be disabled until you define them', 'th23-contact'), '<em>reCaptcha v2</em>');
			$this->plugin['requirement_notices']['captcha'] = $notice;
		}

		// allow further checks (without re-assessing $context)
		do_action('th23_contact_requirements', $context);

	}

	// == customization: from here on plugin specific ==

	// Add option to specify title and URL for a legal information page in general admin
	// note: shared across th23 plugins and themes
	function add_general_options() {
		add_settings_section('th23_terms', '<a name="th23_terms"></a>' . __('Legal information', 'th23-contact') . '<!-- th23 Contact -->', array($this, 'admin_general_section_description'), 'general');
		register_setting('general', 'th23_terms_title');
		add_settings_field(
			'th23_terms_title',
			__('Title', 'th23-contact'),
			array($this, 'admin_general_show_field'),
			'general',
			'th23_terms',
			array(
				'id' => 'th23_terms_title',
				'description' => __('If left empty, &quot;Terms of Usage&quot; will be used', 'th23-contact')
			)
		);
		register_setting('general', 'th23_terms_url');
		add_settings_field(
			'th23_terms_url',
			__('URL', 'th23-contact'),
			array($this, 'admin_general_show_field'),
			'general',
			'th23_terms',
			array(
				'id' => 'th23_terms_url',
				'description' => __('Can be relative URL - if left empty, no link will be added', 'th23-contact'),
				'input_class' => 'regular-text code'
			)
		);
	}
	function admin_general_section_description() {
		echo '<p>' . esc_html__('Reference a page providing user with legally required information about terms of usage, impressum and data provacy policy', 'th23-contact') . '</p>';
	}
	function admin_general_show_field($args) {
		$class = (isset($args['input_class'])) ? $args['input_class'] : 'regular-text';
		echo '<input class="' . esc_attr($class) . '" type="text" id="'. esc_attr($args['id']) .'" name="'. esc_attr($args['id']) .'" value="' . esc_attr(get_option($args['id'])) . '" />';
		if(isset($args['description'])) {
			echo '<p class="description">' . esc_html($args['description']) . '</p>';
		}
	}

	// Save Settings: Warn the user if no (valid) e-mail address is specified
	function save_admin_email($new_options, $options_unfiltered) {
		// re-check requirement, as latest save (executed) after prerequisites check, might have changed things
		if(empty($this->options['admin_email']) || !is_email($this->options['admin_email'])) {
			$this->plugin['requirement_notices']['admin_email'] = '<strong>' . __('Error', 'th23-contact') . '</strong>: ' . __('No valid e-mail address is specified as recipient - contact form is disabled until you specify one', 'th23-contact');
		}
		else {
			unset($this->plugin['requirement_notices']['admin_email']);
		}
		return $new_options;
	}

	// Save Settings: Warn the user if now activated, but required keys are missing
	function save_captcha($new_options, $options_unfiltered) {
		// re-check requirement, as latest save (executed) after prerequisites check, might have changed things
		if(!empty($this->options['captcha']) && (empty($this->options['captcha_public']) || empty($this->options['captcha_private']))) {
			$notice = '<strong>' . __('Error', 'th23-contact') . '</strong>: ';
			/* translators: Parses in "reCaptcha v2" as service name */
			$notice .= sprintf(__('%s requires a public and a private key to work - despite your settings it will be disabled until you define them', 'th23-contact'), '<i>reCaptcha v2</i>');
			$this->plugin['requirement_notices']['captcha'] = $notice;
		}
		else {
			unset($this->plugin['requirement_notices']['captcha']);
		}
		return $new_options;
	}

	// Add contact form block
	// note: embedd editor JS/CSS only on add/edit post/page, if allowed for that type/item - based on https://www.designbombs.com/registering-gutenberg-blocks-for-custom-post-type/
	function register_block_editor_js_css() {
		global $pagenow;
		if(!in_array($pagenow, array('post-new.php', 'post.php'))) {
			return;
		}
		// note: less strict check for type "post" or "page" only - activation check done by rendering block, allowing for a note to editor to enable it for this post/page in the settings
		if(!empty($type = get_post_type()) && in_array($type, array('post', 'page'))) {
			wp_enqueue_script('th23-contact-block-editor-js', $this->plugin['dir_url'] . 'th23-contact-block-editor.js', array('wp-blocks', 'wp-server-side-render'), $this->plugin['version'], true);
			// load frontend CSS for minimal styling of the contact form block as "preview" in the editor
			wp_enqueue_block_style('th23-contact/contact-form', array('handle' => 'th23-contact-block-editor-css', 'src' => $this->plugin['dir_url'] . 'th23-contact.css'));
		}
	}

}

?>
