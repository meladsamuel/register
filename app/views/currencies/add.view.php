<div class="container">
    <form method="post" class="form">
        <div class="input-section">
            <input type="text" name="currency" id="currency" value="<?= $this->showValue('currency')?>" autocomplete="off" required>
            <label for="currency" class="input-content"><span><?= $text_form_currency ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="currency_name_en" id="currency_name_en" value="<?= $this->showValue('currency_name_en')?>" autocomplete="off" required>
            <label for="currency_name_en" class="input-content"><span><?= $text_form_currency_name_en ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="currency_name_ar" id="currency_name_ar" value="<?= $this->showValue('currency_name_ar')?>" autocomplete="off" required>
            <label for="currency_name_ar" class="input-content"><span><?= $text_form_currency_name_ar ?></span></label>
        </div>
        <div class="input-section">
            <input type="text" name="currency_amount" id="currency_amount" value="<?= $this->showValue('currency_amount')?>" autocomplete="off" required>
            <label for="currency_amount" class="input-content"><span><?= $text_form_currency_amount ?></span></label>
        </div>
        <input type="submit" name="submit" value="<?= $text_form_currency_add ?>" class=" btn_add" >
    </form>
</div>