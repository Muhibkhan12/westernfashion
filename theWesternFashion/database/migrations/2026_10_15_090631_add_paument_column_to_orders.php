<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Columns your OrderService and the payment code write to. Each one is only added if it is
 * missing, so it is safe to run even if you already added some of them in another migration.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'provider_order_id')) {
                $table->string('provider_order_id', 100)->nullable()->after('payment_method'); // PayPal order id
            }
            if (! Schema::hasColumn('orders', 'payment_reference')) {
                $table->string('payment_reference', 100)->nullable()->after('payment_method'); // PayPal capture id
            }
            if (! Schema::hasColumn('orders', 'paid_at')) {
                $table->timestamp('paid_at')->nullable();
            }
            if (! Schema::hasColumn('orders', 'cancelled_at')) {
                $table->timestamp('cancelled_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            foreach (['provider_order_id', 'payment_reference', 'paid_at', 'cancelled_at'] as $col) {
                if (Schema::hasColumn('orders', $col)) $table->dropColumn($col);
            }
        });
    }
};