<div class="container">
      <a href="/usersGroup/add"><?= $text_add_user_group ?></a>
      <div class="responsive-table">
            <table class="table">
                  <tr>
                        <td><?= $text_usersGroup_group_name ?></td>
                        <td><?= $text_controller ?></td>
                  </tr>
            <?php  if($usersGroup): foreach ($usersGroup as $value): ?>

                  <tr>
                        <td><?= $value->group_name?></td>
                        <td>
                              <a href="\usersGroup\edit\<?= $value->group_id ?>">edit</a>
                              <a href="\usersGroup\delete\<?= $value->group_id ?>">delete</a>
                        </td>
                  </tr>
            <?php endforeach; else: ?>
                  <tr>
                        <td colspan="2"><?= $text_no_data ?></td>
                  </tr>
            <?php endif; ?>

            </table>
      </div>
</div>
