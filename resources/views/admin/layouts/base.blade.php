<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.ttf')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.woff')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.woff2')}} as="font">
    <link rel="prefetch" href={{asset('/fonts/Material-Design-Iconic-Font.eot')}} as="font">
    <!-- Favicon -->
    <link rel="shortcut icon" href={{asset('images/favicon/favicon.ico')}} type="image/x-icon"/>
    <link rel="apple-touch-icon" sizes="180x180" href={{asset('images/favicon/apple-touch-icon.png')}} />
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('images/favicon/favicon-32x32.png') }} />
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('images/favicon/favicon-16x16.png') }} />
    <link rel="manifest" href={{ asset('sag.webmanifest') }}/>
    <link rel="mask-icon" href={{ asset('images/favicon/safari-pinned-tab.svg') }} color="#4daa00"/>
    <meta name="msapplication-TileColor" content="#fefefe"/>
    <meta name="theme-color" content="#ffffff"/>
    @vite('resources/css/app.css')
</head>
<body>
    <x-header/>
    <div class="content-wrapper absolute top-[56px] left-0 right-0 bottom-0 flex">
        @if(session()->has('success'))
            <p>{{ session()->get('success') }}</p>
        @endif
        @yield('content')
    </div>

</body>
</html>
