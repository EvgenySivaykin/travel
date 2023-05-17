@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    {{-- начало вставки: --}}
                    <form action="{{route('hotels-index')}}" method="get">
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
                                            @foreach($sortSelect as $value => $name)
                                            {{-- <option value="{{$value}}"> --}}
                                            <option value="{{$value}}" @if($sortShow==$value) selected @endif>
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
                                            @foreach($countries as $country)
                                            {{-- <option value="{{$value}}"> --}}
                                            <option value="{{$country->id}}" @if($country->id == $countryShow) selected @endif>
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
                                        <a href="{{route('hotels-index')}}" class="btn btn-outline-info mt-3">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @csrf

                    </form>
                    <form action="{{route('hotels-index')}}" method="get">
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
                    </form>


                    {{-- конец вставки --}}
                    {{-- <h1>Hotels List</h1> --}}
                </div>
            </div>

            <div class="card-body">
                <ul class="list-group">
                    @forelse($hotels as $hotel)
                    <li class="list-group-item">
                        <div class="list-table">
                            <div class="list-table__content">

                                <h3>hotel: {{$hotel->title}}</h3>
                                <div class="country">country: {{$hotel->hotelCountry->title}}</div>
                                <div class="period">
                                    <div>Check-in: {{$hotel->start}}</div>
                                    <div>Check-out: {{$hotel->end}}</div>
                                </div>
                                <div class="price">price: {{$hotel->price}} Eur</div>

                                <div class="smallimg">
                                    @if($hotel->photo)
                                    <img src="{{asset($hotel->photo)}}">
                                    @endif
                                </div>
                            </div>

                            <div class="list-table__buttons">
                                <a href="{{ route('hotels-show', $hotel) }}" class="btn btn-outline-primary">Show</a>
                                <a href="{{ route('hotels-edit', $hotel) }}" class="btn btn-outline-success">Edit</a>
                                <form action="{{route('hotels-delete', $hotel)}}" method="post">
                                    <button type="submit" class="btn btn-outline-danger">
                                        Delete
                                    </button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class=class="list-group-item">No hotels yet</li>
                    @endforelse
                </ul>
            </div>
        </div>
        {{-- начало вставки: --}}
        {{-- <div class="m-2">{{ $hotels->links() }}
    </div> --}}

    @if($perPageShow != 'all')
    <div class="m-2">{{ $hotels->links() }}
    </div>
    @endif
    {{-- конец вставки --}}

</div>
</div>
</div>
@endsection
