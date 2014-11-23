<ul class="nav navmenu-nav">
    <li><a class="bootbox-confirm" href="{{ action('UserController@destroy', array($user->id)) }}" data-method="delete"><i class="fa fa-remove"></i> Delete</a></li>
</ul>