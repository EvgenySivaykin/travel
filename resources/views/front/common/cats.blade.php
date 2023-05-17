@inject('cats', 'App\Services\CatsService')
{{-- CATS**
{{$cats->test()}} --}}

{{--
@extends('layouts.app')

@section('content') --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>All countries</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($cats->get() as $country)
                        <li class="list-group-item">
                            <div class="list-table cats">
                                <div class="list-table__content">
                                    <a href="{{route('show-cats-hotels', $country)}}">
                                        <h3>{{$country->title}}</h3>

                                        {{-- <h3>{{$country->country_title}}</h3> --}}
                                        {{-- <h4>Season start: {{$country->country_start}}</h4>
                                        <h4>Season end: {{$country->country_end}}</h4> --}}
                                        <div class="mb-3">
                                            <h4>Season start:<br>{{$country->start}}</h4>
                                            <h4>Season end:<br>{{$country->end}}</h4>
                                        </div>
                                        <div class="count">[{{$country->countryHotels()->count()}}]</div>
                                    </a>
                                </div>


                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No countries yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
