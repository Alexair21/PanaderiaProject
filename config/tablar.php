<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    | Here you can change the default title of your admin panel.
    |
    */

    'title' => '',
    'title_prefix' => '',
    'title_postfix' => '',
    'bottom_title' => 'Tablar',
    'current_version' => 'v4.8',


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    */

    'logo' => '<b>Tab</b>LAR',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can set up an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'icon2.png',
            'class' => '',
            'width' => 50,
            'height' => 50,
            'url' => '/clientes',
        ],
        'url' => '/clientes',
    ],



    /*
     *
     * Default path is 'resources/views/vendor/tablar' as null. Set your custom path here If you need.
     */

    'views_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look at the layout section here:
    |
    */

    'layout' => 'condensed',
    //boxed, combo, condensed, fluid, fluid-vertical, horizontal, navbar-overlap, navbar-sticky, rtl, vertical, vertical-right, vertical-transparent

    'layout_light_sidebar' => null,
    'layout_light_topbar' => true,
    'layout_enable_top_header' => false,

    /*
    |--------------------------------------------------------------------------
    | Sticky Navbar for Top Nav
    |--------------------------------------------------------------------------
    |
    | Here you can enable/disable the sticky functionality of Top Navigation Bar.
    |
    | For detailed instructions, you can look at the Top Navigation Bar classes here:
    |
    */

    'sticky_top_nav_bar' => false,

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions, you can look at the admin panel classes here:
    |
    */

    'classes_body' => '',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions, you can look at the urls section here:
    |
    */

    'use_route_url' => true,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password.request',
    'password_email_url' => 'password.email',
    'profile_url' => false,
    'setting_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Display Alert
    |--------------------------------------------------------------------------
    |
    | Display Alert Visibility.
    |
    */
    'display_alert' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    |
    */

    'menu' => [
        [
            'text' => 'Dashboard',
            'icon' => 'ti ti-dashboard',
            'url' => '/inicio',
            'can' => 'ver-rol',
        ],
        // Navbar items:
        [
            'text' => 'Principal',
            'icon' => 'ti ti-home',
            'url' => '/',
            'can' => 'Acciones-cliente',
        ],
        [
            'text' => 'Menú',
            'icon' => 'ti ti-ticket',
            'url' => '/catalogos'
        ],
        [
            'text' => 'Gestion venta',
            'icon' => 'ti ti-receipt',
            'can' => 'ver-rol',
            'submenu' => [
                [
                'text' => 'Pedidos',
                'icon' => 'ti ti-receipt',
                'url' => '/pedidos',
                'can' => ['Acciones-barista', 'Acciones-cajero']
                ],
                [
                    'text' => 'Voucher',
                    'icon' => 'ti ti-receipt',
                    'url' => '/vouchers',
                    'can' => ['ver-rol', 'Acciones-cajero']

                ],
            ],
        ],

        [
            'text' => 'Gestion restaurante',
            'icon' => 'ti ti-receipt',
            'can' => 'Acciones-mesero',
            //'active' => ['support1'],
            'submenu' => [
                [
                    'text' => 'Salas',
                    'icon' => 'ti ti-menu',
                    'url' => '/salas',
                    'can' => 'Acciones-mesero',
                ],
                [
                    'text' => 'Historial Mesas',
                    'icon' => 'ti ti-archive',
                    'url' => '/mesas',
                    'can' => 'Acciones-mesero',
                ],
            ],

        ],

        [
            'text' => 'Acciones Admin',
            'url' => '//products',
            'icon' => 'ti ti-receipt',
            'can' => 'ver-rol',
            //'active' => ['support1'],
            'submenu' => [
                [
                    'text' => 'Roles',
                    'icon' => 'ti ti-user',
                    'url' => '/roles'
                ],
                [
                    'text' => 'Categorias',
                    'icon' => 'ti ti-star',
                    'url' => '/categorias',
                    'can' => 'ver-rol',
                ],
                [
                    'text' => 'SubCategorias',
                    'icon' => 'ti ti-star',
                    'url' => '/subcategorias',
                    'can' => 'ver-rol',
                ],
                [
                    'text' => 'Platillos',
                    'icon' => 'ti ti-shopping-cart',
                    'url' => '/platillos',
                    'can' => 'ver-rol',
                ],
            ],

        ],
        [
            'text' => 'Usuarios',
            'url' => '//products',
            'icon' => 'ti ti-user',
            'can' => 'ver-rol',
            //'active' => ['support1'],
            'submenu' => [
                [
                    'text' => 'Usuarios generales',
                    'icon' => 'ti ti-user',
                    'url' => '/usuarios'
                ],
                [
                    'text' => 'Personal',
                    'icon' => 'ti ti-user',
                    'url' => '/personal'
                ],
                [
                    'text' => 'Clientes',
                    'icon' => 'ti ti-star',
                    'url' => '/cliente',
                    'can' => 'ver-rol',
                ],
                [
                    'text' => 'Repartidores',
                    'icon' => 'ti ti-user',
                    'url' => '/repartidor',
                    'can' => 'ver-rol',
                ],
            ],

        ],






        [
            //'text' => 'Products',
            //'icon' => 'ti ti-shopping-cart',
            //'url' => '/products'
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    |
    */

    'filters' => [
        TakiElias\Tablar\Menu\Filters\GateFilter::class,
        TakiElias\Tablar\Menu\Filters\HrefFilter::class,
        TakiElias\Tablar\Menu\Filters\SearchFilter::class,
        TakiElias\Tablar\Menu\Filters\ActiveFilter::class,
        TakiElias\Tablar\Menu\Filters\ClassesFilter::class,
        TakiElias\Tablar\Menu\Filters\LangFilter::class,
        TakiElias\Tablar\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Vite
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Vite support.
    |
    | For detailed instructions you can look the Vite here:
    | https://laravel-vite.dev
    |
    */

    'vite' => true,

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://livewire.laravel.com
    |
    */

    'livewire' => false,
];
