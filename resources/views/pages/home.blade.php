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

                <section class="text-gray-600 body-font">
                    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                            <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                        </div>
                        <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Before they sold out
                                <br class="hidden lg:inline-block">readymade gluten
                            </h1>
                            <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken authentic tumeric truffaut hexagon try-hard chambray.</p>
                        </div>
                    </div>
                </section>

                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Derniers posts du blog</h1>
                <div class="flex flex-wrap -m-4">
                    @foreach($lastBlogposts as $blogpost)
                        <x-blogpost :blogpost="$blogpost" />
                    @endforeach
                </div>
                <div class="inline-flex my-4">
                    <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0" href="{{ route('blog') }}">
                        Voir le blog
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M5 12h14"></path>
                          <path d="M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
