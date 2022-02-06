<x-layout class="home">
    <x-slot name="title">
        Station météo {{ $station->getTitleBasedOnLocation() }}
    </x-slot>

    <x-slot name="meta_title">
        Station météo {{ $station->getTitleBasedOnLocation() }}
    </x-slot>

    <x-slot name="meta_description">
        {{ $station->description }}
    </x-slot>

    <x-slot name="meta_image">
        {{ $station->visuals->first()->thumbnail(1200,627) }}
    </x-slot>

    <x-slot name="content">


        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{ $station->getTitleBasedOnLocation() }}</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                        {{ $station->description }}
                    </p>
                </div>
                <div class="flex flex-wrap -m-4">
                    @foreach($station->visuals as $visual)
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <div class="flex relative">
                            <img alt="gallery" class="w-full h-full object-cover object-center" src="{{ $visual->thumbnail(600) }}">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="flex flex-col flex-wrap lg:py-6 -mb-10 lg:w-1/2 lg:pl-12 lg:text-left text-center mx-auto">
                    <div class="flex flex-col mb-10 lg:items-start items-center">
                        @if($station->creation_date)
                        <div class="flex-grow py-2">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-1">Date de mise en service</h2>
                            <p class="leading-relaxed text-base">{{ $station->creation_date }}</p>
                        </div>
                        @endif
                        @if($station->altitude)
                        <div class="flex-grow py-2">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-1">Altitude</h2>
                            <p class="leading-relaxed text-base">{{ $station->altitude }} m</p>
                        </div>
                        @endif
                        @if($station->hardware_details)
                            <div class="flex-grow py-2">
                                <h2 class="text-gray-900 text-lg title-font font-medium mb-1">Matériel</h2>
                                <p class="leading-relaxed text-base">{{ $station->hardware_details }}</p>
                            </div>
                        @endif
                        @if($station->website_url)
                            <div class="flex-grow py-2">
                                <h2 class="text-gray-900 text-lg title-font font-medium mb-1">Site web</h2>
                                <a href="{{ $station->website_url }}" target="_blank" class="text-indigo-500 leading-relaxed text-base">{{ $station->website_url }}</a>
                            </div>
                        @endif
                        <div class="flex-grow py-2">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-1">Propriétaire</h2>
                            <div class="flex items-center flex-wrap ">
                                <img alt="testimonial" src="{{ $station->user->avatar->thumbnailFit(40, 40) }}" class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center">
                                <span class="flex-grow flex flex-col pl-4">
                                      <span class="title-font font-medium text-sm text-gray-900">{{ $station->user->name }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
