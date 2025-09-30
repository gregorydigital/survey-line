<?php 
    $site_logo = get_field('site_logo', 'options');
    $phone = get_field('phone_number', 'options');
    $email = get_field('email_address', 'options');
?>

<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="header__top-inner">
                <div class="social-channels">
                    <?php if(have_rows('social_repeater', 'options')): ?>
                        <?php while(have_rows('social_repeater', 'options')): the_row();?>
                            <?php 
                                $icon = get_sub_field('icon');
                                $link = get_sub_field('link');
                            ?>
                            <?php if (!empty($icon && !empty($link))) : ?>
                                <a href="<?php echo esc_url($link) ?>" target="_blank">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" />
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="contact-details">
                    <?php if(!empty($phone)): ?>
                        <div class="contact-details-box">
                            <a href="tel:<?php echo esc_html($phone) ?>" target="_blank">
                                <p><?php echo esc_html($phone); ?></p>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($email)): ?>
                        <div class="contact-details-box">
                            <a href="mailto:<?php echo esc_html($email); ?>" target="_blank">
                                <p><?php echo esc_html($email); ?></p>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header__main">
        <div class="container">
            <div class="header__main-inner">
                <?php if( !empty( $site_logo ) ): ?>
                <div class="header-logo-container">
                    <a href="<?php echo home_url(); ?>" aria-label="<?php echo esc_attr($site_logo['alt']); ?>" class="header__logo">
                        <img class="header__logo" src="<?php echo esc_url($site_logo['url']); ?>" alt="<?php echo esc_attr($site_logo['alt']); ?>" />
                    </a> 
                </div>
                <?php endif; ?>
                <div class="main-nav-container">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'main_menu',
                        'container'      => false,
                        'menu_class'     => 'main-nav',
                        'walker'         => new My_Mega_Menu_Walker(), // custom walker
                        ) ); 
                    ?> 
                    <div class="contact-details">
                        <?php if(!empty($phone)): ?>
                            <div class="contact-details-box">
                                <a href="tel:<?php echo esc_html($phone) ?>" target="_blank">
                                    <p><?php echo esc_html($phone); ?></p>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($email)): ?>
                            <div class="contact-details-box">
                                <a href="mailto:<?php echo esc_html($email); ?>" target="_blank">
                                    <p><?php echo esc_html($email); ?></p>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if(have_rows('social_repeater', 'options')): ?>
                        <div class="social-mobile-container">
                            <?php while(have_rows('social_repeater', 'options')): the_row();?>
                                <?php 
                                    $icon = get_sub_field('mobile_icon');
                                    $link = get_sub_field('link');
                                ?>
                                <?php if (!empty($icon && !empty($link))) : ?>
                                    <a href="<?php echo esc_url($link) ?>" target="_blank">
                                        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" />
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button class="menu-toggle" aria-expanded="false" aria-controls="primary-menu" aria-label="mobile menu button">
				    <span class="hamburger"></span>
			    </button>
            </div>
        </div>
    </div>
</header>