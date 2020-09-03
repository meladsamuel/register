<?php
//var_dump($orders);
// 0https://commerce.coinbase.com/checkout/3086ebe8-5384-4e40-b9d9-2526657bc292

?>
<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th>imei id</th>
                <th>status</th>
                <th>date</th>
                <th>date of accept</th>
                <th>price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php  if($orders): foreach ($orders as $value): ?>

            <tr>
                <td><a href="/invoicesOrder/show/<?= $value->imei_order_id ?>">#<?= $value->imei_order_id ?></a></td>
                <td><?= $text_status[$value->imei_order_status]?></td>
                <td><?= $value->imei_order_created_date ?></td>
                <td><?= $value->imei_order_updated_date?></td>
                <td><?= $value->imei_order_prices ?></td>
                <td>
                    <a class="button xs process" onclick="changeStatus('/invoicesOrder/status/', this, '1', '<?= $value->imei_order_id ?>')" ><?= $text_status[1] ?> <i class="fas fa-check"></i></a>
                    <a class="button xs success" onclick="changeStatus('/invoicesOrder/status/', this, '3', '<?= $value->imei_order_id ?>')" ><?= $text_status[3] ?> <i class="fas fa-fan"></i></a>
                    <a class="button xs danger" onclick="changeStatus('/invoicesOrder/status/', this, '4', '<?= $value->imei_order_id ?>')" ><?= $text_status[4] ?> <i class="icon-cancel"></i></a>
                    <a class="button xs danger" onclick="changeStatus('/invoicesOrder/status/', this, '5', '<?= $value->imei_order_id ?>')" ><?= $text_status[5] ?>  <i class="icon-cancel"></i></a>
                    <a class="button xs warning" onclick="createReplay('<?= $value->imei_order_id ?>')"><?= $text_status[2]?> <i class="fa fa-envelope"></i></a>
                </td>
            </tr>
        <?php endforeach; else: ?>
            <tr>
                <td colspan="6"><?= $text_no_data ?></td>
            </tr>
        <?php endif; ?>
        <tbody>
    </table>
</div>
<div class="container">
    <div id="modal" class="modal">
        <div class="content">
            <div class="content-header">
                <span id="close" class="model-close end"><i class="fa fa-times"></i></span>
                <span>الرد علي العميل</span>
            </div>
            <div id="containerInput" class="content-body">

            </div>
        </div>
    </div>
</div>
<script>
    /**
     * this function create input form for replaying to the user
     *
     * @return void
     * */
    function createReplay(value) {


        var text   = CreateInputField('Order No.'+value, 'response'),
            hidden = CreateInputField('','id',value,'hidden'),
            submit = CreateInputField('', 'submit', 'replay', 'submit');
        document.getElementById('containerInput').innerHTML = CreateForm(text+hidden+submit, '/invoicesOrder/return/');

        modal.style.display =  'block';

    }
    var modal = document.getElementById('modal');
    var close = document.getElementById('close');
    close.onclick = function() {
        modal.style.display = 'none';
    }
    /**
     * this function create text, password, hidden input
     * @return {string}
     */
    function CreateInputField (label, fieldName, fieldValue = '', type = "text") {
        if (type !== "hidden" && type !== "submit") {
            return '<div class="input-section"> ' +
                '<input type="' + type + '" name="' + fieldName + '" id="' + fieldName + '" autocomplete="off" dir="auto" required>' +
                '<label for="' + fieldName + '" class="input-content"><span>' + label + '</span></label></div>' +
                '</div>';
        }else if(type === "submit") {
            return '<input class="btn_add" type="'+type+'"name="'+fieldName+'" value="'+fieldValue+'" >';
        }
        return '<input type="'+type+'"name="'+fieldName+'" value="'+fieldValue+'" >';

    }
    /**
     * this function create the form and return it with method and you can enter the field inside it
     * @return {string}
    * */
    function CreateForm (body = '', action = '', method = 'POST') {
        return '<form class="form" method="' + method + '" action="' + action + '">' + body + '</form>';
    }

</script>