<?php 
    $title = get_field('title');
    $content = get_field('content');
    $link = get_field('link');
    $bg_color = get_field('background_color');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

   <img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/icon-repeater/_preview.png' ); ?>">

<?php else: ?> 

    <section class="icon-repeater padded-mid bg-<?php echo esc_html($bg_color); ?>">
        <div class="container">
            <?php if($title): ?>
            <div class="icon-repeater__content">
                <h2><?php echo esc_html($title); ?></h2>
                <?php if($content): ?>
                    <?php echo wp_kses_post($content); ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="icon-repeater__inner" data-aos="fade-up">
                <?php if(have_rows('icon_repeater')): ?>
                    <?php while(have_rows('icon_repeater')): the_row(); ?>
                        <?php 
                            $image = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $text = get_sub_field('text');
                        ?>
                        <div class="icon-repeater__card">
                            <?php if( !empty( $image ) ): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                            <?php if(!empty($title)): ?>
                                <h3><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if(!empty( $text )): ?>
                                <p><?php echo esc_html($text) ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php if( !empty( $link )) : ?>
            <div class="icon-repeater__link">
                <a href="<?php echo $link['url']; ?>" class="btn --accent --alt --light-hover m-t-3" targget="<?php echo $link['target']; ?>"><span><?php echo $link['title']; ?></span></a> 
            </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>