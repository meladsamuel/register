
<div class="ViewBody">
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
