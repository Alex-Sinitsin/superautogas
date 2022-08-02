<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Admin
Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('admin.index'));
});

// Posts
Breadcrumbs::for('admin.posts', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Новости', route('posts.index'));
});

Breadcrumbs::for('admin.post.edit', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('admin.posts');
    $trail->push($post->title, route('posts.edit', $post));
});

Breadcrumbs::for('admin.post.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.posts');
    $trail->push('Создание новости', route('posts.create'));
});

//Pages
Breadcrumbs::for('admin.pages', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Конфиденциальность', route('pages.index'));
});

Breadcrumbs::for('admin.pages.edit', function (BreadcrumbTrail $trail, $page) {
    $trail->parent('admin.pages');
    $trail->push('Редактироввание страницы', route('pages.edit', $page));
});

Breadcrumbs::for('admin.about', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('О компании', route('about.index'));
});

Breadcrumbs::for('admin.about.edit', function (BreadcrumbTrail $trail, $page) {
    $trail->parent('admin.about');
    $trail->push('Редактироввание страницы', route('about.edit', $page));
});

Breadcrumbs::for('admin.pages.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pages');
    $trail->push('Создание новой страницы', route('pages.create'));
});
Breadcrumbs::for('admin.about.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.about');
    $trail->push('Создание новой страницы', route('about.create'));
});
