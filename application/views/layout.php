<!DOCTYPE html>
<html dir="ltr" lang="ru-RU">
<?php echo $head; ?>
<body>
<div id="art-main">
    <?php echo $header; ?>
    <?php echo $navigation; ?>
    <div class="art-sheet clearfix">
        <div class="art-layout-wrapper clearfix">
            <div class="art-content-layout">
                <div class="art-content-layout-row">

                    <div class="art-layout-cell art-sidebar1 clearfix">
                        <!-- начало блока-->
                        <div class="art-block clearfix">
                            <div class="art-blockheader">
                                <h3 class="t">Категории</h3>
                            </div>
                            <div class="art-blockcontent">
                                <div>Брюки</div>
                                <div>Блузки</div>
                                <div>Шубы</div>
                                <p style="text-align: center;">
                                    <a href="#">Read more »</a>
                                </p>
                            </div>
                        </div>
                        <!-- конец блока-->

                        <!-- начало блока-->
                        <div class="art-block clearfix">
                            <div class="art-blockheader">
                                <h3 class="t">Популярное</h3>
                            </div>
                            <div class="art-blockcontent">
                                <div>Брюки</div>
                                <div>Блузки</div>
                                <div>Шубы</div>
                                <p style="text-align: center;">
                                    <a href="#">Read more »</a>
                                </p>
                            </div>
                        </div>
                        <!-- конец блока-->
                    </div>

                    <div class="art-layout-cell art-content clearfix">
                        <article class="art-post art-article">
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