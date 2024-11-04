<?php

namespace App\Api\V1\Http\Controllers\Product;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\FlashSale\FlashSaleRepositoryInterface;
use App\Api\V1\Repositories\Product\ProductRepositoryInterface;
use App\Api\V1\Http\Resources\Product\{AllProductResource, FlashSaleResource, ShowProductResource};
use App\Api\V1\Http\Requests\Product\ProductRequest;
use Illuminate\Http\Request;

/**
 * @group Sản phẩm
 */

class ProductController extends Controller
{
    protected FlashSaleRepositoryInterface $flashSaleRepository;
    public function __construct(
        ProductRepositoryInterface $repository,
        FlashSaleRepositoryInterface $flashSaleRepository,
    ) {
        $this->repository = $repository;
        $this->flashSaleRepository = $flashSaleRepository;
    }

    /**
     * Danh sách sản phẩm
     *
     * Lấy danh sách sản phẩm.
     *
     * @headersParam X-TOKEN-ACCESS string required
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @queryParam keywords string
     * Từ khóa tên sản phẩm. Example: ipad
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *               "id": 10,
     *               "name": "Iphone 14",
     *               "slug": "iphone-14",
     *               "in_stock": true,
     *               "on_flashsale": true,
     *               "flashsale_price": 20000,
     *               "avatar": "http://localhost/topzone/public/assets/images/default-image.png",
     *               "price": 20900,
     *               "promotion_price": 10000,
     *               "review": [
     *                  {
     *                      "id": 7,
     *                      "user_id": 1,
     *                      "rating": 5,
     *                      "content": "Hài lòng",
     *                      "product_id": 16,
     *                      "created_at": "2024-11-01T08:06:30.000000Z",
     *                      "updated_at": "2024-11-01T08:06:30.000000Z",
     *                      "order_id": null
     *                  }
     *              ],
     *              "avg_rating": 5
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductRequest $request)
    {
        $data = $request->validated();

        $products = $this->repository->getSearchByKeysWithRelations($data);

        $products = new AllProductResource($products);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $products
        ]);
    }

    /**
     * Chương trình flash sale
     *
     * Lấy ra chương trình flash sale cũng như các sản phẩm đang có trong chương trình.
     *
     * @headersParam X-TOKEN-ACCESS string required
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @queryParam keywords string
     * Từ khóa tên sản phẩm. Example: ipad
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *              "id": 1,
     *              "name": "SALE15",
     *              "start_time": "19-09-2024 12:40",
     *              "end_time": "27-11-2024 12:40",
     *              "products": [
     *                  {
     *                      "id": 18,
     *                      "name": "CELL PHONE Z",
     *                      "slug": "cell-phone-z",
     *                      "on_flashsale": true,
     *                      "in_stock": 1,
     *                      "avatar": "http://localhost:8080/2906-BahaGroup/userfiles/files/d1.jpg",
     *                      "flashsale_price": null,
     *                      "min_promotion_price": 4500000,
     *                      "min_price": 5000000,
     *                      "max_price": 5500000
     *                  }
     *              ]
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function saleLimited()
    {
        $flashSale = $this->flashSaleRepository->getFlashSaleId_ValidDay();
        if ($flashSale) {
            return response()->json([
                'status' => 200,
                'message' => __('Chương trình flash sale đang được diễn ra.'),
                'data' => new FlashSaleResource($flashSale)
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => __('Hiện tại không có chương trình flash sale.'),
                'data' => []
            ]);
        }
    }
    /**
     * Chi tiết sản phẩm
     *
     * Lấy chi tiết của sản phẩm.
     *
     * @headersParam X-TOKEN-ACCESS string required
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * id sản phẩm. Example: 1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *              "id": 10,
     *               "name": "Iphone 14",
     *               "slug": "iphone-14",
     *               "in_stock": true,
     *               "on_flashsale": true,
     *               "flashsale_price": 20000,
     *               "avatar": "http://localhost/topzone/public/assets/images/default-image.png",
     *               "price": 20900,
     *               "promotion_price": 10000,
     *               "review": [
     *                  {
     *                      "id": 7,
     *                      "user_id": 1,
     *                      "rating": 5,
     *                      "content": "Hài lòng",
     *                      "product_id": 16,
     *                      "created_at": "2024-11-01T08:06:30.000000Z",
     *                      "updated_at": "2024-11-01T08:06:30.000000Z",
     *                      "order_id": null
     *                  }
     *               ],
     *               "avg_rating": 5
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = $this->repository->findOrFailWithRelations($id);
            $product = new ShowProductResource($product);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $product
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 404,
                'message' => __('Không tìm thấy sản phẩm')
            ], 404);
        }
    }

    // public function search(ProductSearchRequest $request): JsonResponse
    // {
    //     $response = $this->repository->searchProducts($request);

    //     $products = new AllProductResource($response);

    //     return response()->json([
    //         'status' => 200,
    //         'message' => __('Product search results'),
    //         'data' => $products
    //     ]);
    // }
}
