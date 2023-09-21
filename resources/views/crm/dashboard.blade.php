hello crm



<form method="POST" action="{{ route('logout') }}">
    @csrf
    <x-nav-link href="{{ route('logout') }}"
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="text-black ml-4">
        {{ __('Logout') }}
    </x-nav-link>
</form>
