<div class="container">
    <form method="post" class="form">
        <div class="input-section">
            <input type="text" name="currency_amount" id="currency_amount" value="<?= $this->showValue('currency_amount', $currency, "currency_amount")?>" autocomplete="off" required>
            <label for="currency_amount" class="input-content"><span><?= $text_form_currency_amount ?></span></label>
        </div>
        <input type="submit" name="submit" value="<?= $text_form_currency_add ?>" class=" btn_add" >
    </form>
</div>
