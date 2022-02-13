<x-layout class="home">
    <x-slot name="title">
        Relevés météo journaliers
    </x-slot>

    <x-slot name="meta_title">
        Relevés météo journaliers
    </x-slot>

    <x-slot name="meta_description">
        Relevés météo journaliers de la station de {{ $station->getTitleBasedOnLocation() }}
    </x-slot>

    <x-slot name="meta_image">
        {{ $station->visuals ? $station->visuals->first()->thumbnail(1200,627) : asset('/img/metas/stations.jpg') }}
    </x-slot>

    <x-slot name="content">

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">

                <div class="flex items-center py-4 overflow-y-auto whitespace-nowrap">
                    <a href="/" class="text-gray-600 dark:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </a>

                    <span class="mx-5 text-gray-500 dark:text-gray-300">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                      </svg>
                    </span>

                    <a href="{{ route('station', $station) }}" class="text-indigo-500 hover:underline"> Station de {{ $station->getTitleBasedOnLocation() }} </a>

                    <span class="mx-5 text-gray-500 dark:text-gray-300">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                      </svg>
                    </span>

                    <span class=""> Relevés </span>
                </div>

                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-1 text-gray-900">Relevés météo de la station de {{ $station->city }}</h1>

                <div class="text-lg mb-6">
                    {{ Str::title($start_date->isoFormat('MMMM YYYY')) }}
                </div>

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm: lg:px-8">
                            @if(count($reports)>0)
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <x-reports-table :type="'monthly'" :reports="$reports" />
                                </div>
                            @else
                                Aucun relevé enregistré pour cette période
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
