<nav class="navigation">
    <a href="/" class="navigation__home-link" aria-label="Home link">
        <?= \Light\svg('/wp-content/uploads/2022/01/logo.svg', [
            'keepcolors' => true,
        ]); ?>
    </a>

    <button class="navigation__burger navigation__toggle">
        <?= \Light\svg('/wp-content/uploads/2022/01/burger-menu.svg'); ?>
    </button>

    <div class="navigation__overlay">
        <div class="navigation__slide-in">
            <div class="navigation__top-row">
                <a href="/" class="navigation__brandmark-logo">
                    <?= \Light\svg('/wp-content/uploads/2022/01/elation-brandmark-logo.svg', [
                        'keepcolors' => true,
                    ]); ?>
                </a>
                <button class="navigation__close navigation__toggle">
                    <?= \Light\svg('/wp-content/uploads/2022/01/close.svg'); ?>
                </button>
            </div>
            <?php wp_nav_menu([
                'menu'            => 'main-menu',
                'menu_class'      => 'navigation__menu',
                'container_class' => 'navigation__menu-container',
            ]); ?>
            <div class="navigation__bottom-row">
                <a href="https://en-gb.facebook.com/"
                    class="navigation__social-link navigation__social-link--facebook"
                    target="_blank"
                    rel="noopener"
                >
                    <span class="blob">
                        <?= \Light\svg('/wp-content/uploads/2022/01/fb-shape.svg', [
                            'keepcolors' => true,
                        ]); ?>
                    </span>
                    <span class="logo logo--facebook">
                        <?= \Light\svg('/wp-content/uploads/2022/01/facebook-f.svg'); ?>
                    </span>
                </a>
                <a href="https://twitter.com/"
                    class="navigation__social-link navigation__social-link--twitter"
                    target="_blank"
                    rel="noopener"
                >
                    <span class="blob">
                        <?= \Light\svg('/wp-content/uploads/2022/01/twitter-shape.svg', [
                            'keepcolors' => true,
                        ]); ?>
                    </span>
                    <span class="logo logo--twitter">
                        <?= \Light\svg('/wp-content/uploads/2022/01/twitter.svg'); ?>
                    </span>
                </a>
                <a href="https://www.linkedin.com/"
                    class="navigation__social-link navigation__social-link--linkedin"
                    target="_blank"
                    rel="noopener"
                >
                    <span class="blob">
                        <?= \Light\svg('/wp-content/uploads/2022/01/linkedin-shape.svg', [
                            'keepcolors' => true,
                        ]); ?>
                    </span>
                    <span class="logo logo--linkedin">
                        <?= \Light\svg('/wp-content/uploads/2022/01/linkedin-in.svg'); ?>
                    </span>
                </a>
                <a href="https://www.instagram.com/"
                    class="navigation__social-link navigation__social-link--instagram"
                    target="_blank"
                    rel="noopener"
                >
                    <span class="blob">
                        <?= \Light\svg('/wp-content/uploads/2022/01/instagram-shape.svg', [
                            'keepcolors' => true,
                        ]); ?>
                    </span>
                    <span class="logo logo--instagram">
                        <?= \Light\svg('/wp-content/uploads/2022/01/instagram.svg'); ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>
