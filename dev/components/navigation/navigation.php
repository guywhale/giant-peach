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
                <a href="" class="navigation__social-link"></a>
                <a href="" class="navigation__social-link"></a>
                <a href="" class="navigation__social-link"></a>
                <a href="" class="navigation__social-link"></a>
            </div>
        </div>
    </div>
</nav>
