<section class="three-columns back-purple-1">
    <div class="three-columns__container container">
        <div class="three-columns__row row">
            <div class="col-lg-10">
                <h2 class="three-columns__section-title caption white-1">
                    It’s time to make your business <strong class="line-animation line-animation--green">awesome.</strong>
                </h2>
            </div>
            <div class="col-lg-8">
                <p class="three-columns__subtitle white-1">
                    We are the only company in the UK to offer this completely unique system of business assessment and transformation.
                </p>
            </div>
            <div class="col-lg-4">
                <div class="three-columns__white-box">
                    <h3 class="three-columns__box-title" aria-label="growth framework">
                        <?= \Light\render('/wp-content/uploads/2022/01/growth-framework-icon.svg', [
                            'keepcolors' => true,
                        ]) ?>
                    </h3>
                    <p class="three-columns__text">The Business Growth Framework is our full consultancy approach programme.</p>
                    <p class="three-columns__list-intro">Perfect for your business if you:</p>
                    <ul class="three-columns__list">
                        <li>SME</li>
                        <li>Turnover in excess of £5 million</li>
                        <li>Sales team of 10+ people</li>
                        <li>Ambitious growth plans</li>
                        <li>Available budget to invest</li>
                    </ul>

                    <?= Light\render('build/components/button', [
                        'type'           => 'text-link',
                        'link'           => '/',
                        'label'          => 'Learn more',
                    ]);?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="three-columns__white-box">
                    <h3 class="three-columns__box-title" aria-label="growth academy">
                        <?= \Light\render('/wp-content/uploads/2022/01/growth-academy-icon.svg', [
                            'keepcolors' => true,
                        ]) ?>
                    </h3>
                    <p class="three-columns__text">Perfect for businesses who want to master The Growth Framework for themselves.</p>
                    <p class="three-columns__list-intro">Perfect for your business if you:</p>
                    <ul class="three-columns__list">
                        <li>Small business/Sole trader</li>
                        <li>Turnover of less than £5 million</li>
                        <li>5 - people sales team</li>
                        <li>Ambitious growth plans</li>
                        <li>Limited budget to invest</li>
                    </ul>

                    <?= Light\render('build/components/button', [
                        'type'           => 'text-link',
                        'link'           => '/',
                        'label'          => 'Learn more',
                    ]);?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="three-columns__white-box">
                    <h3 class="three-columns__box-title" aria-label="growth club">
                        <?= \Light\render('/wp-content/uploads/2022/01/growth-club-icon.svg', [
                            'keepcolors' => true,
                        ]) ?>
                    </h3>
                    <p class="three-columns__text">The Growth Club provides a focused, supportive space for you to work on your business.</p>
                    <p class="three-columns__list-intro">Perfect for your business if you:</p>
                    <ul class="three-columns__list">
                        <li>Business owner/sales director</li>
                        <li>Turnover in excess of £1 million</li>
                        <li>Ambitious growth plans</li>
                        <li>Prepared to do things differently</li>
                    </ul>

                    <?= Light\render('build/components/button', [
                        'type'           => 'text-link',
                        'link'           => '/',
                        'label'          => 'Learn more',
                    ]);?>
                </div>
            </div>
        </div>
    </div>
</section>
