<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th><?= $text_charge_user_name ?></th>
            <th><?= $text_charge_id ?></th>
            <th><?= $text_charge_created_at ?></th>
        </tr>
        </thead>
        <tbody>
        <?php  if($charges): foreach ($charges as $value): ?>

            <tr>
                <td><a class="ajax button xs warning" data="<?= $value->charge_id ?>"><i class="fa fa-eye"></i></a></td>
                <td><?= $value->user_name ?></td>
                <td><?= $value->charge_id ?></td>
                <td><?= $value->charge_created_at ?></td>
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
                <span>بيانات طلب الدفع</span>
            </div>
            <div id="containerInput" class="content-body">

            </div>
        </div>
    </div>
</div>
