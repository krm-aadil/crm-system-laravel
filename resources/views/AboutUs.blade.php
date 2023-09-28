@extends('layouts.home')
@section('content')

    <div class="flex md:flex-row flex-col-reverse md:items-stretch items-center justify-center">
        <div class="md:py-20 xl:w-1/2 sm:w-1/2 lg:mr-20 md:mr-6 flex flex-col md:items-end items-center justify-center xl:mr-28">
            <div class="flex flex-col items-center justify-center">
                <h1 class="md:text-5xl text-3xl font-bold text-center text-#1cc5e7 dark:text-black">LIVRE</h1>
                <p class="sm:w-96 w-full mt-6 text-base leading-6 text-center text-black dark:text-black-200">Your Premier Destination for Books and Knowledge.</p>
                <div class="md:mt-14 mt-12 flex flex-col items-center">
                    <div class="w-20 h-20 bg-primary shadow rounded-full flex items-center justify-center" role="img" aria-label="money">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/about-2-svg1.svg" alt="money" />
                    </div>
                    <p class="text-base leading-6 mt-6 text-center text-black dark:text-black-200 sm:w-96 w-full">Explore our wide selection of books and find the perfect read for every occasion.</p>
                </div>
                <div class="mt-7 flex flex-col items-center">
                    <div class="w-20 h-20 bg-primary shadow rounded-full flex items-center justify-center" role="img" aria-label="phone">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/about-2-svg2.svg" alt="phone" />
                    </div>
                    <p class="text-base leading-6 mt-6 text-center text-black dark:text-black-200 sm:w-96 w-full">Stay connected with our customer support team for any inquiries or assistance.</p>
                </div>
                <div class="mt-7 flex flex-col items-center">
                    <div class="w-20 h-20 bg-primary shadow rounded-full flex items-center justify-center" role="img" aria-label="ideas">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/about-2-svg3.svg" alt="app" />
                    </div>
                    <p class="text-base leading-6 mt-6 text-center text-black dark:text-black-200 sm:w-96 w-full">Discover new ideas and expand your knowledge with our curated collection of books.</p>
                </div>
                <div class="mt-7 flex flex-col items-center">
                    <div class="w-20 h-20 bg-primary shadow rounded-full flex items-center justify-center" role="img" aria-label="bright ideas">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/about-2-svg4.svg" alt="bulb" />
                    </div>
                    <p class="text-base leading-6 mt-6 text-center text-black dark:text-black-200 sm:w-96 w-full">Unleash your creativity and imagination through the power of books.</p>
                </div>
            </div>
        </div>
        <div class="py-12 xl:w-1/2 lg:w-1/3 sm:w-1/2">
            <img src="{{asset('img/a-smart-hare-in-a-hat-and-glasses-stands-at-full-height-with-a-book-in-his-paws-flat-character-illustration-vector.jpg')}}" alt="image of a woman studying" class="h-full rounded-md object-cover object-center md:block hidden" />
            <img src="https://i.ibb.co/NT0VJcd/pexels-la-miko-3681591-1.png" alt="image of a woman studying" class="h-auto w-auto md:hidden block" />
        </div>
    </div>



@endsection
