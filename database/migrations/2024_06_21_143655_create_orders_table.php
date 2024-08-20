<?php

use App\Enums\DefaultStatus;
use App\Enums\DeleteStatus;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\OrderType;
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
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('payment_method')->default(PaymentMethod::Online->value);
            $table->text('address')->nullable();
            $table->double('total');
            $table->tinyInteger('status')->default(OrderStatus::Pending->value);
            $table->text('note')->nullable();
            $table->tinyInteger('is_deleted')->default(DefaultStatus::Published->value);

            $table->string('name_other')->nullable();
            $table->text('address_other')->nullable();
            $table->string('phone_other')->nullable();
            $table->text('note_other')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
