<?php

namespace App\Api\V1\Http\Controllers\Category;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Repositories\Category\CategoryRepositoryInterface;
use \Illuminate\Http\Request;
use App\Api\V1\Http\Resources\Category\{AllCategoryTreeResource, RootCategoryWithProductResource, ShowCategoryWithAllResource};
use App\Api\V1\Repositories\Product\ProductRepositoryInterface;

/**
 * @group Danh mục
 */

class CategoryController extends Controller
{
    protected $repositoryProduct;
    public function __construct(
        CategoryRepositoryInterface $repository,
        ProductRepositoryInterface $repositoryProduct
    ) {
        $this->repository = $repository;
        $this->repositoryProduct = $repositoryProduct;
    }

    /**
     * Danh sách danh mục
     *
     * Lấy danh sách danh mục.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *               "id": 7,
     *               "name": "parent 3",
     *               "slug": "parent-3",
     *               "avatar": null,
     *               "children": [
     *                   {
     *                       "id": 8,
     *                       "name": "child 3",
     *                       "slug": "child-3",
     *                       "avatar": null
     *                   }
     *               ]
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->repository->getTree();
        $categories = new AllCategoryTreeResource($categories);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $categories
        ]);
    }
    /**
     * Chi tiết danh mục
     *
     * Lấy chi tiết danh mục.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @pathParam id integer required
     * id danh mục. Example: 1
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 6,
     *           "name": "children",
     *           "slug": "children",
     *           "parents": [
     *               {
     *                   "id": 7,
     *                   "name": "parent",
     *                   "slug": "parent"
     *               },
     *               {
     *                   "id": 9,
     *                   "name": "chuas",
     *                   "slug": "chuas"
     *               }
     *           ],
     *           "products": [
     *               {
     *                   "id": 31,
     *                   "name": "Doraemon",
     *                   "slug": "doraemon",
     *                   "in_stock": 1,
     *                   "avatar": "http://localhost:8080/AppBanSach/userfiles/files/Huong-dan-hoc-va-giai-cac-dang-bai-tap-toan-9-tap-1-KNTT.jpg",
     *                   "min_promotion_price": 45000,
     *                   "min_price": 50000,
     *                   "max_price": 60000
     *               },
     *           ]
     *       }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = $this->repository->findByIdOrSlugWithAncestorsAndDescendants($id);
            $category = new ShowCategoryWithAllResource($category, $this->repositoryProduct);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $category
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 404,
                'message' => __('Không tìm thấy dữ liệu')
            ], 404);
        }
    }

    /**
     * Danh sách danh mục kèm sản phẩm
     *
     * Lấy danh sách danh mục root và tất cả sản phẩm thuộc danh mục này và danh mục của nó.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *              "id": 5,
     *             "name": "Ipad",
     *             "slug": "ipad",
     *              "products": [
     *                   {
     *                       "id": 31,
     *                       "name": "Doraemon",
     *                       "slug": "doraemon",
     *                       "in_stock": 1,
     *                       "avatar": "http://localhost:8080/AppBanSach/userfiles/files/Huong-dan-hoc-va-giai-cac-dang-bai-tap-toan-9-tap-1-KNTT.jpg",
     *                       "min_promotion_price": 45000,
     *                       "min_price": 50000,
     *                       "max_price": 60000
     *                   }
     *               ]
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $categories = $this->repository->getRootWithAllChildren();
        $categories = new RootCategoryWithProductResource($categories, $this->repositoryProduct);
        return $categories;
    }

    /**
     * Danh sách danh mục nằm trên menu
     *
     * Lấy danh sách danh mục nằm trên menu.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *               "id": 7,
     *               "name": "parent 3",
     *               "slug": "parent-3",
     *               "avatar": null,
     *               "children": [
     *                   {
     *                       "id": 8,
     *                       "name": "child 3",
     *                       "slug": "child-3",
     *                       "avatar": null
     *                   }
     *               ]
     *           }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $categories = $this->repository->getTree()->where('is_menu', 1);
        $categories = new AllCategoryTreeResource($categories);

        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $categories
        ]);
    }
}
