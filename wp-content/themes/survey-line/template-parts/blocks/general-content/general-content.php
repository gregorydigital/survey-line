
<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>
	<img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/general-content/_preview.png' ); ?>">
<?php else: ?>

<?php $content = get_field('content'); ?>

<section class="padded-mid general-content" >
   <div class="container">
      <?php echo wp_kses_post($content) ?>
   </div>
</section>
<?php endif; ?>