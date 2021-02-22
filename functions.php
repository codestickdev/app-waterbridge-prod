<?php
/**
 * Waterbridge APP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Waterbridge_APP
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'waterbridge_app_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function waterbridge_app_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Waterbridge APP, use a find and replace
		 * to change 'waterbridge_app' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'waterbridge_app', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Header', 'waterbridge'),
			)
		);
		register_nav_menus(
			array(
				'menu-2' => esc_html__('Footer', 'waterbridge'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'waterbridge_app_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'waterbridge_app_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function waterbridge_app_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'waterbridge_app_content_width', 640 );
}
add_action( 'after_setup_theme', 'waterbridge_app_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function waterbridge_app_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'waterbridge_app' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'waterbridge_app' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'waterbridge_app_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function waterbridge_app_scripts() {
	wp_enqueue_style( 'waterbridge_app-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'waterbridge_app-style', 'rtl', 'replace' );

	wp_enqueue_script( 'waterbridge_app-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'waterbridge_app_scripts' );

wp_enqueue_style('custom_style',  '/wp-content/themes/waterbridge-prod/css/custom.css');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* ACF FIELDS */

// if( function_exists('acf_add_local_field_group') ):

// 	acf_add_local_field_group(array(
// 		'key' => 'group_5fde2f2973b2a',
// 		'title' => 'Inwestorzy',
// 		'fields' => array(
// 			array(
// 				'key' => 'field_5fde2f4405334',
// 				'label' => 'Inwestycje',
// 				'name' => 'user_investment',
// 				'type' => 'repeater',
// 				'instructions' => '',
// 				'required' => 0,
// 				'conditional_logic' => 0,
// 				'wrapper' => array(
// 					'width' => '',
// 					'class' => '',
// 					'id' => '',
// 				),
// 				'collapsed' => '',
// 				'min' => 0,
// 				'max' => 0,
// 				'layout' => 'table',
// 				'button_label' => '',
// 				'sub_fields' => array(
// 					array(
// 						'key' => 'field_5fde2f5605335',
// 						'label' => 'Nazwa inwestycji',
// 						'name' => 'user_investment_name',
// 						'type' => 'relationship_multisite',
// 						'instructions' => '',
// 						'required' => 1,
// 						'conditional_logic' => 0,
// 						'wrapper' => array(
// 							'width' => '',
// 							'class' => '',
// 							'id' => '',
// 						),
// 						'site' => 1,
// 						'filters' => array(
// 							0 => 'search',
// 							1 => 'post_type',
// 							2 => 'taxonomy',
// 						),
// 						'elements' => '',
// 						'max' => '',
// 						'return_format' => 'id',
// 						'post_type' => array(
// 						),
// 						'taxonomy' => array(
// 						),
// 					),
// 					array(
// 						'key' => 'field_5fde2f7b05336',
// 						'label' => 'Zainwestowana kwota',
// 						'name' => 'user_investment_value',
// 						'type' => 'number',
// 						'instructions' => '',
// 						'required' => 1,
// 						'conditional_logic' => 0,
// 						'wrapper' => array(
// 							'width' => '',
// 							'class' => '',
// 							'id' => '',
// 						),
// 						'default_value' => '',
// 						'placeholder' => '',
// 						'prepend' => '',
// 						'append' => 'zł',
// 						'min' => '',
// 						'max' => '',
// 						'step' => '',
// 					),
// 				),
// 			),
// 		),
// 		'location' => array(
// 			array(
// 				array(
// 					'param' => 'user_form',
// 					'operator' => '==',
// 					'value' => 'edit',
// 				),
// 				array(
// 					'param' => 'user_role',
// 					'operator' => '==',
// 					'value' => 'inwestor',
// 				),
// 			),
// 		),
// 		'menu_order' => 0,
// 		'position' => 'normal',
// 		'style' => 'default',
// 		'label_placement' => 'top',
// 		'instruction_placement' => 'label',
// 		'hide_on_screen' => '',
// 		'active' => true,
// 		'description' => '',
// 	));
	
// 	endif;


/* EXTRA USER FIELDS
---------------------- */

/**
 * The field on the editing screens.
 *
 * @param $user WP_User user object
 */
function wporg_usermeta_form_field_phone($user)
{
?>
	<h3>Dane osobiste</h3>
	<table class="form-table">
		<tr>
			<th>
				<label for="user_phone">Numer telefonu</label>
			</th>
			<td>
				<input type="tel" class="regular-text ltr" id="user_phone" name="user_phone" value="<?= esc_attr(get_user_meta($user->ID, 'user_phone', true)) ?>" placeholder="Numer telefonu" required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_pesel">Numer PESEL</label>
			</th>
			<td>
				<input type="text" class="regular-text ltr" minlength="11" maxlength="11" id="user_pesel" name="user_pesel" value="<?= esc_attr(get_user_meta($user->ID, 'user_pesel', true)) ?>" placeholder="Numer PESEL" required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_birthday">Data urodzenia</label>
			</th>
			<td>
				<input type="text"
                       class="regular-text ltr"
                       id="user_birthday"
                       name="user_birthday"
                       value="<?= esc_attr( get_user_meta( $user->ID, 'user_birthday', true ) ) ?>"
                       title="Proszę uzyć formatu DD-MM-RRRR"
                       pattern="(3[01]|[21][0-9]|0[1-9])-(1[0-2]|0[1-9])-(19[0-9][0-9]|20[0-9][0-9])"
                       required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_bank">Adres korespondencyjny</label>
			</th>
			<td>
				<input type="text" class="regular-text ltr" id="user_street" name="user_street" value="<?= esc_attr( get_user_meta( $user->ID, 'user_street', true ) ) ?>" required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="user_bank">Numer konta bankowego</label>
			</th>
			<td>
				<input type="text" class="regular-text ltr" minlength="26" maxlength="26" id="user_bank" name="user_bank" value="<?= esc_attr( get_user_meta( $user->ID, 'user_bank', true ) ) ?>" required>
			</td>
		</tr>
	</table>
<?php
}

/**
 * The save action.
 *
 * @param $user_id int the ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function wporg_usermeta_form_field_phone_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_phone', $_POST['user_phone']);
}
function wporg_usermeta_form_field_pesel_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_pesel', $_POST['user_pesel']);
}
function wporg_usermeta_form_field_birthday_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_birthday', $_POST['user_birthday']);
}
function wporg_usermeta_form_field_street_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_street', $_POST['user_street']);
}
function wporg_usermeta_form_field_bank_update($user_id){
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	return update_user_meta($user_id, 'user_bank', $_POST['user_bank']);
}

// Add the field to user's own profile editing screen.
add_action('show_user_profile', 'wporg_usermeta_form_field_phone');

// Add the field to user profile editing screen.
add_action('edit_user_profile', 'wporg_usermeta_form_field_phone');

// Add the save action to user's own profile editing screen update.
add_action('personal_options_update', 'wporg_usermeta_form_field_phone_update');
add_action('personal_options_update', 'wporg_usermeta_form_field_pesel_update');
add_action('personal_options_update', 'wporg_usermeta_form_field_birthday_update');
add_action('personal_options_update', 'wporg_usermeta_form_field_street_update');
add_action('personal_options_update', 'wporg_usermeta_form_field_bank_update');

// Add the save action to user profile editing screen update.
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_phone_update');
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_pesel_update');
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_birthday_update');
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_street_update');
add_action('edit_user_profile_update', 'wporg_usermeta_form_field_bank_update');

add_action('wp_loaded', 'my_custom_redirect');
function my_custom_redirect(){
	if (!is_user_logged_in()) {
		switch_to_blog(1);
		$redirect = home_url();
		wp_redirect($redirect);
		switch_to_blog(2);
		exit;
	}
}
add_action('after_setup_theme', 'remove_admin_bar');
	function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

add_action('wpcf7_mail_sent', 'extract_cf7_data');
function extract_cf7_data($data) {
	if ($data->title == 'Formularz inwestycyjny') {
		$submission = WPCF7_Submission::get_instance();
		if ( $submission ) {
			$cf7_data = $submission->get_posted_data();
			$getValue = preg_replace('/[^0-9]/', '', $cf7_data['text-478']);
			$value = $getValue * 500;
			$currentUserID = 'user_' . $cf7_data['user-id-12'];
			$field_key = "field_5fde2f4405334";
			$row = array(
				"field_5fde2f5605335"   => $cf7_data['invest-id-32'],
				"field_5fde2f7b05336"   => $value,
			);
			add_row($field_key, $row, $currentUserID);
		}
	}
}

add_action( 'wp_footer', 'mycustom_wp_footer' );
function mycustom_wp_footer() { ?>
    <script type="text/javascript">
        document.addEventListener( 'wpcf7mailsent', function( event ) {
        	if ( '115' == event.detail.contactFormId ) { // Change 123 to the ID of the form 
        		jQuery('.wbInvest__content').addClass('hide');
        		jQuery('.wbInvest__success').addClass('toggle');
    		}
        }, false );
    </script>
<?php }

remove_action( 'template_redirect', 'redirect_canonical' );