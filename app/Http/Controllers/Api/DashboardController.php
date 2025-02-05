<?php

namespace App\Http\Controllers\Api;

use App\Enums\AddressType;
use App\Enums\CustomerStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function activeCustomers()
    {
        return Customer::where('status', CustomerStatus::Active->value)->count();
    }

    public function activeProducts()
    {
        return Product::where('published', '=', 1)->count();
    }

    public function paidOrders()
    {
        $query = Order::query()->where('status', OrderStatus::Paid->value);

        return $query->count();
    }

    public function totalIncome()
    {
        $query = Order::query()->where('status', OrderStatus::Paid->value);

        return round($query->sum('total_price'));
    }

    public function ordersByCountry()
    {
        // c = country
        // a = address
        $query = Order::query()
            ->select(['c.name', DB::raw('count(orders.id) as count')])
            ->join('users', 'created_by', '=', 'users.id')
            ->join('customer_addresses AS a', 'users.id', '=', 'a.customer_id')
            ->join('countries AS c', 'a.country_code', '=', 'c.code')
            ->where('status', OrderStatus::Paid->value)
            ->where('a.type', AddressType::Billing->value)
            ->groupBy('c.name');

        return $query->get();
    }

    public function latestCustomers()
    {
        return Customer::query()
            ->select(['id', 'first_name', 'last_name', 'u.email', 'phone', 'u.created_at'])
            ->join('users AS u', 'u.id', '=', 'customers.user_id')
            ->where('status', CustomerStatus::Active->value)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function latestOrders()
    {
        // items
        // user_id
        // first_name
        // last_name

        return OrderResource::collection(
            Order::query()
                ->select([
                    'orders.id',
                    'orders.total_price',
                    'orders.created_at',
                    DB::raw('COUNT(order_items.id) AS items_count'),
                    'customers.user_id',
                    'customers.first_name',
                    'customers.last_name'
                ])
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->join('customers', 'customers.user_id', '=', 'orders.created_by')
                ->where('orders.status', OrderStatus::Paid->value)
                ->groupBy(
                    'orders.id',
                    'orders.total_price',
                    'orders.created_at',
                    'customers.user_id',
                    'customers.first_name',
                    'customers.last_name'
                )
                ->limit(7)
                ->withoutTrashed()
                ->orderBy('orders.created_at', 'desc')
                ->get()
        );
    }
}
