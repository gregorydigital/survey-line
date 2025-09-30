<?php 
    $title = get_field('title');
    $text = get_field('text');
    $link = get_field('link');
    $bg_color = get_field('background_color');
    $three_column = get_field('three_column');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/general-cards/_preview.png' ); ?>'>

<?php else: ?>

    <section class='general-cards padded-mid bg-<?php echo esc_html($bg_color); ?> <?php echo $three_column ? 'three-column' : '' ;?>'>
        <div class='container'>
            <?php if(!empty($title)): ?>
            <div class="general-cards__content">
                <h2><?php echo esc_html($title); ?></h2>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class='general-cards__inner' data-aos="fade-up">
                <?php if(have_rows('general_cards')): ?>
                    <?php while(have_rows('general_cards')): the_row();?>
                        <?php
                            $image = get_sub_field('image');
                            $card_title = get_sub_field('card_title');
                            $card_subtitle = get_sub_field('card_subtitle');
                            $card_text = get_sub_field('card_text');
                        ?>
                        <div class='general-cards__card'>
                            <?php if (!empty($image)) : ?>
                            <div class="general-cards__card-image">
                                <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                                <div class="general-cards__card-title">
                                    <?php if(!empty($card_title)): ?>
                                        <h3><?php echo esc_html($card_title); ?></h3>
                                    <?php endif; ?>
                                    <?php if(!empty($card_subtitle)): ?>
                                        <h5><?php echo esc_html($card_subtitle) ?></h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($card_text)): ?>
                            <div class="general-cards__card-content">
                                <?php if (empty($image)) : ?>
                                    <?php if(!empty($card_title)): ?>
                                        <h3><?php echo esc_html($card_title); ?></h3>
                                    <?php endif; ?>
                                    <?php if(!empty($card_subtitle)): ?>
                                        <h5><?php echo esc_html($card_subtitle) ?></h5>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php echo wp_kses_post($card_text); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <div class="general-cards__link">
                    <a class='btn' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>