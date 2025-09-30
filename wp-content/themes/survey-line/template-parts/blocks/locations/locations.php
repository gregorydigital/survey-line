<?php 
    $title = get_field('title');
    $text = get_field('text');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/locations/_preview.png' ); ?>'>

<?php else: ?>

    <?php
        // Safest: look up the term ID by name, then query by term_id
        $term = get_term_by('name', 'Location Pages', 'page_group');

        $args = array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'page_group',
                    'field'    => 'term_id',
                    'terms'    => $term ? $term->term_id : 0,
                ),
            ),
        );

        $location_pages = new WP_Query($args);
    ?>

    <section class='locations padded-mid'>
        <div class='container'>
            <?php if(!empty($title)): ?>
            <div class="locations__content">
                <h2><?php echo esc_html($title); ?></h2>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class='locations__inner'>
                <?php while ($location_pages->have_posts()) : $location_pages->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="location-grid__item">
                        <div class="locations__card">
                            <h3><?php the_title(); ?></h3>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

<?php endif; ?>