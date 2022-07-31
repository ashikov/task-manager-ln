@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.task.index.header')</h1>

    <div>
        {{ Form::open(['route' => 'tasks.index', 'method' => 'get']) }}
        <div class="row g-1">
            <div class="col">
                {{ Form::select('filter[status_id]', $taskStatusesForFilterForm, Arr::get($filterQueryString, 'status_id', ''), ['class' => 'form-select me-2', 'placeholder' => __('views.task.index.placeholders.filter.status_id')]) }}
            </div>
            <div class="col">
                {{ Form::select('filter[created_by_id]', $usersForFilterForm, Arr::get($filterQueryString, 'created_by_id', ''), ['class' => 'form-select me-2', 'placeholder' => __('views.task.index.placeholders.filter.created_by_id')]) }}
            </div>
            <div class="col">
                {{ Form::select('filter[assigned_to_id]', $usersForFilterForm, Arr::get($filterQueryString, 'assigned_to_id', ''), ['class' => 'form-select me-2', 'placeholder' => __('views.task.index.placeholders.filter.assigned_to_id')]) }}
            </div>
            <div class="col">
                {{ Form::submit(__('views.task.index.submits.filter'), ['class' => 'btn btn-outline-primary me-2']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>

    @can('create', App\Models\Task::class)
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            @lang('views.task.index.create_button')
        </a>
    @endcan

    <table class="table mt-2">
        <thead>
            <tr>
                <th>@lang('views.task.index.id')</th>
                <th>@lang('views.task.index.status')</th>
                <th>@lang('views.task.index.name')</th>
                <th>@lang('views.task.index.creator')</th>
                <th>@lang('views.task.index.assigned_to')</th>
                <th>@lang('views.task.index.created_at')</th>
                @can('seeActions', App\Models\Task::class)
                    <th>@lang('views.task_status.index.actions')</th>
                @endcan
            </tr>
        </thead>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->status->name }}</td>
                <td>
                    <a class="text-decoration-none" href="{{ route('tasks.show', $task) }}">
                        {{ $task->name }}
                    </a>
                </td>
                <td>{{ $task->createdBy->name }}</td>
                <td>{{ $task->assignedTo->name ?? '' }}</td>
                <td>{{ $task->created_at->format('d.m.Y') }}</td>
                <td>
                    @can('delete', $task)
                        <a
                            data-confirm="@lang('views.task.index.delete_confirmation')"
                            data-method="delete"
                            class="text-danger text-decoration-none"
                            href="{{ route('tasks.destroy', $task) }}"
                        >
                            @lang('views.task.index.delete')
                        </a>
                    @endcan
                    @can('update', $task)
                        <a class="text-decoration-none" href="{{ route('tasks.edit', $task) }}">
                            @lang('views.task.index.edit')
                        </a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {{ $tasks->links() }}
@endsection
