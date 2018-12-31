<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {




        \Menu::make('MyNavBar', function ($menu) {
            $menu->add('Home');
            $menu->add('About', 'about');
            $menu->add('Services', 'services');
            $menu->add('Contact', 'contact');
        });
    
        return $next($request);










        \Menu::make('admin_sidebar', function ($menu) {
            // Dashboard
            $menu->add('<i class="nav-icon icon-speedometer"></i> Dashboard', [
                'route' => 'backend.dashboard',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 1,
                'activematches' => 'admin/dashboard*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Separator: Access Management
            $menu->add('Management', [
                'class' => 'nav-title',
            ])
            ->data('order', 77);

            // Settings
            $menu->add('<i class="nav-icon fas fa-cogs"></i> Settings', [
                'route' => 'backend.settings',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 78,
                'activematches' => 'admin/settings*',
                'permission'    => ['edit_settings'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Backup
            $menu->add('<i class="nav-icon fas fa-archive"></i> Backups', [
                'route' => 'backend.backups.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 79,
                'activematches' => 'admin/backups*',
                'permission'    => ['view_backups'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Access Control Dropdown
            $accessControl = $menu->add('<i class="nav-icon icon-key"></i> Access Control', [
                'class' => 'nav-item nav-dropdown',
            ])
            ->data([
                'order'         => 80,
                'activematches' => [
                    'admin/roles*',
                    'admin/users*',
                ],
                'permission'    => ['view_users', 'view_roles'],
            ]);
            $accessControl->link->attr([
                'class' => 'nav-link nav-dropdown-toggle',
                'href'  => '#',
            ]);

            // Submenu: Users
            $accessControl->add('<i class="nav-icon icon-people"></i> Users', [
                'route' => 'backend.users.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 81,
                'activematches' => 'admin/users*',
                'permission'    => ['view_users'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Roles
            $accessControl->add('<i class="nav-icon icon-people"></i> Roles', [
                'route' => 'backend.roles.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 82,
                'activematches' => 'admin/roles*',
                'permission'    => ['view_roles'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Log Viewer
            // Log Viewer Dropdown
            $accessControl = $menu->add('<i class="nav-icon fas fa-list"></i> Log Viewer', [
                'class' => 'nav-item nav-dropdown',
            ])
            ->data([
                'order'         => 83,
                'activematches' => [
                    'log-viewer*',
                ],
                'permission'    => ['view_logs'],
            ]);
            $accessControl->link->attr([
                'class' => 'nav-link nav-dropdown-toggle',
                'href'  => '#',
            ]);

            // Submenu: Log Viewer Dashboard
            $accessControl->add('<i class="nav-icon fas fa-list"></i> Dashboard', [
                'route' => 'log-viewer::dashboard',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 84,
                'activematches' => 'admin/log-viewer',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Submenu: Log Viewer Logs by Days
            $accessControl->add('<i class="nav-icon fas fa-list-ol"></i> Logs by Days', [
                'route' => 'log-viewer::logs.list',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 85,
                'activematches' => 'admin/log-viewer/logs*',
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Newsletter Dropdown
            $newslettersControl = $menu->add('<i class="nav-icon fas fa-newspaper"></i> Newsletter', [
                'class' => 'nav-item nav-dropdown',
            ])
            ->data([
                'order'         => 8,
                'activematches' => [
                    'admin/newsletters*',
                ],
                'permission'    => ['view_newsletters'],
            ]);
            $newslettersControl->link->attr([
                'class' => 'nav-link nav-dropdown-toggle',
                'href'  => '#',
            ]);

            // Submenu: Posts
            $newslettersControl->add('<i class="nav-icon fas fa-newspaper"></i> Newsletter Posts', [
                'route' => 'backend.newsletters.index',
                'class' => 'nav-item',
            ])
            ->data('order', 9)
            ->link->attr([
                'class' => 'nav-link',
            ]);

            // Access Permission Check
            $menu->filter(function ($item) {
                if ($item->data('permission')) {
                    if (auth()->check() && auth()->user()->hasAnyPermission($item->data('permission'))) {
                        return true;
                    }

                    return false;
                } else {
                    return true;
                }
            });

            $menu->filter(function ($item) {
                // if ($item->title === '<i class="icon-key"></i> Access Control') {
                //     if ($item->activematches) {
                //
                //         $matches = is_array($item->activematches) ? $item->activematches : [$item->activematches];
                //
                //         foreach ($matches as $pattern) {
                //             // dd(\Request::path());
                //             // dd($pattern);
                //             if (str_is($pattern, \Request::path())) {
                //                 $item->activate();
                //                 $item->isActive = true;
                //                 dd($item);
                //             }
                //             // dd($item);
                //         }
                //     }
                // }
                if ($item->activematches) {
                    $matches = is_array($item->activematches) ? $item->activematches : [$item->activematches];

                    foreach ($matches as $pattern) {
                        if (str_is($pattern, \Request::path())) {
                            $item->activate();
                            // dd($item);
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        return $next($request);
    }
}
