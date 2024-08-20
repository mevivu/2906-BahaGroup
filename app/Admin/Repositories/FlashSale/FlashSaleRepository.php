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
}
