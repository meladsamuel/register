<div class="container">
    <div class="whight_section">
        <p><?= $text_description ?></p>
        <div class="code-block">
            <div class="code_head">
                <?= $text_cryptoCurrency[$this->session->paymentType] ?>
            </div>
            <div class="code"><?= $charge->addresses[$this->session->paymentType]?></div>
        </div>
        <div class="code-block">
            <div class="code_head">
                <?= $text_pricing ?>
            </div>
            <div class="code">
                <span>
                    <?php if(isset($charge)) foreach ($charge->pricing[$this->session->paymentType] as $price) echo $price . " "; ?>
                </span>

                <span>(
                    <?php if(isset($charge)) foreach ($charge->pricing['local'] as $price) echo $price . " "; ?>
                )</span>

            </div>
        </div>

        <div class="timer">
            <div class="timer-block">
                <span id="minutes">--</span>
                <div><?= $text_minute ?></div>
            </div>
            <div class="timer-block">
                <span id="seconds">--</span>
                <div><?= $text_second?></div>
            </div>
            <span class="timer-message" id="msg"><?= $text_waiting_payment?></span>
        </div>
    </div>

</div>
