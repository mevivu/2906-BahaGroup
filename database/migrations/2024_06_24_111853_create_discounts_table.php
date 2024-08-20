<?php

use App\Enums\DefaultActiveStatus;
use App\Enums\Discount\DiscountType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('code', 255);
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->integer('max_usage')->nullable();
            $table->double('min_order_amount')->nullable();
            $table->double('discount_value');
            $table->tinyInteger('status')->default(DefaultActiveStatus::Active->value);
            $table->tinyInteger('type')->default(DiscountType::Money->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
};
