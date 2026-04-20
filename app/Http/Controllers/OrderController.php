<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
public function store(Request $request)
    {
        $request->validate(['item_id' => 'required|exists:items,id']);

        $item = Item::findOrFail($request->item_id);

        // Cannot buy own item
        if ($item->users_id === Auth::id()) {
            return back()->with('error', 'You cannot buy your own listing.');
        }

        // Must be available
        if ($item->status !== 'available') {
            return back()->with('error', 'This item is no longer available.');
        }

        // Prevent duplicate pending orders
        $existing = Order::where('buyer_id', Auth::id())
            ->where('item_id', $item->id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return redirect()->route('orders.show', $existing)->with('info', 'You already have a pending order for this item.');
        }

        $order = DB::transaction(function () use ($item) {
            $order = Order::create([
                'buyer_id'   => Auth::id(),
                'item_id'    => $item->id,
                'status'     => 'pending',
                'total_price'=> $item->price,
                'users_id'   => $item->users_id,
            ]);
            $item->update(['status' => 'reserved']);
            return $order;
        });

        return redirect()->route('orders.show', $order)->with('success', 'Order placed! Please confirm your payment.');
    }

    public function show(Order $order)
    {
        $this->authorizeOrder($order);
        $order->load(['item.category', 'buyer', 'seller']);
        return view('orders.show', compact('order'));
    }

    private function authorizeOrder(Order $order): void
    {
        abort_unless(
            $order->buyer_id === Auth::id() || $order->users_id === Auth::id(),
            403
        );
    }
}