<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Précipitations</th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Cumul de précipitations
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $stats->sum_precipitation }} mm
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec un cumul >= 1mm
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithPrecipitationOver1->count_days_with_precipitation_over_1 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec un cumul >= 5mm
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithPrecipitationOver5->count_days_with_precipitation_over_5 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec un cumul >= 10mm
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithPrecipitationOver10->count_days_with_precipitation_over_10 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec un cumul >= 40mm
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithPrecipitationOver40->count_days_with_precipitation_over_40 }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Quantité maximale de précipitations
                <div class="text-xs text-gray-500">en 24 heures</div>
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $stats->max_precipitation }} mm
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
                {{ $reportsWithMaxPrecipitation->map(fn(\App\Models\WeatherDailyReport $report) => 'le ' . $report->date->format('d/m'))->implode(', ') }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours de neige
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithSnow->count_days_with_snow }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours de grêle
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithHail->count_days_with_hail }}
            </td>
            <td class="pl-3 py-4 whitespace-nowrap">
            </td>
        </tr>
        </tbody>
    </table>
</div>
