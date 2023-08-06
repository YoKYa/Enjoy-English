<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('topics', function (BreadcrumbTrail $trail) {
    $trail->push('topics', route('topics'));
});

Breadcrumbs::for('materi', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('topics');
    $trail->push('Materi', route('materi', $id));
});


// Admin
Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('admin', route('admin'));
});
Breadcrumbs::for('admin.topics', function (BreadcrumbTrail $trail) {
    $trail->push('topics', route('admin'));
});


// Admin > Users
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Users', route('admin.users'));
});
Breadcrumbs::for('admin.materi', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('admin');
    $trail->push('materi', route('admin.materi', $id));
});

// Admin > Topic > Materi > lessons
Breadcrumbs::for('admin.lessons', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('admin');
    $trail->push('lessons', route('admin.lessons', $slug));
});
// Admin > Topic > Materi > Practice
Breadcrumbs::for('admin.practice', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('admin');
    $trail->push('practice', route('admin.practice', $slug));
});

// Admin > Topic > Materi > Test
Breadcrumbs::for('admin.test', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('admin');
    $trail->push('test', route('admin.test', $slug));
});