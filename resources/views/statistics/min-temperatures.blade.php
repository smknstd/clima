<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Températures minimales</th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Moyenne des minimales journalières
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->avg_min_temperature) }}°c
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Température minimale
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->min_min_temperature) }}°c
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ $reportsWithMinMinTemperature->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Maximale des minimales journalières
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->max_min_temperature) }}°c
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ $reportsWithMaxMinTemperature->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec Tn<=-5°C
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countMinTemperatureSubMinus5->count_min_temperature_sub_minus_5 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec Tn<=0°C
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countMinTemperatureSub0->count_min_temperature_sub_0 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec Tn>=20°C
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countMinTemperatureOver20->count_min_temperature_over_20 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        </tbody>
    </table>
</div>
