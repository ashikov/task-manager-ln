@extends('layouts.app')

@section('content')
    <h1 class="mb-5">
        @lang('views.task.show.header', ['name' => $task->name])
        <a href="{{ route('tasks.edit', $task) }}">&#9881;</a>
    </h1>
    <p>@lang('views.task.show.name'): {{ $task->name }}</p>
    <p>@lang('views.task.show.status_id'): {{ $task->status->name }}</p>
    <p>@lang('views.task.show.description'): {{ $task->description }}</p>
    @if ($task->labels()->exists())
        <p>@lang('views.task.show.labels'):</p>
        <ul>
            @foreach ($task->labels as $label)
                <li>{{ $label->name }}</li>
            @endforeach
        </ul>
    @endif

@endsection
