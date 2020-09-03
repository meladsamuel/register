<?= ($this->Breadcrumb()) ?>
<?php if (isset($services) && $services): ?>
    <div class='sub-header'>
        <div class="container">
            <h1 class=""><?= $services->file_service_title ?></h1>
            <p>من خدمات <?= $services->file_service_cat_name ?></p>
            <span class="text-end">سعر الخدمة <?= $services->file_service_price ?></span>
            <span class="text-start">مدة تنفيذ الخدمة <?= $services->file_service_delivery_time ?></span>
        </div>
    </div>
    <div class="container">
        <?= html_entity_decode($services->file_service_content) ?>
    </div>
<?php elseif (isset($allServices) && $allServices): ?>
    <?php foreach ($allServices as $cat => $catServices): ?>
        <div class="collapsible-container">
            <div onclick="collapsible(this)" class="head"><span><?= $cat ?></span></div>
            <ul class="body list-unstyled">
                <?php foreach ($catServices as $kay => $serviceObject): ?>
                    <li>
                        <a href="<?= WEB_SITE_NAME ?>/Service/Files/ar/<?= $serviceObject->file_service_url ?>/"><?= $serviceObject->file_service_title ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
