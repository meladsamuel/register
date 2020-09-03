<?php if ($order && $service == 'IMEI'): ?>
    <tr>
        <td><a href="#" onclick="viewOrders(<?= $order->file_order_id ?>) "><?= $order->imei_order_id ?></a></td>
        <td><?= $text_status[$order->imei_order_status] ?></td>
        <td><?= $order->imei_order_created_date ?></td>
        <td><?= $order->imei_order_updated_date ?></td>
        <td><?= $order->imei_order_prices ?></td>
        <td>
            <?= $text_status[$order->imei_order_status] ?>
        </td>
    </tr>
<?php elseif ($order && $service == 'File'): ?>
    <tr>
        <td><a href="#" onclick="viewOrders(<?= $order->file_order_id ?>) "><?= $order->file_order_id ?></a></td>
        <td><?= $text_status[$order->file_order_status] ?></td>
        <td><?= $order->file_order_created_date ?></td>
        <td><?= $order->file_order_updated_date ?></td>
        <td><?= $order->file_order_price ?></td>
        <td>
            <?= $text_status[$order->file_order_status] ?>
        </td>
    </tr>
<?php endif; ?>