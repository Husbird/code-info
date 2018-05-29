<option value="<?= $category['id'] ?>" 
    <?php if($category['id'] == $this->model->parent) echo ' selected' ?>
    <?php if($category['id'] == $this->model->id) echo ' disabled' ?>
><?= $tab . $category['title'] ?></option>

<?php if( isset($category['childs']) ):?>
    <ul style="list-style-type:none; padding-left: 10px;">
        <?= $this->getMenuHtml($category['childs'], $tab . '- ');?>
    </ul>
<?php endif; ?>

