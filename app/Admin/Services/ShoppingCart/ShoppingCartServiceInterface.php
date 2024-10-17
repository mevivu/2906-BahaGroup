<?php

namespace App\Admin\Services\ShoppingCart;

use Illuminate\Http\Request;

interface ShoppingCartServiceInterface
{
    /**
     * Tạo mới
     *
     * @var Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function store(Request $request);
    /**
     * Cập nhật
     *
     * @var Illuminate\Http\Request $request
     *
     * @return boolean
     */
    public function update(Request $request);
    /**
     * Xóa
     *
     * @param int $id
     *
     * @return boolean
     */
    public function delete($id);
    public function storeNotLogin(Request $request);
    public function checkout(Request $request);
    public function calculateDiscountValue($total, $discount);
    public function calculateTotal($shoppingCart);
    public function calculateTotalFromSession($cart);
}
