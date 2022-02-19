<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-100">
    <tr>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            @if($type === 'monthly')
                Date
            @else
                Station
            @endif
        </th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Température minimum">Tn</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Température maximum">Tx</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Pression au moment du relevé">P</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Préssion minimum">Pn</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Préssion maximum">Px</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Précipitations">RR</span></th>
        @if($hasAtLeastOneReportWithSnowDepth())
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Épaisseur de neige">N</span></th>
        @endif
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Insolation">W</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Direction dominante du vent">Vd</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Vitesse moyenne du vent">Vm</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span class="cursor-default hint--bottom hint--rounded" aria-label="Vitesse maximum du vent">Vx</span></th>
        <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Observations</th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @foreach($reports as $report)
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                @if($type === 'monthly')
                    <span class="text-gray-500 text-xs">{{ ucfirst($report->date->isoFormat('ddd')) }}</span> {{ $report->date->isoFormat('D') }}
                @else
                    <a class="text-indigo-500 text-decoration-underline" href="{{ route('station-monthly-reports', [$report->weatherStation, today()->format('Y'), today()->format('m')]) }}">
                        {{ $report->weatherStation->city }}
                        <div class="text-gray-500 text-xs">{{ Str::limit($report->weatherStation->postal_code, 2, '') }}</div>
                    </a>
                @endif
            </td>
            <td class="pl-3 py-4 whitespace-nowrap font-medium bg-{{ get_bg_temperature('min', $report->min_temperature, $report->date) }}">
                {{ format_report_value_from_storage($report->min_temperature, 1, '°c') }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap font-medium bg-{{ get_bg_temperature('max', $report->max_temperature, $report->date) }}">
                {{ format_report_value_from_storage($report->max_temperature, 1, '°c') }}
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
                {{ format_report_value_in_cm_from_storage($report->precipitation) }}
            </td>
            @if($hasAtLeastOneReportWithSnowDepth())
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ format_report_value_in_cm_from_storage($report->snow_depth) }}
            </td>
            @endif
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                @if($report->sunshine_duration)
                    {{ $report->sunshine_duration }} h
                @endif
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
                @if($report->has_glaze)
                    <div class="px-3 py-2 inline-flex text-xl rounded-full bg-amber-100 text-amber-800 cursor-default hint--bottom hint--rounded" aria-label="Verglas">
                        <i class="wi wi-snowflake-cold"></i>
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
