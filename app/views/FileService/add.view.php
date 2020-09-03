<div class="container">
    <?php var_dump($categories); ?>
    <form class="form" method="post">
        <div class="input-section">
            <input type="text" name="serviceTitle_en" id="serviceTitle_en"
                   value="<?= $this->showValue('serviceTitle_en') ?>" autocomplete="off">
            <label for="serviceTitle_en" class="input-content"><span><?= $text_form_serviceTitle_en ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="serviceTitle_ar" id="serviceTitle_ar"
                   value="<?= $this->showValue('serviceTitle_ar') ?>" autocomplete="off">
            <label for="serviceTitle_ar" class="input-content"><span><?= $text_form_serviceTitle_ar ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="servicePrice" id="servicePrice" value="<?= $this->showValue('servicePrice') ?>"
                   autocomplete="off">
            <label for="servicePrice" class="input-content"><span><?= $text_form_servicePrice ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="serviceCostPrice" id="serviceCostPrice"
                   value="<?= $this->showValue('serviceCostPrice') ?>" autocomplete="off">
            <label for="serviceCostPrice" class="input-content"><span><?= $text_form_serviceCostPrice ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="serviceReceivedTime" id="serviceReceivedTime"
                   value="<?= $this->showValue('serviceReceivedTime') ?>" autocomplete="off">
            <label for="serviceReceivedTime"
                   class="input-content"><span><?= $text_form_serviceReceivedTime ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="deliveryTime_en" id="deliveryTime_en"
                   value="<?= $this->showValue('deliveryTime_en') ?>">
            <label for="deliveryTime_en" class="input-content"><span><?= $text_form_deliveryTime_en ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="deliveryTime_ar" id="deliveryTime_ar"
                   value="<?= $this->showValue('deliveryTime_ar') ?>">
            <label for="deliveryTime_ar" class="input-content"><span><?= $text_form_deliveryTime_ar ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="ServiceUrl" id="ServiceUrl" value="<?= $this->showValue('ServiceUrl') ?>">
            <label for="ServiceUrl" class="input-content"><span><?= $text_form_ServiceUrl ?></span></label>
        </div>
        <div>
            <select name="serviceCategories" id="mySelect">
                <option value="0" hidden><?= $text_form_serviceCategories ?></option>
                <?php if (isset($categories)): foreach ($categories as $value): ?>
                    <option value="<?= $value->file_service_cat_id ?>"<?= $this->selected_A('serviceCategories', $value->file_service_cat_id) ?>><?= $value->file_service_cat_name ?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <div>
            <textarea id="editor" name="serviceContent_en"><?= $this->showValue('serviceContent_en') ?></textarea>
        </div>
        <div>
            <textarea id="editor2" name="serviceContent_ar"><?= $this->showValue('serviceContent_ar') ?></textarea>
        </div>
        <div>
            <input type="radio" value="2" name="visibility" hidden checked>
            <input type="radio" id="ves-yes" value="1" name="visibility" <?= $this->checked('visibility', '1') ?> >
            <label for="ves-yes"><?= $text_form_serviceVisible ?></label>
            <input type="radio" id="ves-no" value="0" name="visibility" <?= $this->checked('visibility', '0') ?>>
            <label for="ves-no"><?= $text_form_serviceHidden ?></label>
        </div>

        <div>
            <input type="radio" value="2" name="verification" hidden checked>
            <input type="radio" id="verification-yes" value="1"
                   name="verification" <?= $this->checked('verification', '1') ?> >
            <label for="verification-yes"><?= $text_form_verificationOK ?></label>
            <input type="radio" id="verification-no" value="0"
                   name="verification" <?= $this->checked('verification', '0') ?>>
            <label for="verification-no"><?= $text_form_verificationNO ?></label>
        </div>

        <input type="submit" name="submit" value="<?= $text_form_save ?>">
    </form>
</div>
