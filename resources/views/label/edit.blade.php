@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.label.edit.form_header')</h1>
    {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'PATCH', 'class' => 'w-50']) }}
        {{ Form::label('name', __('views.label.create.labels.name')) }}
        {{ Form::text('name', null, ['class' => 'form-control form-control-lg']) }}
        @error('name')
            <div class="alert alert-danger mt-3 mb-0">{{ $message }}</div>
        @enderror
        {{ Form::label('description', __('views.label.create.labels.name')) }}
        {{ Form::text('description', null, ['class' => 'form-control form-control-lg']) }}
        @error('description')
            <div class="alert alert-danger mt-3 mb-0">{{ $message }}</div>
        @enderror
        {{ Form::submit(__('views.label.edit.buttons.update'), ['class' => 'btn btn-primary mt-3']) }}
    {{ Form::close() }}
@endsection
