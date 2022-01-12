<div class="sample">
    <div class="container">
        <p class="caption">Caption</p>
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <p>Body</p>
        <strong class="emphasise">emphasise</strong>
        <ul class="emphasise">
            <li>List 1</li>
            <li>List 2</li>
            <li>List 3</li>
        </ul>
        <div class="row">
            <div class="back-grey-1 py-5 my-2 col-md-6">
                <?= Light\render('build/components/button', [
                    'type'           => 'white',
                    'sectionBgColor' => 'grey-1',
                    'size'           => 'medium',
                    'link'           => '/',
                    'label'          => 'Normal',
                ]);?>
            </div>
            <div class="back-grey-1 py-5 my-2 col-md-6">
                <?= Light\render('build/components/button', [
                    'type'           => 'purple',
                    'sectionBgColor' => 'grey-1',
                    'size'           => 'medium',
                    'link'           => '/',
                    'label'          => 'Normal',
                ]);?>
            </div>
            <div class="back-grey-1 py-5 my-2 col-md-6">
                <?= Light\render('build/components/button', [
                    'type'           => 'purple',
                    'sectionBgColor' => 'grey-1',
                    'size'           => 'small',
                    'link'           => '/',
                    'label'          => 'Small',
                ]);?>
            </div>
            <div class="back-grey-1 py-5 my-2 col-md-6">
                <?= Light\render('build/components/button', [
                    'type'           => 'purple',
                    'sectionBgColor' => 'grey-1',
                    'size'           => 'medium',
                    'link'           => '/',
                    'label'          => 'Medium',
                ]);?>
            </div>
            <div class="back-grey-1 py-5 my-2 col-md-6">
                <?= Light\render('build/components/button', [
                    'type'           => 'purple',
                    'sectionBgColor' => 'grey-1',
                    'size'           => 'large',
                    'link'           => '/',
                    'label'          => 'Large',
                ]);?>
            </div>
            <div class="back-grey-1 py-5 my-2 col-md-6">
                <?= Light\render('build/components/button', [
                    'type'           => 'text-link',
                    'link'           => '/',
                    'label'          => 'Text button',
                ]);?>
            </div>
        </div>
    </div>
</div>

