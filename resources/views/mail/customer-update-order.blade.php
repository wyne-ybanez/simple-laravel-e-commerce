<h2>
    The Order #{{$order->id}} status was changed into "{{$order->status}}"
</h2>

<p>
    Link to the order:
    <a href="{{route('order.view', $order, true)}}">Order #{{$order->id}}</a>
</p>