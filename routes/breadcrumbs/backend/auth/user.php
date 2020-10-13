<?php

Breadcrumbs::for('admin.auth.user.index', function ($trail) {
    $trail->push(__('labels.backend.access.users.management'), route('admin.auth.user.index'));
});

Breadcrumbs::for('admin.auth.user.deactivated', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.deactivated'), route('admin.auth.user.deactivated'));
});

Breadcrumbs::for('admin.auth.user.deleted', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.deleted'), route('admin.auth.user.deleted'));
});

Breadcrumbs::for('admin.auth.user.create', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('labels.backend.access.users.create'), route('admin.auth.user.create'));
});

Breadcrumbs::for('admin.auth.user.show', function ($trail, $id) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.view'), route('admin.auth.user.show', $id));
});

Breadcrumbs::for('admin.auth.user.edit', function ($trail, $id) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.edit'), route('admin.auth.user.edit', $id));
});

Breadcrumbs::for('admin.auth.user.change-password', function ($trail, $id) {
    $trail->parent('admin.auth.user.index');
    $trail->push(__('menus.backend.access.users.change-password'), route('admin.auth.user.change-password', $id));
});


Breadcrumbs::for('admin.blog.category.index', function ($trail) {
    $trail->push('Blog Category', route('admin.blog.category.index'));
});

Breadcrumbs::for('admin.blog.category.create', function ($trail) {
    $trail->parent('admin.blog.category.index');
    $trail->push('Create Blog Category', route('admin.blog.category.create'));
});

Breadcrumbs::for('admin.blog.category.deleted', function ($trail) {
    $trail->parent('admin.blog.category.index');
    $trail->push('Deleted Blog Category', route('admin.blog.category.deleted'));
});

Breadcrumbs::for('admin.blog.category.edit', function ($trail, $id) {
    $trail->parent('admin.blog.category.index');
    $trail->push('Edit Blog Category', route('admin.blog.category.edit', $id));
});

Breadcrumbs::for('admin.blog.index', function ($trail) {
    $trail->push('Blog', route('admin.blog.index'));
});

Breadcrumbs::for('admin.blog.create', function ($trail) {
    $trail->parent('admin.blog.index');
    $trail->push('Create Blog', route('admin.blog.create'));
});

Breadcrumbs::for('admin.blog.edit', function ($trail, $id) {
    $trail->parent('admin.blog.index');
    $trail->push('Edit Blog', route('admin.blog.edit', $id));
});

Breadcrumbs::for('admin.blog.deleted', function ($trail) {
    $trail->parent('admin.blog.index');
    $trail->push('Deleted Blog', route('admin.blog.deleted'));
});


Breadcrumbs::for('admin.blog.show', function ($trail, $id) {
    $trail->parent('admin.blog.index');
    $trail->push('Blog View', route('admin.blog.show', $id));
});