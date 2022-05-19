<?php
/**
 * Theme functions and definitions
 *
 * @package Business Street 
 */

/**
 * After setup theme hook
 */
function business_street_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'business-street', get_stylesheet_directory() . '/languages' );	
	require get_stylesheet_directory() . '/inc/customizer/business-street-customizer-options.php';
}
add_action( 'after_setup_theme', 'business_street_theme_setup' );

/**
 * Load assets.
 */

function business_street_theme_css() {
	wp_enqueue_style( 'business-street-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('business-street-child-style', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('business-street-default-css', get_stylesheet_directory_uri() . "/assets/css/theme-default.css" );  
}
add_action( 'wp_enqueue_scripts', 'business_street_theme_css', 99);

/**
 * Remove Parent Theme Setting
 *
 */
function business_street_remove_parent_setting( $wp_customize ) {
	$wp_customize->remove_setting('arilewp_testomonial_background_image');
	$wp_customize->remove_setting('arilewp_testimonial_overlay_disable');
}
add_action( 'customize_register', 'business_street_remove_parent_setting',99 );

/**
 * Import Options From Parent Theme
 *
 */
function business_street_parent_theme_options() {
	$arilewp_mods = get_option( 'theme_mods_arilewp' );
	if ( ! empty( $arilewp_mods ) ) {
		foreach ( $arilewp_mods as $arilewp_mod_k => $arilewp_mod_v ) {
			set_theme_mod( $arilewp_mod_k, $arilewp_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'business_street_parent_theme_options' );

/**
 * Fresh site activate
 *
 */
$fresh_site_activate = get_option( 'fresh_business_street_site_activate' );
if ( (bool) $fresh_site_activate === false ) {
	set_theme_mod( 'arilewp_blog_front_container_size', 'container' );
	set_theme_mod( 'arilewp_page_header_background_color', 'rgba(0,0,0,0.7)' );
	update_option( 'fresh_business_street_site_activate', true );
}

/**
 * Page header
 *
 */
function business_street_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'business_street_custom_header_args', array(
		'default-image'      => get_stylesheet_directory_uri().'/assets/img/business-street-header-image.jpg',
		'default-text-color' => '000000',
		'width'              => 1920,
		'height'             => 500,
		'flex-height'        => true,
		'flex-width'         => true,
		'wp-head-callback'   => 'business_street_header_style',
	) ) );
}

/**
 * Custom background
 *
 */
function business_street_custom_background_setup() {
	add_theme_support( 'custom-background', apply_filters( 'business_street_custom_background_args', array(
		'default-color' => 'f3f8fe',
		'default-image' => '',
	) ) );
}
add_action( 'after_setup_theme', 'business_street_custom_background_setup' );

add_action( 'after_setup_theme', 'business_street_custom_header_setup' );

if ( ! function_exists( 'business_street_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see business_street_custom_header_setup().
	 */
	function business_street_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
				?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}

			<?php
			// If the user has set a custom color for the text use that.
			else :
				?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?> !important;
			}

			<?php endif; ?>
		</style>
		<?php
	}
endif;