<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces and Routes
|--------------------------------------------------------------------------
|
| When your module starts, this file is executed automatically. By default
| it will only load the module's route file. However, you can expand on
| it to load anything else from the module, such as a class or view.
|
*/

if (!app()->routesAreCached()) {
    require __DIR__.'/Http/routes.php';
}

/*
 *
 * Module Menu for Admin Backend
 *
 * *************************************************************************
 */
\Menu::makeOnce('core_sidebar', function ($menu) {
    // Separator: Module Management
    $all_modules = $menu->add('Modules', [
        'class' => 'nav-title',
    ])
    ->data('order', 2);

    // Articles Dropdown
    $core_menu = $menu->add('<i class="nav-icon fas fa-file-alt"></i> Article', [
        'class' => 'nav-item nav-dropdown',
    ])
    ->data([
        'order'         => 3,
        'activematches' => [
            'admin/posts*',
            'admin/categories*',
            'admin/tags*',
        ],
        'permission' => ['view_posts', 'view_categories', 'view_tags'],
    ]);
    $core_menu->link->attr([
        'class' => 'nav-link nav-dropdown-toggle',
        'href'  => '#',
    ]);

    // Submenu: Posts
    $core_menu->add('<i class="nav-icon fas fa-file-alt"></i> Posts', [
        //'route' => '',
        'class' => 'nav-item',
    ])
    ->data([
        'order'         => 4,
        'activematches' => 'admin/posts*',
        'permission'    => ['edit_posts'],
    ])
    ->link->attr([
        'class' => 'nav-link',
    ]);
    // Submenu: Categories
    $core_menu->add('<i class="nav-icon fas fa-sitemap"></i> Categories', [
        //'route' => '',
        'class' => 'nav-item',
    ])
    ->data([
        'order'         => 5,
        'activematches' => 'admin/categories*',
        'permission'    => ['edit_categories'],
    ])
    ->link->attr([
        'class' => 'nav-link',
    ]);
    // Submenu: Tags
    $core_menu->add('<i class="nav-icon fas fa-tags"></i> Tags', [
        //'route' => '',
        'class' => 'nav-item',
    ])
    ->data([
        'order'         => 6,
        'activematches' => 'admin/tags*',
        'permission'    => ['edit_tags'],
    ])
    ->link->attr([
        'class' => 'nav-link',
    ]);
    // Submenu: Comments
    $core_menu->add('<i class="nav-icon fas fa-comments"></i> Comments', [
        //'route' => '',
        'class' => 'nav-item',
    ])
    ->data([
        'order'         => 7,
        'activematches' => 'admin/comments*',
        'permission'    => ['edit_comments'],
    ])
    ->link->attr([
        'class' => 'nav-link',
    ]);
})->sortBy('order');
