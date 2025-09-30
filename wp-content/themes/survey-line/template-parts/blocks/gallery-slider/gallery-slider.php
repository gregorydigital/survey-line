<?php 
    $title = get_field('title');
    $text = get_field('text');
    $bg_color = get_field('background_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/gallery-slider/_preview.png' ); ?>'>

<?php else: ?>

    <section class='gallery-slider padded-mid bg-<?php echo esc_html($bg_color); ?>' data-aos="fade-up">
        <div class='container'>
            <div class="gallery-slider__content">
                <?php if(!empty($title)): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class='gallery-slider__inner'>
            <?php if(have_rows('gallery_slider')): ?>
                <div class="splide gallery-carousel">
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php while(have_rows('gallery_slider')): the_row();?>
                                <?php
                                    $image = get_sub_field('image');
                                ?>
                                <div class="splide__slide gallery-slider__slide">
                                    <?php if (!empty($image)) : ?>
                                        <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>