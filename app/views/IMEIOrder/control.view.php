<div class="container">
      <a class="btn-add" href="/IMEIOrder/accept"><?= $text_accept_order ?></a>
      <table class="table">
            <thead>
                  <tr>
                        <th>.</th>
                        <th><?= $text_order_serviceName ?></th>
                        <th><?= $text_order_servicePrice ?></th>
                        <th><?= $text_order_userName ?></th>
                        <th><?= $text_order_imei ?></th>
                        <th><?= $text_order_created_date ?></th>
                        <th><?= $text_order_status ?></th>
                        <th><?= $text_controller ?></th>
                  </tr>
            </thead>
            <tbody>
            <?php  if($orders): foreach ($orders as $value): ?>
                  <tr>
                        <td><?= ($value->file_service_visibility == 1 ? '<i class="fa fa-eye" ></i>' : '<i class="fa fa-eye-slash" ></i>') ?></td>
                        <td><?= $value->file_service_title ?></td>
                        <td><?= $value->file_service_price ?></td>
                        <td><?= $value->file_service_cost_price ?></td>
                        <td><?= $value->file_service_cat_name ?></td>
                        <td><?= $value->file_service_time_to_verfiy ?></td>
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
                        <td colspan="8"><?= $text_no_data ?></td>
                  </tr>
            <?php endif; ?>
            </tbody>
      </table>
</div>
