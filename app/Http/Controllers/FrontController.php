<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;

class FrontController extends Controller
{
    public function home()
    {
        $hotels = Hotel::paginate(12);

        return view('front.home', [
            'hotels' => $hotels
        ]);
    }

    //НАЧАЛО ПОСЛЕДНЕЙ ПОПЫТКИ:

    // public function home(Request $request)
    // {

    //     $hotels = Hotel::paginate(12)->sortBy('title');
        
    //     if (!$request->s) {
    //         $hotels = Hotel::paginate(12)->sortBy('title');
    //     } else {
    //         $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->get();
    //         // $s = explode(' ', $request->s);

    //         // if (count($s) == 1) {
    //         //     $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->get();
    //         // }
    //         // else {
    //         //     $hotels = Hotel::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
    //         //     ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
    //         //     ->get();
    //         // } 
    //     }
        
    //     // $countries = Country::all()->sortBy('title');
    //     $hotels = Hotel::paginate(12);
    //     // $hotels = Hotel::all()->sortBy('title');

    //     return view('front.home', [
    //         'hotels' => $hotels,
    //         // 'countries' => $countries,
    //         's' => $request->s ?? '',
    //     ]);
    // }


    //КОНЕЦ ПОСЛЕДНЕЙ ПОПЫТКИ:

    //ЕЩЕ ОДНА ПОПЫТКА:

    // public function home(Request $request)
    // {
        
    //     $hotels = match ($request->sort ?? '') {
    //         'asc_price' => Hotel::orderBy('price'),
    //         'desc_price' => Hotel::orderBy('price', 'desc'),
    //         default => Hotel::where('id', '>', 0),
    //     };

    //     $hotels = Hotel::paginate(12)->withQueryString();

    //     // $hotels = $hotels->get();

    //     return view('front.home', [
    //         'hotels' => $hotels,
    //         'sortSelect' => Hotel::SORT,
    //         'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
    //         'perPageSelect' => Hotel::PER_PAGE,
    //         // 'perPageShow' => $perPageShow,
    //     ]);
    // }

    //КОНЕЦ ЕЩЕ ОДНОЙ ПОПЫТКИ


    // новая сортировочная вставка вместо вышезакомментированного:

    // public function home(Request $request)
    // {
    //     $perPageShow = in_array($request->per_page, Hotel::PER_PAGE) ? $request->per_page : 'all';

    //     if (!$request->s) {
    //         if ($request->country_id && $request->country_id != 'all') {
    //             $hotels = Hotel::where('country_id', $request->country_id);
    //         }
    //         else {
    //             $hotels = Hotel::where('id', '>', 0);
    //         }
            
            
    //         $hotels = match($request->sort ?? '') {
    //             'asc_price' => $hotels->orderBy('price'),
    //             'desc_price' => $hotels->orderBy('price', 'desc'),
    //             default => $hotels,
    //             // default => Hotel::where('id', '>', 0)->sortBy('title'),
    //             // default => Hotel::all()->sortBy('title'),
    //         };
        
    //         // $hotels = $hotels->paginate(12)->withQueryString();
        
    //         // $perPageShow = in_array($request->per_page, Hotel::PER_PAGE) ? $request->per_page : 'all';

    //         if ($perPageShow == 'all') {
    //             $hotels = $hotels->get();
    //         } else {
    //             $hotels = $hotels->paginate($perPageShow)->withQueryString();
    //         }
    //     }
    //     else {
    //         // $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->get();
    //         $s = explode(' ', $request->s);

    //         if (count($s) == 1) {
    //             $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->get();
    //         }
    //         else {
    //             $hotels = Hotel::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
    //             ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
    //             ->get();
    //         }
    //         $hotels = $hotels->paginate($perPageShow)->withQueryString();
    //     }


    //     // $hotels = Hotel::all()->sortBy('title');
    //     // $countries = Country::all()->sortBy('title');
    //     // $hotels = $hotels->paginate($perPageShow)->withQueryString();
    
    
    //     $countries = Country::all();
    //     //конец вставки

    //     return view('front.home', [
    //         'hotels' => $hotels,
    //         //вставка ниже:
    //         'sortSelect' => Hotel::SORT,
    //         'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
    //         'perPageSelect' => Hotel::PER_PAGE,
    //         'perPageShow' => $perPageShow,
    //         'countries' => $countries,
    //         'countryShow' => $request->country_id ? $request->country_id : '',
    //         's' => $request->s ?? '',

    //     ]);
    // }



    // конец большой вставки

    public function showHotel(Hotel $hotel)
    {
        return view('front.hotel', [
            'hotel' => $hotel
        ]);
    }


    public function showCatHotels(Country $country)
    {
        $hotels = Hotel::where('country_id', $country->id)->paginate(21);
        
        return view('front.home', [
            'hotels' => $hotels
        ]);
    }

    public function addToCart(Request $request, CartService $cart)
    {
        // $cart = $request->session()->get('cart', []);
        $id = (int) $request->product;
        $count = (int) $request->count;
        $cart->add($id, $count);
        return redirect()->back();
    }

    public function cart(CartService $cart)
    {
        return view('front.cart', [
            'cartList' => $cart->list
        ]);
    }

    public function updateCart(Request $request, CartService $cart)
    {
        if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart);
        }
        return redirect()->back();
    }

    public function makeOrder(CartService $cart)
    {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->order_json = json_encode($cart->order());
        $order->save();
        $cart->empty();

        return redirect()->route('start')->with('ok', 'Hotel succesfully booked');
    }
}