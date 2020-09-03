<div class="container">
      <div>
            <?php if(isset($errors))foreach($errors as $error)echo $error,'<br>';?>
      </div>
      <form class="form" method="post">
            <div class="input-section">
                  <input type="text" name="privilageName" id="privilageName" value="<?= $privilage->privilage_title ?>" autocomplete="off">
                  <label for="privilageName" class="input-content"><span><?= $text_privilage_name ?></span></label>
            </div>
            <div class="input-section">
                  <input type="text" name="privilageLink" id="privilageLink" value="<?= $privilage->privilage ?>" autocomplete="off">
                  <label for="privilageLink" class="input-content"><span><?= $text_privilage_link ?></span></label>
            </div>
            <input type="submit" name="submit" value="<?= $text_privilage_add ?>">
      </form>
</div>