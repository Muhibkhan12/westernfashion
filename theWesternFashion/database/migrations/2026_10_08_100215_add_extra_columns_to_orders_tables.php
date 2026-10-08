<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('orders', function (Blueprint $t) {
        $t->string('payment_reference')->nullable()->after('payment_status');
        $t->timestamp('paid_at')->nullable();
        $t->timestamp('cancelled_at')->nullable();
    });

    Schema::table('order_items', function (Blueprint $t) {
        $t->string('size')->nullable()->after('sku');
        $t->string('color')->nullable()->after('size');
        $t->string('image_path')->nullable()->after('color');
    });
}

public function down(): void
{
    Schema::table('orders', fn (Blueprint $t) => $t->dropColumn(['payment_reference', 'paid_at', 'cancelled_at']));
    Schema::table('order_items', fn (Blueprint $t) => $t->dropColumn(['size', 'color', 'image_path']));
}
};
