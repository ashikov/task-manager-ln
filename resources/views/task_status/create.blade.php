@extends('layouts.app')

@section('content')
<div class="grid col-span-full">
    <h1 class="mb-5">@lang('views.task_status.create.form_header')</h1>

    {{ Form::open(['route' => 'task_statuses.store', 'method' => 'POST', 'class' => 'w-50']) }}
    <div class="flex flex-col">
        <div>
            {{ Form::label('name', __('views.task_status.create.labels.name')) }}
        </div>
        <x-forms.input-name/>
        <div class="mt-2">
            {{ Form::submit(__('views.task_status.create.buttons.create'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded']) }}
        </div>
    </div>
    {{ Form::close() }}
</div>
@endsection
