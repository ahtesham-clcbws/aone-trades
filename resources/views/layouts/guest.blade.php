<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) && $title ? ($title . ' | Aone Trades') : 'Aone Trades - Trade Became Easy' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link
        rel="preload"
        href="/fonts/fa-brands-400.woff2"
        as="font"
        type="font/woff2"
        crossorigin />
    <link
        rel="preload"
        href="/fonts/fa-solid-900.woff2"
        as="font"
        type="font/woff2"
        crossorigin />
    <link
        rel="preload"
        href="/fonts/rubik-v9-latin-regular.woff2"
        as="font"
        type="font/woff2"
        crossorigin />
    <link
        rel="preload"
        href="/fonts/rubik-v9-latin-500.woff2"
        as="font"
        type="font/woff2"
        crossorigin />
    <link
        rel="preload"
        href="/fonts/rubik-v9-latin-300.woff2"
        as="font"
        type="font/woff2"
        crossorigin />
    <link rel="preload" href="/css/style.css" as="style" />
    <link rel="preload" href="/js/vendors/uikit.min.js" as="script" />
    <link rel="preload" href="/js/utilities.min.js" as="script" />
    <link rel="preload" href="/js/config-theme.js" as="script" />
    <!-- stylesheet -->
    <link rel="stylesheet" href="/css/style.css" />
    <!-- uikit -->
    <script src="/js/vendors/uikit.min.js"></script>
    <!-- favicon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <main>
        <div class="uk-section uk-padding-remove-vertical">
            <div class="uk-container uk-container-expand">

                <div class="uk-grid" data-uk-height-viewport="expand: true" style="min-height: 702px">
                    <div class="uk-width-3-5@m uk-background-cover uk-background-center-right uk-visible@m uk-box-shadow-xlarge"
                        style="background-image: url(img/in-signin-image.jpg)">
                    </div>
                    <div class="uk-width-expand@m uk-flex uk-flex-middle">
                        <div class="uk-grid uk-flex-center">
                            <div class="uk-width-3-5@m">

                                {{ $slot }}

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- to top begin -->
    <a href="#" class="to-top uk-visible@m" data-uk-scroll>
        Top<i class="fas fa-chevron-up"></i>
    </a>
    <!-- to top end -->
    <!-- javascript -->
    <script src="/js/utilities.min.js"></script>
    <script src="/js/config-theme.js"></script>
    @livewireScripts
</body>

</html>
