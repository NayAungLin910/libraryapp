<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('/default_images/logo_transparent.png') }}" />

    <title>@yield('meta-title', 'Library')</title>
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

<body class="font-lato h-screen bg-violet-300">
    <header class="bg-violet-500 shadow-md p-y-1 text-white">
        <nav class="flex gap-4 justify-around md:justify-normal items-center w-[92%] mx-auto p-1">
            <a href="{{ route('home') }}">
                <div class="flex items-center gap-2">
                    <img class="w-12" src="{{ asset('default_images/logo_transparent.png') }}" alt="Beaty Shop Logo">
                    <p class="md:text-base lg:text-xl font-bold">
                        For Your Future
                    </p>
                </div>
            </a>

            <div
                class="nav-links bg-violet-500 md:static absolute ease-in-out transition-all duration-500 md:min-h-fit left-0 top-[-100%] w-full md:w-auto flex items-center px-5 py-2">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8 text-lg">

                    <!-- Search Book -->
                    <li>
                        <a href="{{ route('books.view') }}"
                            class="hover:text-black {{ request()->routeIs('books.view') ? 'text-black' : ''}}">
                            Search Books
                        </a>
                    </li>

                    <!-- Profile -->
                    @if (Auth::check())
                    <li class="group/auth pr-6">
                        <button class=" cursor-pointer" onclick="">
                            <img id="profile-image" src="/storage{{ Auth::user()->image }}"
                                class="max-w-[2.7rem] border rounded-full shadow" loading="lazy"
                                alt="{{ Auth::user()->name }}'s profile image" />
                        </button>
                        <div id="profile-dropdown"
                            class="hidden group-hover/auth:block md:absolute rounded-lg w-auto bg-white text-black shadow py-2 px-1">
                            <ul class="ul-clear">

                                @if (Auth::user()->role === '2')
                                <a class="text-black hover:no-underline" href="{{ route('admin.statistics') }}">
                                    <li class="rounded-lg cursor-pointer px-4 py-2 hover:bg-gray-100">
                                        <div class="flex items-center">
                                            Dashboard
                                        </div>
                                    </li>
                                </a>
                                @endif

                                <!-- Profile -->
                                <a class="text-black hover:no-underline" href="{{ route('user.profile') }}">
                                    <li class="rounded-lg cursor-pointer px-4 py-2 hover:bg-gray-100">
                                        Profile
                                    </li>
                                </a>

                                <li class="rounded-lg p-2 hover:bg-gray-100">
                                    <form id="logout-accept-form" action="{{ route('user.logout') }}" method="POST">
                                        @csrf
                                        <button type="button"
                                            onclick='openPopupSubmit("Are you sure about logging out form your account?", "logout", true)'
                                            class="flex items-center gap-2 w-full">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @else
                    <!-- Not logied yet -->
                    <li class="group/unauth pr-6">
                        <button class="cursor-pointer">
                            <img id="unauth-image" src="{{ asset('storage/default_images/unlogin.png') }}"
                                class="w-12 max-h-12 border rounded-full shadow" loading="lazy"
                                alt="unauthenticated user's profile image" />
                        </button>
                        <div id="unauth-dropdown"
                            class="hidden group-hover/unauth:block md:absolute rounded-lg w-auto bg-white text-black shadow py-2 px-1">
                            <ul class="ul-clear">

                                <!-- Login link -->
                                <a class="text-black hover:no-underline text-base" href="{{ route('auth.login') }}">
                                    <li
                                        class="rounded-lg cursor-pointer px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('auth.login') ? 'bg-gray-100' : '' }}">
                                        Login
                                    </li>
                                </a>

                                <!-- Register link --->
                                <a class="text-black hover:no-underline text-base " href="{{ route('auth.register') }}">
                                    <li
                                        class="rounded-lg cursor-pointer px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('auth.register') ? 'bg-gray-100' : '' }}">
                                        Register
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </li>
                    @endif

                </ul>
            </div>
            <div class="flex items-center gap-6 justify-self-end">
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            </div>
        </nav>
    </header>

    {{-- Slot --}}
    <main class="">
        {{ $slot }}
    </main>

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

    <!-- Menu Toggle Function --->
    <script>
        const navLinks = document.querySelector('.nav-links')

        // mobile toggle
        function onToggleMenu(event) {
            event.name = event.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[3.8rem]')
        }

        // update the profiles
        window.addEventListener('new-profile', event => {
            const profiles = document.querySelectorAll("#profile-image")
            // loop over all the profile images
            for(i = 0; i < profiles.length; ++i) {
                profiles[i].src = "/storage" + event.detail.src // change to new src
            }
        })  
    </script>
</body>

</html>