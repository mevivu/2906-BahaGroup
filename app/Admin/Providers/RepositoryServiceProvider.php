<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Admin\Repositories\CategorySystem\CategorySystemRepositoryInterface' => 'App\Admin\Repositories\CategorySystem\CategorySystemRepository',
        'App\Admin\Repositories\Module\ModuleRepositoryInterface' => 'App\Admin\Repositories\Module\ModuleRepository',
        'App\Admin\Repositories\Permission\PermissionRepositoryInterface' => 'App\Admin\Repositories\Permission\PermissionRepository',
        'App\Admin\Repositories\Role\RoleRepositoryInterface' => 'App\Admin\Repositories\Role\RoleRepository',
        'App\Admin\Repositories\Admin\AdminRepositoryInterface' => 'App\Admin\Repositories\Admin\AdminRepository',
        'App\Admin\Repositories\User\UserRepositoryInterface' => 'App\Admin\Repositories\User\UserRepository',
        'App\Admin\Repositories\Category\CategoryRepositoryInterface' => 'App\Admin\Repositories\Category\CategoryRepository',
        'App\Admin\Repositories\Product\ProductRepositoryInterface' => 'App\Admin\Repositories\Product\ProductRepository',
        'App\Admin\Repositories\Product\ProductAttributeRepositoryInterface' => 'App\Admin\Repositories\Product\ProductAttributeRepository',
        'App\Admin\Repositories\Product\ProductVariationRepositoryInterface' => 'App\Admin\Repositories\Product\ProductVariationRepository',
        'App\Admin\Repositories\Attribute\AttributeRepositoryInterface' => 'App\Admin\Repositories\Attribute\AttributeRepository',
        'App\Admin\Repositories\AttributeVariation\AttributeVariationRepositoryInterface' => 'App\Admin\Repositories\AttributeVariation\AttributeVariationRepository',
        'App\Admin\Repositories\Order\OrderRepositoryInterface' => 'App\Admin\Repositories\Order\OrderRepository',
        'App\Admin\Repositories\Order\OrderDetailRepositoryInterface' => 'App\Admin\Repositories\Order\OrderDetailRepository',
        'App\Admin\Repositories\Slider\SliderRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderRepository',
        'App\Admin\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderItemRepository',
        'App\Admin\Repositories\Setting\SettingRepositoryInterface' => 'App\Admin\Repositories\Setting\SettingRepository',
        'App\Admin\Repositories\Post\PostRepositoryInterface' => 'App\Admin\Repositories\Post\PostRepository',
        'App\Admin\Repositories\PostCategory\PostCategoryRepositoryInterface' => 'App\Admin\Repositories\PostCategory\PostCategoryRepository',
        'App\Admin\Repositories\Area\AreaRepositoryInterface' => 'App\Admin\Repositories\Area\AreaRepository',
        'App\Admin\Repositories\Driver\DriverRepositoryInterface' => 'App\Admin\Repositories\Driver\DriverRepository',
        'App\Admin\Repositories\StoreCategory\StoreCategoryRepositoryInterface' => 'App\Admin\Repositories\StoreCategory\StoreCategoryRepository',
        'App\Admin\Repositories\Store\StoreRepositoryInterface' => 'App\Admin\Repositories\Store\StoreRepository',
        'App\Admin\Repositories\Notification\NotificationRepositoryInterface' => 'App\Admin\Repositories\Notification\NotificationRepository',
        'App\Admin\Repositories\Topping\ToppingRepositoryInterface' => 'App\Admin\Repositories\Topping\ToppingRepository',
        'App\Admin\Repositories\Vehicle\VehicleRepositoryInterface' => 'App\Admin\Repositories\Vehicle\VehicleRepository',
        'App\Admin\Repositories\Discount\DiscountRepositoryInterface' => 'App\Admin\Repositories\Discount\DiscountRepository',
        'App\Admin\Repositories\Discount\DiscountApplicationRepositoryInterface' => 'App\Admin\Repositories\Discount\DiscountApplicationRepository',
        'App\Admin\Repositories\Cart\CartRepositoryInterface' => 'App\Admin\Repositories\Cart\CartRepository',
        'App\Admin\Repositories\CartItem\CartItemRepositoryInterface' => 'App\Admin\Repositories\CartItem\CartItemRepository',
        'App\Admin\Repositories\VehicleOwner\VehicleOwnerRepositoryInterface' => 'App\Admin\Repositories\VehicleOwner\VehicleOwnerRepository',
        'App\Admin\Repositories\FlashSale\FlashSaleRepositoryInterface' => 'App\Admin\Repositories\FlashSale\FlashSaleRepository',
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->repositories as $interface => $implement) {
            $this->app->singleton($interface, $implement);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
