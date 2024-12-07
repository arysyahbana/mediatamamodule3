@extends('layouts.user')
@section('title', 'Home')

@section('content')
    <!-- Content 1 -->
    <div class="container mx-auto mt-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 px-5 md:px-0">
            @forelse ($allArticles as $article)
                <a href="{{ route('detail', $article->id) }}">
                    <div
                        class="hover:border hover:border-gray-200 rounded-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-105">
                        <div class="max-h-52 overflow-hidden">
                            <div class="relative">
                                <div class="absolute flex gap-1 py-1 top-44 right-1">
                                    @foreach ($article->rTags as $tag)
                                        <span
                                            class="text-xs font-medium text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <img class="rounded-t-lg object-cover"
                                    src="{{ asset('dist/assets/img/article/' . $article->image) }}"
                                    alt="{{ $article->title }}" />
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex justify-between mb-2">
                                <span
                                    class="text-slate-600 font-semibold text-xs uppercase bg-gray-100 px-2 py-1 rounded-full">{{ $article->rCategories->first()->name ?? '' }}
                                </span>
                            </div>
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">{{ $article->title }}
                            </h5>
                            <p class="text-gray-700 text-sm mb-2">
                                {{ Str::limit($article->content, 100) }}
                            </p>
                            <div class="flex justify-between">
                                <p class="text-slate-800 font-light text-xs">{{ $article->rAuthor->name ?? '' }}</p>
                                <p class="text-slate-800 font-light text-xs">
                                    {{ $article->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-slate-700">No articles found.</p>
            @endforelse
        </div>
        <div class="mt-5">
            {{ $allArticles->links() }}
        </div>
    </div>


    <hr class="h-1 w-48 mx-auto my-20 bg-gradient-to-r from-indigo-500 to-sky-500 border-0" />

    <!-- Content 2 -->
    @if (isset($filteredArticles) && $filteredArticles)
        <div class="container mx-auto px-5 md:px-0">
            <div class="flex justify-between items-center">
                <p class="text-2xl font-bold text-slate-700">
                    {{ $selectedCategory->name ?? 'All Articles' }}
                </p>
            </div>

            <div class="mt-5">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @forelse ($filteredArticles as $article)
                        <a href="{{ route('detail', $article->id) }}">
                            <div
                                class=" hover:border hover:border-gray-200 rounded-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-105">
                                <div class="max-h-52 overflow-hidden">

                                    <div class="relative">
                                        <div class="absolute flex gap-1 py-1 top-44 right-1">
                                            @foreach ($article->rTags as $tag)
                                                <span
                                                    class="text-xs font-medium text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <img class="rounded-t-lg object-cover"
                                            src="{{ asset('dist/assets/img/article/' . $article->image) }}"
                                            alt="{{ $article->title }}" />
                                    </div>

                                </div>
                                <div class="p-5">
                                    <div class="flex justify-start mb-2">
                                        <span
                                            class="text-slate-600 font-semibold text-xs uppercase bg-gray-100 px-2 py-1 rounded-full">{{ $article->rCategories->first()->name ?? '' }}</span>
                                    </div>
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">
                                        {{ $article->title }}
                                    </h5>
                                    <p class="text-gray-700 text-sm mb-2">
                                        {{ Str::limit($article->content, 100) }}
                                    </p>
                                    <div class="flex justify-between">
                                        <p class="text-slate-800 font-light text-xs">{{ $article->rAuthor->name ?? '' }}
                                        </p>
                                        <p class="text-slate-800 font-light text-xs">
                                            {{ $article->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-slate-700">No articles found in this category.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <hr class="h-1 w-48 mx-auto my-20 bg-gradient-to-r from-indigo-500 to-sky-500 border-0" />
    @endif
@endsection
