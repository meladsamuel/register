<div class="container">
      <div>
            <?php if(isset($errors))foreach($errors as $error)echo $error,'<br>';?>
      </div>      
      <form class="form" method="post">
            <div class="input-section">
                  <input type="text" name="groupName" id="groupName" value="<?= $usersGroup->group_name ?>" autocomplete="off">
                  <label for="groupName" class="input-content"><span>Group Name</span></label>
            </div>
            
<?php if ($privilage !== false): foreach ($privilage as $value): ?>
            <input type="checkbox" id="<?= $value->privilage_id ?>" <?= in_array($value->privilage_id, $groupPrivilages) ? 'checked' : '' ?> value="<?= $value->privilage_id ?>" name="privilages[]">
            <label for="<?= $value->privilage_id ?>"><?= $value->privilage_title ?></label><br>
<?php endforeach; endif; ?>
            <input type="submit" name="submit" value="Add">
      </form>
</div>

<?php // TODO EDITE THIS PAGE INPUT VALUE ?>