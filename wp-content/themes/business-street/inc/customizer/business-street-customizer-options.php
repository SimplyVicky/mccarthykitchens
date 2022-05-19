<?php
/**
 * Customizer section options.
 *
 * @package business-street
 *
 */

function business_street_customizer_theme_settings( $wp_customize ){
	
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
		
		$wp_customize->add_setting(
			'arilewp_footer_copright_text',
			array(
				'sanitize_callback' =>  'business_street_sanitize_text',
				'default' => __('Copyright &copy; 2021 | Powered by <a href="//wordpress.org/">WordPress</a> <span class="sep"> | </span> Business Street theme by <a target="_blank" href="//themearile.com/">ThemeArile</a>', 'business-street'),
				'transport'         => $selective_refresh,
			)	
		);
		$wp_customize->add_control('arilewp_footer_copright_text', array(
				'label' => esc_html__('Footer Copyright','business-street'),
				'section' => 'arilewp_footer_copyright',
				'priority'        => 10,
				'type'    =>  'textarea'
		));
		
		// Transparent Logo
		$wp_customize->add_setting( 'arilewp_transparent_header_logo', array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'arilewp_transparent_header_logo',
			array(
				'label'       => esc_html__( 'Transparent Header Logo', 'business-street' ),
				'description' => esc_html__( 'Only apply when transparent header option is enabled (260px*39px).', 'business-street' ),
				'section'  => 'arilewp_theme_menu_bar',
				'settings' => 'arilewp_transparent_header_logo',
				'priority'        => 16,
			) 
			
		));

}
add_action( 'customize_register', 'business_street_customizer_theme_settings' );

function business_street_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Theme Custom Logo
*/
function business_street_header_logo() {

	$business_street_sticky_bar_logo = get_theme_mod('arilewp_sticky_bar_logo');
	$business_street_transparent_header_logo = get_theme_mod('arilewp_transparent_header_logo');
	
	if($business_street_transparent_header_logo != null && is_page_template('page-templates/frontpage.php') ){  ?>
	
	<a class="navbar-brand" href="<?php echo home_url( '/' ); ?>" ><img src="<?php echo $business_street_transparent_header_logo; ?>" class="custom-logo" alt="<?php bloginfo("name"); ?>"></a>
	
	<?php } else {
		the_custom_logo();
	}		
	?>
					
	<?php if($business_street_sticky_bar_logo != null) : ?>	
			<a class="sticky-navbar-brand" href="<?php echo home_url( '/' ); ?>" ><img src="<?php echo $business_street_sticky_bar_logo; ?>" class="custom-logo" alt="<?php bloginfo("name"); ?>"></a>
	<?php endif; ?>
	
    <?php if ( display_header_text() ) : ?>
	<div class="site-branding-text">
	    <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
		<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>
			<p class="site-description"><?php echo $description; ?></p>
		<?php endif; ?>
	</div>
	<?php endif;
} 