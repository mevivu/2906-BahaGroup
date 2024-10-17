<?php

use App\Enums\Category\HomeSliderOption;
use App\Enums\DefaultActiveStatus;
use App\Enums\DefaultStatus;
use App\Enums\Discount\DiscountType;
use App\Enums\FeaturedStatus;
use App\Enums\Order\OrderStatus;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Order\OrderType;
use App\Enums\Post\PostStatus;
use App\Enums\PriorityStatus;
use App\Enums\Product\{ProductInStock, ProductManagerStock, ProductStatus, ProductType, ProductVariationAction};
use App\Enums\Slider\SliderStatus;
use App\Enums\User\{Gender, UserVip, UserRoles};

return [
    Gender::class => [
        Gender::Male->value => 'Nam',
        Gender::Female->value => 'Nữ',
        Gender::Other->value => 'Khác',
    ],
    DefaultActiveStatus::class => [
        DefaultActiveStatus::Active->value => 'Có',
        DefaultActiveStatus::UnActive->value => 'Không',
    ],
    HomeSliderOption::class => [
        HomeSliderOption::Active->value => 'Có',
        HomeSliderOption::InActive->value => 'Không',
    ],
    SliderStatus::class => [
        SliderStatus::Active => 'Đang hoạt động',
        SliderStatus::UnActive => 'Ngưng hoạt động',
    ],
    PostStatus::class => [
        PostStatus::Draft->value => 'Bản nháp',
        PostStatus::Published->value => 'Đã xuất bản',
    ],
    ProductStatus::class => [
        ProductStatus::Active->value => 'Đang hoạt động',
        ProductStatus::InActive->value => 'Ngưng hoạt động',
    ],
    ProductManagerStock::class => [
        ProductManagerStock::Managed->value => 'Có quản lý',
        ProductManagerStock::NotManaged->value => 'Không quản lý',
    ],
    ProductInStock::class => [
        ProductInStock::InStock->value => 'Còn hàng',
        ProductInStock::OutOfStock->value => 'Hết hàng',
    ],
    PaymentMethod::class => [
        PaymentMethod::Online->value => 'Online',
        PaymentMethod::Direct->value => 'Trực tiếp',
    ],
    UserVip::class => [
        UserVip::Default => 'Mặc định',
        UserVip::Bronze => 'Đồng',
        UserVip::Silver => 'Bạc',
        UserVip::Gold => 'Vàng',
        UserVip::Diamond => 'Kim cương',
    ],
    UserRoles::class => [
        UserRoles::Customer->value => 'Khách hàng',
        UserRoles::Driver->value => 'Tài xế',
    ],
    ProductType::class => [
        ProductType::Simple->value => 'Sản phẩm đơn giản',
        ProductType::Variable->value => 'Sản phẩm có biến thể'
    ],
    DefaultStatus::class => array(
        DefaultStatus::Published->value => 'Đã xuất bản',
        DefaultStatus::Draft->value => 'Bản nháp',
        DefaultStatus::Deleted->value => 'Đã xoá',
    ),
    ProductVariationAction::class => [
        ProductVariationAction::AddSimple => 'Thêm biến thể',
        ProductVariationAction::AddFromAllVariations => 'Tạo biến thể từ tất cả thuộc tính'
    ],
    OrderStatus::class => [
        OrderStatus::Pending->value => 'Chờ xác nhận',
        OrderStatus::Confirmed->value => ' Đã xác nhận',
        // OrderStatus::Completed->value => 'Hoàn thành',
        OrderStatus::Cancelled->value => 'Hủy bỏ',
    ],
    OrderType::class => [
        OrderType::Renting->value => 'Thuê',
        OrderType::Booking->value => 'Đặt',
    ],
    DiscountType::class => [
        DiscountType::Money->value => 'Tiền',
        DiscountType::Percent->value => 'Phần trăm'
    ],
    PriorityStatus::class => [
        PriorityStatus::Priority->value => 'Ưu tiên',
        PriorityStatus::NotPriority->value => 'Không ưu tiên'
    ],
    FeaturedStatus::class => [
        FeaturedStatus::Featured->value => 'Nổi bật',
        FeaturedStatus::Featureless->value => 'Không nổi bật'
    ],
];
