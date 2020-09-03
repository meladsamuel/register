function insertCategory(services, categoryBody) {
    var table = document.createElement('table'),
        thead = document.createElement('thead'),
        tbody = document.createElement('tbody'),
        tr = document.createElement('tr'),
        array = ['title', 'prices', 'time delivery'];
    categoryBody.appendChild(table);
    table.classList = 'table';

    array.forEach(element => {
        var th = document.createElement('th');
        table.appendChild(thead).appendChild(tr).appendChild(th).appendChild(document.createTextNode(element));
    });

    for (var i = 0; i < services.title.length; i++) {
        var trs = table.appendChild(tbody).appendChild(document.createElement('tr'));
        var title = document.createElement('td');
        title.appendChild(document.createTextNode(services.title[i]));
        trs.appendChild(title);
        var price = document.createElement('td');
        price.appendChild(document.createTextNode(services.price[i]));
        trs.appendChild(price);
        var time = document.createElement('td');
        time.appendChild(document.createTextNode(services.time[i]));
        trs.appendChild(time);
    }
}

// (function(){
//       var input_field = document.querySelector('input.IMEI'),
//           output = document.querySelector('span.IMEI_check');
//       /*
//       * this function check the last number for validate the IMEI  code
//       * @param {string} code - the IMEI code that enter
//       * */
//       function IMEI_check(code) {
//             var len = code.length;
//             var sum = 0;
//             for(var i=0; i<len; i++){
//                   var digit = parseInt(code.charAt(i));
//                   if(i%2 != 0){
//                         digit *=2;
//                         if (digit > 9) digit -=9;
//                   }
//                   sum += digit;
//             }
//             return (sum * 9) % 10;
//       }
//       // inner the check number in the page
//       input_field.addEventListener('keyup', function() {
//             output.textContent = IMEI_check(input_field.value);
//       });
//       var imei_add = document.getElementById('btn_imei');
//       var i =2;
//       imei_add.onclick = function() {
//
//
//             var imei_container = document.getElementById('imei');
//
//             var input_section = document.createElement('div');
//             input_section.className = 'input-section';
//
//             var input_label = document.createElement('label');
//             input_label.className = 'input-content force-l';
//             input_label.setAttribute('for', 'IMEI' + i);
//             var label_span = document.createElement('span');
//             var label_text = document.createTextNode(' IMEI Code ' + i);
//
//             var input = document.createElement('input');
//             input.type = 'text';
//             input.setAttribute('name', 'IMEI[]');
//             input.setAttribute('id', 'IMEI' + i);
//             input.setAttribute('required','');
//             input.setAttribute('dir','auto');
//             input.setAttribute('maxLength','14');
//
//             var imei_check = document.createElement('span');
//             imei_check.setAttribute('id', 'imei'+i);
//             imei_check.className = 'IMEI_check';
//
//
//             input_section.appendChild(imei_check);
//             input_section.appendChild(input);
//             label_span.appendChild(label_text);
//             input_label.appendChild(label_span);
//             input_section.appendChild(input_label);
//             imei_container.appendChild(input_section);
//             i++;
//             input.addEventListener('keyup', function() {
//                   imei_check.textContent = IMEI_check(input.value);
//             });
//       }
// })();

/**
 * This object for sending request to the server with AJAX
 * @param source
 * @constructor
 */
function SentRequest(source) {
    /**
     * The location of the page that send the request to it
     * @type {string}
     */
    this.source = source;
    /**
     * Get the domain of the website
     * @type {string}
     */
    this.host = window.location.origin;
    /**
     * @property XMLHttpRequest the ajax object
     * */
    this.ajax = new XMLHttpRequest();
    /**
     * sent post request the server and get the value
     * @param {Object} body <p>
     *     the request body : you can enter the args as array
     *     </p>
     * @return {SentRequest}
     * */
    this.post = function (body = null) {
        this.ajax.open("POST", this.host + '/' + this.source, true);
        this.ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        let content = '';
        if (body != null)
            for (let args of body)
                content += args[0] + '=' + args[1] + '&';
        this.ajax.send(content);
        return this;
    };
    /**
     * send get request to the server
     * @param {string} arg <p>
     *     the argument that pass the page with the request
     *     </p>
     * @return {SentRequest}
     * */
    this.get = function (arg = '') {
        this.ajax.open("GET", this.host + '/' + this.source + '/' + arg);
        this.ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        this.ajax.send();
        return this;
    };
    /**
     * send files to the server
     * @param {Object} body <p> this is the file object that you want upload it</p>
     * @return {SentRequest}
     * */
    this.file = function (body) {
        this.ajax.open('POST', this.host + '/' + this.source, true);
        this.ajax.send(body);
        return this;
    };
    /**
     * download file from the server
     * @param {string} arg <p> this is the file object that you want upload it</p>
     * @return {SentRequest}
     * */
    this.download = function (arg = '') {
        this.ajax.open("GET", this.host + '/' + this.source + '/' + arg, true);
        this.ajax.responseType = 'blob';
        this.ajax.send();
        return this;
    };
    /**
     * when the response received the onLoaded function will call
     * @return {void}
     * */
    this.ajax.onreadystatechange = () => {
        if (this.ajax.readyState === 4 && this.ajax.status === 200) {
            console.log(this.ajax.responseType);
            if (this.ajax.responseType !== 'blob')
                this.onLoaded(this.ajax.responseText);
            else
                this.onLoaded(this.ajax.response);
        }
    };
    /**
     * create Event progress to listen to uploading process and show it the HTML element
     * @param {object} prg  HTML Object the container element that consist of progress bar
     * @param {object} bar  HTML Object the progress bar that increase
     * @param {object} text HTML Object the uploading number in percentage
     * @returns {SentRequest}
     */
    this.addProgress = function (prg, bar, text) {
        this.ajax.upload.addEventListener('progress', function (event) {
            let percent = (event.loaded / event.total) * 100;
            prg.style.display = 'block';
            bar.style.width = percent.toFixed(2) + '%';
            text.innerText = percent.toFixed(2) + '%';
        }, true);
        return this;
    };
    /**
     * create Event progress to listen to Downloading process and show it the HTML element
     * @param {object} obj  HTML Object that contain the elements of progress
     * @returns {SentRequest}
     */
    this.downloadProgress = function (obj) {
        this.ajax.addEventListener('progress', function (e) {
            let percent = (e.loaded / e.total) * 100;
            obj.progress.style.display = 'block';
            obj.bar.style.width = percent.toFixed(2) + '%';
            obj.text.innerText = percent.toFixed(2) + '%';
        }, true);
        return this;
    };
    this.onLoaded = () => {
    };
}

/**
 * redirect to the specific page
 * @param {string} path <p>the path of the page that you want to redirect for it</p>
 * @param {number} time <p> the redirect after n time in second  </p>
 */
function redirect(path, time = 0) {
    this.path = path;
    setTimeout(() => {
        window.location.href = window.location.origin + '/' + this.path;
    }, time);
}

/**
 * set new cookies in user browser
 * @param cookieName cookie name in the browser
 * @param cookieValue cookie value in the browser
 * @param expiresDays the expires day for the cookie
 */
function setCookie(cookieName, cookieValue, expiresDays) {
    let d = new Date();
    d.setTime(d.getTime() + (expiresDays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
}

/**
 * get the cookies that store in user browser
 * @param cookieName the name of the cookie
 * @returns {string}
 */
function getCookie(cookieName) {
    let name = cookieName + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/**
 * make the box collapsible
 * @param element
 */
function collapsible(element) {
    let boxBody = element.nextElementSibling;
    boxBody.style.maxHeight = boxBody.style.maxHeight ? null : boxBody.scrollHeight + "px";
}

/**
 * this function create text, password, hidden input
 * @param {string} label the label field
 * @param {string} fieldName the name of the input field
 * @param {string} fieldValue the value of input field
 * @param {string} type the type of input field
 * @returns {ChildNode}
 */
function CreateInputField(label, fieldName, fieldValue = '', type = "text") {
    let tmp = document.createElement('div');
    if (type !== "hidden" && type !== "submit")
        tmp.innerHTML = `<div class="input-section"><input type="${type}" name="${fieldName}" id="${fieldName}" autocomplete="off" dir="auto" required="required">
            <label for="${fieldName}" class="input-content"><span>${label}</span></label></div>`;
    else if (type === "submit")
        tmp.innerHTML =  `<input class="btn_add" type="submit" name="${fieldName}" value="${fieldValue}" >`;
    else
        tmp.innerHTML =  `<input type="hidden" name="${fieldName}" value="${fieldValue}" >`;
    return tmp.firstChild;
}

/**
 * create the form and return it with method and you can enter the field inside it
 * @param {string} action the form action
 * @param {string} method the from method
 */
function CreateForm(action = '', method = 'POST') {
    let tmp = document.createElement('div');
    tmp.innerHTML = `<form class="form" method="${method}" action="${action}"></form>`;
    return tmp.firstChild;
}

/**
 * create modal box
 * @param head the message that display in the top of modal
 * @returns {HTMLElement}
 */
function createModal(head) {
    let container = createContainer();
    container.innerHTML = `<div class="modal">
        <div class="content">
            <div class="content-header">
                <span id="close" class="model-close end"><i class="fa fa-times"></i></span>
                <span>${head}</span>
            </div>
            <div id="modal" class="content-body"></div>
        </div>
    </div>`;
    let close = document.getElementById('close');
    close.addEventListener('click', function closeModal() {
        close.removeEventListener('click', this);
        container.remove()
    });
    return document.getElementById('modal');
}

/**
 * create div with container class
 * @returns {HTMLDivElement}
 */
function createContainer() {
    let container = document.createElement('div');
    container.className = "container";
    document.body.appendChild(container);
    return container;
}