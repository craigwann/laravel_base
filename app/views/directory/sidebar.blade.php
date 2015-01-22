<nav class="navmenu navmenu-default" role="navigation">
    <ul class="nav navmenu-nav">
      <li class="{{{ (Request::is('rules') ? 'active' : '') }}}"><a href="{{ route('directory.show') }}">Getting Started</a></li>
      <li class="{{{ (Request::is('milestones') ? 'active' : '') }}}"><a href="{{ route('milestones.index') }}">Milestones</a></li>
    </ul>
</nav>