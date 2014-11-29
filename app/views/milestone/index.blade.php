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
                <th>Milestone</th>
                <th>Description</th>
                <th><a href="{{ URL::action('MilestoneController@create') }}"><i class="fa fa-plus"></i></a></th>
            </tr>
        </table>
        <div class="text-center">
            <?php echo $milestones->links(); ?>
        </div>
@endsection

@stop