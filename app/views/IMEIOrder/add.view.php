<div class="container">
      <form class="form" method="post">
            <div class="input-section">
                  <input type="text" name="serviceTitle" id="serviceTitle" value="<?= $this->showValue('serviceTitle')?>" autocomplete="off">
                  <label for="serviceTitle" class="input-content"><span><?= $text_form_serviceTitle ?></span></label>
            </div>
            <div class="input-section">
                  <input type="text" name="servicePrice" id="servicePrice" value="<?= $this->showValue('servicePrice')?>" autocomplete="off">
                  <label for="servicePrice" class="input-content"><span><?= $text_form_servicePrice ?></span></label>
            </div>
            <div class="input-section">
                  <input type="text" name="serviceCostPrice" id="serviceCostPrice" value="<?= $this->showValue('serviceCostPrice')?>" autocomplete="off">
                  <label for="serviceCostPrice" class="input-content"><span><?= $text_form_serviceCostPrice ?></span></label>
            </div>
            <div class="input-section">
                  <input type="text" name="serviceTimeVerify" id="serviceTimeVerify" value="<?= $this->showValue('serviceTimeVerify')?>" autocomplete="off">
                  <label for="serviceTimeVerify" class="input-content"><span><?= $text_form_serviceTimeVerify ?></span></label>
            </div>
            <div class="input-section">
                  <input type="text" name="deliveryTime" id="deliveryTime"  value="<?= $this->showValue('deliveryTime')?>" >
                  <label for="deliveryTime" class="input-content"><span><?= $text_form_deliveryTime ?></span></label>
            </div>
            <div>
                  <select name="serviceCategories" id="mySelect">
                        <option value="0" hidden><?= $text_form_serviceCategories ?></option>
                  <?php if(isset($categories)): foreach($categories as $value): ?>
                        <option value="<?= $value->file_service_cat_id ?>"><?= $value->file_service_cat_name ?></option>
                  <?php endforeach; endif;?>
                  </select>
            </div>
            <div>
                  <textarea id="editor" name="serviceContent">Hello World!</textarea>
            </div>
            <div>
                  <input type="radio" value="2" name="visibility" hidden checked>
                  <input type="radio" id="ves-yes" value="1" name="visibility" <?= $this->checked('visibility', '1') ?> >
                  <label for="ves-yes"><?= $text_form_serviceVisible ?></label>
                  <input type="radio" id="ves-no"value="0"  name="visibility" <?= $this->checked('visibility', '0') ?>>
                  <label for="ves-no"><?= $text_form_serviceHidden ?></label>
            </div>

            <div>
                  <input type="radio" value="2" name="verification" hidden checked>
                  <input type="radio" id="verification-yes" value="1" name="verification" <?= $this->checked('verification', '1') ?> >
                  <label for="verification-yes"><?= $text_form_verificationOK ?></label>
                  <input type="radio" id="verification-no"value="0"  name="verification" <?= $this->checked('verification', '0') ?>>
                  <label for="verification-no"><?= $text_form_verificationNO ?></label>
            </div>

            <input type="submit" name="submit" value="<?= $text_form_save ?>">
      </form>
</div>
