<?php

use App\Enums\Transaction\TransactionStatus;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('vnp_Amount');
            $table->string('vnp_BankCode');
            $table->string('vnp_OrderInfo');
            $table->string('vnp_TmnCode');
            $table->string('vnp_TxnRef');
            $table->string('status')->default(TransactionStatus::Pending->value); // Trạng thái giao dịch
            $table->timestamp('expires_at')->nullable(); // Thời gian hết hạn
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
        Schema::dropIfExists('transactions');
    }
};
