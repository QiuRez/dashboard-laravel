@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('content')
    @if ($notFound)
        <h2>Категория не найдена</h2>
    @else
        @if ($ads = App\Models\Adverisements::where([['CategoryID', $categoryID], ['Status', 'Одобрено']])->get())
            @foreach ($ads as $ad)
                <div class="news">
                    <img src="{{url('/images/ad/sale-products-with-discount_23-2150296289.jpg')}}" alt="" id="featuredico" />
                    <h3>{{ $ad->Title }}</h3>
                    <p><p>{{ $ad->Description }}</p></p>
                    <div class="button__user">
                        <a href="#" class="readmore">Read more</a>
                        <div class="user-info">
                            <p>ЮзерИД{{ $ad->UserID }}</p>

                        </div>
                    </div>
                </div>
                
            @endforeach
        @endif
        @if (count($ads) == 0)
            <h2>Объявлений ещё нет</h2>
        @endif


    @endif
@endsection
