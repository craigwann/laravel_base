@extends('layouts.default')

@section('content')
    <table class="table table-hover table-striped">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Type</th>
            <th>Subscription</th>
            <th></th>
        </tr>
        @foreach ($users as $user)
            <tr @if (!$user->user_active) class="danger rowlink" @else class="rowlink" @endif data-link="row">
                <td>{{ $user->user_first_name }} {{ $user->user_last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->user_username }}</td>
                <td>{{ $user->user_type_name }}</td>
                <td></td>
                <td><a href="{{ URL::action('UserController@edit', array($user->user_id)) }}"></a><i class="fa fa-edit"></i></td>
            </tr>
        @endforeach
    </table>
@stop