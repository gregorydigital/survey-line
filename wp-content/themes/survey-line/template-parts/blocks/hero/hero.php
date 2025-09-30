<?php 
   $image = get_field('image');
   $title = get_field('title');
   $text = get_field('intro');
   $link = get_field('link');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

   <img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/hero/_preview.png' ); ?>">

<?php else: ?> 

   <section class="hero">
      <?php if (!empty($image)) : ?>
          <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
      <?php endif; ?>
      <div class="container">
         <div class="hero__content" data-aos="fade-up">
            <?php if(!empty($title)): ?>
               <h1><span></span><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            <?php if(!empty($text)): ?>
               <p><?php echo esc_html($text); ?></p>
            <?php endif; ?>
            <?php if( $link ):
               $link_url = $link['url'];
               $link_title = $link['title'];
               $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class='btn btn--white' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
            <?php endif; ?>
         </div>
      </div>
   </section>

<?php endif; ?>