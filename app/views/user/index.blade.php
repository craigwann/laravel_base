@extends('layouts.default')

@section('breadcrumbs')
    {{ Breadcrumbs::render('users') }}
@stop

@section('content')
    <table class="table table-hover table-striped">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Type</th>
            <th>Subscription</th>
            <th><a href="{{ URL::route('users.create') }}"><i class="fa fa-plus"></i></a></th>
        </tr>
        @foreach ($users as $user)
            <tr @if ($user->deleted_at) class="danger rowlink" @else class="rowlink" @endif data-link="row">
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->user_type_name }}</td>
                <td></td>
                <td><a href="{{ URL::route('users.edit', array($user->id)) }}"><i class="fa fa-edit"></i></a></td>
            </tr>
        @endforeach
    </table>
    <div class="text-center">
        <?php echo $users->links() ?>
    </div>
@stop