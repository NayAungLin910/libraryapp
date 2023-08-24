<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('/default_images/logo_transparent.png') }}" />

    <title>@yield('meta-title', 'Statistics - Library App Dashboard')</title>
    <meta name="description"
        content="@yield('meta-description', 'Library is an online library app where users can find books and download them.')" />
    <link rel="canonical" href='@yield(' meta-canonical', url()->current())' />
    <meta name="robots" content="@yield('meta-robots', 'index, follow')">

    <!-- Open Graph meta tags -->
    <meta property="og:type" content="@yield('meta-og-type', 'website')" />
    <meta property="og:title" content="@yield('meta-og-title', 'Library')" />
    <meta property="og:description"
        content="@yield('meta-og-description', 'Come and find the books you love in Library and also find other books written by your favourite authors.')" />
    <meta property="og:image"
        content="@yield('meta-og-image', asset('/default_images/beauty_shop_white_banner.png'))" />
    <meta property="og:url" content="@yield('meta-og-url', url()->current())" />
    <meta property="og:site_name" content="@yield('meta-og-sitename', 'Library')" />

    <!-- Tailwind css directive -->
    @vite('resources/js/app.js')

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

    <!-- toastify css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Custom Styles -->
    @yield('layout-style')

    @stack('layout-style-stack')
</head>

<body class="font-lato bg-gradient-to-t from-[#e0bad5] to-[#f1b5d8] h-screen">

    <!-- Sidebar button for mobile view -->
    <span class="absolute text-4xl top-2 left-3 cursor-pointer" onclick="toggleSideBar()">
        <ion-icon name="menu-outline" class="bg-pink-900 text-white rounded-md"></ion-icon>
    </span>

    <!-- Sidebar -->
    <div
        class="sidebar text-white bg-pink-700 shadow fixed top-0 bottom-0 lg:left-0 left-[-300px] p-2 w-[300px] overflow-y-auto text-center">
        <div class="text-xl">
            <div class="p-2.5 mt-1 flex items-center">
                <ion-icon name="bar-chart-outline" class="px-2 py-1 bg-pink-900 rounded"></ion-icon>
                <h1 class="font-bold text-[15px] ml-3">Tailwindbar</h1>
                <ion-icon name="close-circle-outline" onclick="toggleSideBar()"
                    class="ml-20 text-2xl cursor-pointer lg:hidden bg-pink-900 rounded-full"></ion-icon>
            </div>
            <hr class="my-2 text-gray-600">
        </div>

        <!--Search -->
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-pink-800">
            <ion-icon name="search-outline" class="text-xl"></ion-icon>
            <input type="text" class="focus:outline-none text-[15px] ml-4 w-full bg-transparent" placeholder="Search">
        </div>

        <!-- Home -->
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-pink-800">
            <ion-icon name="home-outline" class="text-xl"></ion-icon>
            <span class="text-[15px] ml-4">Home</span>
        </div>

        <!-- Bookmark -->
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-pink-800">
            <ion-icon name="bookmark-outline" class="text-xl"></ion-icon>
            <span class="text-[15px] ml-4">Bookmark</span>
        </div>

        <hr class="my-4 text-gray-600">

        <!-- Chatbox -->
        <div onclick="dropDown()"
            class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-pink-800">
            <ion-icon name="chatbubble-outline" class=" text-xl"></ion-icon>
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4">Chatbox</span>
                <span class="text-sm rotate-180 duration-300" id="arrow">
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </span>
            </div>
        </div>

        <!-- Chatbox submenu -->
        <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto " id="submenu">
            <h1 class="cursor-pointer p-2 hover:bg-pink-800 rounded-md mt-1">Social</h1>
            <h1 class="cursor-pointer p-2 hover:bg-pink-800 rounded-md mt-1">Personal</h1>
            <h1 class="cursor-pointer p-2 hover:bg-pink-800 rounded-md mt-1">Friends</h1>
        </div>

        <!-- Logout-->
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-pink-800">
            <ion-icon name="log-out-outline" class="text-xl"></ion-icon>
            <span class="text-[15px] ml-4">Logout</span>
        </div>
    </div>

    <div class="lg:ml-[300px] mt-11 lg:mt-0">
        {{ $slot }}
    </div>

    <!-- Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- toastify js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Custom Scripts -->
    @yield('layout-script')

    @stack('layout-script-stack')

    @include('components.partials.toast')

    <script type="text/javascript">
        // handles submenu dropdown
        function dropDown(){
            document.querySelector('#submenu').classList.toggle('hidden')
            document.querySelector('#arrow').classList.toggle('rotate-0')
        }

        // toggle the sidebar for mobile view
        function toggleSideBar(){
            document.querySelector('.sidebar').classList.toggle('left-[-300px]')
        }
    </script>
</body>

</html>