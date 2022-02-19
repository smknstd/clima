<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Températures maximales</th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Moyenne des maximales journalières
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->avg_max_temperature) }}°c
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Minimale des maximales journalières
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->min_max_temperature) }}°c
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ $reportsWithMinMaxTemperature->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Température maximale
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ format_report_value_from_storage($stats->max_max_temperature) }}°c
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ $reportsWithMaxMaxTemperature->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec Tx<=0°C
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countMaxTemperatureSub0->count_max_temperature_sub_0 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec Tx>=25°C
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countMaxTemperatureOver25->count_max_temperature_over_25 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec Tx>=30°C
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countMaxTemperatureOver30->count_max_temperature_over_30 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec Tx>=35°C
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countMaxTemperatureOver35->count_max_temperature_over_35 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        </tbody>
    </table>
</div>
