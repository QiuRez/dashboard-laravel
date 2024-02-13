@extends('layouts.layout')

@section('title')
    @parent{{$title}}
@endsection

@section('content')
    @if ($notFound)
        <h2>Категория не найдена</h2>
    @else


    @if($ads = App\Models\Adverisements::where([
        ['CategoryID', $categoryID],
        ['Status', 'Одобрено']
        ])->get())
        @foreach ($ads as $ad)
            <h1>{{$ad->Title}}</h1>
            <p>{{$ad->Description}}</p>
            <p>{{$ad->Status}}</p>
            <p>ЮзерИД{{$ad->UserID}}</p>
        @endforeach
    @endif
    @if (count($ads) == 0)    
    <h2>Объявлений ещё нет</h2>
    @endif


    @endif
@endsection