@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('content')
    @if ($notFound)
        <h2>Категория не найдена</h2>
    @else
        @if ($ads)
            {{printAll($errors)}}
            <h2 class="text-center">{{ $category->CategoryName }}</h2>
            <div class="row align-items-end justify-content-around">
                @include('layouts.card')
            </div>
        @endif
        @if (count($ads) == 0)
            <h2>Объявлений ещё нет</h2>
        @endif


    @endif
@endsection
