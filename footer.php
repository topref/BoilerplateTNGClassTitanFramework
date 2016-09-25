<?php $titan = TitanFramework::getInstance('radial'); ?>
<footer>
    <div class='container'>
        <div class="footer-row row">
            <div class="footer-left row">
                <?php
                $imageID = $titan->getOption('logo');
                $imageSrc = $imageID;
                if (is_numeric($imageID)) {
                    $imageAttachment = wp_get_attachment_image_src($imageID, 'full', false);
                    $imageSrc = $imageAttachment[0];
                }
                ?>
                <?php if ($imageSrc): ?>
                    <a href="<?php bloginfo('url'); ?>" class="footer__logo"><img src="<?php echo esc_url($imageSrc); ?>" alt=""/></a>
                <?php else: ?>
                <a href="<?php bloginfo('url'); ?>" class="footer__logo"><img src="<?php bloginfo('template_url'); ?>/img/footer-logo.png" alt=""/></a>
                <?php endif; ?>
                <div class="footer-text">
                    <p><strong><?php echo $titan->getOption('copy');?></strong></p>
                    <?php echo $titan->getOption('contact');?>
                </div>
            </div>
            <div class="footer-right">
                <div class="footer-phones">
                    <div class="footer-phones__item"><?php echo $titan->getOption('tel1');?></div>
                    <div class="footer-phones__item"><?php echo $titan->getOption('tel2');?></div>
                    <div class="footer-phones__item"><?php echo $titan->getOption('tel3');?></div>
                </div>
                <ul class="footer-social">
                    <?php if ($titan->getOption('fb')): ?>
                    <li><a href="<?php echo $titan->getOption('fb');?>" class="footer-social__link footer-social__link_1" target="_blank"></a></li>
                    <?php endif; ?>
                    <?php if ($titan->getOption('tw')): ?>
                    <li><a href="<?php echo $titan->getOption('tw');?>" class="footer-social__link footer-social__link_2" target="_blank"></a></li>
                    <?php endif; ?>
                    <?php if ($titan->getOption('google')): ?>
                    <li><a href="<?php echo $titan->getOption('google');?>" class="footer-social__link footer-social__link_3" target="_blank"></a></li>
                    <?php endif; ?>
                    <?php if ($titan->getOption('inst')): ?>
                    <li><a href="<?php echo $titan->getOption('inst');?>" class="footer-social__link footer-social__link_4" target="_blank"></a></li>
                    <?php endif; ?>
                    <?php if ($titan->getOption('vk')): ?>
                    <li><a href="<?php echo $titan->getOption('vk');?>" class="footer-social__link footer-social__link_5" target="_blank"></a></li>
                    <?php endif; ?>
                    <?php if ($titan->getOption('ok')): ?>
                    <li><a href="<?php echo $titan->getOption('ok');?>" class="footer-social__link footer-social__link_6" target="_blank"></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>

</body>
</html>