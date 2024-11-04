<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // roles
        DB::table('roles')->insert([
            'title' => 'Super Admin',
            'name' => 'superAdmin',
            'guard_name' => 'admin',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('roles')->insert([
            'title' => 'Khách hàng',
            'name' => 'customer',
            'guard_name' => 'web',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        //modules
        DB::table('modules')->insert([
            'id' => 1,
            'name' => 'QL Bài viết',
            'description' => '<p>QL các Bài viết trong hệ thống</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 2,
            'name' => 'QL Danh mục Bài viết',
            'description' => '<p>QL Danh mục Bài viết</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 3,
            'name' => 'QL Người dùng',
            'description' => '<p>QL Người dùng</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 4,
            'name' => 'QL Sản phẩm',
            'description' => '<p>QL các thông tin Sản phẩm của hệ thống</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 5,
            'name' => 'QL Thuộc tính Sản phẩm',
            'description' => '<p>QL Thuộc tính Sản phẩm</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 6,
            'name' => 'QL Danh mục Sản phẩm',
            'description' => '<p>QL Danh mục Sản phẩm</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 7,
            'name' => 'QL Đơn hàng',
            'description' => '<p>QL Đơn hàng</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 8,
            'name' => 'QL Slider',
            'description' => '<p>QL Slider các hình ảnh chạy qua lại ở trang Web bên ngoài</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 9,
            'name' => 'QL Slider items',
            'description' => '<p>QL các Hình ảnh bên trong một Slider</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 10,
            'name' => 'QL Danh mục',
            'description' => '<p>QL danh mục</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 11,
            'name' => 'QL Mã giảm giá',
            'description' => '<p>QL mã giảm giá</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('modules')->insert([
            'id' => 12,
            'name' => 'QL Flash Sale',
            'description' => '<p>QL flash sale</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('modules')->insert([
            'id' => 13,
            'name' => 'QL Thông báo',
            'description' => '<p>QL Thông báo</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'AppModelsAdmin',
            'model_id' => 1
        ]);

        // permissions
        DB::table('permissions')->insert([
            'id' => 1,
            'title' => 'Đọc tài liệu API',
            'name' => 'readAPIDoc',
            'guard_name' => 'admin',
            'module_id' => null,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 2,
            'title' => 'Xem Bài viết',
            'name' => 'viewPost',
            'guard_name' => 'admin',
            'module_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 3,
            'title' => 'Thêm Bài viết',
            'name' => 'createPost',
            'guard_name' => 'admin',
            'module_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 4,
            'title' => 'Sửa Bài viết',
            'name' => 'updatePost',
            'guard_name' => 'admin',
            'module_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 5,
            'title' => 'Xóa Bài viết',
            'name' => 'deletePost',
            'guard_name' => 'admin',
            'module_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 6,
            'title' => 'Xem Chuyên mục Bài viết',
            'name' => 'viewPostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 7,
            'title' => 'Thêm Chuyên mục Bài viết',
            'name' => 'createPostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 8,
            'title' => 'Sửa Chuyên mục Bài viết',
            'name' => 'updatePostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 9,
            'title' => 'Xóa Chuyên mục Bài viết',
            'name' => 'deletePostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 10,
            'title' => 'Xem Người dùng',
            'name' => 'viewUser',
            'guard_name' => 'admin',
            'module_id' => 3,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 11,
            'title' => 'Thêm Người dùng',
            'name' => 'createUser',
            'guard_name' => 'admin',
            'module_id' => 3,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 12,
            'title' => 'Sửa Người dùng',
            'name' => 'updateUser',
            'guard_name' => 'admin',
            'module_id' => 3,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 13,
            'title' => 'Xóa Người dùng',
            'name' => 'deleteUser',
            'guard_name' => 'admin',
            'module_id' => 3,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 14,
            'title' => 'Xem Đơn hàng',
            'name' => 'viewOrder',
            'guard_name' => 'admin',
            'module_id' => 7,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 15,
            'title' => 'Thêm Đơn hàng',
            'name' => 'createOrder',
            'guard_name' => 'admin',
            'module_id' => 7,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);


        DB::table('permissions')->insert([
            'id' => 16,
            'title' => 'Sửa Đơn hàng',
            'name' => 'updateOrder',
            'guard_name' => 'admin',
            'module_id' => 7,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);


        DB::table('permissions')->insert([
            'id' => 17,
            'title' => 'Xóa Đơn hàng',
            'name' => 'deleteOrder',
            'guard_name' => 'admin',
            'module_id' => 7,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);


        DB::table('permissions')->insert([
            'id' => 18,
            'title' => 'Xem Sản phẩm',
            'name' => 'viewProduct',
            'guard_name' => 'admin',
            'module_id' => 4,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 19,
            'title' => 'Thêm Sản phẩm',
            'name' => 'createProduct',
            'guard_name' => 'admin',
            'module_id' => 4,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);


        DB::table('permissions')->insert([
            'id' => 20,
            'title' => 'Sửa Sản phẩm',
            'name' => 'updateProduct',
            'guard_name' => 'admin',
            'module_id' => 4,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 21,
            'title' => 'Xóa Sản phẩm',
            'name' => 'deleteProduct',
            'guard_name' => 'admin',
            'module_id' => 4,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 22,
            'title' => 'Xem Thuộc tính Sản phẩm',
            'name' => 'viewProductAttribute',
            'guard_name' => 'admin',
            'module_id' => 5,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 23,
            'title' => 'Thêm Thuộc tính Sản phẩm',
            'name' => 'createProductAttribute',
            'guard_name' => 'admin',
            'module_id' => 5,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 24,
            'title' => 'Sửa Thuộc tính Sản phẩm',
            'name' => 'updateProductAttribute',
            'guard_name' => 'admin',
            'module_id' => 5,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 25,
            'title' => 'Xóa Thuộc tính Sản phẩm',
            'name' => 'deleteProductAttribute',
            'guard_name' => 'admin',
            'module_id' => 5,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 26,
            'title' => 'Xem Danh mục Sản phẩm',
            'name' => 'viewProductCategory',
            'guard_name' => 'admin',
            'module_id' => 6,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 27,
            'title' => 'Thêm Danh mục Sản phẩm',
            'name' => 'createProductCategory',
            'guard_name' => 'admin',
            'module_id' => 6,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 28,
            'title' => 'Sửa Danh mục Sản phẩm',
            'name' => 'updateProductCategory',
            'guard_name' => 'admin',
            'module_id' => 6,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 29,
            'title' => 'Xóa Danh mục Sản phẩm',
            'name' => 'deleteProductCategory',
            'guard_name' => 'admin',
            'module_id' => 6,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 30,
            'title' => 'Xem Slider',
            'name' => 'viewSlider',
            'guard_name' => 'admin',
            'module_id' => 8,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 31,
            'title' => 'Thêm Slider',
            'name' => 'createSlider',
            'guard_name' => 'admin',
            'module_id' => 8,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 32,
            'title' => 'Sửa Slider',
            'name' => 'updateSlider',
            'guard_name' => 'admin',
            'module_id' => 8,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 33,
            'title' => 'Xóa Slider',
            'name' => 'deleteSlider',
            'guard_name' => 'admin',
            'module_id' => 8,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 34,
            'title' => 'Xem Slider Item',
            'name' => 'viewSliderItem',
            'guard_name' => 'admin',
            'module_id' => 9,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);


        DB::table('permissions')->insert([
            'id' => 35,
            'title' => 'Thêm Slider Item',
            'name' => 'createSliderItem',
            'guard_name' => 'admin',
            'module_id' => 9,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 36,
            'title' => 'Sửa Slider Item',
            'name' => 'updateSliderItem',
            'guard_name' => 'admin',
            'module_id' => 9,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 37,
            'title' => 'Xóa Slider Item',
            'name' => 'deleteSliderItem',
            'guard_name' => 'admin',
            'module_id' => 9,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 38,
            'title' => 'Cài đặt chung',
            'name' => 'settingGeneral',
            'guard_name' => 'admin',
            'module_id' => null,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 39,
            'title' => 'Thêm danh mục',
            'name' => 'createCategory',
            'guard_name' => 'admin',
            'module_id' => 10,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 40,
            'title' => 'Sửa danh mục',
            'name' => 'updateCategory',
            'guard_name' => 'admin',
            'module_id' => 10,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 41,
            'title' => 'Xoá danh mục',
            'name' => 'deleteCategory',
            'guard_name' => 'admin',
            'module_id' => 10,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 42,
            'title' => 'Xem danh mục',
            'name' => 'viewCategory',
            'guard_name' => 'admin',
            'module_id' => 10,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 43,
            'title' => 'Thêm mã giảm giá',
            'name' => 'createDiscountCode',
            'guard_name' => 'admin',
            'module_id' => 11,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 44,
            'title' => 'Sửa mã giảm giá',
            'name' => 'updateDiscountCode',
            'guard_name' => 'admin',
            'module_id' => 11,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 45,
            'title' => 'Xoá mã giảm giá',
            'name' => 'deleteDiscountCode',
            'guard_name' => 'admin',
            'module_id' => 11,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 46,
            'title' => 'Xem mã giảm giá',
            'name' => 'viewDiscountCode',
            'guard_name' => 'admin',
            'module_id' => 11,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 47,
            'title' => 'Thêm Flash Sale',
            'name' => 'createFlashSale',
            'guard_name' => 'admin',
            'module_id' => 12,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 48,
            'title' => 'Sửa Flash Sale',
            'name' => 'updateFlashSale',
            'guard_name' => 'admin',
            'module_id' => 12,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 49,
            'title' => 'Xoá Flash Sale',
            'name' => 'deleteFlashSale',
            'guard_name' => 'admin',
            'module_id' => 12,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 50,
            'title' => 'Xem Flash Sale',
            'name' => 'viewFlashSale',
            'guard_name' => 'admin',
            'module_id' => 12,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 51,
            'title' => 'Thêm Thông báo',
            'name' => 'createNotification',
            'guard_name' => 'admin',
            'module_id' => 13,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 52,
            'title' => 'Sửa Thông báo',
            'name' => 'updateNotification',
            'guard_name' => 'admin',
            'module_id' => 13,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 53,
            'title' => 'Xoá Thông báo',
            'name' => 'deleteNotification',
            'guard_name' => 'admin',
            'module_id' => 13,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 54,
            'title' => 'Xem Thông báo',
            'name' => 'viewNotification',
            'guard_name' => 'admin',
            'module_id' => 13,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        for ($i = 1; $i <= 54; $i++) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $i,
                'role_id' => 1
            ]);
        }
    }
}
