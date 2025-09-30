<?php 
    $title = get_field('title');
    $text = get_field('text');
    $cards = get_field('card_repeater');
?>

<?php if ( ! empty( $block['data']['_is_preview'] ) ) : ?>

    <img src='<?php echo esc_url( get_template_directory_uri() . '/template-parts/blocks/card-info-split/_preview.png' ); ?>'>

<?php else: ?>

    <section class='card-info-split'>
        <div class='container'>
            <div class="card-info-split__content">
                <?php if(!empty($title)): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if(!empty($text)): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
            </div>
            <div class='card-info-split__inner'>
                <div class="card-info-split__list">
                    <?php if(have_rows('card_repeater')): ?>
                        <?php $count1 = 1; ?>
                        <?php while(have_rows('card_repeater')): the_row();?>
                            <?php
                                $image = get_sub_field('image');
                                $card_title = get_sub_field('title');
                                $description = get_sub_field('description');
                            ?>
                            <div class="user-card <?php echo $count1 === 1 ? 'active' : '' ;?>" id="card-<?php echo $count1 ?>">
                                <div class="user-card-image">
                                    <?php if (!empty($image)) : ?>
                                        <img class="img-object-fit" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="user-card-content">
                                    <?php if(!empty($card_title)): ?>
                                        <h3><?php echo esc_html($card_title); ?></h3>
                                    <?php endif; ?>
                                    <div class="mobile-bio-toggle">
                                        <span>VIEW MORE INFO</span>
                                    </div>
                                </div>
                            </div>
                        <?php $count1 ++; endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="card-info-split__details">
                    <div id="mobile-team-bio-close">
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50"><path fill="#000000" d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z"/></svg>                    
                    </div>
                    <div class="card-info-split__details-inner">
                        <?php $count = 1 ?>
                        <?php if(have_rows('card_repeater')): ?>
                            <?php while(have_rows('card_repeater')): the_row();?>
                                <?php
                                    $title = get_sub_field('title');
                                    $description = get_sub_field('description');
                                    $second_image = get_sub_field('second_image');
                                ?>
                                 <article id="bio-card-<?php echo $count ?>" class="<?php echo $count === 1 ? 'active' : '' ;?>">
                                    <div class="card-info-split__bio-intro">
                                        <?php if(!empty($title)): ?>
                                            <h2><?php echo esc_html($title); ?></h2>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-info-split__bio">
                                        <p><?php echo esc_html($description); ?></p>
                                        <?php if (!empty($second_image)) : ?>
                                            <div class="bio-image">
                                                <img class="img-object-fit" src="<?php echo esc_url($second_image['url']); ?>" alt="<?php echo esc_attr($second_image['alt'] ?? ''); ?>" />
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            <?php $count ++;  endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>