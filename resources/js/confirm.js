const Confirm = {
    open(options) {
        Object.assign(
            {},
            {
                title: "Подтверждение",
                body: "",
                okText: "Да",
                cancelText: "Нет",
                onOk: () => {},
                onCancel: () => {},
            },
            options
        );

        const HTML = `
            <div class="confirm animate__animated animate__fadeIn">
                <div class="confirm-window">
                    <div class="confirm-window__title">
                        <h5 class="confirm-window__text font-bold text-lg">${options.title}</h5>
                        <button class="confirm-window__close">&times;</button>
                    </div>
                    <div class="confirm-window__body">
                        <p>${options.body}</p>
                    </div>
                    <div class="confirm-window__footer">
                        <button class="confirm-window__ok">${options.okText}</button>
                        <button class="confirm-window__cancel">${options.cancelText}</button>
                    </div>
                </div>
            </div>
        `;

        const template = document.createElement("template");
        template.innerHTML = HTML;

        // Elements
        const confirmEl = template.content.querySelector(".confirm");
        const btnClose = template.content.querySelector(
            ".confirm-window__close"
        );
        const btnOk = template.content.querySelector(".confirm-window__ok");
        const btnCancel = template.content.querySelector(
            ".confirm-window__cancel"
        );

        document.body.appendChild(template.content);

        btnOk.addEventListener("click", () => {
            options.onOk();
            this._close(confirmEl);
        });

        [btnCancel, btnClose].forEach((el) => {
            el.addEventListener("click", () => {
                options.onCancel();
                this._close(confirmEl);
            });
        });
    },

    _close(confirmEl) {
        confirmEl.classList.remove("animate__fadeIn");
        confirmEl.classList.add("hide");

        confirmEl.addEventListener("animationend", () => {
            document.body.removeChild(confirmEl);
        });
    },
};
