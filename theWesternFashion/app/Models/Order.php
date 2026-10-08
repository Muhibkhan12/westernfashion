<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;
    protected $guarded = ['id']; // only ever created in OrderService from validated data

    protected function casts(): array
    {
        return [
            'subtotal'     => 'decimal:2',
            'shipping'     => 'decimal:2',
            'discount'     => 'decimal:2',
            'total'        => 'decimal:2',
            'paid_at'      => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'order_number';
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function items(): HasMany  { return $this->hasMany(OrderItem::class); }

    public function isPayable(): bool
{
    return $this->status === 'PENDING' && $this->payment_status === 'PENDING';
}

    public function isCancellable(): bool
    {
        return $this->isPayable();
    }
}