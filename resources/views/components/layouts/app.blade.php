@php($title = isset($title) ? $title : '')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#FCB42D">
    <!-- preload assets -->
    <link rel="preload" href="/fonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/rubik-v9-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/rubik-v9-latin-500.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/rubik-v9-latin-300.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/css/style.css" as="style">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- stylesheet -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>{{ isset($title) && $title ? ($title . ' | Aone Trades') : 'Aone Trades - Trade Became Easy' }}</title>
</head>

<body>
    <livewire:website.partials.header :title="$title" />
    <main>
        {{ $slot }}
    </main>
    <livewire:website.partials.footer />

    <a href="#" class="to-top uk-visible@m" data-uk-scroll>
        Top<i class="fas fa-chevron-up"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- uikit -->
    <script src="/js/vendors/uikit.min.js"></script>
    <script src="/js/utilities.min.js"></script>
    <script src="/js/config-theme.js"></script>


    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 3, // Default number of items to display
                loop: true, // Infinite loop
                margin: 10, // Space between items
                autoplay: true, // Auto play
                autoplayTimeout: 3000, // Delay between auto play
                nav: true, // Show navigation buttons
                dots: true, // Show dot indicators
                responsive: {
                    0: {
                        items: 1 // 1 item for small screens
                    },
                    600: {
                        items: 1 // 2 items for medium screens
                    },
                    1000: {
                        items: 3 // 3 items for larger screens
                    }
                }
            });
        });
    </script>
</body>

</html>
