<span class="text-black uppercase py-1 px-2 rounded text-sm
            {{ ($order->isPaid() ||  $order->isCompleted()) ? 'bg-emerald-400' : '' }}
            {{ $order->isUnpaid() ? 'bg-red-400' : '' }}
            {{ $order->isCancelled() ? 'bg-gray-300' : '' }}
            {{ $order->isShipped() ? 'bg-orange-300' : '' }}
            {{ $order->isIncomplete() ? 'bg-violet-300' : '' }}
            ">
    {{$order->status}}
</span>