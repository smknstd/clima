<x-layout class="home">
    <x-slot name="title">
        Nos stations météo
    </x-slot>

    <x-slot name="meta_title">
        Nos stations météo
    </x-slot>

    <x-slot name="meta_description">
        Liste des stations météo de l'association CLI.M.A.
    </x-slot>

    <x-slot name="meta_image">
        {{ asset('/img/metas/stations.jpg') }}
    </x-slot>

    <x-slot name="content">

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <h1 class="text-2xl font-medium title-font mb-4 text-gray-900">Nos stations météo</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                        Liste des stations météo répertoriées sur notre site et publiant des relevés régulièrement.
                    </p>
                </div>
                <div class="flex flex-wrap -m-4">
                    @foreach($stations as $station)
                    <div class="p-4 lg:w-1/4 md:w-1/2">
                        <a class="" href="{{ route('station', [$station]) }}">
                            <div class="h-full flex flex-col items-center text-center">
                                <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4"
                                     src="{{ $station->getStationThumbnail() }}">
                                <div class="w-full">
                                    <h2 class="title-font font-medium text-lg text-gray-900">{{ $station->getTitleBasedOnLocation() }}</h2>
                                    <p class="mb-4">
                                        {{ $station->description }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
