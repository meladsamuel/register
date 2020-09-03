<div class="container">
      <a class="btn-add" href="/privilage/add"><?= $text_add_privilage ?></a>
      <table class="table">
            <thead>
                  <tr>
                        <th><?= $text_privilage_name ?></th>
                        <th><?= $text_privilage_link ?></th>
                        <th><?= $text_controller ?></th>
                  </tr>
            </thead>
            <tbody>
            <?php  if($privilage): foreach ($privilage as $value): ?>
                  <tr>
                        <td><?= $value->privilage_title?></td>
                        <td><?= $value->privilage?></td>
                        <td>
                              <a href="/privilage/edit/<?= $value->privilage_id ?>"><i class="icon-edit"></i></a>
                              <a href="/privilage/delete/<?= $value->privilage_id ?>"><i class="icon-cancel"></i></a>
                        </td>
                  </tr>
            <?php endforeach; else: ?>
                  <tr>
                        <td colspan="3"><?= $text_no_data ?></td>
                  </tr>
            <?php endif; ?>
            </tbody>
      </table>
</div>
