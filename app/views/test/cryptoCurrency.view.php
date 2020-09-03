<div class="container">
    <form method="post" class="form">
        <div class="input-section" >
            <input type="text"  name="amount" id="amount"  value="<?= $this->showValue('amount')?>"  autocomplete="off" required \>
            <label for="amount" class="input-content"><span><?= $text_amount ?></span></label>
        </div>
        <div class="btn-section">
            <select name="cryptoCurrency" id="mySelect">
                <option value="0" hidden><?= $text_select_cryptoCurrency ?></option>
                <option value="1" <?= $this->selected_A('cryptoCurrency','1')?> >Bitcoin</option>
                <option value="2" <?= $this->selected_A('cryptoCurrency','2')?> >Bitcoin Cash</option>
                <option value="3" <?= $this->selected_A('cryptoCurrency','3')?> >Ethereum</option>
                <option value="4" <?= $this->selected_A('cryptoCurrency','4')?> >Litecoin</option>
                <option value="5" <?= $this->selected_A('cryptoCurrency','5')?> >USD Coin</option>

            </select>

        </div>
        <div class="btn-section">
            <button class="btn_add"  type="submit"><?= $text_form_save ?></button>
        </div>

    </form>
</div>