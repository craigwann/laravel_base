<?php
//DIRECTORY
Breadcrumbs::register('directory', function($breadcrumbs) {
    $breadcrumbs->push('Rules', url('/rules'));
});

//MILESTONES
Breadcrumbs::register('milestones', function($breadcrumbs) {
    $breadcrumbs->parent('directory');
    $breadcrumbs->push('Milestones', url('/milestones'));
});

//USERS
Breadcrumbs::register('users', function($breadcrumbs) {
    $breadcrumbs->push('Users', url('/users'));
});

Breadcrumbs::register('user', function($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->username, url('/users', $user->id));
});