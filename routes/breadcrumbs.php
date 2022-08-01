<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Admin
Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('admin.index'));
});

// Posts
Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Новости', route('posts.index'));
});

Breadcrumbs::for('post', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('posts');
    $trail->push($post->title, route('posts.edit', $post));
});
