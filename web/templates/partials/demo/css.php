<?php if(isset($cssCall) && count($cssCall)>0): ?>

    <?php foreach ($cssCall AS $css): ?>

        <?php if($css!=''): ?>

            <link rel="stylesheet" type="text/css" href="<?= Helper::getFilePathWithUpdateTime($css) ?>">

        <?php endif; ?>

    <?php endforeach; ?>

<?php endif; ?>
