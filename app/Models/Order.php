<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['status', 'total_price', 'created_by', 'updated_by'];

    public function isPaid()
    {
        return $this->status === OrderStatus::Paid->value;
    }

    public function isCompleted()
    {
        return $this->status === OrderStatus::Completed->value;
    }

    public function isIncomplete()
    {
        return $this->status === OrderStatus::Incomplete->value;
    }

    public function isShipped()
    {
        return $this->status === OrderStatus::Shipped->value;
    }

    public function isUnpaid()
    {
        return $this->status === OrderStatus::Unpaid->value;
    }

    public function isCancelled()
    {
        return $this->status === OrderStatus::Cancelled->value;
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function deleteUnpaidOrders($hours)
    {
        return Order::query()->where('status', OrderStatus::Unpaid->value)
            ->where('created_at', '<', Carbon::now()->subHours($hours))
            ->delete();
    }
}
