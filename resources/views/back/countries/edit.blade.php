@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edit country</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('countries-update', $country)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Country title</label>
                            <input type="text" class="form-control" name="country_title" value="{{$country->title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season start</label>
                            <input type="date" class="form-control" name="country_start" value="{{$country->start}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Season end</label>
                            <input type="date" class="form-control" name="country_end" value="{{$country->end}}">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary mt-4">Save</button>
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
