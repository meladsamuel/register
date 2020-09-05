<div class="container">
    <?php $messages = $this->messenger->getMessages(); if(!empty($messages)): foreach($messages as $message): ?>
        <div class="alert <?= $message[1] === 'success' ? 'alert-success': 'alert-danger' ?>">
            <?= $message[0] ?>
        </div>
    <?php endforeach; endif; ?>
</div>
<div class="container">
    <form class="form" method="post">
        <?php if (isset($msgs)): foreach ($msgs as $key => $msg): foreach ($msg as $value): ?>
            <div class="alert <?= $key == 'success'? 'alert-success' : 'alert-danger'?>" role="alert">
                <?= $value ?>
            </div>
        <?php endforeach; endforeach; endif; ?>
        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <div class="form-row">
            <div class="form-group col">
                <input type="text" name="firstName" class="form-control" placeholder="First name" maxlength="14">
            </div>
            <div class="form-group col">
                <input type="text" name="lastName" class="form-control" placeholder="Last name" maxlength="14">
            </div>
            <div class="form-group col-12">
                <input type="email" name="email" id="email" class="form-control" placeholder="username@domain.com"
                       >
            </div>
            <div class="form-group col-12">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                       >
            </div>
            <div class="form-group col-12">
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number"
                       maxlength="14" >
            </div>
            <div class="form-group col-12">
                <input type="text" name="address" id="address" class="form-control" placeholder="address"
                       >
            </div>
            <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">Login</button>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; 2020-<?= date('Y') ?></p>
    </form>
</div>
