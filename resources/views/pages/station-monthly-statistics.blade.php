<x-layout class="home">
    <x-slot name="title">
        Statistiques
    </x-slot>

    <x-slot name="meta_title">
        Statistiques
    </x-slot>

    <x-slot name="meta_description">
        Statistiques des relevés météo de la station de {{ $station->getTitleBasedOnLocation() }}
    </x-slot>

    <x-slot name="meta_image">
        {{ count($station->visuals) > 0 ? $station->visuals->first()->thumbnail(1200,627) : asset('/img/metas/stations.jpg') }}
    </x-slot>

    <x-slot name="content">

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">

                <nav class="flex mb-3" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="{{ route('station', $station) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Station de {{ $station->getTitleBasedOnLocation() }}</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 dark:text-gray-500">Statistiques</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <h1 class="sm:text-3xl text-2xl font-medium title-font my-6 text-gray-900">Statistiques de la station de {{ $station->city }}</h1>

                <div class="text-lg mb-6">
                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                        <a href="{{ route('station-monthly-statistics', [$station, $start->subMonth()->format('Y'),$start->subMonth()->format('m')]) }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>

                        <a href="{{ route('station-monthly-statistics', [$station, $start->addMonth()->format('Y'),$start->addMonth()->format('m')]) }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </span>
                    <span class="ml-3">
                         {{ Str::title($start->isoFormat('MMMM YYYY')) }}
                    </span>
                    <div class="text-sm mt-3">
                        <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0" href="{{ route('station-monthly-reports', [$station, $start->format('Y'), $start->format('m')]) }}">
                            Voir les relevés
                        </a>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 lg:w-1/2 md:w-1/2 w-5/6">
                        <div class="py-2 align-middle inline-block min-w-full sm: lg:px-8">
                            @if($hasReports)
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-100">
                                        <tr>
                                            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Températures</th>
                                            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="pl-3 py-4 whitespace-nowrap">
                                                    Amplitude journalière moyenne
                                                </td>
                                                <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                                                    {{ format_report_value_from_storage($stats->avg_temperature_range) }}°c
                                                </td>
                                                <td class="pl-3 py-4 whitespace-nowrap">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3 py-4 whitespace-nowrap">
                                                    Amplitude journalière minimale
                                                </td>
                                                <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                                                    {{ format_report_value_from_storage($stats->min_temperature_range) }}°c
                                                </td>
                                                <td class="pl-3 py-4 whitespace-nowrap">
                                                    {{ $reportsWithMinTemperatureRange->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-3 py-4 whitespace-nowrap">
                                                    Amplitude journalière maximale
                                                </td>
                                                <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                                                    {{ format_report_value_from_storage($stats->max_temperature_range) }}°c
                                                </td>
                                                <td class="pl-3 py-4 whitespace-nowrap">
                                                    {{ $reportsWithMaxTemperatureRange->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
