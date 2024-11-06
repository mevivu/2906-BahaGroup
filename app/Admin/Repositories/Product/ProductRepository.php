<?php

namespace App\Admin\Repositories\Product;

use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{

    protected $select = [];

    public function getModel()
    {
        return Product::class;
    }
    public function getByIdsAndOrderByIds(array $ids)
    {
        $this->instance = $this->model
            ->whereIn('id', $ids)
            ->orderByRaw(DB::raw("FIELD(id, " . implode(',', $ids) . ")"))
            ->get();

        return $this->instance;
    }

    public function getRelatedProducts($id)
    {
        $this->instance = $this->model
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(8)
            ->get();
        return $this->instance;
    }

    public function getAllByColumns(array $data)
    {
        $this->getQueryBuilder();
        foreach ($data as $key => $value) {
            if ($key == 'name') {
                $this->instance = $this->instance->where($key, 'like', "%{$value}%");
            } else {
                $this->instance = $this->instance->where($key, $value);
            }
        }
        $this->instance = $this->instance->get();
        return $this->instance;
    }
    public function getByColumnsWithRelationsLimit(array $data, array $relations = ['productVariations.attribute_variations.attribute'], $limit = 10)
    {
        $this->getQueryBuilderWithRelations($relations);

        foreach ($data as $key => $value) {
            if ($key == 'name') {
                $this->instance = $this->instance->where($key, 'like', "%{$value}%");
            } else {
                $this->instance = $this->instance->where($key, $value);
            }
        }

        $this->instance = $this->instance->limit($limit)->get();
        return $this->instance;
    }

    public function attachCategories(Product $product, array $categoriesId)
    {
        return $product->categories()->attach($categoriesId);
    }

    public function syncCategories(Product $product, array $categoriesId)
    {
        return $product->categories()->sync($categoriesId);
    }

    public function attachDiscounts(Product $product, array $discountIds)
    {
        return $product->discounts()->attach($discountIds);
    }

    public function syncDiscounts(Product $product, array $discountIds)
    {
        return $product->discounts()->sync($discountIds);
    }

    public function attachToppings(Product $product, array $toppingsId)
    {
        return $product->toppings()->attach($toppingsId);
    }

    public function syncToppings(Product $product, array $toppingsId)
    {
        return $product->toppings()->sync($toppingsId);
    }
    public function deleteProductAttributes(Product $product)
    {
        $product->productAttributes()->delete();
    }
    public function deleteProductVariations(Product $product)
    {
        $product->productVariations()->delete();
    }
    public function loadRelations(Product $product, array $relations = [])
    {
        return $product->load($relations);
    }
    public function getQueryBuilderWithRelations($relations = ['categories', 'productVariations'])
    {
        $this->getQueryBuilderOrderBy();
        $this->instance = $this->instance->with($relations);
        return $this->instance;
    }
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC')
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->orderBy($column, $sort);
        return $this->instance;
    }
    public function getMinMaxPromotionPrices($relations = ['productVariations']): array
    {
        $this->getQueryBuilder();
        $this->instance = $this->instance->with($relations);
        $products = $this->instance->get();

        $allPrices = collect();

        foreach ($products as $product) {
            // Thêm giá của sản phẩm chính
            $allPrices->push($product->promotion_price);

            // Thêm giá của các biến thể sản phẩm
            if ($product->productVariations) {
                $allPrices = $allPrices->concat($product->productVariations->pluck('promotion_price'));
            }
        }

        // Lọc bỏ các giá trị null hoặc 0 (nếu cần)
        $allPrices = $allPrices->filter();

        return [
            'min_product_price' => $allPrices->min(),
            'max_product_price' => $allPrices->max(),
        ];
    }

    public function getProductsWithRelations(array $filterData = [], array $relations = ['categories', 'productVariations', 'productVariations.attribute_variations'], $desc = 'desc')
    {
        $this->instance = $this->instance->with($relations);

        if (isset($filterData['min_product_price']) && isset($filterData['max_product_price'])) {
            $this->instance = $this->instance->where(function ($query) use ($filterData) {
                $query->whereBetween('promotion_price', [$filterData['min_product_price'], $filterData['max_product_price']])
                    ->orWhereHas('productVariations', function ($subQuery) use ($filterData) {
                        $subQuery->whereBetween('promotion_price', [$filterData['min_product_price'], $filterData['max_product_price']]);
                    });
            });
        }

        if (isset($filterData['category_slug'])) {
            $this->instance = $this->instance->whereHas('categories', function ($query) use ($filterData) {
                $query->where('slug', $filterData['category_slug']);
            });
        }

        if (isset($filterData['color_slug'])) {
            $this->instance = $this->instance->whereHas('productAttributes.attributeVariations', function ($query) use ($filterData) {
                $query->where('slug', $filterData['color_slug']);
            });
        }

        if (isset($filterData['size_slug'])) {
            $this->instance = $this->instance->whereHas('productAttributes.attributeVariations', function ($query) use ($filterData) {
                $query->where('slug', $filterData['size_slug']);
            });
        }

        $desc = $desc ?? 'asc';
        $this->instance = $this->instance->orderBy(function ($query) {
            $query->selectRaw('CASE
                WHEN type = 1 THEN promotion_price
                WHEN type = 2 THEN (SELECT promotion_price FROM products_variations WHERE products_variations.product_id = products.id ORDER BY promotion_price ASC LIMIT 1)
                ELSE promotion_price
            END');
        }, $desc)->paginate($filterData['limit']);
        return $this->instance;
    }

    public function getFlashSaleProductsWithRelations(array $relations = ['categories', 'productVariations'])
    {
        $this->instance = $this->loadRelations($this->model, $relations);
        $this->instance = $this->instance->where('is_active', 1)->orderBy('promotion_price', 'ASC')->paginate(8);

        return $this->instance;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $select = ['id', 'sku', 'name', 'price', 'promotion_price', 'slug', 'avatar'], $limit = 10)
    {
        $this->instance = $this->model->with('productVariations')->select($select);
        $this->getQueryBuilderFindByKey($keySearch);

        foreach ($meta as $key => $value) {
            $this->instance = $this->instance->where($key, $value);
        }

        return $this->instance->get();
    }

    protected function getQueryBuilderFindByKey($key)
    {
        $this->instance = $this->instance->where(function ($query) use ($key) {
            return $query->where('name', 'LIKE', '%' . $key . '%')
                ->orWhere('price', 'LIKE', '%' . $key . '%');
        });
    }
    public function findOrFailBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }
}
