<div class="container">
    <form method="post" class="form">
        <div class="input-section" >
            <input type="text"  name="amount" id="amount"  value="<?= $this->showValue('amount')?>"  autocomplete="off" required \>
            <label for="amount" class="input-content"><span><?= $text_amount ?></span></label>
        </div>
        <div class="btn-section">
            <select name="cryptoCurrency" id="mySelect">
                <option value="0" hidden><?= $text_select_cryptoCurrency ?></option>
                <option value="bitcoin" <?= $this->selected_A('cryptoCurrency','bitcoin')?> >Bitcoin</option>
                <option value="bitcoincash" <?= $this->selected_A('cryptoCurrency','bitcoincash')?> >Bitcoin Cash</option>
                <option value="ethereum" <?= $this->selected_A('cryptoCurrency','ethereum')?> >Ethereum</option>
                <option value="litecoin" <?= $this->selected_A('cryptoCurrency','litecoin')?> >Litecoin</option>
                <option value="usdc" <?= $this->selected_A('cryptoCurrency','usdc')?> >USD Coin</option>
            </select>
        </div>
        <div class="btn-section">
            <button class="btn_add"  type="submit"><?= $text_form_save ?></button>
        </div>

    </form>
</div>