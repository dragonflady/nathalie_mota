<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header alignwide">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php twenty_twenty_one_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="photo-content">
            <div class="photo-info" style="width: 50%; float: left;">
				<ul>
					<li>TITRE : <?php the_title(); ?></li>
					<li>RÉFÉRENCE : <?php the_field('reference'); ?></li>
                    <li>CATÉGORIE : <?php the_terms($post->ID, 'categorie'); ?></li>
                    <li>FORMAT : <?php the_terms($post->ID, 'format'); ?></li>
                    <li>TYPE : <?php the_field('type'); ?></li>
                    <li>ANNÉE : <?php the_time('Y'); ?></li>
				</ul>
				<div class="contact-info">
                    <p>Cette photo vous intéresse ?</p>
                    <button id="contact-button" data-reference="<?php the_field('reference'); ?>">Contact</button>
                </div>
            </div>
            <div class="photo-image" style="width: 50%; float: right;">
                <?php the_post_thumbnail('full'); ?>
            </div>
			<div class="clearfix"></div>
        </div>
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
    // Affichage des photos apparentées
    $related_photos = new WP_Query( array(
        'post_type' => 'photo',
        'posts_per_page' => 2,
        'post__not_in' => array( get_the_ID() ),
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field' => 'term_id',
                'terms' => wp_list_pluck( get_the_terms(get_the_ID(), 'categorie'), 'term_id' ),
            ),
        ),
    ) );

	if ( $related_photos->have_posts() ) {
        echo '<div class="related-photos">';
        echo '<h2>VOUS AIMEREZ AUSSI</h2>';
        while ( $related_photos->have_posts() ) {
            $related_photos->the_post();
            get_template_part( 'template-parts/photo', 'block' );
        }
        echo '</div>';
        wp_reset_postdata();
    }
?>

<!-- Modale de contact -->
<div id="contact-modale" class="contact-modale">
    <div class="contact-modale-content">
        <span class="close">&times;</span>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Contact_header.png" alt="CONTACT">
        <?php echo do_shortcode('[contact-form-7 id="a7dad4c" title="Formulaire Nathalie Mota"]'); ?>
    </div>
</div>
