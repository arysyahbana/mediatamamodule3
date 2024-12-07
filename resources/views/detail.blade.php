@extends('layouts.user')

@section('title', 'Detail')

@section('content')
    <!-- Content 1 -->
    <div class="container mx-auto mt-12">
        <div class="rounded-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-105">
            <a href="{{ route('detail', $article->id) }}">
                <img class="rounded-t-lg object-cover w-full h-64 sm:h-80 md:h-96 lg:h-80"
                    src="{{ asset('dist/assets/img/article/' . $article->image) }}" alt="{{ $article->title }}" />
            </a>
            <div class="p-6">
                <!-- Kategori -->
                <div class="flex justify-between mb-2">
                    <span
                        class="text-slate-600 font-semibold text-xs uppercase bg-gray-100 px-2 py-1 rounded-full">{{ $article->rCategories->first()->name ?? '' }}</span>
                    <div class="flex space-x-2">
                        @foreach ($article->rTags as $tag)
                            <span class="text-xs font-medium text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <!-- Judul Artikel -->
                <a href="{{ route('detail', $article->id) }}">
                    <h5
                        class="text-2xl font-bold text-gray-900 tracking-tight mb-4 hover:text-indigo-600 transition-colors duration-200">
                        {{ $article->title }}</h5>
                </a>
                <!-- Konten Singkat Artikel -->
                <p class="text-gray-700 text-sm line-clamp-3 mb-4">
                    {{ $article->content }}
                </p>
                <!-- Footer Artikel -->
                <div class="flex justify-between items-center text-sm text-gray-600">
                    <p class="font-light">{{ $article->rAuthor->name ?? '' }}</p>
                    <p class="font-light">{{ $article->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>



    <hr class="h-1 w-48 mx-auto my-20 bg-gradient-to-r from-indigo-500 to-sky-500 border-0" />

@endsection
