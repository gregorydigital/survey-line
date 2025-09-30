<?php 
    $title = get_field('title');
    $text = get_field('text');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/card-slider/_preview.png' ); ?>'>

<?php else: ?>

    <section class='card-slider padded-mid'>
        <div class='container'>
            <?php if(!empty($title)): ?>
                <div class="card-slider__content">
                    <h2><?php echo esc_html($title); ?></h2>
                    <?php if(!empty($text)): ?>
                        <p><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class='card-slider__inner'>
                <?php if(have_rows('card_repeater')): ?>
                    <div class="splide gallery-info-cards">
                        <div class="splide__track">
                            <div class="splide__list">
                                <?php while(have_rows('card_repeater')): the_row();?>
                                    <?php
                                        $card_title = get_sub_field('card_title');
                                        $subtitle = get_sub_field('subtitle');
                                        $description = get_sub_field('description');
                                        $image = get_sub_field('image');
                                    ?>
                                    <div class="splide__slide gallety-info-cards__slide card-slider__card">
                                        <div class="card-slider__card-image">
                                            <?php if (!empty($image)) : ?>
                                                <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-slider__card-content">
                                            <?php if(!empty($card_title)): ?>
                                                <h3><?php echo esc_html($card_title); ?></h3>
                                            <?php endif; ?>
                                            <?php if(!empty($subtitle)): ?>
                                                <h4><?php echo esc_html($subtitle); ?></h4>
                                            <?php endif; ?>
                                            <?php if(!empty($description)): ?>
                                                <p><?php echo wp_kses_post($description); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>