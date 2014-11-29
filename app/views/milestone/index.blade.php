@extends('layouts.leftSidebar')

@section('breadcrumbs')
    {{ Breadcrumbs::render('milestones') }}
@stop

@section('sidebar')
    @include('directory.sidebar')
@stop

@section('content')
    <h1>Milestones</h1>
@endsection

@stop