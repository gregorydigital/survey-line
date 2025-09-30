<?php 
    $section_title = get_field('title');
    $section_text = get_field('text');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/services/_preview.png' ); ?>'>

<?php else: ?>

    <section class='services-section padded-mid'>
        <div class="container">
            <div class='services-section__inner' data-aos="fade-up">
                <div class="services-section__left">
                    <?php if(!empty($section_title)): ?>
                        <h2><?php echo esc_html($section_title); ?></h2>
                    <?php endif; ?>
                    <?php if(!empty($section_text)): ?>
                        <p><?php echo esc_html($section_text); ?></p>
                    <?php endif; ?>
                </div>
                <div class="services-section__right">
                    <?php if(have_rows('services')): ?>
                        <?php while(have_rows('services')): the_row();?>
                            <?php 
                                $title = get_sub_field('title');
                                $text = get_sub_field('text');
                                $image = get_sub_field('image');
                                $link = get_sub_field('link');
                            ?>
                            <div class="services-section__card">
                                <?php if (!empty($image)) : ?>
                                    <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                                <?php endif; ?>
                                <div class="services-section__card-content">
                                    <?php if(!empty($title)): ?>
                                        <h3><?php echo esc_html($title); ?></h3>
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
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>