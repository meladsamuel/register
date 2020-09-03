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
        <?php if ($orders): foreach ($orders as $value): ?>
            <tr>
                <td>
                    <a href="#" onclick="viewOrders(<?= $value->file_order_id ?>)"><?= $value->file_order_id ?></a>
                </td>
                <td><?= $text_status[$value->file_order_status] ?></td>
                <td><?= $value->file_order_created_date ?></td>
                <td><?= $value->file_order_updated_date ?></td>
                <td><?= $value->file_order_price ?></td>
                <td>
                    <a class="button xs process" onclick="changeStatus('invoicesOrder/status/File', this, '1', '<?= $value->file_order_id ?>')">
                        <?= $text_status[1] ?><i class="fas fa-check"></i>
                    </a>
                    <a class="button xs success" onclick="changeStatus('invoicesOrder/status/File', this, '3', '<?= $value->file_order_id ?>')">
                        <?= $text_status[3] ?><i class="fas fa-fan"></i>
                    </a>
                    <a class="button xs danger" onclick="changeStatus('invoicesOrder/status/File', this, '4', '<?= $value->file_order_id ?>')">
                        <?= $text_status[4] ?><i class="icon-cancel"></i>
                    </a>
                    <a class="button xs danger" onclick="changeStatus('invoicesOrder/status/File', this, '5', '<?= $value->file_order_id ?>')">
                        <?= $text_status[5] ?><i class="icon-cancel"></i>
                    </a>
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

<script>


</script>