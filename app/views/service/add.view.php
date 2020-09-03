<div class="container">
      <div>
            <?php if(isset($errors))foreach($errors as $error)echo $error,'<br>';?>
      </div>
      <form class="form" method="post">
            <div class="input-section">
                  <input type="text" name="serviceName" id="serviceName" autocomplete="off">
                  <label for="serviceName" class="input-content"><span>service Name</span></label>
            </div>
            <div class="input-section">
                  <input type="text" name="serviceDescription" id="serviceDescription" autocomplete="off">
                  <label for="serviceDescription" class="input-content"><span>service Description</span></label>
            </div>

            <div class="input-section">
                  <input type="number" name="servicePrice" id="peice">
                  <label for="price" class="input-content">
                        <span>service price</span>
                  </label>
            </div>
            <div class="input-section">
                  <input type="text" name="serviceDeadTime" id="serviceDeadTime">
                  <label for="serviceDeadTime" class="input-content">
                        <span>service Tax</span>
                  </label>
            </div>
                  <input type="radio" id="ves-yes" value="1" name="visibility" checked>
            <label for="ves-yes">Visible</label>
            <input type="radio" id="ves-no"value="0"  name="visibility">
            <label for="ves-no">Hidden</label>
            <select name="serviceCategory">
                  <?php foreach($categoryitem as $item): ?>
                  <option value="<?= $item->service_cat_id ?>" > <?= $item->service_cat_name ?> </option>
                  <?php endforeach; ?>
            </select>
            <input type="submit" name="submit" value="Add">
      </form>
</div>