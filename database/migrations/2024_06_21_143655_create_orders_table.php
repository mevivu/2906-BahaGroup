<?php

use App\Enums\DefaultStatus;
use App\Enums\Order\OrderReview;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentStatus;
use App\Enums\Payment\PaymentMethod;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('payment_method')->default(PaymentMethod::Online->value);
            $table->text('note')->nullable();
            $table->text('payment_image')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fullname')->nullable();
            $table->double('discount_value')->default(0);
            $table->double('total');
            $table->double('surcharge')->default(0);
            $table->tinyInteger('status')->default(OrderStatus::Pending->value);
            $table->tinyInteger('payment_status')->default(PaymentStatus::UnPaid->value);
            $table->text('code')->unique();
            $table->tinyInteger('is_deleted')->default(DefaultStatus::Published->value);
            $table->tinyInteger('is_review')->default(OrderReview::NotReviewed->value);

            $table->string('name_other')->nullable();
            $table->text('address_other')->nullable();
            $table->string('phone_other')->nullable();
            $table->text('note_other')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('ward_id');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
