<?php

return [

    'title' => 'Gestor de Proyectos', // Título de la pestaña del navegador
    'title_prefix' => '',
    'title_postfix' => '',

    'use_ico_only' => false,
    'use_full_favicon' => false,

    'google_fonts' => [
        'allowed' => true,
    ],

    'logo' => '<b>Gestor de Proyectos</b>',
    // Asegúrate que esta ruta sea correcta para tu logo
    // Si tu archivo "Logo.PNG" está en 'public/img/Logo.PNG', cambia la ruta a 'img/Logo.PNG'.
    // Si está en 'public/vendor/adminlte/dist/img/Logo.PNG', la ruta actual es correcta.
    'logo_img' => 'images/Logo.PNG',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Logo del Gestor',

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Cargando...',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    'use_route_url' => false,
    'dashboard_url' => 'dashboard', // Nombre de la ruta de tu dashboard
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    'navbar' => [
        'type'         => 'full-width',
        'items'        => [
            [
                'type'         => 'navbar-sidebar-toggle',
                'url'          => '#',
                'icon'         => 'fas fa-bars',
            ],
            [
                'type'         => 'navbar-search',
                'url'          => 'admin/search', // Puedes cambiar esta URL si tienes una búsqueda personalizada
                'text'         => 'search',
                'topnav_right' => true,
            ],
            [
                'type'         => 'darkmode-widget',
                'topnav_right' => true,
            ],
            [
                'type'         => 'navbar-notification',
                'id'           => 'my-notification-center',
                'icon'         => 'fas fa-bell',
                'url'          => 'notifications',
                'topnav_right' => true,
                'badge'        => 0,
                'text'         => 'Notifications',
                'update_url'   => 'notifications/get',
            ],
            [
                'type'         => 'fullscreen-widget',
                'topnav_right' => true,
            ],
            [
                'type'         => 'gen-auth-user',
                'topnav_right' => true,
            ],
        ],
    ],

    // --- SECCIÓN MENÚ (SIDEBAR) ---
    'menu' => [
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text'        => 'Dashboard',
            'url'         => 'dashboard',
            'icon'        => 'fas fa-fw fa-tachometer-alt',
            'active'      => ['dashboard'],
        ],
        [
            'header' => 'GESTIÓN DE PROYECTOS',
        ],
        [
            'text'        => 'Proyectos',
            'url'         => '#', // URL principal para el menú desplegable (no lleva a ningún lado directamente)
            'icon'        => 'fas fa-fw fa-project-diagram',
            'active'      => ['proyectos*'], // Importante: 'proyectos*' para que se active con 'proyectos' y 'proyectos/crear'
            'submenu' => [
                [
                    'text' => 'Ver Todos',
                    'url'  => 'proyectos', // Coincide con la ruta 'proyectos.index'
                    'icon' => 'fas fa-fw fa-list',
                    'active' => ['proyectos'], // Activa solo cuando estás en /proyectos
                ],
               
            ],
        ],
        
        [
            'text'        => 'Clientes',
            'url'         => 'clientes',
            'icon'        => 'fas fa-fw fa-users',
            'active'      => ['clientes*', 'clientes/*'],
        ],
        [
            'text'        => 'Proyectos Pendientes',
            'url'         => 'pendientes',
            'icon'        => 'fas fa-fw fa-tasks',
            'active'      => ['pendientes*', 'pendientes/*'],
        ],
        [
            'text'        => 'Proyetos Finalizados en el Mes',
            'url'         => 'entregados-mes',
            'icon'        => 'fas fa-fw fa-chart-line',
            'active'      => ['entregados-mes*'],
        ],
        
        [
            'header' => 'AJUSTES DEL SISTEMA',
        ],
        [
            'text'        => 'Perfil', // Renombrado para que coincida con 'profile.edit'
            'url'         => 'profile', // Coincide con la ruta 'profile.edit'
            'icon'        => 'fas fa-fw fa-user',
            'active'      => ['profile'],
        ],
        // No tienes una ruta específica de "configuración general" ni "usuarios y roles" aún.
        // Si las creas, puedes añadirlas aquí.
        /*
        [
            'text'        => 'Configuración General',
            'url'         => 'settings',
            'icon'        => 'fas fa-fw fa-cogs',
        ],
        [
            'text'        => 'Usuarios y Roles',
            'url'         => 'admin/users',
            'icon'        => 'fas fa-fw fa-user-shield',
            'active'      => ['admin/users*', 'admin/roles*'],
        ],
        */
        [

        [
          'type'       => 'logout',
          'text'       => 'Cerrar Sesión',
          'icon'       => 'fas fa-fw fa-sign-out-alt',
        ],

        ],
    ],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],

        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'close_all_other' => true, // Duplicate entry, removed.
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    'livewire' => false,
];