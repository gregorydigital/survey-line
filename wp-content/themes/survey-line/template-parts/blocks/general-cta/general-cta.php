<?php 
    $background_color = get_field('background_colour');
    $title = get_field('title');
    $text = get_field('text');
    $image = get_field('image');
    $cta = get_field('call_to_action');
    $cta_color = get_field('call_to_action_color');
    $cta2 = get_field('call_to_action_2');
    $cta2_color = get_field('call_to_action_2_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

   <img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/general-cta/_preview.png' ); ?>">

<?php else: ?>

   <section class="padded-mid general-cta bg-<?php echo $background_color ? esc_html($background_color) : '' ; ?>"> 
        <?php if (!empty($image) && $background_color === 'image') : ?>
            <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
        <?php endif; ?>
        <div class="container">
            <div class="general-cta__left" data-aos="fade-up">
                <?php if($title): ?>
                <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if($text): ?>
                    <?php echo wp_kses_post($text); ?>
                <?php endif; ?>
                <div class="cta-container">
                    <?php if( $cta ): 
                        $link_url = $cta['url'];
                        $link_title = $cta['title'];
                        $link_target = $cta['target'] ? $cta['target'] : '_self';
                        ?>
                        <a class="btn btn--<?php echo $cta_color ? esc_attr($cta_color) : '' ;?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?></span></a>
                    <?php endif; ?>
                    <?php if( $cta2 ): 
                        $link_url = $cta2['url'];
                        $link_title = $cta2['title'];
                        $link_target = $cta2['target'] ? $cta2['target'] : '_self';
                        ?>
                        <a class="btn btn--<?php echo $cta2_color ? esc_attr($cta2_color) : '' ;?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?></span></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
   </section>

<?php endif; ?>