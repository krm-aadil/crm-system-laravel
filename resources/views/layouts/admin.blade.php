<!doctype html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css
" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>

    <!-- Add this to the <head> section of your HTML -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Add this before the closing </body> tag of your HTML -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    @include('sweetalert::alert')

    @vite('resources/css/app.css')
    <title>Livre-books</title>



</head>

<body>



<header>
    <aside class="ml-[-100%] fixed z-10 top-0 pb-3 px-6 w-full flex flex-col justify-between h-screen border-r bg-white transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
        <div>
            <div class="-mx-6 px-6 py-4">
                <a href="{{route('welcome')}}" title="home">
                    <img src="https://tailus.io/sources/blocks/stats-cards/preview/images/logo.svg" class="w-32" alt="tailus logo">
                </a>
            </div>

           <a  href="/user/profile">
               <div class="mt-8 text-center">
                   <img src="https://tailus.io/sources/blocks/stats-cards/preview/images/second_user.webp" alt="" class="w-10 h-10 m-auto rounded-full object-cover lg:w-28 lg:h-28">
                   <h5 class="hidden mt-4 text-xl font-semibold text-gray-600 lg:block">Cynthia J. Watts</h5>
                   <span class="hidden text-gray-400 lg:block">Admin</span>
               </div>
           </a>

            <ul class="space-y-2 tracking-wide mt-8">
                <li>
                    <a href="{{ route('analytics') }}" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600 {{ request()->routeIs('analytics') ? 'bg-gradient-to-r from-sky-600 to-cyan-400 active:bg-gradient-to-r active:from-sky-600 active:to-cyan-400' : '' }}">

                    <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                            <path d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z" class="fill-current text-cyan-400 dark:fill-slate-600"></path>
                            <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z" class="fill-current text-cyan-200 group-hover:text-cyan-300"></path>
                            <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z" class="fill-current group-hover:text-sky-300"></path>
                        </svg>
                        <span class="-mr-1 font-medium">Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600
                    {{ request()->routeIs('users.index') ? 'bg-gradient-to-r from-sky-600 to-cyan-400 active:bg-gradient-to-r active:from-sky-600 active:to-cyan-400' : '' }}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd" />
                            <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                        </svg>
                        <span class="group-hover:text-gray-700">User Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('books.index') }}" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600
                    {{ request()->routeIs('books.index') ? 'bg-gradient-to-r from-sky-600 to-cyan-400 active:bg-gradient-to-r active:from-sky-600 active:to-cyan-400' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path class="fill-current text-gray-600 group-hover:text-cyan-600" fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                        </svg>
                        <span class="group-hover:text-gray-700">Stocks Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.show') }}" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600
                    {{ request()->routeIs('profile.show') ? 'bg-gradient-to-r from-sky-600 to-cyan-400 active:bg-gradient-to-r active:from-sky-600 active:to-cyan-400' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                        </svg>
                        <span class="group-hover:text-gray-700">profile management</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('book-orders') }}" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600
                    {{ request()->routeIs('book-orders') ? 'bg-gradient-to-r from-sky-600 to-cyan-400 active:bg-gradient-to-r active:from-sky-600 active:to-cyan-400' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                        </svg>
                        <span class="group-hover:text-gray-700">Orders management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phonebook') }}" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600
                    {{ request()->routeIs('phonebook') ? 'bg-gradient-to-r from-sky-600 to-cyan-400 active:bg-gradient-to-r active:from-sky-600 active:to-cyan-400' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                        </svg>
                        <span class="group-hover:text-gray-700">Customer Phonebook</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('maps') }}" aria-label="dashboard" class="relative px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600
                    {{ request()->routeIs('maps') ? 'bg-gradient-to-r from-sky-600 to-cyan-400 active:bg-gradient-to-r active:from-sky-600 active:to-cyan-400' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path class="fill-current text-gray-600 group-hover:text-cyan-600" d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                            <path class="fill-current text-gray-300 group-hover:text-cyan-300" d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                        </svg>
                        <span class="group-hover:text-gray-700">User locations</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="px-6 -mx-6 pt-4 flex justify-between items-center border-t">
            <button class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-600 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-nav-link>
                </form>
                <span class="group-hover:text-gray-700"></span>
            </button>
        </div>
    </aside>
</header>
<body >





</body>
<main>
    @yield('content')
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>






<footer>

</footer>
</body>
</html>
