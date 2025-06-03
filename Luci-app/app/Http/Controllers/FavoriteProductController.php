<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteProductController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // or use a specific user ID if needed
        $favoriteProducts = FavoriteProduct::with('product')
            ->where('user_id', $userId)
            ->get();

        return view('User.user-favorite', ['favorites' => $favoriteProducts]);
    }
}
