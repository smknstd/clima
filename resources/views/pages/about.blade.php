<x-layout class="home">
    <x-slot name="title">
        A propos de l'association
    </x-slot>

    <x-slot name="meta_title">
        L'association CLI.M.A.
    </x-slot>

    <x-slot name="meta_description">
        bla bla bla
    </x-slot>

    <x-slot name="meta_image">
        {{ asset('/img/metas/about.jpg') }}
    </x-slot>

    <x-slot name="content">

        <section class="text-gray-600 body-font">
            <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
                <img class="lg:w-3/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero" src="{{ asset('/img/association.jpg') }}">
                <div class="text-left lg:w-1/2 w-full">
                    <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">A propos de l'association</h1>
                    <p class="mb-8 leading-relaxed">
                        CLI.M.A. 57-67-68 est une association créée le 30 mars 2007 à Saverne, ayant pour principaux objectifs :<br>
                        <ul class="list-disc text-left mb-4">
                            <li>de diffuser des connaissances dans le domaine des sciences de l'atmosphère,</li>
                            <li>d'effectuer et diffuser les observations climatologiques dans les départements du Bas-Rhin, du Haut-Rhin et de la Moselle,</li>
                            <li>de promouvoir et développer la météorologie amateur,</li>
                            <li>de soutenir techniquement des stations météo amateurs régionales,</li>
                            <li>la prise de photographies ou de vidéos météorologiques et naturelles,</li>
                            <li>l'organisation d'expositions et de conférences sur la météorologie locale, régionale ou nationale,</li>
                            <li>l'organisation de stages axés sur la météorologie et sur la photographie météo et nature,</li>
                            <li>la recherche et l'archivage de données météorologiques,</li>
                            <li>de favoriser la rencontre entre passionnés de météorologie,</li>
                            <li>le développement de liens d'amitiés entre ses membres.</li>
                        </ul>
                    Pour découvrir le fonctionnement de notre association, nous vous invitons à lire ses <a class="text-indigo-500 text-decoration-underline" href="{{ asset('/documents/statuts.pdf') }}">statuts</a>.
                    </p>
                    <p class="mb-8 leading-relaxed text-left">
                        <h2 class="title-font text-xl mb-4 font-medium text-gray-900">D'abord pourquoi l'association régionale CLI.M.A. a-t-elle été créée ?</h2>
                        En mars 2007 , après une longue réfexion en amont, des passionnés de météo, climato et photo ont décidé de s'unir pour devenir l'outil de référence capable de fédérer le travail météo entrepris par tous les passionnés, depuis de longues années parfois, dans la région !
                        C'est avant tout à travers le site www.clima.fr que l'association arrive à faciliter, harmoniser et améliorer le travail des partenaires de terrain mais aussi à travers les rencontres et les activités où sont conviés tous les membres adhérents .
                    </p>
                    <p class="mb-8 leading-relaxed text-left">
                        <h2 class="title-font text-xl mb-4 font-medium text-gray-900">Faut-il adhérer obligatoirement pour participer à la vie du site ?</h2>
                        Bien sûr que non ! Il n'est pas obligatoire d'adhérer si l'on veut simplement s'intégrer dans le réseau des stations, fournir les données météo personnelles par exemple, mais même à ce niveau-là on peut obtenir le statut de correspondant sur simple demande sans devoir s'acquitter de la cotisation .
                    </p>
                    <p class="mb-8 leading-relaxed text-left">
                        <h2 class="title-font text-xl mb-4 font-medium text-gray-900">Pourquoi alors adhérer à l'association ?</h2>
                        Adhérer pour une cotisation modique de 20 euros minimum c'est aller un peu plus loin :<br>
                        <ul class="list-disc text-left">
                            <li>c'est marquer davantage son intérêt pour le travail fait par l'ensemble des bénévoles des 3 départements du Nord-Est en s'engageant avec eux</li>
                            <li>c'est apporter sa pierre à l'édifice, mettre ses compétences au service des autres tout en profitant du savoir faire des membres</li>
                            <li>c'est pouvoir rencontrer concrètement les autres passionnés lors de nos activités (randos, journées à thème, week end, stages , rencontres....etc) proposées seulement aux adhérents,</li>
                            <li>c'est bien sûr aussi, même si c'est modeste, soutenir financièrement notre association par sa cotisation.</li>
                            <li>Enfin combien d'adhérents poussés par la seule passion de la météo sont devenus les meilleurs amis du monde car la convivialité est toujours présente dans tous les moments de partage, de réflexion, de mise en oeuvre qui nous unissent !</li>
                        </ul>
                    </p>
                    <p class="mb-8 leading-relaxed text-left">
                        <h2 class="title-font text-xl mb-4 font-medium text-gray-900">Alors comment adhérer ?</h2>
                        Veuillez nous écrire un email à l'adresse : ?
                    </p>
                </div>
            </div>
        </section>

    </x-slot>

</x-layout>
