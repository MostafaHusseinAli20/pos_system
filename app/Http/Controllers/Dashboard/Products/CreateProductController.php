<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Notifications\AddProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Notification;

class CreateProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
        ];

        foreach (config('translatable.locales') as $locale)
        {
            $rules += [$locale. '.name' => ['required' => Rule::unique('product_translations', 'name')]];
            $rules += [$locale. '.description' => ['required' => Rule::unique('product_translations', 'description')]];
        }

        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ];

        $request->validate($rules);

        $request_data = $request->all();

        Product::create($request_data);

        $product = Product::latest()->first();
        $currentUser = Auth::user();

        if($currentUser->hasRole('super_admin')) {
            Notification::send($currentUser, new AddProduct($product));
        }else {
            $users = collect([
                User::role('super_admin')->get(),
                $currentUser,
            ])->flatten();
            Notification::send($users, new AddProduct($product));
        }

        return redirect()->route('products.index')->with('success', __('site.added_successfully'));
    }

    public function MarkAsRead()
    {
        $userUnreadNotifiaction = auth()->user()->unreadNotifications;
        if($userUnreadNotifiaction)
        {
            $userUnreadNotifiaction->MarkAsRead();
            return back()->with('success', __('site.read_all_succssfully'));
        }
    }
}
