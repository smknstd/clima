<x-layout class="home">
    <x-slot name="title">
        Blog CLI.M.A.
    </x-slot>

    <x-slot name="meta_title">
        Blog CLI.M.A.
    </x-slot>

    <x-slot name="meta_description">

    </x-slot>

    <x-slot name="meta_image">
        {{ $blogpost->cover ? $blogpost->cover->thumbnail(1200, 627) : asset('/img/metas/blogpost.jpg') }}
    </x-slot>

    <x-slot name="content">

        <section class="text-gray-600 body-font">
            <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
                <img class="lg:w-3/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded-lg" alt="photo d'illustration de l'article" src="{{ $blogpost->cover ? $blogpost->cover->thumbnail(750) : asset('/img/default-blogpost.jpg') }}">
                <div class="text-left lg:w-1/2 w-full">
                    <div class="flex items-center flex-wrap my-6">
                        <img alt="photo miniature de l'auteur" src="{{ $blogpost->user->getAvatarThumbnail() }}" class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center">
                        <span class="flex-grow flex flex-col pl-4">
                            <span class="title-font font-medium text-md text-gray-900">
                                {{ $blogpost->user->name }}
                            </span>
                            <span class="text-gray-500 text-sm">
                                {{ $blogpost->published_at->isoFormat('Do MMM YYYY') }}
                            </span>
                        </span>
                    </div>
                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{ Str::upper($blogpost->type->label()) }}</h2>
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                        {{ $blogpost->title }}
                    </h1>
                    <p class="mb-8 leading-relaxed">
                        {!! $blogpost->content !!}
                    </p>
                    @if($blogpost->type === \App\Models\Enums\BlogpostType::REVIEW)
                        <div class="my-3">
                            <a href="{{ route('reviews', [$blogpost->user]) }}" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
                                Voir tous les bilans périodiques de ce membre
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
