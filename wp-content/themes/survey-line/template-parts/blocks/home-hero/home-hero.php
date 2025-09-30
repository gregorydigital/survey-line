<?php 
   $title = get_field('title');
   $text = get_field('text');
   $image = get_field('image');
   $cta_1 = get_field('cta_1');
   $cta_1_color = get_field('cta_1_color');
   $cta_2 = get_field('cta_2');
   $cta_2_color = get_field('cta_2_color');
   $rating_text = get_field('rating_text');
   $rating_icon = get_field('rating_icon');
   $rating_link = get_field('rating_link');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

   <img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/home-hero/_preview.png' ); ?>">

<?php else: ?> 

   <section class="home-hero">
      <?php if (!empty($image)) : ?>
          <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
      <?php endif; ?>
         <div class="home-hero__inner" data-aos="fade-up">
            <?php if(!empty($title)): ?>
               <h1><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            <?php if(!empty($text)): ?>
               <p><?php echo esc_html($text); ?></p>
            <?php endif; ?>
            <div class="home-hero__buttons">
               <?php if( $cta_1 ):
                  $cta_1_url = $cta_1['url'];
                  $cta_1_title = $cta_1['title'];
                  $cta_1_target = $cta_1['target'] ? $cta_1['target'] : '_self';
               ?>
                  <a class='btn btn--<?php echo $cta_1_color ? esc_html($cta_1_color) : '' ;?>' href='<?php echo esc_url( $cta_1_url ); ?>' target='<?php echo esc_attr( $cta_1_target ); ?>'><?php echo esc_html( $cta_1_title ); ?></a>
               <?php endif; ?>
               <?php if( $cta_2 ):
                  $cta_2_url = $cta_2['url'];
                  $cta_2_title = $cta_2['title'];
                  $cta_2_target = $cta_2['target'] ? $cta_2['target'] : '_self';
               ?>
                  <a class='btn btn--<?php echo $cta_2_color ? esc_html($cta_2_color) : '' ;?>' href='<?php echo esc_url( $cta_2_url ); ?>' target='<?php echo esc_attr( $cta_2_target ); ?>'><?php echo esc_html( $cta_2_title ); ?></a>
               <?php endif; ?>
            </div>
            <?php if(!empty($rating_icon) && !empty($rating_link)): ?>
               <a class="hero-rating" href="<?php echo esc_url($rating_link) ?>" target="_blank">
                  <?php if(!empty($rating_text)): ?>
                     <p>Rated</p>
                     <div class="hero-star-container">
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                        <svg class="star filled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f4b400" width="18" height="18"><path d="M12 .587l3.668 7.431L24 9.587l-6 5.849L19.336 24 12 19.412 4.664 24 6 15.436 0 9.587l8.332-1.569L12 .587z"></path></svg>
                     </div>
                  <?php endif; ?>
                  <?php if (!empty($rating_icon)) : ?>
                     <img src="<?php echo esc_url($rating_icon['url']); ?>" alt="<?php echo esc_attr($rating_icon['alt'] ?? ''); ?>" />
                  <?php endif; ?>
               </a>
            <?php endif; ?>
         </div>
   </section>

<?php endif; ?>