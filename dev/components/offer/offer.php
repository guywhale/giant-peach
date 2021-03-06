<section class="offer">
    <div class="container">
        <div class="row">
            <div class="offer__col offer__col-l col-xl-7">
                <div class="offer__wrapper">
                    <div class="offer__white-box offer__white-box--l back-white-1">
                        <p class="green-1 h1">
                            For those who know they can be more <strong class="line-animation line-animation--yellow">successful</strong>, the time is now.
                        </p>
                    </div>
                </div>
            </div>
            <div class="offer__col col-xl-5">
                <div class="offer__wrapper offer__wrapper--r">
                    <div class="offer__white-box offer__white-box--r back-white-1">
                        <p class="purple-1">The Growth Academy gives business leaders the tools to implement a blueprint for attaining growth. Using a unique and proven methodology, we enable you to create a healthier and efficient team that will transform sales and break through barriers to let your business thrive.</p>
                        <?= Light\render('build/components/button', [
                            'type'           => 'purple',
                            'sectionBgColor' => 'white-1',
                            'size'           => 'medium',
                            'link'           => '/',
                            'label'          => 'What we offer',
                        ]);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
