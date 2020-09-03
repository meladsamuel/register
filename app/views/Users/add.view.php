<div class="container">
      <form class="form" method="post">
            <div class="input-section n50 border">
                  <input type="text" name="firstName" id="firstName" autocomplete="off" value="<?= $this->showValue('firstName') ?>" >
                  <label for="firstName" class="input-content"><span><?= $text_form_firstName ?></span></label>
            </div>
            <div class="input-section n50">
                  <input type="text" name="lastName" id="lastName" autocomplete="off" value="<?= $this->showValue('lastName') ?>" >
                  <label for="lastName" class="input-content"><span><?= $text_form_lastName ?></span></label>
            </div>
            <div class="input-section">
                  <input type="text" name="userName" id="userName" autocomplete="off" value="<?= $this->showValue('userName') ?>" >
                  <label for="userName" class="input-content"><span><?= $text_form_userName ?></span></label>
            </div>
            <div class="input-section">
                  <input type="password" name="password" id="password" autocomplete="off" value="<?= $this->showValue('password') ?>">
                  <label for="password" class="input-content"><span><?= $text_form_password ?></span></label>
            </div>
            <div class="input-section">
                  <input type="email" name="email" id="email" autocomplete="off" value="<?= $this->showValue('email') ?>">
                  <label for="email" class="input-content"><span><?= $text_form_email ?></span></label>
            </div>
            <div class="input-section">
                  <input type="text" name="phoneNumber" id="phoneNumber" autocomplete="off" value="<?= $this->showValue('phoneNumber') ?>">
                  <label for="phoneNumber" class="input-content"><span><?= $text_form_phoneNumber ?></span></label>
            </div>
            <select name="usersGroup">
                  <option value="0" hidden><?= $text_form_usersGroup ?></option>
<?php foreach($usersGroup as $value): ?>
                  <option value="<?= $value->group_id ?>" <?= $this->selected('usersGroup', $value->group_id) ?> ><?= $value->group_name ?></option>
<?php endforeach; ?>
            </select>
            <input type="submit" name="submit" value="<?= $text_form_save ?>">
      </form>
</div>