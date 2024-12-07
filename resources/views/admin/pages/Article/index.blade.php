@extends('admin.app')

@section('title', 'Daftar Article')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h6>Daftar Article</h6>
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="#" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#addArticle"><i
                                class="fa fa-plus" aria-hidden="true"></i><span
                                class="text-capitalize ms-1">Tambah</span></a>
                    </div>
                    <div class="card-body px-5 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <x-admin.table id="datatable">
                                @slot('header')
                                    <tr>
                                        <x-admin.th>No</x-admin.th>
                                        <x-admin.th>Photo</x-admin.th>
                                        <x-admin.th>Title</x-admin.th>
                                        <x-admin.th>Author</x-admin.th>
                                        <x-admin.th>Content</x-admin.th>
                                        <x-admin.th>Category</x-admin.th>
                                        <x-admin.th>Tags</x-admin.th>
                                        <x-admin.th>Action</x-admin.th>
                                    </tr>
                                @endslot

                                @foreach ($data as $item)
                                    <tr>
                                        <x-admin.td>{{ $loop->iteration }}</x-admin.td>
                                        <x-admin.td>
                                            <img src="{{ asset('dist/assets/img/article/' . $item->image ?? '') }}"
                                                alt="{{ $item->title ?? '' }}" class="img-fluid img-thumbnail"
                                                style="max-width: 100px">
                                        </x-admin.td>
                                        <x-admin.td>{{ $item->title ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->rAuthor->name ?? '' }}</x-admin.td>
                                        <x-admin.td
                                            style="word-wrap: break-word; word-break: break-word; white-space: normal; min-width: 300px">{{ $item->content ?? '' }}</x-admin.td>
                                        <x-admin.td>{{ $item->rCategories->pluck('name')->implode(', ') }}</x-admin.td>
                                        <x-admin.td>
                                            @foreach ($item->rTags as $tag)
                                                {{ $tag->name . ', ' }}
                                            @endforeach
                                        </x-admin.td>
                                        <x-admin.td>
                                            <a href="#" class="btn bg-gradient-info" data-bs-toggle="modal"
                                                data-bs-target="#editArticle{{ $item->id }}"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Edit</span></a>
                                            <a href="#" class="btn bg-gradient-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusArticle{{ $item->id }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i><span
                                                    class="text-capitalize ms-1">Hapus</span></a>
                                        </x-admin.td>

                                        <!-- Modal Edit Article -->
                                        <div class="modal fade" id="editArticle{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="editArticleLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editArticleLabel">Edit Data Article
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <img src="{{ asset('dist/assets/img/article/' . $item->image ?? '') }}"
                                                        alt="" class="img-fluid p-3 img-thumbnail">
                                                    <form action="{{ route('Article.update', $item->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <x-admin.input type="file" placeholder="Change Photo"
                                                                label="Change Photo" name="image"
                                                                value="{{ $item->image ?? '' }}" />
                                                            <x-admin.input type="text" placeholder="Title" label="Title"
                                                                name="title" value="{{ $item->title ?? '' }}" />
                                                            <div class="mb-3">
                                                                <label for="author_id">Author</label>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="author_id"
                                                                    name="author_id">
                                                                    <option selected value="0">--- Pilih Author ---
                                                                    </option>
                                                                    @foreach ($authors as $author)
                                                                        <option value="{{ $author->id ?? '0' }}"
                                                                            @if ($author->id == $item->author_id) selected @endif>
                                                                            {{ $author->name ?? '' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="category" class="form-label">Category</label>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="category"
                                                                    name="category_id">
                                                                    <option selected value="0">--- Pilih Category ---
                                                                    </option>
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                            @if ($item->rCategories->contains('id', $category->id)) selected @endif>
                                                                            {{ $category->name ?? '' }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tag" class="form-label">Tag</label>
                                                                <select class="form-select tag"
                                                                    aria-label="Default select example" id="tag"
                                                                    name="tag[]" multiple="multiple">
                                                                    @foreach ($tags as $tag)
                                                                        <option value="{{ $tag->id ?? '0' }}"
                                                                            @if ($item->rTags->contains('id', $tag->id)) selected @endif>
                                                                            {{ $tag->name ?? '' }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="content">Content</label>
                                                                <textarea class="form-control" id="content" name="content" rows="3">
                                                                    {{ $item->content ?? '' }}
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-success">Update</button>
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus Article -->
                                        <div class="modal fade" id="hapusArticle{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="hapusArticleLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusArticleLabel">Hapus Data
                                                            Article
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('dist/assets/img/bin.gif') }}" alt=""
                                                            class="img-fluid w-25">
                                                        <p>Yakin ingin menghapus data {{ $item->nama }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('Article.destroy', $item->id) }}"
                                                            type="submit" class="btn btn-sm btn-danger">Hapus</a>
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </x-admin.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Article -->
    <div class="modal fade" id="addArticle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addArticleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addArticleLabel">Tambah Data Article</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('Article.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <x-admin.input type="file" placeholder="Photo" label="Photo" name="image" />
                        <x-admin.input type="text" placeholder="Title" label="Title" name="title" />
                        <div class="mb-3">
                            <label for="author_id">Author</label>
                            <select class="form-select" aria-label="Default select example" id="author_id"
                                name="author_id">
                                <option selected value="0">--- Pilih Author ---</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id ?? '0' }}">{{ $author->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" aria-label="Default select example" id="category"
                                name="category_id">
                                <option selected value="0">--- Pilih Category ---</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id ?? '0' }}">
                                        {{ $category->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag</label>
                            <select class="form-select tag" aria-label="Default select example" id="tag"
                                name="tag[]" multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id ?? '0' }}">
                                        {{ $tag->name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
