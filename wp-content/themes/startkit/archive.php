<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package startkit
 */

get_header();
?>
<section id="blog-content" class="section-padding-80">
	<div class="container">
		<div class="row">	
			<!--Blog Detail-->
			<div class="<?php esc_attr(startkit_post_layout()); ?>" >
					
				<?php if( have_posts() ): ?>
				
						<?php while( have_posts() ): the_post(); ?>
						
							<?php get_template_part('template-parts/content','page'); ?>
					
						<?php endwhile; ?>
					
				<?php else: ?>
					
					<?php get_template_part('template-parts/content','none'); ?>
					
				<?php endif; ?>
			
			</div>
			<!--/End of Blog Detail-->
			<?php get_sidebar(); ?>
		</div>	
	</div>
</section>

<?php get_footer(); ?>
