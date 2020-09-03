<div class="container">
      <h1><?= $text_profile ?></h1>
      <h2><?= $text_contact_details ?></h2>
      <span><?= $text_user_name ?></span>
      <?= $this->session->u->user_name ?>
      <span><?= $text_user_email ?></span>
      <?= $this->session->u->user_email ?> <br>
      <span><?= $this->session->u->user_balance * $this->session->currency_amount ?> <?= $this->session->u->user_currency  ?></span>
      <h2><?= $text_other_details ?></h2>
      <span><?= $text_user_phoneNumber ?></span>
      <?= $this->session->u->profile->user_profile_phone_number ?>  <br>
      <span><?= $text_user_firstName ?></span>
      <?= $this->session->u->profile->user_profile_first_name ?>  <br>
      <span><?= $text_user_lastName ?></span>
      <?= $this->session->u->profile->user_profile_last_name ?>  <br>
      <span><?= $text_user_last_login ?></span>
      <?= $this->session->u->user_last_login ?>  <br>


      <?php //TODO dont forget add the countery selector and language selector ?>
</div>

