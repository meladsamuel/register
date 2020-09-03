<div class="container">
      <form class="form" method="post">
            <div class="input-section n50 border">
                  <input type="text" name="firstName" id="firstName" autocomplete="off" value="<?= $this->showValue('firstName', $userProfile, 'user_profile_first_name') ?>" >
                  <label for="firstName" class="input-content"><span><?= $text_form_firstName ?></span></label>
            </div>
            <div class="input-section n50">
                  <input type="text" name="lastName" id="lastName" autocomplete="off" value="<?= $this->showValue('lastName', $userProfile, 'user_profile_last_name') ?>" >
                  <label for="lastName" class="input-content"><span><?= $text_form_lastName ?></span></label>
            </div>

            <div class="input-section">
                  <input type="text" name="phoneNumber" id="phoneNumber" autocomplete="off" value="<?= $this->showValue('phoneNumber', $userProfile, 'user_profile_phone_number') ?>">
                  <label for="phoneNumber" class="input-content"><span><?= $text_form_phoneNumber ?></span></label>
            </div>
          <div class="btn-section">
              <select name="currency" id="mySelect">
                  <option value="0" hidden><?= $text_form_currency ?></option>
                  <?php if(isset($currencies)): foreach($currencies as  $value ): ?>
                      <option value="<?= $value->currency_code?>" <?= $this->selected('currency', $value->currency_code, $user, 'user_currency') ?> ><?= $value->currency_name ?></option>
                  <?php endforeach; endif;?>
              </select>
          </div>
            <input type="submit" name="submit" value="<?= $text_form_save ?>">
      </form>
</div>
