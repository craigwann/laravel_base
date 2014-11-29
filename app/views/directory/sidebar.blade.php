<nav class="navmenu navmenu-default" role="navigation">
    <ul class="nav navmenu-nav">
      <li class="{{{ (Request::is('rules') ? 'active' : '') }}}"><a href="{{ action('DirectoryController@show') }}">Getting Started</a></li>
      <li class="{{{ (Request::is('milestones') ? 'active' : '') }}}"><a href="{{ action('MilestoneController@index') }}">Milestones</a></li>
    </ul>
</nav>