<div class="container" id="container"></div>
<div class="container">


<form class="form" id="form" method="post" enctype="multipart/form-data">
    <select name="serviceCategories" id="mySelect">
        <option value="0" hidden><?= $text_form_serviceCategories ?></option>
        <?php if(isset($catService)): foreach($catService as $key => $values ): ?>
        <option disabled><?= $key ?></option>
        <?php for($i=0; $i<count($values[0]); $i++): ?>
        <option value="<?= $values[0][$i] ?>" <?= $this->selected_A('serviceCategories', $values[0][$i]) ?> ><?= $values[1][$i] ?></option>
        <?php endfor; ?>
        <?php endforeach; endif;?>
    </select>

    <div class="input-section">
        <input type="text" name="note" id="note" value="<?= $this->showValue('note')?>" autocomplete="off">
        <label for="note" class="input-content"><span></span></label>
    </div>
    <div class="input-section">
        <input type="file" name="file" id="file" value="<?= $this->showValue('file')?>" autocomplete="off">
        <label for="file" class="input-content"><span></span></label>
    </div>
        <div id="prg" class="progress">
            <div id="bar" class="bar"><div class="text" id="text">0%</div></div>
        </div>
    <button id="makeOrder" type="submit" name="makeOrder" ><?= $text_form_order ?></button>
</form>
</div>

<script>
    var form = document.getElementById('form'),
        content = document.getElementById('container'),
        makeOrder = document.getElementById('makeOrder'),
        bar = document.getElementById('bar'),
        prg = document.getElementById('prg'),
        text = document.getElementById('text');
    form.onsubmit = function() {
        makeOrder.innerHTML = "<i class='fas fa-spinner fa-pulse'></i>";
        let formData = new FormData(this);
        var senders = new SentRequest('FileOrder/upload');

        senders.onLoaded = function(data) {
            console.log(data);
            var getter = new SentRequest('Msg');
            if(data == 0) {
                //  you can use redirect function here
                getter.get();
            }else if(data == 1) {
                getter.get();
            }
            getter.onLoaded = function(data) {
                content.innerHTML= data;
                makeOrder.innerHTML = "done";

            }
        };
        senders.addProgress(prg, bar, text).file(formData);

        return false;
    };




</script>