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
