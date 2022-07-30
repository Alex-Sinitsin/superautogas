<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Admin
Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('admin.index'));
});

// Admin
Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Новости', route('posts.index'));
});
