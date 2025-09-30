<?php 
    $title = get_field('title');
    $text = get_field('text');
    $image = get_field('image');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/process/_preview.png' ); ?>'>

<?php else: ?>

    <section class="process padded-mid">
        <div class="container">
            <div class="process__content" data-aos="fade-up">
                <?php if(!empty($title)): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
            </div>
            <div class="process__inner">
                <?php if(have_rows('process_repeater')): ?>
                    <?php $count = 1; ?>
                    <?php $delay = 0; ?>
                    <?php while(have_rows('process_repeater')): the_row();?>
                        <?php
                            $image = get_sub_field('image');
                            $title = get_sub_field('title');
                            $text = get_sub_field('text');
                        ?>
                        <div class="process__card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                            <div class="process__card-image">
                                <?php if (!empty($image)) : ?>
                                    <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="process__card-content">
                                <div class="process__card-number" >
                                    <span><?php echo esc_html($count); ?></span>
                                </div>
                                <?php if(!empty($title)): ?>
                                    <h3><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>
                                <?php if(!empty($text)): ?>
                                    <p><?php echo esc_html($text); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $delay += 100; ?>
                    <?php $count ++; endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>