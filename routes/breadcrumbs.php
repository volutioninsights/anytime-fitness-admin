<?php

Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Admin');
});

Breadcrumbs::for('admin.users', function ($trail) {
    $trail->parent('admin');
    $trail->push('All Users', route("admin.users"));
});

Breadcrumbs::for('admin.users.view', function ($trail) {
    $trail->parent('admin.users');
    $trail->push('View User');
});

Breadcrumbs::for('gyms.list', function ($trail) {
    // $trail->parent('admin.users');
    $trail->push('All Gyms', route("gyms.list"));
});

Breadcrumbs::for('gyms.view', function ($trail, $gym) {
    $trail->parent('gyms.list');
    $trail->push($gym->name, route('gyms.view', ['gym' => $gym->id]));
});

Breadcrumbs::for('pt.view', function ($trail, $pt) {
    $trail->parent('gyms.view', $pt->gym);
    $trail->push('Personal Trainer', route('pt.view', ['pt' => $pt->id]));
});

Breadcrumbs::for('gyms.trainer', function ($trail, $gym) {
    $trail->parent('gyms.view', $gym);
    $trail->push('Add Personal Trainer');
});

Breadcrumbs::for('pt.edit', function ($trail, $pt) {
    $trail->parent('pt.view', $pt);
    $trail->push('Edit');
});

Breadcrumbs::for('gyms.edit', function ($trail, $gym) {
    $trail->parent('gyms.view', $gym);
    $trail->push('Edit');
});

Breadcrumbs::for('members.list', function ($trail) {
    $trail->push('All Members', route("members.list"));
});

?>