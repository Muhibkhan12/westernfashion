<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomOrder extends Model
{
    use HasUuids;

    protected $guarded = ['id']; // only ever created in CustomOrderController from validated data

    protected function casts(): array
    {
        return [
            'reference_images' => 'array',
            'needed_by'        => 'date',
            'quote_amount'     => 'decimal:2',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'order_number';
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}