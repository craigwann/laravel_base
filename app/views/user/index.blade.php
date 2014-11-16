@extends('layouts.default')

@section('content')
    <table class="table table-hover table-striped">
      @foreach ($users as $user)
        <tr @if (!$user->user_active) class="danger" @endif >
            <td>{{ $user->user_first_name }}</td>
            <td>{{ $user->user_last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->user_username }}</td>
        </tr>
      @endforeach
    </table>
@stop