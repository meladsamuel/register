<!--<canvas id="ctx" width="20" height="10"></canvas>-->
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="collapsible-container">
                <div onclick="collapsible(this)" class="head">
                    <span>last order for files</span>
                </div>
                <div class="body">
                    <table class="table">
                        <tbody>
                        <?php foreach ($file as $value): ?>
                            <tr>
                                <td><?= $value->file_order_id ?></td>
                                <td><?= $value->user_name ?></td>
                                <td><?= $value->file_order_created_date ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="collapsible-container">
                <div onclick="collapsible(this)" class="head">
                    <span>last order for IMEI</span>
                </div>
                <div class="body">
                    <table class="table">
                        <tbody>
                        <?php foreach ($IMEI as $value): ?>
                            <tr>
                                <td><?= $value->imei_order_id ?></td>
                                <td><?= $value->user_name ?></td>
                                <td><?= $value->imei_order_created_date ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-ls-4">
            <div class="card">
                <div class="card-icon"><i class="icon-user"></i></div>
                <div class="card-body">
                    <div>total users</div>
                    <div><?= $userNumber ?></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-ls-4">
            <div class="card">
                <div class="card-icon"><i class="icon-user"></i></div>
                <div class="card-body">
                    <div>total imei service</div>
                    <div><?= $IMEINumber ?></div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-ls-4">
            <div class="card">
                <div class="card-icon"><i class="icon-user"></i></div>
                <div class="card-body">
                    <div>total users</div>
                    <div>241</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-ls-4">
            <div class="card">
                <div class="card-icon"><i class="icon-user"></i></div>
                <div class="card-body">
                    <div>total users</div>
                    <div>241</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-ls-4">
            <div class="card">
                <div class="card-icon"><i class="icon-user"></i></div>
                <div class="card-body">
                    <div>total users</div>
                    <div>241</div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-ls-4">
            <div class="card">
                <div class="card-icon"><i class="icon-user"></i></div>
                <div class="card-body">
                    <div>total users</div>
                    <div>241</div>
                </div>
            </div>
        </div>
    </div>
</div>