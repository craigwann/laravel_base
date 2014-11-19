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
            <tr @if (!$user->active) class="danger rowlink" @else class="rowlink" @endif data-link="row">
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->user_type_name }}</td>
                <td></td>
                <td><a href="{{ URL::action('UserController@edit', array($user->id)) }}"></a><i class="fa fa-edit"></i></td>
            </tr>
        @endforeach
    </table>
    <div class="text-center">
        <?php echo $users->links(); ?>
    </div>
@stop