<?php 
    $title = get_field('title');
    $text = get_field('text');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/comparison/_preview.png' ); ?>'>

<?php else: ?>

    <section class='comparison padded-mid'>
        <div class='container'>
            <?php if(!empty($title)): ?>
            <div class="comparison__content" data-aos="fade-up">
                <h2><?php echo esc_html($title); ?></h2>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class='comparison__inner' data-aos="fade-up">
                <?php if(have_rows('comparison_cards')): ?>
                    <?php while(have_rows('comparison_cards')): the_row();?>
                        <?php
                            $image = get_sub_field('image');
                            $card_title = get_sub_field('title');
                            $card_subtitle = get_sub_field('subtitle');
                            $card_text = get_sub_field('text');
                        ?>
                        <div class="comparison__card">
                            <div class="comparison__card-top">
                                 <?php if(!empty($card_title)): ?>
                                <h3><?php echo esc_html($card_title); ?></h3>
                                <?php endif; ?>
                                <?php if(!empty($card_subtitle)): ?>
                                    <h5><?php echo esc_html($card_subtitle); ?></h5>
                                <?php endif; ?>
                            </div>
                            <div class="comparison__card-image">
                                <?php if (!empty($image)) : ?>
                                    <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="comparison__card-bottom">
                            <?php if(!empty($card_text)): ?>
                                <p><?php echo esc_html($card_text); ?></p>
                            <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>