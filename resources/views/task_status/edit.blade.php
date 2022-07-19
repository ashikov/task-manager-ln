@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.task_status.create.form_header')</h1>
    {{ Form::model($taskStatus, ['route' => ['task_statuses.update', $taskStatus], 'method' => 'PATCH', 'class' => 'w-50']) }}
        {{ Form::label('name', __('views.task_status.edit.labels.name')) }}
        {{ Form::text('name', null, ['class' => 'form-control form-control-lg']) }}
        @error('name')
            <div class="alert alert-danger mt-3 mb-0">{{ $message }}</div>
        @enderror
        {{ Form::submit(__('views.buttons.create'), ['class' => 'btn btn-primary mt-3']) }}
    {{ Form::close() }}
@endsection
