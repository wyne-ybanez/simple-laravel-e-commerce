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
use Carbon\Carbon;

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
        $fromDate = $this->getFromDate();
        $query = Order::query()->where('status', OrderStatus::Paid->value);

        if ($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }

        return $query->count();
    }

    public function totalIncome()
    {
        $fromDate = $this->getFromDate();
        $query = Order::query()->where('status', OrderStatus::Paid->value);

        if ($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }
        return round($query->sum('total_price'));
    }

    public function ordersByCountry()
    {
        // c = country
        // a = address
        $fromDate = $this->getFromDate();
        $query = Order::query()
            ->select(['c.name', DB::raw('count(orders.id) as count')])
            ->join('users', 'created_by', '=', 'users.id')
            ->join('customer_addresses AS a', 'users.id', '=', 'a.customer_id')
            ->join(
                'countries AS c',
                'a.country_code',
                '=',
                'c.code'
            )
            ->where('status', OrderStatus::Paid->value)
            ->where('a.type', AddressType::Billing->value)
            ->groupBy('c.name');

        if ($fromDate) {
            $query->where('orders.created_at', '>', $fromDate);
        }

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
                ->limit(10)
                ->withoutTrashed()
                ->orderBy('orders.created_at', 'desc')
                ->get()
        );
    }

    // get 'date' from request and we map it to this array for a result
    // mappings should be similar as in store/state.js
    private function getFromDate()
    {
        $request = \request();
        $paramDate = $request->get('date');
        $array = [
            '1 day' => Carbon::now()->subDays(1),
            '1 week' => Carbon::now()->subDays(7),
            '2 weeks' => Carbon::now()->subDays(14),
            '1 month' => Carbon::now()->subDays(30),
            '3 months' => Carbon::now()->subDays(60),
            '6 months' => Carbon::now()->subDays(180),
        ];

        return $array[$paramDate] ?? null;
    }
}
