@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('content')
    <div class="row align-items-start justify-content-between">
        <div class="col-md-7">
            <div class="d-flex flex-row justify-content-between align-items-start flex-wrap">
                @if ($ads)
                    @foreach ($ads as $ad)
                        <div class="card">
                            <div class="img">
                                <img src="{{ url($ad->AdPhoto) }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$ad->Title}}</h5>
                                <p class="card-text">{{$ad->Description}}</p>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <p>Автор: {{$ad->user->Username}}</p>
                                    <img src="{{url($ad->user->UserPhoto)}}" alt="">
                                </div>
                                <a href="{{route("admin.approved", ['adId' => "{$ad->AdID}"])}}" class="btn btn-primary">Одобрить</a>
                                <a href="{{route("admin.rejection", ['adId' => "{$ad->AdID}"])}}" class="btn btn-danger">Отказать</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-sm-5">
            <table class="table">
                <thead>
                    <tr class="">
                        <th scope="col">Avatar</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $users = App\Models\User::all() @endphp
                    @foreach ($users as $user)
                        <tr class='@if ($user->Banned) table-danger @endif'>
                            <td class="has-image"><img src="{{ $user->UserPhoto }}" alt=""></td>
                            <td>{{ $user->Username }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>{{ $user->Role }}</td>
                            <td>
                                @if ($user->Role != 'Администратор')
                                    @switch($user->Banned)
                                        @case(false)
                                            <a href="">Edit</a>
                                            <a href="{{route('user.ban', ['userId' => $user->UserID])}}">Ban</a>
                                        @break

                                        @case(true)
                                            <a href="{{route('user.unban', ['userId' => $user->UserID])}}">Unban</a>
                                        @break

                                        @default
                                    @endswitch
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
