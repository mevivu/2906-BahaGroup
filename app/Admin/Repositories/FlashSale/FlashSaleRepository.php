<?php

namespace App\Admin\Repositories\FlashSale;
use App\Admin\Repositories\EloquentRepository;
use App\Models\FlashSale;
use App\Models\FlashSaleDetail;

class FlashSaleRepository extends EloquentRepository implements FlashSaleRepositoryInterface
{
    public function getModel(): string
    {
        return FlashSale::class;
    }

    public function deleteDetail($id)
    {
        $detail = FlashSaleDetail::find($id);
        if ($detail) {
            $detail->delete();
            return true;
        }
        return false;
    }

    public function getAllFlashSaleProducts_Rows($flash_sale_id) {
        // dd($flash_sale_id);
        $detail = FlashSaleDetail::where('flash_sale_id', $flash_sale_id)->get();
        if ($detail) {
            return $detail;
        }
    }
}
