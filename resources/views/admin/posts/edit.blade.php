@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактировать статью</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Статья {{ $post->title }}</h3>
                        </div>
                        <!-- /.card-header -->

                        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}"
                              role="form" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title" class="form-control
                        @error('title') is-invalid @enderror" id="title" value="{{ $post->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ $post->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content">Текст</label>
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="10">{{ $post->content }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Категория</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                        @foreach($categories as $key => $category)
                                            <option value="{{ $key }}" @if($key == $post->category_id) selected @endif>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="is_published">Опубликовано?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ $post->is_published ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_published">
                                            Да
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" class="custom-file-input">
                                            <label class="custom-file-label" for="image">Файл</label>
                                        </div>
                                    </div>
                                    <div><img src="{{ $post->getImage() }}" alt="Изображение" class="img-thumbnail img-fluid mt-2" width="600" height="400"></div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Создать</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
