<div class="container">
    <form class="form" method="post">
        <div class="input-section">
            <input type="text" name="categoryName" id="catName"
                   value="<?= $this->showValue('categoryName', $catergoy, 'imei_service_cat_name') ?>"
                   autocomplete="off">
            <label for="catName" class="input-content"><span><?= $text_form_categoryName ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="categoryDescription" id="catDescription"
                   value="<?= $this->showValue('categoryDescription', $catergoy, 'imei_service_cat_description') ?>"
                   autocomplete="off">
            <label for="catDescription" class="input-content"><span><?= $text_form_categoryDescription ?></span></label>
        </div>
        <div>
            <select name="serviceCategories" id="mySelect">
                <option value="0" hidden><?= $text_form_serviceCategories ?></option>
                <?php if (isset($categories)): foreach ($categories as $value): ?>
                    <option value="<?= $value->imei_service_cat_id ?>" <?= $this->selected('serviceCategories', $value->imei_service_cat_id) ?>><?= $value->imei_service_cat_name ?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <div class="input-section">
            <input type="text" name="categoryOrdering"
                   value="<?= $this->showValue('categoryOrdering', $catergoy, 'imei_service_cat_ordering') ?>"
                   id="categoryOrdering">
            <label for="categoryOrdering" class="input-content">
                <span><?= $text_form_categoryOrdering ?></span>
            </label>
        </div>
        <input type="radio" id="ves-yes" value="1"
               name="visibility" <?= $this->checked('visibility', '1', $catergoy, 'imei_service_cat_visibility'); ?> >
        <label for="ves-yes"><?= $text_form_categoryVisible ?></label>
        <input type="radio" id="ves-no" value="0"
               name="visibility" <?= $this->checked('visibility', '0', $catergoy, 'imei_service_cat_visibility'); ?> >
        <label for="ves-no"><?= $text_form_categoryHidden ?></label>
        <input type="submit" name="submit" value="<?= $text_form_save ?>">
    </form>
</div>