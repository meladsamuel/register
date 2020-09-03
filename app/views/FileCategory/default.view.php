<div class="container">
      <a class="btn-add" href="/FileCategory/add"><?= $text_add_category ?></a>
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
                        <td><?= ($value->file_service_cat_visibility == 1 ? '<i class="icon-eye" ></i>' : '<i class=icon-eye-off ></i>') ?></td>
                        <td><?= $value->file_service_cat_name ?></td>
                        <td><?= $value->file_service_cat_description ?></td>
                        <td>
                              <a href="/FileCategory/view/<?= $value->file_service_cat_id ?>"><i class="fa fa-eye"></i></a>
                              <a href="/FileCategory/edit/<?= $value->file_service_cat_id ?>"><i class="fa fa-edit"></i></a>
                              <a href="/FileCategory/delete/<?= $value->file_service_cat_id ?>"><i class="fa fa-trash"></i></a>
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
