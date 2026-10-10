<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete(); // guests can submit too
            $table->string('order_number', 50)->unique();
            $table->enum('status', ['NEW', 'QUOTED', 'ACCEPTED', 'IN_PRODUCTION', 'COMPLETED', 'CANCELLED'])->default('NEW');

            // design
            $table->string('style', 100);
            $table->string('material', 100);
            $table->string('color', 100);
            $table->string('color_other', 100)->nullable();
            $table->string('lining', 100)->nullable();
            $table->string('hardware', 100)->nullable();

            // fit
            $table->string('fit', 50);
            $table->enum('sizing_mode', ['standard', 'custom']);
            $table->string('standard_size', 10)->nullable();
            $table->enum('unit', ['cm', 'in'])->default('cm');
            $table->decimal('height', 5, 1)->nullable();
            $table->decimal('chest', 5, 1)->nullable();
            $table->decimal('waist', 5, 1)->nullable();
            $table->decimal('shoulder_width', 5, 1)->nullable();
            $table->decimal('sleeve_length', 5, 1)->nullable();
            $table->decimal('jacket_length', 5, 1)->nullable();
            $table->unsignedTinyInteger('quantity')->default(1);

            // extras
            $table->string('monogram', 40)->nullable();
            $table->text('details')->nullable();
            $table->json('reference_images')->nullable();
            $table->string('budget', 50)->nullable();
            $table->date('needed_by')->nullable();

            // contact
            $table->string('name');
            $table->string('email');
            $table->string('phone', 50)->nullable();

            // for you to fill in later (admin side)
            $table->decimal('quote_amount', 10, 2)->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_orders');
    }
};