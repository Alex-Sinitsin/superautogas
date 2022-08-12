<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.ttf')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.woff')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.woff2')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.eot')}} as="font">
    <!-- Favicon -->
    <link rel="shortcut icon" href={{asset('images/favicon/favicon.ico')}} type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href={{asset('images/favicon/apple-touch-icon.png')}} />
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('images/favicon/favicon-32x32.png') }} />
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('images/favicon/favicon-16x16.png') }} />
    <link rel="manifest" href={{ asset('sag.webmanifest') }} />
    <link rel="mask-icon" href={{ asset('images/favicon/safari-pinned-tab.svg') }} color="#4daa00" />
    <meta name="msapplication-TileColor" content="#fefefe" />
    <meta name="theme-color" content="#ffffff" />
    @vite('resources/css/app.css')
    @vite('resources/css/admin.css')
    @stack('styles')
    @stack('trix')
</head>

<body class="admin-body">
    <x-header />
    <div class="content-wrapper relative flex h-screen">
        @yield('content')
    </div>

    @vite('resources/js/app.js')
    <script>
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
    </script>
    @stack('scripts')
</body>

</html>