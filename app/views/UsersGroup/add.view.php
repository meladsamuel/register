<div class="container">
      <div>
            <?php if(isset($errors))foreach($errors as $error)echo $error,'<br>';?>
      </div>
      <form class="form" method="post">
            <div class="input-section">
                  <input type="text" name="groupName" id="groupName" autocomplete="off">
                  <label for="groupName" class="input-content"><span>Group Name</span></label>
            </div>
<?php if ($privilage): foreach ($privilage as $value): ?>
            <input type="checkbox" id="<?= $value->privilage_id ?>" value="<?= $value->privilage_id ?>" name="privilages[]">
            <label for="<?= $value->privilage_id ?>"><?= $value->privilage_title ?></label><br>
<?php endforeach; endif; ?>
            <input type="submit" name="submit" value="Add">
      </form>
</div>