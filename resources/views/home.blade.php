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
            @foreach ($ads as $ad)
                <div class="card mb-3">
                    @if ($ad->AdPhoto)
                        <div class="img">
                            <img src="{{ url($ad->AdPhoto) }}" class="card-img-top" alt="...">
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $ad->Title }}</h5>
                        <p class="card-text">{{ $ad->Description }}</p>
                        <hr>
                        <div class="d-flex flex-row justify-content-between">
                            <p>Автор: {{ $ad->user->Username }}</p>
                            <img src="{{ url($ad->user->UserPhoto) }}" alt="">
                        </div>
                        <p class="text-muted mb-2">Категория: {{ $ad->category->CategoryName }}</p>
                    @auth
                        @if (Auth::user()->Role == 'Администратор')
                            <a href="{{ route('ad.removeAd', ['adId' => $ad->AdID]) }}"
                                class="btn btn-outline-danger btn-sm">Delete</a>
                        @endif
                    @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h2>Объявлений нет :(</h2>
    @endif 
@endsection


@section('footer')
    @parent
@endsection
