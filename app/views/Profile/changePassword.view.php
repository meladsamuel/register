<div class="container">
      <form class="form" method="post" autocomplete="off">
            <div class="input-section">
                  <input type="password" name="oldPassword" id="oldPassword">
                  <label for="oldPassword" class="input-content"><span><?= $text_form_oldPassword ?></span></label>
            </div>
            <div class="input-section">
                  <input type="password" name="newPassword" id="newPassword">
                  <label for="newPassword" class="input-content"><span><?= $text_form_newPassword ?></span></label>
            </div>
            <input type="submit" name="submit" value="<?= $text_form_save ?>">
      </form>
</div>
