<?php 
    $title = get_field('title');
    $text = get_field('text');
    $image = get_field('image');
    $quote = get_field('quote');
    $quote_name = get_field('quote_name');
    $align_left = get_field('align_left');
    $bg_color = get_field('bg_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/quote-highlight/_preview.png' ); ?>'>

<?php else: ?>

    <section class='quote-highlight padded-mid <?php echo $align_left ? 'align-left' : ''; ?> bg-<?php echo esc_html($bg_color); ?>'>
        <div class='container'>
            <div class='quote-highlight__inner'>
                <div class='quote-highlight__left' data-aos="fade-up">
                    <div class="quote-highlight__img">
                        <?php if (!empty($image)) : ?>
                            <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
                <div class='quote-highlight__right'>
                    <div class="quote-highlight__right-inner" data-aos="fade-up" data-aos-delay="200" >
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/quote.svg' ); ?>" alt="quote icon"/>
                        <?php if(!empty($quote)): ?>
                            <h3><?php echo esc_html($quote); ?></h3>
                        <?php endif; ?>
                        <?php if(!empty($quote_name)): ?>
                            <p><?php echo esc_html($quote_name); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>