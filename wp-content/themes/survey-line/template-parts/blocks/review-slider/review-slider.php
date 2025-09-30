<?php 
    $title = get_field('title');
    $text = get_field('text');
    $subtitle = get_field('subtitle');
    $background_color = get_field('background_color');
    $link = get_field('link');
    $image = get_field('review_icon');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/review-slider/_preview.png' ); ?>'>

<?php else: ?>

    <section class='review-slider padded-mid bg-<?php echo $background_color ? esc_html($background_color) : '' ; ?>'>
        <div class='container'>
            <?php if(!empty($title)): ?>
                <div class="review-slider__content">
                    <h2><?php echo esc_html($title); ?></h2>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class='review-slider__inner'>
                <div class="review-slider__left">
                    <?php if(!empty($subtitle)): ?>
                        <h3><?php echo esc_html($subtitle); ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($image)) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                    <?php endif; ?>
                    <div class="review-rating">
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                    </div>
                    <?php if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                        <a class='btn' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="review-slider__right">
                    <?php if(have_rows('review_slider')): ?>
                        <div class="splide review-carousel">
                            <div class="splide__track">
                                <div class="splide__list">
                                    <?php while(have_rows('review_slider')): the_row();?>
                                        <?php 
                                            $name = get_sub_field('name');
                                            $date = get_sub_field('date');
                                            $review = get_sub_field('review');
                                            $icon = get_sub_field('icon');
                                        ?>
                                        <div class="splide__slide review-slider__slide">
                                            <div class="review-header">
                                                <?php if (!empty($icon)) : ?>
                                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" />
                                                <?php endif; ?>
                                                <div class="review-author-info">
                                                    <?php if(!empty($name)): ?>
                                                        <p><?php echo esc_html($name); ?></p>
                                                    <?php endif; ?>
                                                    <?php if(!empty($date)): ?>
                                                        <p><?php echo esc_html($date); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="40px" height="40px"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path></svg>
                                            </div>
                                            <div class="review-rating">
                                                <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                                                <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                                                <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                                                <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                                                <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                                            </div>
                                            <?php if(!empty($review)): ?>
                                                <div class="review-text">
                                                    <p><?php echo esc_html($review); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>