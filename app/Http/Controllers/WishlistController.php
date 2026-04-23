<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $items = Auth::user()->favorites()
            ->with(['category', 'user'])
            ->latest('favorites.created_at')
            ->paginate(12);

        return view('favorites.index', compact('items'));
    }

    public function toggle(Item $item)
    {
        $user = Auth::user();
        $result = $user->favorites()->toggle($item->id);
        $favorited = count($result['attached']) > 0;

        if (!request()->expectsJson()) {
            return back()->with('success', $favorited ? 'Ditambahkan ke wishlist!' : 'Dihapus dari wishlist.');
        }

        return response()->json([
            'favorited' => $favorited,
            'count'     => $item->favoritedBy()->count(),
        ]);
    }
}