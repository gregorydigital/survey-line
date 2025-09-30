<?php 
    $title = get_field('title');
    $text = get_field('text');
    $align_center = get_field('align_center');
    $bg_color = get_field('background_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/title-text/_preview.png' ); ?>'>

<?php else: ?>

    <section class='title-text padded-mid <?php echo $align_center ? 'center' : ''; ?> bg-<?php echo esc_html($bg_color); ?>'>
        <div class='container'>
            <div class='title-text__inner' data-aos="fade-up">
                <?php if(!empty($title)): ?>
                    <h2 class="<?php echo $align_center ? 'indented-center' : 'indented'; ?>">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>
                <?php if(!empty($text)): ?>
                    <?php echo wp_kses_post($text); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>