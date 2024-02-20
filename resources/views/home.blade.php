@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('header')
    @parent
@endsection


@section('content')
    @if ($ads)
        {{printAll($errors)}}
        <div class="row align-items-end justify-content-around">
            @include('layouts.card')
        </div>
    @else
        <h2>Объявлений нет :(</h2>
    @endif 
@endsection


@section('footer')
    @parent
@endsection
