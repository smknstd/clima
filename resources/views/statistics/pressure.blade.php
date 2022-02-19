<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pression atmosphérique</th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Pression maximale
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $stats->max_max_pressure }} hPa
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ $reportsWithMaxMaxPressure->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Pression minimale
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $stats->min_min_pressure }} hPa
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ $reportsWithMinMinPressure->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
            </td>
        </tr>
        </tbody>
    </table>
</div>
