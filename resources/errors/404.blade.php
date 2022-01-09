@extends('errors.layout')

@section('title')
    Cette page est introuvable
@endsection

@section('message')
    <div>
        La page que vous recherchez n’existe pas ou à peut-être été supprimée.
        Vous pouvez reprendre vos recherches depuis la page d’accueil.
    </div>

    <div class="my-5">
        <a class="btn btn-outline-primary" href="{{ route('home') }}">
           Accueil
        </a>
    </div>
@endsection
