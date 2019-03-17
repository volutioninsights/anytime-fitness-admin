<?php

Breadcrumbs::for('admin.users', function ($trail) {
    $trail->push('All Users', route('admin.users'));
    $trail->push('View User');
});

?>