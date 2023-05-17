@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Show hotel</h1>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Hotel title</label>
                                    {{$hotel->title}}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    {{$hotel->hotelCountry->title}}
                                    <div class="mb-3">
                                        <div>Check-in: {{$hotel->start}}</div>
                                        <div>Check-out: {{$hotel->end}}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Hotel price</label>
                                    {{$hotel->price}} eur / person
                                </div>
                            </div>
                            @if($hotel->photo)
                            <div class="col-12">
                                <div class="mb-3 img">
                                    <img src="{{asset($hotel->photo)}}">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <a href="{{route('hotels-pdf', $hotel)}}" class="btn btn-outline-primary">Download PDF</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
