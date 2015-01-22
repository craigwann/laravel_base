@extends('layouts.leftSidebar')

@section('breadcrumbs')
    {{ Breadcrumbs::render('milestones') }}
@stop

@section('sidebar')
    @include('directory.sidebar')
@stop

@section('content')
    <h1>Milestones</h1>
    <table class="table table-hover table-striped">
            <tr>
                <th>Name</th>
                <th>About</th>
                <th>@if (Auth::checkAccess(Config::get('auth.userType.manager')))<a href="{{ URL::route('milestones.create') }}"><i class="fa fa-plus"></i></a>@endif</th>
            </tr>
            @foreach ($milestones as $milestone)
                <tr class="rowlink" data-link="row">
                    <td>{{ $milestone->name }}</td>
                    <td>{{ $milestone->short }}</td>
                    <td><a href="{{ URL::route('milestones.show', array($milestone->id)) }}"><i class="fa fa-info"></i></a></td>
                </tr>
            @endforeach
        </table>
        <div class="text-center">
            <?php echo $milestones->links() ?>
        </div>
@endsection

@stop