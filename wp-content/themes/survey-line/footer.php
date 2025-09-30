</main>

<?php 
    $footer_logo = get_field('footer_logo', 'options');
    $company = get_field('company_name', 'options');
    $phone = get_field('phone_number', 'options');
    $email = get_field('email_address', 'options');
    $address = get_field('address', 'options');
    $footer_text = get_field('footer_text', 'options');
    $accreditation_logo = get_field('accreditation_logo', 'options');
    $accreditation_link = get_field('accreditation_link', 'options');
?>

<footer class="footer padded-mid">
	<div class="container">
        <div class="footer__inner">
            <div class="footer-company">
                <?php if (!empty($footer_logo)) : ?>
                    <img src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt'] ?? ''); ?>" />
                <?php endif; ?>
                <?php if(!empty($footer_text)): ?>
                    <?php echo wp_kses_post($footer_text); ?>
                <?php endif; ?>
                <?php if (!empty($accreditation_logo) && !empty($accreditation_link)) : ?>
                    <a class="footer-accreditation" href="<?php echo esc_url($accreditation_link); ?>" target="_blank">
                        <img src="<?php echo esc_url($accreditation_logo['url']); ?>" alt="<?php echo esc_attr($accreditation_logo['alt'] ?? ''); ?>" />
                    </a>
                <?php endif; ?>
            </div>
            <div class="footer-contact">
                <h3>Contact us</h3>
                <?php if(!empty($phone)): ?>
                    <a href="tel:<?php echo esc_html($phone) ?>" target="_blank">
                        <?php echo esc_html($phone); ?>
                    </a>
                <?php endif; ?>
                <?php if(!empty($email)): ?>
                    <a href="mailto:<?php echo esc_html($email); ?>" target="_blank">
                        <?php echo esc_html($email); ?>
                    </a>
                <?php endif; ?>
                <?php if(!empty($address)): ?>
                    <?php echo wp_kses_post($address); ?>
                <?php endif; ?>
            </div>
            <div class="footer-menu">
                <h3><?php echo esc_html( my_menu_title('footer_menu') ); ?></h3>
                <?php wp_nav_menu( array(
                    'theme_location' => 'footer_menu',
                    'container'      => false,
                    'menu_class'     => 'footer-nav',
                    ) ); 
                ?> 
            </div>
            <div class="footer-legal">
                <h3><?php echo esc_html( my_menu_title('legal_menu') ); ?></h3>
                <?php wp_nav_menu( array(
                    'theme_location' => 'legal_menu',
                    'container'      => false,
                    'menu_class'     => 'legal-nav',
                    ) ); 
                ?> 
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom-inner">
                <div class="websie-copyright">
                    <p>Copyright © <?php echo date("Y"); ?> <?php echo esc_html($company) ?></p>
                </div>
                <div>
                    <p>Website by <a href="https://gregorydigital.co.uk" target="_blank">Gregory Digital</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="pg-lightbox" id="pgLightbox" aria-hidden="true" role="dialog" aria-modal="true">
    <button class="pg-lightbox__close" aria-label="Close">&times;</button>
    <button class="pg-lightbox__nav pg-lightbox__prev" aria-label="Previous">&#10094;</button>
    <figure class="pg-lightbox__figure">
        <img id="pgLightboxImg" src="" alt="" />
        <figcaption id="pgLightboxCaption"></figcaption>
    </figure>
    <button class="pg-lightbox__nav pg-lightbox__next" aria-label="Next">&#10095;</button>
    <div class="pg-lightbox__backdrop"></div>
</div>
<?php wp_footer(); ?>    
</body>
</html>