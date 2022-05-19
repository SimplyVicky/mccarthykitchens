<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package businessdeal
 */

if ( ! function_exists( 'businessdeal_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function businessdeal_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s"><i class="far fa-calendar-alt"></i> %2$s </time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s"><i class="far fa-calendar-alt"></i>%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf( '%s', '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'businessdeal_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function businessdeal_posted_by() {
		$byline = sprintf( '<span class="author vcard"> <a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fas fa-user-tie"></i>' . esc_html( get_the_author() ) . '</a> </span>'
		);

		echo $byline ; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'businessdeal_comment_links' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function businessdeal_comment_links() {

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="far fa-comment-alt"></i>';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Comment<span class="screen-reader-text"> on %s</span>', 'businessdeal' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'businessdeal' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link"><i class="far fa-edit"></i>',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'businessdeal_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function businessdeal_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail( 'businessdeal-blog', array(
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );
				?>
			</a>
		</div>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'businessdeal_tag_lists' ) ) :
	function businessdeal_tag_lists () {
		/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '');
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
			printf( '<span class="tag-links">%1$s</span> ', $tags_list ); // WPCS: XSS OK.
			}
	}

endif;

if ( ! function_exists( 'businessdeal_cat_lists' ) ) :
	function businessdeal_cat_lists () {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ' ');
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
		}
	}

endif;