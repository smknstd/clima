<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>{{ $title }}</title>

        <meta name="description" content="{{ $meta_description }}">

        <meta property="og:title" content="{{ $meta_title }}">
        <meta property="og:type" content="{{ $meta_type }}" />
        <meta property="og:description" content="{{ $meta_description }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="CLI.M.A.">
        <meta property="og:image" content="{{ $meta_image }}">

        <link rel="canonical" href="{{ rtrim(request()->fullUrlWithQuery(['page' => null]), '?') }}">

        <link rel="icon" href="/favicon.ico">
        <link rel="icon" href="{{ asset('/img/favicons/favicon-32x32.png') }}" type="image/png" sizes="32x32">
        <link rel="apple-touch-icon" href="{{ asset('/img/favicons/apple-icon-180x180.png') }}">
        <link rel="manifest" href="{{ asset('/img/favicons/manifest.json') }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
            <div class="container w-full max-w-7xl">
                <div x-data="{ open: false }" class="
          flex flex-col
          max-w-screen-xl
          p-5
          mx-auto
          md:items-center md:justify-between md:flex-row md:px-6
          lg:px-8
        ">
                    <div class="flex flex-row items-center justify-between lg:justify-start">
                        <a href="/" class="
              text-lg
              font-bold
              tracking-tighter
              text-blue-600
              transition
              duration-500
              ease-in-out
              transform
              tracking-relaxed
              lg:pr-8
            "> wickedblocks </a>
                        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="w-8 h-8">
                                <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" style="display: none"></path>
                            </svg>
                        </button>
                    </div>
                    <nav :class="{'flex': open, 'hidden': !open}" class="flex-col items-center flex-grow hidden pb-4 border-blue-600 md:pb-0 md:flex md:justify-end md:flex-row lg:border-l-2 lg:pl-2">
                        <a class="
              px-4
              py-2
              mt-2
              text-sm text-gray-500
              md:mt-0
              hover:text-blue-600
              focus:outline-none focus:shadow-outline
            " href="#">About</a>
                        <a class="
              px-4
              py-2
              mt-2
              text-sm text-gray-500
              md:mt-0
              hover:text-blue-600
              focus:outline-none focus:shadow-outline
            " href="#">Contact</a>
                        </div>
                    </nav>
                </div>
            </div>

            {{ $content }}

            <x-footer />

        @stack('script')
    </body>
</html>
