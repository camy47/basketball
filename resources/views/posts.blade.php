@extends ('layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        @foreach ($posts as $post)
            <article class="max-w-2xl mx-auto mb-12 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-2">
                        <a href="/posts/{{  $post->slug }}" class="text-gray-900 hover:text-blue-600 transition-colors duration-200">
                            {!! $post->title !!}
                        </a>
                    </h1>

                    <p class="mb-4">
                        <a href="/categories/{{ $post->category->slug }}" 
                           class="inline-block bg-gray-100 text-gray-700 rounded-full px-3 py-1 text-sm hover:bg-gray-200 transition-colors duration-200">
                            {{ $post->category->name }}
                        </a>
                    </p>

                    <div class="text-gray-600 leading-relaxed">
                        {{$post->excerpt}}
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection

