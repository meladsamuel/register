<div class="container">
      <?php if($category): foreach($category as $value): ?>
      <div class="category">
            <div class="categoryHead relative">
                  <span onclick="getCategory(this)"><?= $value->file_service_cat_name ?></span>
            </div>
            <div class="categoryBody active">
            </div>
      </div>
            <?php endforeach; endif; ?>
</div>