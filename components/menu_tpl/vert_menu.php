<?php
// замена пробелов в названии (для ЧПУ)
//$hfuCategoryTitle = str_replace ( ' ' , '_' , $category['title'] );
?>
<li style="padding: 5px 0px 5px 10px">
    <a href="<?= yii\helpers\Url::to([
        'category/view', 
        'title' => clearUrlStr($category['title']),
        'id' => $category['id'],
            ]) ?>" 
       style="text-transform: uppercase; color: #838080; text-decoration: none; ">
        <?= $category['title']; ?>
        <?php if( isset($category['childs']) ):?>
            <span  style="font-weight: bold; float: right; margin-right: 10px;">+</span>
        <?php endif; ?>
    </a>
    <?php if( isset($category['childs']) ):?>
    <ul style="list-style-type:none; padding-left: 10px;">
        <?= $this->getMenuHtml($category['childs']);?>
    </ul>
    <?php endif; ?>
</li>

