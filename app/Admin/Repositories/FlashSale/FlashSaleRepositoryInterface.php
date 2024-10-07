<?php

namespace App\Admin\Repositories\FlashSale;
use App\Admin\Repositories\EloquentRepositoryInterface;


interface FlashSaleRepositoryInterface extends EloquentRepositoryInterface
{
    public function getFlashSaleInfo($id);
    public function getFlashSaleId_ValidDay();
    public function deleteDetail($id);
    public function getAllFlashSaleProducts_Rows($flash_sale_id);
}
