<div class="modal-box">
    <div><?= $text_charge_user_name ?></div>
    <div><?= $charge->user_name?></div>
    <div><?= $text_charge_id ?></div>
    <div><?= $charge->charge_id?></div>
    <div><?= $text_charge_name ?></div>
    <div><?= $charge->charge_name ?></div>
    <div><?= $text_charge_created_at ?></div>
    <div><?= $charge->charge_created_at ?></div>
    <div><?= $text_charge_expires_at ?> </div>
    <div><?= $charge->charge_expires_at ?> </div>
    <div><?= $text_charge_confirmed_at ?> </div>
    <div><?= $charge->charge_confirmed_at ?> </div>
    عناوين المحافظ
    <div> عنوان البتكوين<?= $charge->charge_addresses_bitcoin ?></div>
    <div> عنوان الايثريم<?= $charge->charge_addresses_ethereum ?></div>
    <div> عنوان اليتكوين<?= $charge->charge_addresses_litecoin ?></div>
    <div> عنوان البتكوين كاش<?= $charge->charge_addresses_bitcoincash ?></div>
    <div> عنوان الدولار الامريكي<?= $charge->charge_addresses_usdc ?></div>
    <div>تم الدفع عن طريق شبكة </div>
    <div><?= $charge->charge_network ?></div>
    <div>رقم المعاملة</div>
    <div><?= $charge->charge_transaction_id ?></div>
    <div>العملة المحلية</div>
    <div><?= $charge->charge_value_local ?></div>
    <div>العملة الشفرة</div>
    <div><?= $charge->charge_value_crypto ?></div>
</div>