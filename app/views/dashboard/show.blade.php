@extends('layouts.leftSidebar')

@section('sidebar')
    <nav class="navmenu navmenu-default" role="navigation">
      <!-- <a class="navmenu-brand" href="#">Brand</a> -->

    @if (Auth::checkAccess(Config::get('auth.userType.manager')))
      <ul class="nav navmenu-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Tools <b class="caret"></b></a>
            <ul class="dropdown-menu navmenu-nav" role="menu">
                <li><a href="{{ action('UserController@index') }}"> Manage Users</a></li>
            </ul>
        </li>
      </ul>
    @endif

    <a class="navmenu-brand" href="#">Rules</a>

    <ul class="nav navmenu-nav">
          <li><a href="#">Milestones</a></li>
       </ul>
    </nav>
@stop

@section('content')

@stop

