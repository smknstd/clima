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

            <x-header />

            {{ $content }}

            <x-footer />

        @stack('script')
    </body>
</html>
