<script>

    function loadModule(file, module) {

        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = file;
        $("body").append(script);
        window[module].init();

    }
</script>

<?php if (isset($jsCall) && count($jsCall) > 0): ?>

    <?php foreach ($jsCall as $js): ?>

        <?php if ($js['file'] != ''): ?>

            <?php if (!isset($js['module']) || $js['module'] == ''): ?>

                <script type='text/javascript' src='<?= Helper::getFilePathWithUpdateTime($js['file']) ?>'></script>

            <?php else: ?>

                <script>

                    $(document).ready(function () {

                        loadModule('<?= Helper::getFilePathWithUpdateTime($js['file'])?>', '<?=$js['module']?>');

                    });

                </script>

            <?php endif; ?>

        <?php endif; ?>

    <?php endforeach; ?>

<?php endif; ?>
