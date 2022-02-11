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
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-1 text-gray-900">Relevés météo journaliers</h1>

                <div class="text-lg mb-6">
                    {{ Str::title($date->isoFormat('dddd Do MMMM')) }}
                </div>

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm: lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Station</th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Température minimum">Tn</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Température maximum">Tx</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Pression au moment du relevé">P</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Préssion minimum">Pn</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Préssion maximum">Px</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Précipitations">RR</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Insolation">W</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Épaisseur de neige">N</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Direction dominante du vent">Vd</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Vitesse moyenne du vent">Vm</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Vitesse maximum du vent">Vx</span></th>
                                        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observations</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($reports as $report)
                                    <tr>
                                        <td class="pl-3 py-4 whitespace-nowrap font-medium">
                                            {{ $report->weatherStation->city }}
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap font-medium bg-{{ get_bg_temperature('min', $report->min_temperature, $report->date) }}">
                                            {{ format_report_value_from_storage($report->min_temperature, 1) }} °c
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap font-medium bg-{{ get_bg_temperature('max', $report->max_temperature, $report->date) }}">
                                            {{ format_report_value_from_storage($report->max_temperature, 1) }} °c
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                                            {{ $report->pressure }}
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap">
                                            {{ $report->min_pressure }}
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                                            {{ $report->max_pressure }}
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap font-medium bg-green-100">
                                            {{ format_report_value_from_storage($report->precipitation,1, "cm") }}
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                                            {{ format_report_value_from_storage($report->sunshine_duration, 2, "h") }}
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap">
                                            {{ format_report_value_from_storage($report->snow_depth,1, "cm") }}
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                                            @if($report->wind_direction)
                                                <span class="text-3xl hint--bottom hint--rounded" aria-label="{{ $report->wind_direction->label() }}">
                                                    <i class="wi wi-wind {{ $report->wind_direction->value }}"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap">
                                            {{ format_report_value_from_storage($report->avg_wind_speed,1, "km/h") }}
                                        </td>
                                        <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                                            {{ format_report_value_from_storage($report->max_wind_speed,1, "km/h") }}
                                        </td>
                                        <td class="pl-3 py-4 max-w-xs">
                                            @if($report->has_rain)
                                                <div class="px-3 py-2 inline-flex text-lg rounded-full bg-green-100 text-green-800 cursor-default hint--bottom hint--rounded" aria-label="Pluie">
                                                    <i class="wi wi-raindrop"></i>
                                                </div>
                                            @endif
                                            @if($report->has_storm)
                                                <div class="px-3 py-2 inline-flex text-lg rounded-full bg-orange-100 text-orange-800 cursor-default hint--bottom hint--rounded" aria-label="Orage (tonnerre perçu)">
                                                    <i class="wi wi-lightning"></i>
                                                </div>
                                            @endif
                                            @if($report->has_hail)
                                                <div class="px-3 py-2 inline-flex text-xl rounded-full bg-blue-100 text-blue-800 cursor-default hint--bottom hint--rounded" aria-label="Grêle">
                                                    <i class="wi wi-hail"></i>
                                                </div>
                                            @endif
                                            @if($report->has_snow)
                                                <div class="px-3 py-2 inline-flex text-lg rounded-full bg-sky-100 text-sky-800 cursor-default hint--bottom hint--rounded" aria-label="Neige">
                                                    <i class="wi wi-snow"></i>
                                                </div>
                                            @endif
                                            @if($report->has_fog)
                                                <div class="px-3 py-2 inline-flex text-lg rounded-full bg-yellow-100 text-yellow-800 cursor-default hint--bottom hint--rounded" aria-label="Brouillard">
                                                    <i class="wi wi-windy"></i>
                                                </div>
                                            @endif
                                            @if($report->has_flood)
                                                <div class="px-3 py-2 inline-flex text-xl rounded-full bg-amber-100 text-amber-800 cursor-default hint--bottom hint--rounded" aria-label="Innondation">
                                                    <i class="wi wi-flood"></i>
                                                </div>
                                            @endif
                                            @if($report->comment)
                                                <div class="py-2 italic">
                                                    {{ $report->comment }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
