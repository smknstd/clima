<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href="/" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img src="{{ asset('/img/logo.png') }}" alt="logo" class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center" />
            <div class="ml-3">
                <span class="text-xl">CLI.M.A.</span>
                <div class="text-xs text-gray-500">Météo, climato, photos en Alsace/Moselle</div>
            </div>

        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            <a class="mr-5 hover:text-gray-900" href="{{ route('blog') }}">Blog</a>
            <a class="mr-5 hover:text-gray-900" href="{{ route('reports') }}">Relevés</a>
            <a class="mr-5 hover:text-gray-900" href="{{ route('stations') }}">Stations</a>
            <a class="mr-5 hover:text-gray-900" href="{{ route('about') }}">L'association</a>
        </nav>
        <a href="/sharp" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
            @if(auth()->id())
                Mon compte
            @else
                Se connecter
            @endif
        </a>
    </div>
</header>

