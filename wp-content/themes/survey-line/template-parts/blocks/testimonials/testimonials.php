<?php 
    $title = get_field('title');
    $text = get_field('text');
    $link = get_field('link');
    $link2 = get_field('link_2');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/testimonials/_preview.png' ); ?>'>

<?php else: ?>

    <section class='testimonials padded-mid'>
        <div class='container'>
            <div class="testimonials__content">
                <?php if(!empty($title)): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
            </div>
            <div class='testimonials__inner' data-aos="fade-up">
                <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
            </div>
            <?php if($link || $link2) : ?>
            <div class="testimonials__links">
                <?php if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a class='btn' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
                <?php if( $link2 ):
                    $link2_url = $link2['url'];
                    $link2_title = $link2['title'];
                    $link2_target = $link2['target'] ? $link2['target'] : '_self';
                ?>
                    <a class='btn' href='<?php echo esc_url( $link2_url ); ?>' target='<?php echo esc_attr( $link2_target ); ?>'><?php echo esc_html( $link2_title ); ?></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>