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

<body class="font-lato bg-purple-400">

    <!-- Sidebar button for mobile view -->
    <span class="absolute text-4xl top-2 left-3 cursor-pointer" onclick="toggleSideBar()">
        <ion-icon name="menu-outline" class="bg-purple-900 text-white rounded-md"></ion-icon>
    </span>

    <!-- Sidebar -->
    <div
        class="sidebar text-white bg-purple-700 shadow fixed top-0 bottom-0 lg:left-0 left-[-300px] p-2 w-[300px] overflow-y-auto text-center">

        <!-- side bar toggle for mobile view --->
        <div class="flex items-center place-content-end lg:hidden">
            <ion-icon name="close-circle-outline" onclick="toggleSideBar()"
                class=" text-3xl cursor-pointer lg:hidden bg-purple-900 rounded-full float-right"></ion-icon>
        </div>

        <!-- Home -->
        <a href="{{ route('home') }}">
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-purple-800">
                <ion-icon name="arrow-back-outline" class="text-xl"></ion-icon>
                <span class="text-[15px] ml-4">Back</span>
            </div>
        </a>

        <!-- Statistics -->
        <a href="{{ route('admin.statistics') }}">
            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-purple-800 {{ request()->routeIs('admin.statistics') ? 'bg-purple-800' : '' }}">
                <ion-icon name="stats-chart-outline" class="text-xl"></ion-icon>
                <span class="text-[15px] ml-4">Statistics</span>
            </div>
        </a>

        <!-- Tags -->
        <a href="{{ route('admin.tags') }}">
            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-purple-800 {{ request()->routeIs('admin.tags') ? 'bg-purple-800' : '' }}">
                <ion-icon name="pricetag-outline" class="text-xl"></ion-icon>
                <span class="text-[15px] ml-4">Tags</span>
            </div>
        </a>

        <!-- Author -->
        <div onclick="dropDown('author')"
            class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-purple-800">
            <ion-icon name="pencil-outline" class=" text-xl"></ion-icon>
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4">Author</span>
                <span class="text-sm duration-300 {{ !request()->is('admin/dashboard/authors*') ? '' : 'rotate-180' }}"
                    id="author-arrow">
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </span>
            </div>
        </div>

        <!-- Author submenu -->
        <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto {{ !request()->is('admin/dashboard/authors*') ? 'hidden' : '' }}"
            id="author-submenu">

            <!-- Create Author -->
            <a href="{{ route('admin.authors.create') }}">
                <h1
                    class="cursor-pointer p-2 hover:bg-purple-800 rounded-md mt-1 {{ request()->routeIs('admin.authors.create') ? 'bg-purple-800' : '' }}">
                    Create</h1>
            </a>

            <!-- View Auhors -->
            <a href="{{ route('admin.authors.view') }}">
                <h1
                    class="cursor-pointer p-2 hover:bg-purple-800 rounded-md mt-1 {{ request()->routeIs('admin.authors.view') ? 'bg-purple-800' : '' }}">
                    View</h1>
            </a>

        </div>

        <!-- Book -->
        <div onclick="dropDown('book')"
            class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-purple-800">
            <ion-icon name="book-outline" class=" text-xl"></ion-icon>
            <div class="flex justify-between w-full items-center">
                <span class="text-[15px] ml-4">Book</span>
                <span class="text-sm duration-300 {{ !request()->is('admin/dashboard/books*') ? '' : 'rotate-180' }}"
                    id="book-arrow">
                    <ion-icon name="chevron-down-outline"></ion-icon>
                </span>
            </div>
        </div>

        <!-- Book submenu -->
        <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto {{ !request()->is('admin/dashboard/books*') ? 'hidden' : '' }}"
            id="book-submenu">

            <!-- Create Book -->
            <a href="{{ route('admin.books.create') }}">
                <h1
                    class="cursor-pointer p-2 hover:bg-purple-800 rounded-md mt-1 {{ request()->routeIs('admin.books.create') ? 'bg-purple-800' : '' }}">
                    Create</h1>
            </a>

            <!-- View Book -->
            <a href="{{ route('admin.books.view') }}">
                <h1
                    class="cursor-pointer p-2 hover:bg-purple-800 rounded-md mt-1 {{ request()->routeIs('admin.books.view') ? 'bg-purple-800' : '' }}">
                    View</h1>
            </a>

        </div>

        <hr class="my-4 text-gray-600">

        <!-- Accounts -->
        <a href="{{ route('admin.accounts') }}">
            <div
                class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-purple-800 {{ request()->routeIs('admin.accounts') ? 'bg-purple-800' : '' }}">
                <ion-icon name="receipt-outline"></ion-icon>
                <span class="text-[15px] ml-4">Accounts</span>
            </div>
        </a>

    </div>

    <div class="lg:ml-[300px] mt-11 lg:mt-0 pb-4">
        {{ $slot }}
    </div>

    <!-- popup -->
    <div class="bg-slate-100 duration-200 ease-in-out rounded-xl fixed top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] shadow-md w-full md:w-auto z-30 py-6 px-4 scale-0 border-t-8"
        id="popup">
        <p class="text-lg font-semibold text-center" id="popup-text"></p>
        <div class="flex items-center gap-2 place-content-center mt-4">
            <button class="button-white-rounded w-auto" onclick="closePopup()">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </button>
            <button class="button-violet-rounded w-auto" onclick="acceptPopup()">
                <i class="fa-solid fa-check"></i>
                Accept
            </button>
        </div>
    </div>

    <!-- popup overlay -->
    <div class="duration-200 ease-in-out opacity-0 fixed top-0 left-0 bottom-0 right-0 bg-black/[0.5] z-20 pointer-events-none"
        id="popup-overlay" onclick="closePopup()">
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

    @include('components.partials.popup')

    <script type="text/javascript">
        // handles submenu dropdown
        function dropDown(type){
            document.querySelector(`#${type}-submenu`).classList.toggle('hidden')
            document.querySelector(`#${type}-arrow`).classList.toggle('rotate-180')
        }

        // toggle the sidebar for mobile view
        function toggleSideBar(){
            document.querySelector('.sidebar').classList.toggle('left-[-300px]')
        }
    </script>
</body>

</html>