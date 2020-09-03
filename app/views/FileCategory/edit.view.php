<div class="container">
    <form class="form" method="post">
        <div class="input-section">
            <input type="text" name="categoryName" id="catName"
                   value="<?= $this->showValue('categoryName', $category, 'file_service_cat_name') ?>"
                   autocomplete="off">
            <label for="catName" class="input-content"><span><?= $text_form_categoryName ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="categoryDescription" id="catDescription"
                   value="<?= $this->showValue('categoryDescription', $category, 'file_service_cat_description') ?>"
                   autocomplete="off">
            <label for="catDescription" class="input-content"><span><?= $text_form_categoryDescription ?></span></label>
        </div>

        <div class="input-section">
            <input type="text" name="categoryOrdering"
                   value="<?= $this->showValue('categoryOrdering', $category, 'file_service_cat_ordering') ?>"
                   id="categoryOrdering">
            <label for="categoryOrdering" class="input-content">
                <span><?= $text_form_categoryOrdering ?></span>
            </label>
        </div>
        <input type="radio" id="ves-yes" value="1"
               name="visibility" <?= $this->checked('visibility', '1', $category, 'file_service_cat_visibility'); ?> >
        <label for="ves-yes"><?= $text_form_categoryVisible ?></label>
        <input type="radio" id="ves-no" value="0"
               name="visibility" <?= $this->checked('visibility', '0', $category, 'file_service_cat_visibility'); ?> >
        <label for="ves-no"><?= $text_form_categoryHidden ?></label>
        <input type="submit" name="submit" value="<?= $text_form_save ?>">
    </form>
</div>