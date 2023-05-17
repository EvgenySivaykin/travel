@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            {{-- cats --}}
            @include('front.common.cats')
        </div>
        <div class="col-9">

            {{-- начало новой большой вставки с поиском и сортировкой ниже: --}}
            {{--
            <form action="{{route('start')}}" method="get">
            <div class="container">
                <div class="row justify-content-center"> --}}
                    {{-- <div class="col-3">
                        <h2>Hotels List</h2>
                    </div> --}}

                    {{-- <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Find hotel</label>
                                <input type="text" class="form-control" name="s" value="{{$s}}">
                </div>
            </div>

            <div class="col-3">
                <div class="head-buttons">
                    <button type="submit" class="btn btn-outline-primary mt-3">Search</button>
                </div>
            </div>
        </div>
    </div>
    </form> --}}





    {{-- последняя попытка (начало) --}}
    {{-- <form action="{{route('start')}}" method="get">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <h2>Hotels List</h2>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">Sort by</label>
                    <select class="form-select" name="sort">
                        @foreach($sortSelect as $value => $name)
                        <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">Sort by</label>
                    <select class="form-select" name="sort">
                        @foreach($sortSelect as $value => $name)
                        <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="col-4">
                <div class="head-buttons">
                    <button type="submit" class="btn btn-outline-primary">Show</button>
                    <a href="{{route('start')}}" class="btn btn-outline-info">Reset</a>
                </div>
            </div>
        </div>
    </div>
    </form> --}}

    {{-- последняя попытка (конец) --}}




    {{-- <div class="col-3">
                        <div class="mb-3">
                            <label class="form-label">Sort by</label>
                            <select class="form-select" name="sort"> --}}
    {{-- <option>default</option> --}}
    {{-- @foreach($sortSelect as $value => $name)
                                    <option value="{{$value}}"> --}}
    {{-- <option value="{{$value}}" @if($sortShow==$value) selected @endif> --}}
    {{-- {{$name}}
    </option>
    @endforeach
    </select>
</div>
</div>
<div class="col-4">
    <div class="head-buttons">
        <button type="submit" class="btn btn-outline-primary mt-3">Show</button>
        <a href="{{route('start')}}" class="btn btn-outline-info mt-3">Reset</a>
    </div>
</div>
</div>
</div>
@csrf

</form> --}}



{{-- начало новой большой вставки с поиском и сортировкой ниже: --}}

{{-- <form action="{{route('start')}}" method="get">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            <h1>Hotels List</h1>
        </div>

        <div class="col-3">
            <div class="mb-3">
                <label class="form-label">Sort by</label>
                <select class="form-select" name="sort">
                    <option>default</option>
                    @foreach($sortSelect as $value => $name) --}}
                    {{-- <option value="{{$value}}"> --}}
                    {{-- <option value="{{$value}}" @if($sortShow==$value) selected @endif>
                    {{$name}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-3">
            <div class="mb-3">
                <label class="form-label">Country</label>
                <select class="form-select" name="country_id">
                    <option value="all">All</option>
                    @foreach($countries as $country) --}}
                    {{-- <option value="{{$value}}"> --}}
                    {{-- <option value="{{$country->id}}" @if($country->id == $countryShow) selected @endif>
                    {{$country->title}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-1">
            <div class="mb-3">
                <label class="form-label">Per page</label>
                <select class="form-select" name="per_page">

                    @foreach($perPageSelect as $value)
                    <option value="{{$value}}" @if($perPageShow==$value) selected @endif>
                        {{$value}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-4">
            <div class="head-buttons">
                <button type="submit" class="btn btn-outline-primary mt-3">Show</button>
                <a href="{{route('start')}}" class="btn btn-outline-info mt-3">Reset</a>
            </div>
        </div>
    </div>
</div>
@csrf

</form>
<form action="{{route('start')}}" method="get">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Find hotel</label>
                    <input type="text" class="form-control" name="s" value="{{$s}}">
                </div>
            </div>

            <div class="col-4">
                <div class="head-buttons">
                    <button type="submit" class="btn btn-outline-primary mt-3">Search</button>
                </div>
            </div>

        </div>
    </div>
</form> --}}



{{-- конец большой вставки с поиском и сортировкой --}}



<div class="card-body">
    <div class="container">
        <div class="row justify-content-center">

            @forelse($hotels as $hotel)
            <div class="col-4">

                <div class="list-table">
                    <div class="top">

                        {{-- <h2>
                                        hotel: {{$hotel->title}}
                        </h2> --}}
                        <h3>
                            hotel: <h2>{{$hotel->title}}</h2>
                        </h3>

                        <a href="{{route('show-hotel', $hotel)}}">
                            <div class="smallimg">
                                @if($hotel->photo)
                                <img src="{{asset($hotel->photo)}}">
                                @else
                                <img src="{{asset('no.jpg')}}">
                                @endif
                            </div>
                        </a>
                    </div>

                    <div class="bottom">
                        <div class="info">
                            {{-- <div class="country">country: {{$hotel->hotelCountry->title}}</div> --}}
                        <div class="country">
                            <h2>{{$hotel->hotelCountry->title}}</h2>
                        </div>
                        <div>
                            <div>Check-in: {{$hotel->start}}</div>
                            <div>Check-out: {{$hotel->end}}</div>
                        </div>
                    </div>


                    {{-- конец вставки --}}

                    <div class="buy">
                        {{-- <div class="price">price: {{$hotel->price}} Eur</div> --}}
                    <div class="price">
                        <div>price:</div>
                        <div>{{$hotel->price}} Eur</div>
                    </div>






                    {{-- начало вставки action"содержание": --}}
                    {{-- <form action="" method="post"> --}}
                    <form action="{{route('add-to-cart')}}" method="post">
                        <button type="submit" class="btn btn-outline-primary">Add</button>
                        <input type="number" min="1" name="count" value="1">
                        {{-- начало вставки: --}}
                        <input type="hidden" name="product" value="{{$hotel->id}}">
                        {{-- конец вставки: --}}
                        @csrf
                    </form>
                </div>
            </div>

            {{-- <div class="list-table__buttons">
                                    <a href="{{ route('hotels-show', $hotel) }}" class="btn btn-outline-primary">Show</a>
            <a href="{{ route('hotels-edit', $hotel) }}" class="btn btn-outline-success">Edit</a>
            <form action="{{route('hotels-delete', $hotel)}}" method="post">
                <button type="submit" class="btn btn-outline-danger">
                    Delete
                </button>
                @csrf
                @method('delete')
            </form>
        </div> --}}
    </div>
</div>


{{-- вставляем ниже: --}}
{{-- </div>
            конец вставки --}}


@empty
No hotels yet
@endforelse

</div>
</div>
{{-- @if($perPageShow != 'all') --}}
<div class="m-2">
    {{ $hotels->links() }}
</div>
{{-- @endif --}}
</div>
</div>
@endsection
