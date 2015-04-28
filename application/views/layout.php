<!DOCTYPE html>
<html dir="ltr" lang="ru-RU">
<?php echo $head; ?>
<body>
<div id="main">
    <?php echo $header; ?>
    <?php echo $navigation; ?>
    <div class="sheet clearfix">
        <div class="layout-wrapper clearfix">
            <div class="block clearfix" style="padding:5px;">
                <?php echo $history;?>
            </div>
            <div class="content-layout">
                <div class="content-layout-row">
                    <div class="layout-cell sidebar1 clearfix">
                        <?php echo $sidebar;?>
                    </div>

                    <div class="layout-cell content clearfix">
                        <article class="post article">
                            <?php if (isset($message)) {
                                foreach ($message as $m) {
                                    echo $m;
                                }
                            }
                            ?>
                            <!-- контент начало -->
                            <?php echo $content ?>
                            <!-- контент конец -->
                        </article>
                    </div>

                </div>
            </div>
        </div><?php echo $footer; ?>

    </div>
</div>


</body>
</html>