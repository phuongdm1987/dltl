<?php

return [
	'branch' => [
		'label' => 'Quản lý chi nhánh',
		'permissions' => [
			[
				'name' => 'branch.manager',
				'display_name'=> 'Xem thông tin'
			],
			[
				'name' => 'branch.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name'         => 'branch.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'branch.delete',
				'display_name' => 'Xóa'
			]
		]
	],

	'supplier' => [
		'label' => 'Quản lý thông tin nhà cung cấp',
		'permissions' => [
			[
				'name' => 'supplier.manager',
				'display_name'=> 'Xem thông tin'
			],
			[
				'name' => 'supplier.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name'         => 'supplier.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'supplier.delete',
				'display_name' => 'Xóa'
			]
		]
	],

	'product' => [
		'label' => 'Quản lý sản phẩm',
		'permissions' => [
		 	[
				'name' => 'product.manager',
				'display_name'=> 'Xem thông tin'
			],
			[
				'name' => 'product.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name'         => 'product.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'product.delete',
				'display_name' => 'Xóa'
			],
			[
				'name'         => 'product.import',
				'display_name' => 'Import'
			],
			[
				'name'         => 'product.export',
				'display_name' => 'Export'
			]
		]
	],

	'order' => [
		'label' => 'Quản lý hóa đơn bán hàng',
		'permissions' => [
			[
				'name' => 'order.manager',
				'display_name'=> 'Xem thông tin'
			],
			[
				'name' => 'order.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name'         => 'order.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'order.delete',
				'display_name' => 'Xóa'
			],
			[
				'name'         => 'order.print',
				'display_name' => 'In hóa đơn'
			]
		]
	],

	'import' => [
		'label' => 'Quản lý phiếu nhập kho',
		'permissions' => [
			[
				'name' => 'import.manager',
				'display_name'=> 'Xem thông tin'
			],
			[
				'name' => 'import.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name'         => 'import.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'import.delete',
				'display_name' => 'Xóa'
			],
			[
				'name'         => 'import.print',
				'display_name' => 'In hóa đơn'
			]
		]
	],

	'exchange' => [
		'label' => 'Quản lý phiếu chuyển kho',
		'permissions' => [
			[
				'name' => 'exchange.manager',
				'display_name'=> 'Xem thông tin'
			],
			[
				'name' => 'exchange.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name'         => 'exchange.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'exchange.delete',
				'display_name' => 'Xóa'
			]
		]
	],

	'user' => [
		'label' => 'Quản lý nhân viên',
		'permissions' => [
			[
				'name'         => 'user.manager',
				'display_name' => 'Xem thông tin'
			],
			[
				'name'         => 'user.add',
				'display_name' => 'Thêm mới'
			],
			[
				'name'         => 'user.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'user.delete',
				'display_name' => 'Xóa'
			],
			[
				'name'         => 'user.edit_permissions',
				'display_name' => 'Phân quyền'
			]
		]
	],

	// Trả hàng
	'return_product_customer' => [
		'label' => 'Quản lý thông tin phiếu trả hàng',
		'permissions' => [
			[
				'name' => 'return_product_customer.manager',
				'display_name'=> 'Xem thông tin'
			],
			[
				'name' => 'return_product_customer.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name'         => 'return_product_customer.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'return_product_customer.delete',
				'display_name' => 'Xóa'
			],
			[
				'name'         => 'return_product_customer.print',
				'display_name' => 'In hóa đơn'
			]
		]
	],

	// Trả hàng
	'return_product_supplier' => [
		'label' => 'Quản lý phiếu trả hàng cho nhà cung cấp',
		'permissions' => [
			[
				'name' => 'return_product_supplier.manager',
				'display_name'=> 'Xem thông tin'
			],
			[
				'name' => 'return_product_supplier.add',
				'display_name'=> 'Thêm mới'
			],
			[
				'name'         => 'return_product_supplier.edit',
				'display_name' => 'Sửa',
			],
			[
				'name'         => 'return_product_supplier.delete',
				'display_name' => 'Xóa'
			],
			[
				'name'         => 'return_product_supplier.print',
				'display_name' => 'In hóa đơn'
			]
		]
	],

	// Hoạt động nhân viên
	'activity' => [
		'label' => 'Hoạt động gần đây',
		'permissions' => [
			[
				'name' => 'activity.manager',
				'display_name'=> 'Xem thông tin'
			],
		]
	],

	// Báo cáo kho
	'report_store' => [
		'label' => 'Báo cáo kho',
		'permissions' => [
			[
				'name' => 'report_store.manager',
				'display_name'=> 'Xem thông tin'
			],
		]
	],

	// Công nợ
	'debt_customer' => [
		'label' => 'Công nợ khách',
		'permissions' => [
			[
				'name' => 'debt_customer.manager',
				'display_name'=> 'Xem thông tin'
			],
		]
	],


	'debt_supplier' => [
		'label' => 'Công nợ nhà cung cấp',
		'permissions' => [
			[
				'name' => 'debt_supplier.manager',
				'display_name'=> 'Xem thông tin'
			],
		]
	],


	// Seo/social
	'seo' => [
		'label' => 'SEO/Social',
		'permissions' => [
			[
				'name' => 'seo.manager',
				'display_name'=> 'Xem thông tin'
			],
		]
	],

];