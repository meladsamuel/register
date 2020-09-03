<div class="container">
      <a href="/IMEICategory/add"><?= $text_add_category ?></a>
      <table class="table">
            <thead>
                  <tr>
                        <th>.</th>
                        <th><?= $text_category_name ?></th>
                        <th><?= $text_category_description ?></th>
                        <th><?= $text_controller ?></th>
                  </tr>
            </thead>
            <tbody>
            <?php  if($category): foreach ($category as $value): ?>

                  <tr>
                        <td><?= ($value->imei_service_cat_visibility == 1 ? '<i class="icon-eye" ></i>' : '<i class=icon-eye-off ></i>') ?></td>
                        <td><?= $value->imei_service_cat_name ?></td>
                        <td><?= $value->imei_service_cat_description ?></td>
                        <td>
                              <a href="/IMEICategory/view/<?= $value->imei_service_cat_id ?>"><i class="fa fa-eye"></i></a>
                              <a href="/IMEICategory/edit/<?= $value->imei_service_cat_id ?>"><i class="fa fa-edit"></i></a>
                              <a href="/IMEICategory/delete/<?= $value->imei_service_cat_id ?>"><i class="fa fa-trash"></i></a>
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
