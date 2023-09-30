
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Register</title>
</head>
<body class="flex flex-col md:flex-row h-screen items-center bg-white">



<div class="bg-white w-full md:max-w-md lg:max-w-full  md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
        flex items-center justify-center">

    <div class="w-full h-screen">


        <h1 class="text-4xl md:text-4xl font-bold leading-tight mt-10 text-black">Register </h1><br>
        <x-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full bg-blue-200 border-black " type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full bg-blue-200" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>


            <div class="mt-4">
                <x-label for="birthday" value="{{ __('Birthdate') }}" />
                <x-input id="birthday" class="block mt-1 w-full bg-blue-200" type="date" name="birthdate" :value="old('birthday')" required autocomplete="birthday" />
            </div>


            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" class="block mt-1 w-full bg-blue-200" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />

            </div>

            <div class="mt-4">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" class="block mt-1 w-full bg-blue-200" type="text" name="address" :value="old('address')" required autocomplete="address" />
            </div>

            <div class="mt-4">
                <x-label for="city" value="{{ __('City') }}" />
                <x-input id="city_id" class="block mt-1 w-full bg-blue-200" type="text" name="city_id" :value="old('city')" required autocomplete="city" />
            </div>

            <div class="mt-4">
                <x-label for="country" value="{{ __('Province') }}" />
                <x-input id="country_id" class="block mt-1 w-full bg-blue-200" type="text" name="province_id" :value="old('country')" required autocomplete="country" />
            </div>


            <div class="mt-4">
                <x-label for="city" value="{{ __('City') }}" />
                <select id="city_id" class="block mt-1 w-full bg-blue-200" name="city_id" required autocomplete="city">
                    <option value="" disabled selected>Select a city</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-label for="province" value="{{ __('Province') }}" />
                <select id="province_id" class="block mt-1 w-full bg-blue-200" name="province_id" required autocomplete="province">
                    <option value="" disabled selected>Select a province</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2">
                <label  class="block text-black" for="password" value="{{ __('Password') }}">Password</label>
                <input id="password"  type="password" name="password" required autocomplete="new-password" class="w-full px-2 py-1  rounded-lg bg-blue-200 mt-2 border focus:border-purple-300 focus:bg-white focus:outline-none"/>
            </div>

            <div class="mt-4">
                <label class="block text-black" for="password_confirmation" value="{{ __('Confirm Password') }}">Confirm Password </label>
                <input id="password_confirmation"  type="password" name="password_confirmation" required autocomplete="new-password" class="w-full px-2 py-1  rounded-lg bg-blue-200 mt-2 border focus:border-purple-300 focus:bg-white focus:outline-none" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-black hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-100" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

            </div>

            <div class="flex items-center justify-center mt-4">
                <button type="submit" class="w-2/4 block bg-blue-400 text-black   hover:text-white  border border-amber-100  font-semibold rounded-lg
              px-4 py-3 mt-6 ">  {{ __('Register') }}</button>
            </div>

        </form>

    </div>

</div>
<div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
    <img src="{{asset("img/young-modern-girl-holding-pile-books-smiling-laughing-hard-out-loud-because-funny-crazy-joke.jpg")}}" alt="" class="w-full h-full object-cover">
</div>
</body>
</html>
