<div class="p-4 md:w-1/3">
    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
        <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ $blogpost->cover ? $blogpost->cover->thumbnail(700) : asset('/img/default-blog.jpg') }}" alt="blog">
        <div class="p-6">
            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{ Str::upper($blogpost->type->label()) }}</h2>
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $blogpost->title }}</h1>
            <div class="flex items-center flex-wrap ">
                <img alt="testimonial" src="{{ $blogpost->user->getAvatarThumbnail() }}" class="w-10 h-10 rounded-full flex-shrink-0 object-cover object-center">
                <span class="flex-grow flex flex-col pl-4">
                  <span class="title-font font-medium text-sm text-gray-900">{{ $blogpost->user->name }}</span>
                  <span class="text-gray-500 text-xs">
                      {{ $blogpost->published_at->isoFormat('Do MMM YYYY') }}
                      @if(!$blogpost->isSinglePhoto())
                          <span class="bull">•</span>
                          Lecture {{ $blogpost->getReadingTime() }}
                      @endif
                  </span>
                </span>
            </div>
        </div>
    </div>
</div>
