<?php

return [
    [
        'title' => 'Mã giảm giá',
        'routeName' => null,
        'icon' => '<i class="ti ti-ticket"></i>',
        'roles' => [],
        'permissions' => ['all', 'createDiscountCode', 'viewDiscountCode', 'updateDiscountCode', 'deleteDiscountCode'],
        'sub' => [
            [
                'title' => 'Thêm mã giảm giá',
                'routeName' => 'admin.discount.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['all', 'createDiscountCode'],
            ],
            [
                'title' => 'DS Mã giảm giá',
                'routeName' => 'admin.discount.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['all', 'viewDiscountCode'],
            ],
        ]
    ],
    [
        'title' => 'Đơn hàng',
        'routeName' => null,
        'icon' => '<i class="ti ti-box"></i>',
        'roles' => [],
        'permissions' => ['createOrder', 'viewOrder', 'updateOrder', 'deleteOrder'],
        'sub' => [
            [
                'title' => 'Thêm đơn hàng',
                'routeName' => 'admin.order.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createOrder'],
            ],
            [
                'title' => 'DS Đơn hàng',
                'routeName' => 'admin.order.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewOrder'],
            ],
        ]
    ],
    [
        'title' => 'Sản phẩm',
        'routeName' => null,
        'icon' => '<i class="ti ti-brand-producthunt"></i>',
        'roles' => [],
        'permissions' => [
            'createProduct',
            'viewProduct',
            'updateProduct',
            'deleteProduct',
            'createProductCategory',
            'updateProductCategory',
            'viewProductCategory'
        ],
        'sub' => [
            [
                'title' => 'Thêm sản phẩm',
                'routeName' => 'admin.product.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createProduct'],
            ],
            [
                'title' => 'DS Sản phẩm',
                'routeName' => 'admin.product.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewProduct'],
            ],
            [
                'title' => 'DS Thuộc tính',
                'routeName' => 'admin.attribute.index',
                'icon' => '<i class="ti ti-clipboard-list"></i>',
                'roles' => [],
                'permissions' => ['viewProductAttribute'],
            ],
            [
                'title' => 'DS Danh mục',
                'routeName' => 'admin.category.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewProductCategory'],
            ],
        ]
    ],
    [
        'title' => 'customer',
        'routeName' => null,
        'icon' => '<i class="ti ti-users"></i>',
        'roles' => [],
        'permissions' => ['createUser', 'viewUser', 'updateUser', 'deleteUser'],
        'sub' => [
            [
                'title' => 'Thêm khách hàng',
                'routeName' => 'admin.user.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createUser'],
            ],
            [
                'title' => 'DS Khách hàng',
                'routeName' => 'admin.user.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewUser'],
            ],
        ]
    ],
    [
        'title' => 'FlashSale',
        'routeName' => null,
        'icon' => '<i class="ti ti-bolt"></i>',
        'roles' => [],
        'permissions' => ['createFlashSale', 'viewFlashSale', 'updateFlashSale', 'deleteFlashSale'],
        'sub' => [
            [
                'title' => 'Thêm FlashSale',
                'routeName' => 'admin.flashsale.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createFlashSale'],
            ],
            [
                'title' => 'DS flashSale',
                'routeName' => 'admin.flashsale.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewFlashSale'],
            ],
        ]
    ],
    [
        'title' => 'Đánh giá',
        'routeName' => null,
        'icon' => '<i class="ti ti-star"></i>',
        'roles' => [],
        'permissions' => ['createUser', 'viewUser', 'updateUser', 'deleteUser'],
        'sub' => [
            [
                'title' => 'Thêm đánh giá',
                'routeName' => 'admin.review.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createUser'],
            ],
            [
                'title' => 'DS đánh giá',
                'routeName' => 'admin.review.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['createUser'],
            ],
        ]
    ],
    [
        'title' => 'Bài viết',
        'routeName' => null,
        'icon' => '<i class="ti ti-article"></i>',
        'roles' => [],
        'permissions' =>
        [
            'createPost',
            'viewPost',
            'updatePost',
            'deletePost',
            'viewPostCategory',
            'createPostCategory',
            'updatePostCategory'
        ],
        'sub' => [
            [
                'title' => 'Thêm bài viết',
                'routeName' => 'admin.post.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createPost'],
            ],
            [
                'title' => 'DS Bài viết',
                'routeName' => 'admin.post.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewPost'],
            ],
            [
                'title' => 'DS Chuyên mục',
                'routeName' => 'admin.post_category.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewPostCategory'],
            ]
        ]
    ],
    // [
    //     'title' => 'Sliders',
    //     'routeName' => null,
    //     'icon' => '<i class="ti ti-slideshow"></i>',
    //     'roles' => [],
    //     'permissions' => ['createSlider', 'viewSlider', 'updateSlider', 'deleteSlider'],
    //     'sub' => [
    //         [
    //             'title' => 'Thêm Sliders',
    //             'routeName' => 'admin.slider.create',
    //             'icon' => '<i class="ti ti-plus"></i>',
    //             'roles' => [],
    //             'permissions' => ['createSlider'],
    //         ],
    //         [
    //             'title' => 'DS Sliders',
    //             'routeName' => 'admin.slider.index',
    //             'icon' => '<i class="ti ti-list"></i>',
    //             'roles' => [],
    //             'permissions' => ['viewSlider'],
    //         ],
    //     ]
    // ],
    [
        'title' => 'Cài đặt',
        'routeName' => null,
        'icon' => '<i class="ti ti-settings"></i>',
        'roles' => [],
        'permissions' => ['settingGeneral'],
        'sub' => [
            [
                'title' => 'Chung',
                'routeName' => 'admin.setting.general',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Slider',
                'routeName' => 'admin.setting.slider',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Chân trang',
                'routeName' => 'admin.setting.footer',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Thông tin liên hệ',
                'routeName' => 'admin.setting.contact',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Trang giới thiệu',
                'routeName' => 'admin.setting.information',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Thành viên mua hàng',
                'routeName' => 'admin.setting.user_shopping',
                'icon' => '<i class="ti ti-user-cog"></i>',
                'roles' => [],
                'permissions' => [],
            ],
        ]
    ],
];
