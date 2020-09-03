<div class="nav fix">
    <span>Shfretak</span>
    <a id="sideBarBTN"  href="javascript:void(0)"><i class="fa fa-bars fa-fw"></i></a>
    <?php if(isset($this->session->u)): ?>
        <div id="dropMenu" class="dropMenu end ">
            <a id="menu-btn" href="javascript:void(0)"><span class="hidden-xs"><?= $this->session->u->user_name?></span><i class='fa fa-angle-down fa-fw'></i></a>
            <ul id="menu-body" class="list-unstyled">
                <li><a><?= $this->session->u->user_balance  * $this->session->currency_amount?> <?= $this->session->u->user_currency ?></a></li>
                <li><a href="/profile"><i class="fa fa-user-circle fa-fw"></i> <?= $text_nav_profile ?></a></li>
                <li><a href="/payment/cryptoCurrency"><i class="fab fa-bitcoin fa-fw"></i> <?= $text_nav_cryptoCurrency?></a></li>
                <li><a href="/setting"><i class="fa fa-cog fa-fw"></i> <?= $text_nav_setting ?></a></li>
                <li><a href="/auth/logout"><i class="fa fa-sign-out-alt fa-fw"></i> <?= $text_nav_logOut?></a></li>
            </ul>
        </div>
    <?php else: ?>
        <div id="dropMenu" class="dropMenu end ">
            <a id="menu-btn" href="/profile"><span class="hidden-xs"><?= $text_login ?></span></a>
        </div>
    <?php endif; ?>
    <a id="lang" class="nav-child end" href="/language"><i class="fa fa-language"></i></a>
</div>

<div id="sideBarSlider" class="sideBar">
      <ul id="sideBar" class="list-unstyled">
            <li class='<?= $this->parseUrl(['dashboard']) ? 'currentPage' : '' ?>'><a href="/dashboard"><i class="icon-gauge"></i> <?= $text_dashBoard ?></a></li>
            <li class='<?= $this->parseUrl(['IMEICategory']) ? 'currentPage' : '' ?>'>
                  <a  onclick="drop(this)" href="javascript:void(0)"><i class="icon-basket"></i> <?= $text_imei_service ?></a>
                  <ul>
                        <li><a href="/IMEICategory/PlaceOrder">طلب خدمة </a></li>
                  </ul>
            </li>

      </ul>
</div>
