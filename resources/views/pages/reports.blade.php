<x-layout class="home">
    <x-slot name="title">
        Relevés météo journaliers
    </x-slot>

    <x-slot name="meta_title">
        Relevés météo journaliers
    </x-slot>

    <x-slot name="meta_description">
        Relevés météo journaliers des stations de l'association CLI.M.A.
    </x-slot>

    <x-slot name="meta_image">
        {{ asset('/img/metas/stations.jpg') }}
    </x-slot>

    <x-slot name="content">

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">

                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-6 text-gray-900">Relevés météo journaliers</h1>

                <div class="text-lg mb-6">
                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                        <a href="{{ route('reports-day', [$date->subDay()->format('Y'),$date->subDay()->format('m'),$date->subDay()->format('d')]) }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a href="{{ route('reports-day', [$date->addDay()->format('Y'),$date->addDay()->format('m'),$date->addDay()->format('d')]) }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </span>
                    <span class="ml-3">
                        {{ Str::title($date->isoFormat('dddd D MMMM YYYY')) }}
                    </span>
                </div>

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm: lg:px-8">
                            @if(count($reports)>0)
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <x-reports-table :type="'stations'" :reports="$reports" />
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
