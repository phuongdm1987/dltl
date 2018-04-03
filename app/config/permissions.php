<?php
//{"admin.access":"1", "users.view": "1", "users.edit" : "1", "users.add" : "1", "users.delete" : "1", "setting.view" : 1}
return [

	'admin' => [
		'label' => 'Quản trị',
		'permissions' => [
			[
				'name' => 'admin.access',
				'display_name'=> 'Truy cập'
			],
		]
	],

	'product' => [
		'label' => 'Quản lý sản phẩm',
		'permissions' => [
			[
				'name' => 'product.manager',
				'display_name'=> 'Quản lý'
			]
		]
	],

	'setting' => [
		'label' => 'Cấu hình',
		'permissions' => [
			[
				'name' => 'setting.view',
				'display_name'=> 'Cài đặt'
			]
		]
	],

	'user' => [
		'label' => 'User',
		'permissions' => [
			[
				'name' => 'users.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'users.fake_login',
				'display_name'=> 'Fake Login'
			],
			[
				'name' => 'users.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'users.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'users.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'categories' => [
		'label' => 'Categories',
		'permissions' => [
			[
				'name' => 'categories.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'categories.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'categories.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'categories.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'pages' => [
		'label' => 'Pages',
		'permissions' => [
			[
				'name' => 'pages.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'pages.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'pages.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'pages.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'posts' => [
		'label' =>'Posts',
		'permissions' => [
			[
				'name' => 'posts.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'posts.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'posts.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'posts.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'feedbacks' => [
		'label' =>'Feedbacks',
		'permissions' => [
			[
				'name' => 'feedbacks.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'feedbacks.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'feedbacks.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'subscribers' => [
		'label' =>'Subscribers',
		'permissions' => [
			[
				'name' => 'subscribers.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'subscribers.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'subscribers.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'testimonials' => [
		'label' =>'Testimonials',
		'permissions' => [
			[
				'name' => 'testimonials.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'testimonials.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'testimonials.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'testimonials.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'places' => [
		'label' => 'Places',
		'permissions' => [
			[
				'name' => 'places.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'places.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'places.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'places.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

   'cities' => [
      'label' => 'City',
      'permissions' => [
         [
            'name' => 'cities.view',
            'display_name'=> 'Xem'
         ],
         [
            'name' => 'cities.add',
            'display_name'=> 'Thêm mới'
         ],
         [
            'name' => 'cities.edit',
            'display_name'=> 'Sửa'
         ],
         [
            'name' => 'cities.delete',
            'display_name'=> 'Xóa'
         ]
      ]
   ],

	'cplaces' => [
		'label' => 'Loại địa danh',
		'permissions' => [
			[
				'name' => 'cplaces.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'cplaces.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'cplaces.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'cplaces.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'countries' => [
		'label' => 'Quản lý quốc gia',
		'permissions' => [
			[
				'name' => 'countries.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'countries.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'countries.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'countries.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'tours' => [
		'label' => 'Tours',
		'permissions' => [
			[
				'name' => 'tours.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'tours.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'tours.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'tours.delete',
				'display_name'=> 'Xóa'
			]
		]
	],

	'bookings'=> [
		'label' => 'Booking',
		'permissions' => [
			[
				'name' => 'bookings.view',
				'display_name'=> 'Xem'
			],
			[
				'name' => 'bookings.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name' => 'bookings.edit',
				'display_name'=> 'Sửa'
			],
			[
				'name' => 'bookings.delete',
				'display_name'=> 'Xóa'
			]
		]
	],
];