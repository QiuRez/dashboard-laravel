@extends('layouts.layout')

@section('title')
    @parent{{ $title }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row align-items-start justify-content-between">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
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
                            <tr>
                                <td class="has-image"><img src="{{ $user->UserPhoto }}" alt=""></td>
                                <td>{{ $user->Username }}</td>
                                <td>{{ $user->Email }}</td>
                                <td>{{ $user->Role }}</td>
                                <td>
                                    <a href="">Edit</a>
                                    <a href="">Ban</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
