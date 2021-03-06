<x-layout class="home">
    <x-slot name="title">
        Bilans périodiques CLI.M.A.
    </x-slot>

    <x-slot name="meta_title">
        Bilans périodiques CLI.M.A.
    </x-slot>

    <x-slot name="meta_description">
        liste des bilans périodiques partagés par le membre {{ $user->name }}
    </x-slot>

    <x-slot name="meta_image">
        {{ asset('/img/metas/home.jpg') }}
    </x-slot>

    <x-slot name="content">

        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-10 text-gray-900">
                    Bilans périodiques de {{ $user->name }}
                </h1>

                <div class="flex flex-wrap -m-4">
                    @foreach($blogposts as $blogpost)
                        <x-blogpost :blogpost="$blogpost" />
                    @endforeach
                </div>
                <div class="my-8">
                    {{ $blogposts->links() }}
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
