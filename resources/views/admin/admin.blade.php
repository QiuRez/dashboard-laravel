@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('content')
    <div class="row align-items-start justify-content-between">
        <div class="col-sm-7">
            <div class="d-flex flex-row justify-content-around align-items-start flex-wrap">
                @if ($ads)
                    @foreach ($ads as $ad)
                        <div class="card mb-3">
                            <div class="img">
                                <img src="{{ url($ad->AdPhoto) }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $ad->Title }}</h5>
                                <p class="card-text">{{ $ad->Description }}</p>
                                <hr>
                                <div class="d-flex flex-row justify-content-between">
                                    <p>Автор: {{ $ad->user->Username }}</p>
                                    <img src="{{ url($ad->user->UserPhoto) }}" alt="">
                                </div>
                                <p class="text-muted mb-2">Категория: {{ $ad->category->CategoryName }}</p>
                                <a href="{{ route('admin.approved', ['adId' => "{$ad->AdID}"]) }}"
                                    class="btn btn-primary">Одобрить</a>
                                <a href="{{ route('admin.rejection', ['adId' => "{$ad->AdID}"]) }}"
                                    class="btn btn-danger">Отказать</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-sm-5">
            {{ printAllErrors($errors) }}
            <div class="mb-3">
                <form action="{{ route('admin') }}" method="post">
                    @csrf
                    <label for="newCategory" class="form-label">Новая категория</label>
                    <input class="form-control mb-2" name="newCategory" type="text" id="newCategory">
                    <button type="submit" class="btn btn-success">Создать</button>
                </form>
            </div>
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
                    @foreach ($users as $user)
                        <tr class='@if ($user->Banned) table-danger @endif'>
                            <td class="has-image"><img src="{{ $user->UserPhoto }}" alt=""></td>
                            <form action="{{route('admin.userEdit')}}" method="post">
                            @csrf
                                <td>
                                    <p>{{ $user->Username }}</p>
                                    <input type="text" name="username" value="{{ $user->Username }}">
                                </td>
                                    <input type="hidden" value="{{ $user->UserID }}" name="userId" />
                                <td>
                                    <p>{{ $user->Email }}</p>
                                    <input type="text" name="email" value="{{ $user->Email }}">
                                </td>
                                <td class="has-role">{{ $user->Role }}</td>
                                <td>
                                    @if ($user->Role != 'Администратор')
                                        @switch($user->Banned)
                                            @case(false)
                                                <button class="button-edit">Confirm</button>

                                                <button type="button" class="btn-fake" onclick="userEdit(this)">Edit</button>
                                                <button type="button" class="btn-cancel" onclick="userEdit(this)">Cancel</button>

                                                <a class="ban-or-unban" href="{{ route('user.ban', ['userId' => $user->UserID]) }}">Ban</a>
                                            @break

                                            @case(true)
                                                <a class="ban-or-unban" href="{{ route('user.unban', ['userId' => $user->UserID]) }}">Unban</a>
                                            @break
                                            @default
                                        @endswitch
                                    @endif
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
