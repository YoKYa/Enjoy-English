<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Admin
Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('admin', route('admin'));
});
Breadcrumbs::for('admin.topics', function (BreadcrumbTrail $trail) {
    $trail->push('topics', route('admin'));
});
Breadcrumbs::for('topics', function (BreadcrumbTrail $trail) {
    $trail->push('topics', route('topics'));
});

// Admin > Users
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push('Users', route('admin.users'));
});


// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });