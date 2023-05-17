@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Add new hotel</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('hotels-store')}}" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel title</label>
                                        <input type="text" class="form-control" name="hotel_title" value="{{old('hotel_title')}}">

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <select class="form-select" name="country_id">
                                            @foreach($countries as $country)
                                            {{-- <option value="{{$country->id}}"> --}}
                                            <option value="{{$country->id}}" @if($country->id == old('$country_id')) selected @endif>
                                                {{$country->title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel price</label>
                                        <input type="text" class="form-control" name="hotel_price" value="{{old('hotel_price')}}">
                                    </div>
                                </div>

                                {{-- добавляем даты ниже: --}}

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Check-in</label>
                                        <input type="date" class="form-control" name="hotel_start" value="{{old('hotel_start')}}">
                                        {{-- <input type="date" class="form-control" name="hotel_start"> --}}
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Check-out</label>
                                        <input type="date" class="form-control" name="hotel_end" value="{{old('hotel_end')}}">
                                        {{-- <input type="date" class="form-control" name="hotel_end"> --}}
                                    </div>
                                </div>

                                {{-- конец вставки --}}

                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel photo</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary">
                                Add
                            </button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
