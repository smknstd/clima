<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vent</th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Moyenne de la vitesse du vent
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->avg_avg_wind_speed, 1, 'km/h') }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Maximale de la vitesse moyenne journalière
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->max_avg_wind_speed, 1, 'km/h') }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {!! $reportsWithMaxAvgWindSpeed->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode('<br>') !!}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Rafale maximale de vent
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->max_max_wind_speed, 1, 'km/h') }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ $reportsWithMaxMaxWindSpeed->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours de vent soutenu (>=36km/h)
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithMaxWindSpeedOver36->count_days_with_max_wind_speed_over_36 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours de vent fort (>=58km/h)
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithMaxWindSpeedOver58->count_days_with_max_wind_speed_over_58 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours de vent fort (>=76km/h)
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithMaxWindSpeedOver76->count_days_with_max_wind_speed_over_76 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours de vent fort (>=100km/h)
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithMaxWindSpeedOver100->count_days_with_max_wind_speed_over_100 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        </tbody>
    </table>
</div>
