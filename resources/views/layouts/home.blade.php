<!doctype html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include SweetAlert2 CSS and JavaScript -->
    <link rel="stylesheet" href="@sweetalert2/theme-bulma/bulma.css">

    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.js" integrity="sha512-6m6AtgVSg7JzStQBuIpqoVuGPVSAK5Sp/ti6ySu6AjRDa1pX8mIl1TwP9QmKXU+4Mhq/73SzOk6mbNvyj9MPzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>


    @vite('resources/css/app.css')
    <title>Livre-books</title>



</head>

<body>


<header>
    <div class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <div class="hidden w-full text-gray-600 md:flex md:items-center">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.06298 10.063 6.27212 12.2721 6.27212C14.4813 6.27212 16.2721 8.06298 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16755 11.1676 8.27212 12.2721 8.27212C13.3767 8.27212 14.2721 9.16755 14.2721 10.2721Z" fill="currentColor" /><path fill-rule="evenodd" clip-rule="evenodd" d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.39409 5.48178 3.79417C8.90918 0.194243 14.6059 0.054383 18.2059 3.48178C21.8058 6.90918 21.9457 12.6059 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.97318 6.93028 5.17324C9.59603 2.3733 14.0268 2.26452 16.8268 4.93028C19.6267 7.59603 19.7355 12.0268 17.0698 14.8268Z" fill="currentColor" />
                </svg>
                <span class="mx-1 text-sm">SRILANKA</span>
            </div>
            <div class="w-full text-gray-700 md:text-center text-2xl font-semibold">
                LIVRE .
            </div>

            <div class="flex items-center justify-end w-full">



                <div class="flex sm:hidden">
                    <button @click="isOpen = !isOpen" type="button" class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500" aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                            <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                        </svg>
                    </button>

                </div>





            </div >
            <div class="navbar-end">

                @if (Route::has('login'))
                    <div class>
                        @auth
                            <a href="{{ route('user.dashboard') }}" class="font-semibold text-primary hover:text-neutral focus:outline focus:outline-2 focus:rounded-sm focus:outline-secondary">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-primary hover:text-neutral focus:outline focus:outline-2 focus:rounded-sm focus:outline-secondary ">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-primary hover:text-secondary focus:outline focus:outline-2 focus:rounded-sm focus:outline-secondary">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
        <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
            <div class="flex flex-col sm:flex-row">
                <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Home</a>
                <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Shop</a>
                <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Categories</a>
                <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Contact</a>
                <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a>
            </div>
        </nav>
        <div class="relative mt-6 max-w-lg mx-auto">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>

            <input class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline" type="text" placeholder="Search">
        </div>
    </div>
</header>
<body >







<main>
    @yield('content')
</main>



    <footer>
        <svg xmlns="http://www.w3.org/2000/svg" class="-mb-0.5 w-full" viewBox="0 0 1367.743 181.155">
            <path
                class="fill-current text-gray-100 dark:text-gray-800"
                id="wave"
                data-name="wave"
                d="M0,0S166.91-56.211,405.877-49.5,715.838,14.48,955.869,26.854,1366,0,1366,0V115H0Z"
                transform="translate(1.743 66.155)"
            ></path>
        </svg>
        <div class="bg-gradient-to-b from-gray-100 to-transparent dark:from-gray-800 dark:to-transparent pt-1">
            <div class="container m-auto space-y-8 px-6 text-gray-600 dark:text-gray-400 md:px-12 lg:px-20">
                <div class="grid grid-cols-8 gap-6 md:gap-0">
                    <div class="col-span-8 border-r border-gray-100 dark:border-gray-800 md:col-span-2 lg:col-span-3">
                        <div
                            class="flex items-center justify-between gap-6 border-b border-white dark:border-gray-800 py-6 md:block md:space-y-6 md:border-none md:py-0"
                        >
                            <img src="images/logo.svg" alt="logo tailus" width="100" height="42" class="w-32 dark:brightness-200 dark:grayscale" />
                            <div class="flex gap-6">
                                <a href="#" target="blank" aria-label="github" class="hover:text-cyan-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="currentColor"
                                        class="bi bi-github"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"
                                        />
                                    </svg>
                                </a>
                                <a href="#" target="blank" aria-label="twitter" class="hover:text-cyan-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="currentColor"
                                        class="bi bi-twitter"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"
                                        />
                                    </svg>
                                </a>
                                <a href="#" target="blank" aria-label="medium" class="hover:text-cyan-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="currentColor"
                                        class="bi bi-medium"
                                        viewBox="0 0 16 16"
                                    >
                                        <path
                                            d="M9.025 8c0 2.485-2.02 4.5-4.513 4.5A4.506 4.506 0 0 1 0 8c0-2.486 2.02-4.5 4.512-4.5A4.506 4.506 0 0 1 9.025 8zm4.95 0c0 2.34-1.01 4.236-2.256 4.236-1.246 0-2.256-1.897-2.256-4.236 0-2.34 1.01-4.236 2.256-4.236 1.246 0 2.256 1.897 2.256 4.236zM16 8c0 2.096-.355 3.795-.794 3.795-.438 0-.793-1.7-.793-3.795 0-2.096.355-3.795.794-3.795.438 0 .793 1.699.793 3.795z"
                                        />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-8 md:col-span-6 lg:col-span-5">
                        <div class="grid grid-cols-2 gap-6 pb-16 sm:grid-cols-3 md:pl-16">
                            <div>
                                <h6 class="text-lg font-medium text-gray-800 dark:text-gray-200">Company</h6>
                                <ul class="mt-4 list-inside space-y-4">
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">About</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Customers</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Enterprise</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Partners</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Jobs</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h6 class="text-lg font-medium text-gray-800 dark:text-gray-200">Products</h6>
                                <ul class="mt-4 list-inside space-y-4">
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">About</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Customers</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Enterprise</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Partners</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Jobs</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h6 class="text-lg font-medium text-gray-800 dark:text-gray-200">Ressources</h6>
                                <ul class="mt-4 list-inside space-y-4">
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">About</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Customers</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Enterprise</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Partners</a>
                                    </li>
                                    <li>
                                        <a href="#" class="transition hover:text-cyan-600">Jobs</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex justify-between border-t border-gray-100 dark:border-gray-800 py-4 pb-8 md:pl-16">
                            <span>&copy; tailus 2003 - <span id="year"></span> </span>
                            <span>All right reserved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<!-- JavaScript for displaying the pop-up -->

</div>
</body>
</html>
