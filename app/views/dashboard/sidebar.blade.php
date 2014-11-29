<nav class="navmenu navmenu-default" role="navigation">
    <ul class="nav navmenu-nav">
        @if (Auth::checkAccess(Config::get('auth.userType.manager')))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Tools <b class="caret"></b></a>
                <ul class="dropdown-menu navmenu-nav" role="menu">
                    <li><a href="{{ action('UserController@index') }}">Manage Users</a></li>
                </ul>
            </li>
        @endif
         <li><a href="{{ action('DirectoryController@show') }}">Rules</a></li>
    </ul>
</nav>