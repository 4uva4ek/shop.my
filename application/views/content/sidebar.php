<!-- начало блока-->
<div class="block clearfix">
    <div class="blockheader">
        <h3 class="t">Категории</h3>
    </div>
    <div class="blockcontent">
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
<div class="block clearfix">
    <div class="blockheader">
        <h3 class="t">Популярное</h3>
    </div>
    <div class="blockcontent">
        <div>Брюки</div>
        <div>Блузки</div>
        <div>Шубы</div>
        <p style="text-align: center;">
            <a href="#">Read more »</a>
        </p>
    </div>
</div>
<!-- конец блока-->
<?php if (isset($bars)){
    $str='';
    foreach ($bars as $bar){
        $str.='<div class="block clearfix">
    <div class="blockheader">
        <h3 class="t">'.$bar['name'].'</h3>
    </div>
    <div class="blockcontent">
       '.$bar['content'].'
    </div>
</div>';
    }
    echo $str;
}