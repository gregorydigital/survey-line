<?php 
    $image = get_field('image');
    $title = get_field('title');
    $text = get_field('text');
    $link = get_field('faqs_link');
    $background_color = get_field('background_color');
    $hide_image = get_field('hide_image');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

   <img src="<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/faq-section/_preview.png' ); ?>">

<?php else: ?>

   <section class="faq-section padded-mid bg-<?php echo esc_html($background_color); ?> <?php echo $hide_image ? 'hide-image' : '' ;?>">  
        <div class="container">
            <div class="faq-section__content-top">
                <?php if(!empty($title)) : ?>
                    <h2><?php echo esc_html($title) ?></h2>
                <?php endif; ?>
                <?php if(!empty($text)) : ?>
                    <p><?php echo esc_html($text) ?></p>
                <?php endif; ?>
            </div>
            <div class="faq-section__inner">
                <div class="faq-section__left">
                    <?php if( !empty( $image ) ): ?>
                        <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                    <div class="faq-section__content">
                        <?php if(!empty($title)) : ?>
                            <h2><?php echo esc_html($title) ?></h2>
                        <?php endif; ?>
                        <?php if(!empty($text)) : ?>
                            <p><?php echo esc_html($text) ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                        <a class='btn btn--white' href='<?php echo esc_url( $link_url ); ?>' target='<?php echo esc_attr( $link_target ); ?>'><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="faq-section__right">
                    <?php if(have_rows('faqs')): ?>
                        <?php $count = 1; while(have_rows('faqs')): the_row();?>
                            <?php 
                                $question = get_sub_field('question');
                                $answer = get_sub_field('answer');
                            ?>
                            <div class="faq-row">
                                <div class="faq-question">
                                    <h3><span class="faq-question-number"><?php echo $count < 10 ? '0' : ''; ?><?php echo $count ?>.</span> <?php echo esc_html($question) ?></h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#555427" viewBox="0 0 1024 1024"><path d="M256 120.768 306.432 64 768 512 306.432 960 256 903.232 659.072 512z"/></svg>                                
                                </div>
                                <div class="faq-answer">
                                    <p><?php echo esc_html($answer) ?></p>
                                </div>
                            </div>
                        <?php $count ++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
   </section>

<?php endif; ?>