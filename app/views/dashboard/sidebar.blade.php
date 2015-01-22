<nav class="navmenu navmenu-default" role="navigation">
    <ul class="nav navmenu-nav">
        @if (Auth::checkAccess(Config::get('auth.userType.manager')))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Tools <b class="caret"></b></a>
                <ul class="dropdown-menu navmenu-nav" role="menu">
                    <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                </ul>
            </li>
        @endif
        @if (Auth::checkAccess(Config::get('auth.userType.gameMaster')))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Game Master Tools <b class="caret"></b></a>
                <ul class="dropdown-menu navmenu-nav" role="menu">
                    <li><a href="#">Baddie Generator</a></li>
                    <li><a href="#">Character Builder</a></li>
                    <li><a href="#">Dice Roller</a></li>
                    <li><a href="#">Item Generator</a></li>
                    <li><a href="#">NPC Generator</a></li>
                </ul>
            </li>
        @endif
         <li><a href="{{ route('directory.show') }}">Rules</a></li>
    </ul>
</nav>