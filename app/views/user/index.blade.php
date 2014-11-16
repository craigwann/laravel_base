@extends('layouts.default')

@section('content')
    @foreach ($users as $user)
            <p>This is user {{ $user->id }}</p>
    @endforeach
@stop