import './bootstrap';

window.onload = function () {
    let temp = document.querySelector('.pages-body');
    if (temp) {
        let anchors = document.querySelector('.pages-body').getElementsByTagName('a');
        for (let i = 0; i < anchors.length; i++) {
            anchors[i].setAttribute('target', '_blank');
        }
    }
}
