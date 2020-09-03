let sideBarSlider = document.getElementById('sideBarSlider'),
    sideBar = document.getElementById('sideBar'),
    sideBarBTN = document.getElementById('sideBarBTN'),
    menuBtn = document.getElementById('menu-btn'),
    menuBody = document.getElementById('menu-body');

menuBtn.onclick = () => {
    menuBody.classList['value'] = (menuBody.classList['value'] === 'list-unstyled active') ? menuBody.classList['value'] = 'list-unstyled' : menuBody.classList['value'] = 'list-unstyled active';
};

sideBarBTN.onclick = () => {
    if (sideBarSlider.parentElement.classList['value'] === '') {
        sideBarSlider.parentElement.classList['value'] = 'sideBarActive';
        if (window.innerWidth > 750)
            setCookie('_slide_m', 'open', '30');
        else
            setCookie('_slide_m', 'close', '30');
    } else {
        sideBarSlider.parentElement.classList['value'] = '';
        setCookie('_slide_m', 'close', '30');
    }
};

let drop = function (List) {
    let mainList = List.parentElement;
    if (mainList.classList['value'] === 'active') {
        mainList.classList['value'] = '';
    } else {
        activeOne();
        mainList.classList['value'] = 'active';
    }
};

function activeOne() {
    let sideBarElement = sideBar.querySelectorAll('ul');
    for (let i = 0; i < sideBarElement.length; i++)
        if (sideBarElement[i].parentElement.classList['value'] === 'active')
            sideBarElement[i].parentElement.classList['value'] = '';
}

!(function sideBarCheck() {
    let stat = getCookie('_slide_m');
    if (stat === 'open')
        sideBarSlider.parentNode.classList = 'sideBarActive';
    else if (stat === 'close')
        sideBarSlider.parentNode.classList = '';
})();


/**
 * change the order status
 * @param location the page location in the website
 * @param element the element that
 * @param status the status value
 * @param body the data the send to change the status
 */
function changeStatus(location, element, status, body) {
    let request = new SentRequest(location);
    let replay = createReplay();
    document.addEventListener('submit', function submit(event) {
        let response = document.getElementById('response').value;
        request.post([['status', status], ['body', body], ['response', response]]).onLoaded = (object) => {
            element.parentElement.parentElement.innerHTML = object;
            replay.parentElement.parentElement.parentElement.remove();
        };
        event.preventDefault();
    });
}

/**
 * get the orders details from the server
 * @param {string} body the uniq id for the order
 */
function viewOrders(body) {
    let request = new SentRequest('invoicesOrder/show/File');
    request.post([['body', body]]).onLoaded = (object) => {
        createModal('show orders').innerHTML = object;
        let DownloadFile = document.getElementById('file');
        DownloadFile.addEventListener('click', function getFile() {
            DownloadFile.removeEventListener('click', getFile);
            DownloadFile.innerHTML = "<i class='fa fa-spinner fa-pulse'></i> In Process";
            download(DownloadFile);
        });
    };
}

/**
 * download files form the server
 * @param {HTMLElement} fileLink
 */
function download(fileLink) {
    let fileName = fileLink.getAttribute('data');
    let request = new SentRequest('invoicesOrder/Download');
    request.downloadProgress(progressElement()).download(fileName).onLoaded = (object) => {
        fileLink.setAttribute('href', URL.createObjectURL(object));
        fileLink.setAttribute('download', fileName);
        fileLink.innerText = 'Save';
    };
}

/**
 * get the element of progress bar and pass it to the progress function
 * @returns {{bar: *, progress: *, text: *}}
 */
function progressElement() {
    return {
        "progress": document.getElementById('prg'),
        "bar": document.getElementById('bar'),
        "text": document.getElementById('text')
    }
}

/**
 * this function create input form for replaying to the user
 * @returns {ChildNode}
 */
function createReplay() {
    let form = CreateForm();
    form.appendChild(CreateInputField('Order No.', 'response'));
    form.appendChild(CreateInputField('', 'submit', 'replay', 'submit'));
    return createModal('replay to the user').appendChild(form);
}
