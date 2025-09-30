<?php 
    $title = get_field('title');
    $text = get_field('text');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/shipping-tracking/_preview.png' ); ?>'>

<?php else: ?>

    <section class='shipping-tracking padded-mid'>
        <div class='container'>
            <div class='shipping-tracking__content'>
                <?php if(!empty($title)): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if(!empty($text)): ?>
                    <p><?php echo wp_kses_post($text); ?></p>
                <?php endif; ?>
            </div>
            <div class="shipping-tracking-search">
                <input id="ship-search" type="search" placeholder="Search ship name…" autocomplete="off" aria-controls="ship-results">
                <div id="ship-results"></div>
            </div>
            </div>
        </div>
    </section>

<?php endif; ?>