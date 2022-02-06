<x-layout class="home">
    <x-slot name="title">
        Association CLI.M.A.
    </x-slot>

    <x-slot name="meta_title">
        Association CLI.M.A.
    </x-slot>

    <x-slot name="meta_description">
        Association CLI.M.A. : Passion de la météorologie, climatologie et photographie en Alsace-Moselle
    </x-slot>

    <x-slot name="meta_image">
        {{ asset('/img/metas/home.jpg') }}
    </x-slot>

    <x-slot name="content">

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">
                    @foreach($lastBlogposts as $blogpost)
                    <div class="p-4 md:w-1/3">
                        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ $blogpost->cover->thumbnail(700) }}" alt="blog">
                            <div class="p-6">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{ Str::upper($blogpost->type->label()) }}</h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $blogpost->title }}</h1>
                                <div class="flex items-center flex-wrap ">
                                    <img alt="testimonial" src="{{ $blogpost->user->avatar->thumbnailFit(40, 40) }}" class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center">
                                    <span class="flex-grow flex flex-col pl-4">
                                      <span class="title-font font-medium text-sm text-gray-900">{{ $blogpost->user->name }}</span>
                                      <span class="text-gray-500 text-xs">
                                          {{ $blogpost->published_at->isoFormat('Do MMM YYYY') }}
                                          @if(!$blogpost->isSinglePhoto())
                                            <span class="bull">•</span>
                                            Lecture {{ $blogpost->getReadingTime() }}
                                          @endif
                                      </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
