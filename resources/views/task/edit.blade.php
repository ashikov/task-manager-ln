@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.task.edit.form_header')</h1>
    {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PATCH', 'class' => 'w-50']) }}

        {{ Form::label('name', __('views.task.edit.labels.name')) }}
        {{ Form::text('name', null, ['class' => 'form-control form-control-lg']) }}
        @error('name')
            <div class="alert alert-danger mt-3 mb-0">{{ $message }}</div>
        @enderror

        {{ Form::label('description', __('views.task.edit.labels.description')) }}
        {{ Form::text('description', null, ['class' => 'form-control form-control-lg', 'cols' => 50, 'rows' => 10]) }}

        {{ Form::label('status_id', __('views.task.edit.labels.status_id')) }}
        {{ Form::select('status_id', $taskStatuses->pluck('name', 'id'), null, ['class' => 'form-control',  'placeholder' => '----------'] )}}
        @error('status_id')
            <div class="alert alert-danger mt-3 mb-0">{{ $message }}</div>
        @enderror

        {{ Form::label('assigned_to_id', __('views.task.edit.labels.assigned_to_id')) }}
        {{ Form::select('assigned_to_id', $users->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '----------'] )}}

        {{Form::label('labels', __('views.task.create.labels.assigned_to_id'))}}
        {{Form::select('labels', $labels->pluck('name', 'id'), null, ['placeholder' => '', 'multiple' => 'multiple', 'name' => 'labels[]', 'class' => 'form-control'])}}


        {{ Form::submit(__('views.task.edit.buttons.update'), ['class' => 'btn btn-primary mt-3']) }}
    {{ Form::close() }}
@endsection
