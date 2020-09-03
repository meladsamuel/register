<?php if (isset($order) && $type == 'IMEI'): ?>
    <p>transaction id : <?= $order->imei_order_id ?></p>
    <p>order price : <?= $order->imei_order_prices ?></p>
    <p>order status : <?= $text_status[$order->imei_order_status] ?></p>
    <p>order date : <?= $order->imei_order_created_date ?></p>
    <p>client name : <?= $user->user_name ?></p>
    <p>client email : <?= $user->user_email ?></p>
    <p>user comment : <?= $order->imei_order_note ?></p>
    <p>service name : <?= $service->imei_service_title ?></p>
    <p>service price : <?= $service->imei_service_price ?></p>
    <p>IMEI : <BR>
        <?php foreach ($imeis as $imei): ?>
            <?= $imei->imei_order ?> <br>
        <?php endforeach; ?>
    </p>
    <p>return code : <?= $order->imei_order_return_code ?></p>
<?php elseif (isset($order) && $type == 'File'): ?>
    <div class="overflow-auto">
        <table class="table">
            <tbody>
            <tr>
                <td>transaction id</td>
                <td><?= $order->file_order_id ?></td>
            </tr>
            <tr>
                <td>order price</td>
                <td><?= $order->file_order_price ?></td>
            </tr>
            <tr>
                <td>order status</td>
                <td><?= $text_status[$order->file_order_status] ?></td>
            </tr>
            <tr>
                <td>order date</td>
                <td><?= $order->file_order_created_date ?></td>
            </tr>
            <tr>
                <td>client name</td>
                <td><?= $user->user_name ?></td>
            </tr>
            <tr>
                <td>client email</td>
                <td><?= $user->user_email ?></td>
            </tr>
            <tr>
                <td>user comment</td>
                <td><?= $order->file_order_note ?></td>
            </tr>
            <tr>
                <td>service name</td>
                <td><?= $service->file_service_title ?></td>
            </tr>
            <tr>
                <td>service price</td>
                <td><?= $service->file_service_price ?></td>
            </tr>
            <tr>
                <td>return code</td>
                <td><?= $order->file_order_return_code ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a id="file" class="button xs process" data="<?= $order->file_order_file_path ?>">
                        <i class="fa fa-download fa-fw"></i>Download File
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="prg" class="container-progress">
        <div class="progress">
            <div id="bar" class="bar"></div>
        </div>
        <span class="text" id="text">0%</span>
    </div>

<?php endif; ?>
