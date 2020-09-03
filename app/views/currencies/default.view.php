<div class="container">
    <a class="btn_add" href="/currencies/add"><?= $text_add_currency ?></a>
    <table class="table">
        <thead>
        <tr>
            <th><?= $text_currency ?></th>
            <th><?= $text_currency_name ?></th>
            <th><?= $text_currency_amount ?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php  if($currencies): foreach ($currencies as $value): ?>

            <tr>
                <td><?= $value->currency_code ?></td>
                <td><?= $value->currency_name ?></td>
                <td><?= $value->currency_amount ?></td>
                <td>
                    <a href="/currencies/edit/<?= $value->currency_code ?>"><i class="fa fa-edit"></i></a>
                    <a href="/currencies/delete/<?= $value->currency_code ?>"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; else: ?>
            <tr>
                    <td colspan="4">no data for showing in the page</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
