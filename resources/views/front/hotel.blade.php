@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            {{-- cats --}}
            @include('front.common.cats')
        </div>
        <div class="col-9">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-center">

                        {{-- @forelse($hotels as $hotel) --}}
                        <div class="col-12">

                            <div class="list-table one">
                                <div class="top">

                                    {{-- <h2>
                                        hotel: {{$hotel->title}}
                                    </h2> --}}
                                    <h2>
                                        hotel: <h3>{{$hotel->title}}</h3>
                                    </h2>
                                    <div class="smallimg">
                                        @if($hotel->photo)
                                        <img src="{{asset($hotel->photo)}}">
                                        @else
                                        <img src="{{asset('no.jpg')}}">
                                        @endif
                                    </div>

                                </div>

                                <div class="bottom">
                                    <div class="info">
                                        {{-- <div class="country">country: {{$hotel->hotelCountry->title}}</div> --}}
                                    <div class="country">
                                        <h2>{{$hotel->hotelCountry->title}}</h2>
                                    </div>
                                    {{-- вставка ниже: --}}
                                    <div>
                                        <div>Check-in: {{$hotel->start}}</div>
                                        <div>Check-out: {{$hotel->end}}</div>
                                    </div>
                                    {{-- конец вставки --}}
                                    <div>
                                        <div>Season from: {{$hotel->hotelCountry->start}}</div>
                                        <div>Season till: {{$hotel->hotelCountry->end}}</div>
                                    </div>
                                </div>
                                <div class="buy">
                                    <div class="price">price: {{$hotel->price}} Eur</div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
