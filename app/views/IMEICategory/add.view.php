<div class="container">
      <form class="form" method="post">
          <div class="input-section">
              <input type="text" name="categoryName_en" id="categoryName_en" value="<?= $this->showValue('categoryName_en')?>" autocomplete="off">
              <label for="categoryName_en" class="input-content"><span><?= $text_form_categoryName_en ?></span></label>
          </div>
          <div class="input-section">
              <input type="text" name="categoryName_ar" id="categoryName_ar" value="<?= $this->showValue('categoryName_ar')?>" autocomplete="off">
              <label for="categoryName_ar" class="input-content"><span><?= $text_form_categoryName_ar ?></span></label>
          </div>
          <div class="input-section">
              <input type="text" name="categoryDescription_en" id="categoryDescription_en" value="<?= $this->showValue('categoryDescription_en')?>" autocomplete="off">
              <label for="categoryDescription_en" class="input-content"><span><?= $text_form_categoryDescription_en ?></span></label>
          </div>
          <div class="input-section">
              <input type="text" name="categoryDescription_ar" id="categoryDescription_ar" value="<?= $this->showValue('categoryDescription_ar')?>" autocomplete="off">
              <label for="categoryDescription_ar" class="input-content"><span><?= $text_form_categoryDescription_ar ?></span></label>
          </div>

            <div class="input-section">
                  <input type="text" name="categoryOrdering" id="categoryOrdering"  value="<?= $this->showValue('categoryOrdering')?>" >
                  <label for="categoryOrdering" class="input-content">
                        <span><?= $text_form_categoryOrdering ?></span>
                  </label>
            </div>
            <input type="radio" value="2" name="visibility" hidden checked>
            <input type="radio" id="ves-yes" value="1" name="visibility" <?= $this->checked('visibility', '1') ?> >
            <label for="ves-yes"><?= $text_form_categoryVisible ?></label>
            <input type="radio" id="ves-no"value="0"  name="visibility" <?= $this->checked('visibility', '0') ?>>
            <label for="ves-no"><?= $text_form_categoryHidden ?></label>
            <input type="submit" name="submit" value="<?= $text_form_save ?>">
      </form>
</div>