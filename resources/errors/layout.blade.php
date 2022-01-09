


<x-layout>
    <x-title>@yield('title')</x-title>

    <div class="container">
        <div class="py-5 mt-3 text-center">
            <div class="mb-4.5">
                <img class="img-fluid" width="370" src="{{ asset('img/illustrations/404.svg') }}" alt="Succès" role="presentation">
            </div>

            <h1 class="h2 mb-3">@yield('title')</h1>

            <div class="mx-auto" style="max-width: 26em">
                @yield('message')
            </div>
        </div>
    </div>
</x-layout>
