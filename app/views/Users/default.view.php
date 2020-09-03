<div class="container">
      <a class="btn-add" href="/users/add"><?= $text_add_users ?></a>

      <table class="table">
            <thead>
                  <tr>
                        <th><?= $text_user_name ?></th>
                        <th><?= $text_user_email ?></th>
                        <th><?= $text_user_group ?></th>
                        <th><?= $text_user_reg_date ?></th>
                        <th><?= $text_user_last_login ?></th>
                        <th><?= $text_controller ?></th>
                  </tr>
            </thead>
            <tbody>
            <?php  if($users): foreach ($users as $value): ?>

                  <tr>
                        <td><?= $value->user_name ?></td>
                        <td><?= $value->user_email?></td>
                        <td><?= $value->group_name ?></td>
                        <td><?= $value->user_reg_date ?></td>
                        <td><?= $value->user_last_login ?></td>
                        <td>
                              <a href="/users/edit/<?= $value->user_id ?>"><i class="icon-edit"></i></a>
                              <a href="/users/delete/<?= $value->user_id ?>"><i class="icon-cancel"></i></a>
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
