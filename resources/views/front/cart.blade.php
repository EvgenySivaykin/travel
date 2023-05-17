@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            @include('front.common.cats')
        </div>
        <div class="col-9">
            <div class="card-body">
                {{-- начало большой вставки --}}

                <div class="card-body">
                    <form action="{{route('update-cart')}}" method="post">
                        <ul class="list-group">
                            @forelse($cartList as $hotel)
                            <li class="list-group-item">
                                <div class="list-table cart">
                                    <div class="list-table__content">
                                        <h3>{{$hotel->title}}</h3>

                                        <div>
                                            <div>Check-in: {{$hotel->start}}</div>
                                            <div>Check-out: {{$hotel->end}}</div>
                                        </div>

                                        <div class="size">
                                            <input type="number" min="1" name="count[]" value="{{$hotel->count}}">person(-s)
                                            <input type="hidden" name="ids[]" value="{{$hotel->id}}">
                                        </div>
                                        <div class="price"> {{$hotel->sum}}Eur</div>
                                        <div class="type"> {{$hotel->hotelCountry->title}}</div>
                                        <div class="smallimg">
                                            @if($hotel->photo)
                                            <img src="{{asset($hotel->photo)}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="list-table__buttons">
                                        <button type="submit" name="delete" value="{{$hotel->id}}" class="btn btn-outline-danger">Delete</button>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="list-group-item">Cart Empty</li>
                            @endforelse
                            <li class="list-group-item">
                                <button type="submit" class="btn btn-outline-primary">Update cart</button>
                            </li>
                        </ul>
                        @csrf
                    </form>
                    {{-- начало новой вставки: --}}
                    <ul class="list-group">
                        <li class="list-group-item">
                            <form action="{{route('make-order')}}" method="post">
                                <button type="submit" class="btn btn-outline-primary">Buy</button>
                                @csrf
                            </form>
                        </li>
                    </ul>




                    {{-- <ul class="list-group">
                    <li class="list-group-item">
                        <form action="{{route('make-order')}}" method="post">
                    <button type="submit" class="btn btn-outline-primary">Buy</button>
                    @csrf
                    </form>
                    </li>
                    </ul> --}}
                    {{-- конец новой вставки --}}
                </div>

                {{-- конец большой вставки --}}
            </div>
        </div>
    </div>
</div>
@endsection
