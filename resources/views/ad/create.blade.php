@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('content')
    {{printAllErrors($errors)}}
    <div class="row align-items-start justify-content-center">
        <div class="col-md-7">
            <form action="{{ route('ad.create') }}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="mb-3">
                    <label for="input-title" class="form-label">Заголовок *</label>
                    <input class="form-control" name="title" id="input-title" type="text" placeholder="Title"
                        aria-label="default input example">
                </div>
                <div class="mb-3">
                    <label for="input-description" class="form-label">Текст объявления *</label>
                    <textarea class="form-control" name="description" id="input-description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Фото объявления</label>
                    <input class="form-control" name="image" type="file" id="formFile">
                </div>
                <select class="form-select mb-3" name="category" aria-label="Default select example">
                    <option selected>Выберите категорию *</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->CategoryID}}">{{$category->CategoryName}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">Отправить на модерацию</button>
            </form>
        </div>
    </div>
@endsection
