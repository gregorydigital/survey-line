<?php 
    $image = get_field('image');
    $title = get_field('title');
    $pre_title = get_field('pre_title');
    $text = get_field('text');
    $link = get_field('link');
    $align = get_field('align_center');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/full-image-cta/_preview.png' ); ?>'>

<?php else: ?>

    <section class='full-image-cta padded-mid <?php echo $align ? 'align-center' : '' ?>'>
        <?php if (!empty($image)) : ?>
            <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
        <?php endif; ?>
        <div class='container'>
            <div class='full-image-cta__inner' data-aos="fade-up">
                <div class="full-image-cta__content">
                    <?php if(!empty($pre_title)): ?>
                        <h4><?php echo esc_html($pre_title); ?></h4>
                    <?php endif; ?>
                    <?php if(!empty($title)): ?>
                        <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>
                    <?php if(!empty($text)): ?>
                        <p><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                    <?php if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                        <a class='btn btn-white' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>