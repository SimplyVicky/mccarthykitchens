<?php
/**
 * A multi-checkbox Customizer control for use with Jetpack Search configuration
 *
 * @package automattic/jetpack
 * @since 8.8.0
 */

use Automattic\Jetpack\Search\Helper;

/**
 * Label Control class.
 */
class Excluded_Post_Types_Control extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @since 8.8.0
	 * @var string
	 */
	public $type = 'excluded-post-types';

	/**
	 * Enqueue styles related to this control.
	 */
	public function enqueue() {
		$style_relative_path = 'modules/search/customize-controls/class-excluded-post-types-control.css';
		$style_version       = Helper::get_asset_version( $style_relative_path );
		$style_path          = plugins_url( $style_relative_path, JETPACK__PLUGIN_FILE );
		wp_enqueue_style( 'jetpack-instant-search-customizer-excluded-post-types', $style_path, array(), $style_version );

		$script_relative_path = 'modules/search/customize-controls/class-excluded-post-types-control.js';
		$script_version       = Helper::get_asset_version( $script_relative_path );
		$script_path          = plugins_url( $script_relative_path, JETPACK__PLUGIN_FILE );
		wp_enqueue_script( 'jetpack-instant-search-customizer-excluded-post-types', $script_path, array( 'customize-controls' ), $script_version, true );
	}

	/**
	 * Checks if the post type has been selected.
	 *
	 * @since 8.8.0
	 * @return array $post_types An array of strings representing post type names.
	 */
	public function get_arrayed_value() {
		return explode( ',', $this->value() );
	}

	/**
	 * Generates a customizer settings ID for a given post type.
	 *
	 * @since 8.8.0
	 * @param object $post_type Post type object returned from get_post_types.
	 * @return string $customizer_id Customizer setting ID.
	 */
	public function generate_post_type_customizer_id( $post_type ) {
		return '_customize-post-type-input-' . $post_type->name;
	}

	/**
	 * Checks if the post type has been selected.
	 *
	 * @since 8.8.0
	 * @param object $post_type Post type object returned from get_post_types.
	 * @return array $ids Post type => post type customizer ID object.
	 */
	public function is_checked( $post_type ) {
		return in_array( $post_type->name, $this->get_arrayed_value(), true );
	}

	/**
	 * Override rendering for custom class name; omit element ID.
	 */
	protected function render() {
		$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
		$class = 'customize-control customize-control-excluded-post-types';

		printf( '<li id="%s" class="%s">', esc_attr( $id ), esc_attr( $class ) );
		$this->render_content();
		echo '</li>';
	}

	/**
	 * Override content rendering.
	 */
	protected function render_content() {
		$post_types = get_post_types( array( 'exclude_from_search' => false ), 'objects' );
		if ( count( $post_types ) === 0 ) {
			return;
		}
		?>
			<label class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</label>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description">
				<?php echo esc_html( $this->description ); ?>
			</span>
			<?php endif ?>
			<input
				class="customize-control-excluded-post-types"
				id="<?php echo esc_attr( $this->id ); ?>"
				name="<?php echo esc_attr( $this->id ); ?>"
				type="hidden"
				value="<?php echo esc_attr( $this->value() ); ?>"
				<?php $this->link(); ?>
			/>
		<?php

		$is_only_one_unchecked = ( count( $post_types ) - 1 ) === count( $this->get_arrayed_value() );

		foreach ( $post_types as $post_type ) {
			$input_id = Helper::generate_post_type_customizer_id( $post_type );
			?>
			<div class="customize-control-excluded-post-type-checkbox-container">
				<input
					class="customize-control-excluded-post-type-checkbox"
					id="<?php echo esc_attr( $input_id ); ?>"
					type="checkbox"
					value="<?php echo esc_attr( $post_type->name ); ?>"
					<?php checked( $this->is_checked( $post_type ) ); ?>
					<?php disabled( ! $this->is_checked( $post_type ) && $is_only_one_unchecked ); ?>
				/>
				<label for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_html( $post_type->label ); ?></label>
			</div>
			<?php
		}
	}
}
