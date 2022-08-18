import "./bootstrap";

function setContentMarginFromTop() {
    let header = document.querySelector("header.header");
    let cntWrapper = document.querySelector(".content-wrapper");

    if (cntWrapper && header) {
        cntWrapper.style.marginTop = header.offsetHeight + "px";
    }
}

window.onload = function () {
    let temp = document.querySelector(".pages-body");
    if (temp) {
        let anchors = document
            .querySelector(".pages-body")
            .getElementsByTagName("a");
        for (let i = 0; i < anchors.length; i++) {
            anchors[i].setAttribute("target", "_blank");
        }
    }

    setContentMarginFromTop();

    let hamburgerMenu = document.querySelector("#hamburger");

    hamburgerMenu.addEventListener("click", (e) => {
        let sidebar = document.querySelector(".sidebar");
        sidebar.classList.toggle("active");
        e.target.classList.toggle("active");
    });
};

window.addEventListener("resize", () => {
    setContentMarginFromTop();
});
