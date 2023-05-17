@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Edit hotel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('hotels-update', $hotel)}}" method="post" enctype="multipart/form-data">
                        {{-- <form action="{{route('hotels-update', $hotel)}}" method="post"> --}}
                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel title</label>
                                        <input type="text" class="form-control" name="hotel_title" value="{{old('hotel_title', $hotel->title)}}">

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <select class="form-select" name="country_id">
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}" @if($country->id == old('$country_id', $hotel->country_id)) selected @endif>
                                                {{$country->title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel price</label>
                                        <input type="text" class="form-control" name="hotel_price" value="{{old('hotel_price', $hotel->price)}}">
                                        {{-- <input type="text" class="form-control" name="hotel_price" value="{{$hotel->price}}"> --}}
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel photo</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>
                                @if($hotel->photo)
                                <div class="col-6">
                                    <div class="mb-3 img">
                                        <img src="{{asset($hotel->photo)}}">
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary">
                                Save
                            </button>
                            @if($hotel->photo)
                            <button type="submit" class="btn btn-outline-danger" name="delete_photo" value="1">
                                Delete Photo
                            </button>
                            @endif
                        </div>
                        @csrf
                        @method('put')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
