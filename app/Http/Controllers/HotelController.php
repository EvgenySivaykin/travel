<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\ImageManager;
use Carbon\Carbon;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //вставка ниже:
        $perPageShow = in_array($request->per_page, Hotel::PER_PAGE) ? $request->per_page : 'all';

        if (!$request->s) {
            if ($request->country_id && $request->country_id != 'all') {
                $hotels = Hotel::where('country_id', $request->country_id);
            }
            else {
                $hotels = Hotel::where('id', '>', 0);
            }
            
            
            $hotels = match($request->sort ?? '') {
                'asc_price' => $hotels->orderBy('price'),
                'desc_price' => $hotels->orderBy('price', 'desc'),
                default => $hotels,
                // default => Hotel::where('id', '>', 0)->sortBy('title'),
                // default => Hotel::all()->sortBy('title'),
            };
        
            // $hotels = $hotels->paginate(12)->withQueryString();
        
            // $perPageShow = in_array($request->per_page, Hotel::PER_PAGE) ? $request->per_page : 'all';

            if ($perPageShow == 'all') {
                $hotels = $hotels->get();
            } else {
                $hotels = $hotels->paginate($perPageShow)->withQueryString();
            }
        }
        else {
            // $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->get();
            $s = explode(' ', $request->s);

            if (count($s) == 1) {
                $hotels = Hotel::where('title', 'like', '%'.$request->s.'%')->get();
            }
            else {
                $hotels = Hotel::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->get();
            }
        }


        $hotels = Hotel::all()->sortBy('title');
        $countries = Country::all();
        // $countries = Country::all()->sortBy('title');
        //конец вставки

        return view('back.hotels.index', [
            'hotels' => $hotels,
            //вставка ниже:
            'sortSelect' => Hotel::SORT,
            'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Hotel::PER_PAGE,
            'perPageShow' => $perPageShow,
            'countries' => $countries,
            'countryShow' => $request->country_id ? $request->country_id : '',
            's' => $request->s ?? '',

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all()->sortBy('title');
        return view('back.hotels.create', [
            'countries' => $countries
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make(
            $request->all(), 
            [
            'hotel_title' => 'required|min:3|max:100',
            // 'hotel_price' => 'required|decimal:0,2|min:0|max:999',
            'hotel_price' => 'required|decimal:0,2|min:0|max:9999',
            'country_id' => 'required|numeric|min:1',
            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
        $hotel = new Hotel;

        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $manager = new ImageManager(['driver' => 'GD']);
            $image = $manager->make($photo);
            $image->crop(400, 600);

            // $image = Image::make($photo)->pixelate(12);
            $image->save(public_path().'/hotels/'.$file);
            
            // $photo->move(public_path().'/hotels', $file);

            // $hotel->photo = asset('/hotels') . '/' . $file;
            $hotel->photo = '/hotels/' . $file;
        }

        // вставка ниже:
        $hotel_start = Carbon::parse($request->hotel_start);
        $hotel_end = Carbon::parse($request->hotel_end);
        // конец вставки



        $hotel->title = $request->hotel_title;
        $hotel->country_id = $request->country_id;
        $hotel->price = $request->hotel_price;
        // вставка ниже:
        $hotel->start = $hotel_start;
        $hotel->end = $hotel_end;

        $x = $hotel->hotelCountry->start;
        $y = $hotel->start;
        $x2 = $hotel->hotelCountry->end;
        $y2 = $hotel->end;

        if($x > $y || $x2 < $y2) {
            return redirect()->route('hotels-create')->with('not', 'Hotel reservation exceeds country season limits');
        }


        // конец вставки

        $hotel->save();

        return redirect()->route('hotels-index')->with('ok', 'New hotel was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        return view('back.hotels.show', ['hotel' => $hotel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $countries = Country::all()->sortBy('title');
        
        return view('back.hotels.edit', [
            'countries' => $countries,
            'hotel' => $hotel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        if ($request->delete_photo) {
            $hotel->deletePhoto();
            return redirect()->back()->with('ok', 'Photo was deleted');
        }
        
        $validator = Validator::make(
            $request->all(), 
            [
            'hotel_title' => 'required|min:3|max:100',
            'hotel_price' => 'required|decimal:0,2|min:0|max:9999',
            'country_id' => 'required|numeric|min:1',
            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $countries = Country::all()->sortBy('title');

        //начало вставки:
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;

            $manager = new ImageManager(['driver' => 'GD']);
            $image = $manager->make($photo);
            $image->crop(400, 600);

            if ($hotel->photo) {
                $hotel->deletePhoto();
            }
            
            // $photo->move(public_path().'/hotels', $file);
            $image->save(public_path().'/hotels/'.$file);

            // $hotel->photo = asset('/hotels') . '/' . $file;
            $hotel->photo = '/hotels/' . $file;
        }

        $hotel->title = $request->hotel_title;
        $hotel->country_id = $request->country_id;
        $hotel->price = $request->hotel_price;
        // $hotel->photo = $request->hotel_photo;

        $hotel->save();

        return redirect()->route('hotels-index')->with('ok', 'Hotel was edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        // return redirect()->route('hotels-index')->with('ok', 'Hotel was deleted');
        return redirect()->back()->with('ok', 'Hotel was deleted');
    }

    public function pdf(Hotel $hotel)
    {
        $pdf = Pdf::loadView('back.hotels.pdf', ['hotel' => $hotel]);
        return $pdf->download($hotel->title.'.pdf');
    }

}