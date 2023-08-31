<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderListResource;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderUpdateEmail;
use App\Mail\AdminOrderUpdateEmail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the order resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 15);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Order::query()
            ->withCount('items')
            ->with('user.customer')
            ->where('id', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return OrderListResource::collection($query);
    }

    public function view(Order $order)
    {
        // 'items.product' - relation can be checked in Order and OrderItem model
        $order->load('items.product');
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }

    public function getStatuses()
    {
        return OrderStatus::getStatuses();
    }

    public function changeStatus(Order $order, $status)
    {
        $order->status = $status;
        $order->save();
        $adminUsers = User::where('is_admin', 1)->get();

        Mail::to($order->user)->send(new OrderUpdateEmail($order));
        Mail::to(...$adminUsers)->send(new AdminOrderUpdateEmail($order));

        return response('', 200);
    }
}
