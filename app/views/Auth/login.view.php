<div class="container">
<?php $messages = $this->massenger->getMessages(); if(!empty($messages)): foreach($messages as $message): ?>
      <div class="alert <?= $message[1] ?>">
            <span class="end" onclick="alertC(this)" ><i class="icon-cancel"></i></span>
            <i class="icon-attention-circled"></i>
            <strong><?= $this->language->get('text_message_'.$message[1])?></strong> 
            <?= $message[0] . "\n" ?>
      </div>
<?php endforeach; endif; ?>
</div>
<div class="loginContainer">
      <form method="POST" class="loginForm">
            <div>
                  <span><i class="fa fa-user"></i></span>
                  <input type="text" name="userName" placeholder="<?= $text_login_user_name ?>" autocomplete="off">
            </div>
            <div>
                  <span><i class="fa fa-key"></i></span>
                  <input type="password" name="password" placeholder="<?= $text_login_user_password ?>" autocomplete="off">
            </div>
            <input type="submit" name="login" value="<?= $text_login_user_login ?>">
      </form>
</div>