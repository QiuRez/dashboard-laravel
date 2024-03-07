@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('header')
    @parent
@endsection


@section('content')
    {{printAll($errors)}}
    <div class="row">
        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-2 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3"><img
                            src="{{url($user->UserPhoto)}}"
                            alt="..." width="130" class="rounded mb-2 img-thumbnail">
                        {{-- <a href="#" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a> --}}
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mx-4 mb-0 text-dark">{{ $user->Username }}</h4>
                        {{-- <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>New York</p> --}}
                    </div>
                </div>
            </div>
            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">{{ count($ads) }}</h5><small class="text-muted"> <i
                                class="fas fa-image mr-1"></i>Постов</small>
                    </li>
                    {{-- <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">745</h5><small class="text-muted"> <i
                                    class="fas fa-user mr-1"></i>Followers</small>
                        </li>
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">340</h5><small class="text-muted"> <i
                                    class="fas fa-user mr-1"></i>Following</small>
                        </li> --}}
                </ul>
            </div>
            <div class="px-4 py-3">
                <h5 class="mb-0">О себе</h5>
                <div class="p-4 rounded shadow-sm bg-light">
                    <p class="font-italic mb-0">Web Developer</p>
                    <p class="font-italic mb-0">Lives in New York</p>
                    <p class="font-italic mb-0">Not a Photographer</p>
                </div>
            </div>
            <div class="py-4 px-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Объявления</h5>
                </div>
                <div class="d-flex flex-row justify-content-between">
                    {{-- <div class="col-lg-6 mb-2 pr-lg-1">asd</div> --}}
                    @include('layouts.card')
                </div>
            </div>
            <div class="py-4 px-4">
                {{-- Комментарии --}}
                <h2 class="text-center">Комментарии</h2>
                @include('comments.comment')

                {{-- Конец комментариев --}}
            </div>
        </div>
    </div>
@endsection


@section('footer')
    @parent
@endsection
