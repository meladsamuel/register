<nav itemscope itemtype="http://schema.org/SiteNavigationElement" class="nav fix">
    <span><a href="<?= $this->oneLanguage() ?>">Shfretak</a></span>
    <span class="end hidden-ms"><i class="fa fa-bars"></i></span>
    <ul class="main-nav list-unstyled list-inline end">
        <li itemtype="name" role="menuitem"><a itemtype="url" title="Shfretak | <?= $file_services ?>" href="<?= WEB_SITE_NAME ?>/<?= $this->session->lang ?>/FilesServices/"><?= $file_services ?></a></li>
        <li itemtype="name" role="menuitem"><a itemtype="url" title="Shfretak | <?= $imei_services ?>" href="<?= WEB_SITE_NAME ?>/<?= $this->session->lang ?>/IMEIServices/"><?=$imei_services ?></a></li>
        <li itemtype="name" role="menuitem"><a itemtype="url" title="Shfretak | <?= $server_services ?>" href=""><?= $server_services?></a></li>
        <li itemtype="name" role="menuitem"><a itemtype="url" title="Shfretak | <?= $about ?>" href=""><?= $about?></a></li>
        <li itemtype="name" role="menuitem"><a itemtype="url" title="Shfretak | <?= $contact ?>" href=""><?= $contact?></a></li>
        <li id="dropMenu" class="dropMenu end ">
            <?php if (isset($this->session->u)): ?>
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
            <?php else: ?>
                <a id="menu-btn" href="/profile"><span><?= $text_login ?></span> <i
                            class="fa fa-sign-in-alt fw "></i></a>
            <?php endif; ?>
        </li>
    </ul>
</nav>