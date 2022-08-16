<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Admin
Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('admin.dashboard.index'));
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
    $trail->push('Разделы', route('pages.index'));
});

Breadcrumbs::for('admin.pages.edit', function (BreadcrumbTrail $trail, $page) {
    $trail->parent('admin.pages');
    $trail->push('Редактироввание страницы', route('pages.edit', $page));
});


Breadcrumbs::for('admin.pages.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pages');
    $trail->push('Создание новой страницы', route('pages.create'));
});

//Galleries
Breadcrumbs::for('admin.galleries', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Наши работы', route('galleries.index'));
});

Breadcrumbs::for('admin.galleries.show', function (BreadcrumbTrail $trail, $model, $brand) {
    $trail->parent('admin');
    $trail->push('Наши работы', route('galleries.index'));
    $trail->push($brand->name, route('galleries.index'));
    $trail->push($model->name, route('galleries.show', $model->slug));
});

//Testimonials
Breadcrumbs::for('admin.testimonials', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Отзывы клиентов', route('testimonials.index'));
});
Breadcrumbs::for('admin.testimonials.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.testimonials');
    $trail->push('Создание нового отзыва', route('testimonials.create'));
});
Breadcrumbs::for('admin.testimonials.edit', function (BreadcrumbTrail $trail, $testimonial) {
    $trail->parent('admin.testimonials');
    $trail->push('Редактирование отзыва', route('testimonials.edit', $testimonial->id));
});

//Certificates
Breadcrumbs::for('admin.certificates', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Сертификаты компании', route('admin.certificates.index'));
});
