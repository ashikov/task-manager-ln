@extends('layouts.app')

@section('content')
        <div class="p-5 mb-4 bg-light border rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">@lang('views.home.header')</h1>
                <p class="col-md-8 fs-4">@lang('views.home.description')</p>
                <a href="https://ashikov.ru" class="btn btn-primary btn-lg" target="_blank">@lang('views.home.learn_more')</a>
            </div>
        </div>
@endsection
