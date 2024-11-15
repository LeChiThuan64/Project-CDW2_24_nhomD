<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('street_address');
            $table->string('city');
            $table->string('zipcode');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('country');
            $table->integer('voucher_discount')->nullable(); // ID voucher, nếu có
            $table->decimal('subtotal', 15, 2); // Tổng tiền chưa bao gồm vận chuyển
            $table->decimal('shipping_price', 15, 2); // Phí vận chuyển
            $table->decimal('total', 15, 2); // Tổng tiền đơn hàng
            $table->string('payment_method'); // Phương thức thanh toán
            $table->string('status')->default('pending'); // Trạng thái đơn hàng
            $table->text('note')->nullable(); // Ghi chú đơn hàng, nếu có
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}