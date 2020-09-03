<div class="container">
    <?php var_dump($service); ?>
      <a class="btn-add" href="/FileService/add"><?= $text_add_service ?></a>
      <table class="table">
            <thead>
                  <tr>
                        <th>.</th>
                        <th><?= $text_service_name ?></th>
                        <th><?= $text_service_name ?></th>
                        <th><?= $text_service_name ?></th>
                        <th><?= $text_service_name ?></th>
                        <th><?= $text_service_name ?></th>
                        <th><?= $text_service_name ?></th>
                        <th><?= $text_service_name ?></th>
                        <th><?= $text_controller ?></th>
                  </tr>
            </thead>
            <tbody>
            <?php  if($service): foreach ($service as $value): ?>
                  <tr>
                        <td><?= ($value->file_service_visibility == 1 ? '<i class="fa fa-eye" ></i>' : '<i class="fa fa-eye-slash" ></i>') ?></td>
                        <td><?= $value->file_service_title ?></td>
                        <td><?= $value->file_service_price ?></td>
                        <td><?= $value->file_service_cost_price ?></td>
                        <td><?= $value->file_service_cat_name ?></td>
                        <td><?= $value->file_service_orders_received ?></td>
                        <td><?= $value->file_service_delivery_time ?></td>
                        <td><?= $value->file_service_orders_verification ?></td>
                        <td>
                              <a href="/FileService/view/<?= $value->file_service_id ?>"><i class="fa fa-eye"></i></a>
                              <a href="/FileService/edit/<?= $value->file_service_id ?>"><i class="fa fa-edit"></i></a>
                              <a href="/FileService/delete/<?= $value->file_service_id ?>"><i class="fa fa-trash"></i></a>
                        </td>
                  </tr>
            <?php endforeach; else: ?>
                  <tr>
                        <td colspan="4"><?= $text_no_data ?></td>
                  </tr>
            <?php endif; ?>
            </tbody>
      </table>
</div>
