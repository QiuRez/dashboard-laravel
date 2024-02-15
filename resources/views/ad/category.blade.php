@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('content')
    @if ($notFound)
        <h2>Категория не найдена</h2>
    @else
        @if ($ads)
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
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if (count($ads) == 0)
            <h2>Объявлений ещё нет</h2>
        @endif


    @endif
@endsection
