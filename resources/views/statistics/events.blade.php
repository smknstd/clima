<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phénomènes météo</th>
            <th scope="col" class="pl-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours d'orage
                <div class="text-xs text-gray-500">
                    tonnerre audible
                </div>
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithStorm->count_days_with_storm }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours de brouillard
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithFog->count_days_with_fog }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours de verglas
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithGlaze->count_days_with_glaze }}
            </td>
        </tr>
        <tr>
            <td class="pl-3 py-4 whitespace-nowrap">
                Nombre de jours avec inondations
            </td>
            <td class="pl-3 py-4 whitespace-nowrap bg-gray-100">
                {{ $countDaysWithFlood->count_days_with_flood }}
            </td>
        </tr>
        </tbody>
    </table>
</div>
