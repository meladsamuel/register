<nav class="nav fix">
    <span>Shfretak</span>
    <a id="sideBarBTN" href="javascript:void(0)"><i class="fa fa-bars fa-fw"></i></a>
    <?php if (isset($this->session->u)): ?>
        <div id="dropMenu" class="dropMenu end ">
            <a id="menu-btn" href="javascript:void(0)"><span
                        class="hidden-xs"><?= $this->session->u->user_name ?></span><i
                        class='fa fa-angle-down fa-fw'></i></a>
            <ul id="menu-body" class="list-unstyled">
                <li>
                    <a><?= $this->session->u->user_balance * $this->session->currency_amount ?> <?= $this->session->u->user_currency ?></a>
                </li>
                <li><a href="/profile"><i class="fa fa-user-circle fa-fw"></i> <?= $text_nav_profile ?></a></li>
                <li><a href="/payment/cryptoCurrency"><i
                                class="fab fa-bitcoin fa-fw"></i> <?= $text_nav_cryptoCurrency ?></a></li>
                <li><a href="/setting"><i class="fa fa-cog fa-fw"></i> <?= $text_nav_setting ?></a></li>
                <li><a href="/auth/logout"><i class="fa fa-sign-out-alt fa-fw"></i> <?= $text_nav_logOut ?></a></li>
            </ul>
        </div>
    <?php else: ?>
        <div id="dropMenu" class="dropMenu end ">
            <a id="menu-btn" href="/profile"><span class="hidden-xs"><?= $text_login ?></span></a>
        </div>
    <?php endif; ?>
    <a id="lang" class="nav-child end" href="/language"><i class="fa fa-language"></i></a>
</nav>

<div id="sideBarSlider" class="sideBar">
    <ul id="sideBar" class="list-unstyled">
        <li class='<?= $this->parseUrl(['dashboard']) ? 'currentPage' : '' ?>'><a href="/dashboard"><i
                        class="icon-gauge"></i> <?= $text_dashBoard ?></a></li>
        <li class='<?= $this->parseUrl(['FileCategory', 'FileService']) ? 'currentPage' : '' ?>'>
            <a onclick="drop(this)" href="javascript:void(0)"><i
                        class="fas fa-file-alt fa-fw"></i> <?= $text_file_service ?></a>
            <ul>
                <li><a href="/FileCategory"><?= $text_category_manage ?></a></li>
                <li><a href="/FileCategory/add"><?= $text_category_add ?></a></li>
                <li><a href="/FileService"><?= $text_file_service_manage ?></a></li>
                <li><a href="/FileService/add"><?= $text_file_service_add ?></a></li>
            </ul>
        </li>
        <li class='<?= $this->parseUrl(['IMEICategory', 'IMEIService', 'IMEIOrder']) ? 'currentPage' : '' ?>'>
            <a onclick="drop(this)" href="javascript:void(0)"><i class="icon-basket"></i> <?= $text_imei_service ?></a>
            <ul>
                <li><a href="/IMEICategory"><?= $text_category_manage ?></a></li>
                <li><a href="/IMEICategory/add"><?= $text_category_add ?></a></li>
                <li><a href="/IMEIService">ادارة خدمات IMEI</a></li>
                <li><a href="/IMEIService/add">اضافة خدمات IMEI جديدة</a></li>
                <li><a href="/IMEIOrder">طلب خدمات IMEI جديدة</a></li>
            </ul>
        </li>
        <li class='<?= $this->parseUrl(['users', 'usersGroup', 'privilage']) ? 'currentPage' : '' ?>'>
            <a onclick="drop(this)" href="javascript:void(0)"><i class="fa fa-users fa-fw"></i> <?= $text_users ?></a>
            <ul>
                <li><a href="/users"><i class="fa fa-user-cog fa-fw"></i> <?= $text_users_manage ?></a></li>
                <li><a href="/usersGroup"><i class="fa fa-users-cog fa-fw"></i> <?= $text_usersGroup ?></a></li>
                <li><a href="/privilage"><i class="fa fa-user-lock fa-fw"></i> <?= $text_privilage ?></a></li>
            </ul>
        </li>

        <li class='<?= $this->parseUrl(['invoicesOrder', 'invoicesPayment']) ? 'currentPage' : '' ?>'>
            <a onclick="drop(this)" href="javascript:void(0)"><i class="icon-dollar"></i> <?= $text_invoices ?></a>
            <ul>
                <li><a href="/invoicesOrder/IMEI"><?= $text_invoices_order ?></a></li>
                <li><a href="/invoicesOrder/File"><?= $text_invoices_order ?></a></li>
                <li><a href="/invoicesPayment"><?= $text_invoices_payment ?></a></li>
            </ul>
        </li>
        <li class='<?= $this->parseUrl(['currencies']) ? 'currentPage' : '' ?>'>
            <a onclick="drop(this)" href="javascript:void(0)"><i
                        class="fas fa-money-bill-wave"></i> <?= $text_currency ?></a>
            <ul>
                <li><a href="/currencies"><?= $text_currency_manage ?></a></li>
                <li><a href="/currencies/add"><?= $text_currency_add ?></a></li>
            </ul>
        </li>
    </ul>
</div>
