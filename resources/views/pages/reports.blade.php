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
                                <x-reports-table :type="'stations'" :reports="$reports" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
