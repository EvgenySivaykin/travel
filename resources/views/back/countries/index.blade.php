@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>All countries</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($countries as $country)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <h3>{{$country->title}}</h3>
                                    <div>
                                        <h4>Season start: {{$country->start}}</h4>
                                        <h4>Season end: {{$country->end}}</h4>
                                    </div>
                                </div>

                                <div class="list-table__buttons">
                                    <a href="{{ route('countries-edit', $country) }}" class="btn btn-outline-success">Edit</a>
                                    {{-- <button type="submit" class="btn btn-outline-success">Edit</button> --}}
                                    {{-- <button type="submit" class="btn btn-outline-danger">Delete</button> --}}
                                    <form action="{{route('countries-delete', $country)}}" method="post">
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
                        <li class="list-group-item">No countries yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
