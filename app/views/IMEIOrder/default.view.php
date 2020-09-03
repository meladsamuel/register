<div class="container">

    <form class="form" method="post">
    <div id="container"></div>
        <div class="btn-section">
            <select name="service" id="mySelect">
                <option value="0" hidden><?= $text_form_serviceCategories ?></option>
                <?php if(isset($catService)): foreach($catService as $key => $values ): ?>
                    <option disabled><?= $key ?></option>
                    <?php for($i=0; $i<count($values[0]); $i++): ?>
                        <option value="<?= $values[0][$i] ?>" <?= $this->selected_A('serviceCategories', $values[0][$i]) ?> ><?= $values[1][$i] ?></option>
                    <?php endfor; ?>
                <?php endforeach; endif;?>
            </select>
        </div>

        <div class="imei" id="imei">
            <div class="input-section force-l" >
                <span id="IMEI_check" class="IMEI_check">0</span>
                <input type="text" class="IMEI" name="IMEI[]" id="IMEI" maxlength="14" value="<?= $this->showValue('serviceTitle')?>" dir="auto" autocomplete="off" required \>
                <label for="IMEI" class="input-content force-l"><span>IMEI Code</span></label>
            </div>
        </div>
        <div class="btn-section">
            <button id="btn_imei" class=" btn_add" type="button">اضف رقم اي ام اي ا جديد</button>
        </div>
        <div class="input-section">
            <input type="text" name="note" id="note" value="<?= $this->showValue('servicePrice')?>" dir="auto" autocomplete="off" required>
            <label for="note" class="input-content"><span>ملاحظتك</span></label>
        </div>
        <input type="submit" name="makeOrder" value="<?= $text_form_order ?>">
    </form>


</div>