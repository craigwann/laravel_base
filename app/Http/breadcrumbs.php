<?php

Breadcrumbs::register('users', function($breadcrumbs) {
    $breadcrumbs->push('Users', url('/users'));
});

Breadcrumbs::register('user', function($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->username, url('/users', $user->id));
});