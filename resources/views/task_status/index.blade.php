@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.task_status.index.header')</h1>

    @can('create', App\Models\TaskStatus::class)
        <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">
            @lang('views.task_status.index.create_button')
        </a>
    @endcan

    <table class="table mt-2">
        <thead>
            <tr>
                <th>@lang('views.task_status.index.id')</th>
                <th>@lang('views.task_status.index.name')</th>
                <th>@lang('views.task_status.index.created_at')</th>
                @can('seeActions', App\Models\TaskStatus::class)
                    <th>@lang('views.task_status.index.actions')</th>
                @endcan
            </tr>
        </thead>
        @foreach($taskStatuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at->format('d.m.Y') }}</td>
                <td>
                    @can('delete', $status)
                        <a
                            data-confirm="@lang('views.task_status.index.delete_confirmation')"
                            data-method="delete"
                            class="text-danger text-decoration-none"
                            href="{{ route('task_statuses.destroy', $status) }}"
                        >
                            @lang('views.task_status.index.delete')
                        </a>
                    @endcan
                    @can('update', $status)
                        <a class="text-decoration-none" href="{{ route('task_statuses.edit', $status) }}">
                            @lang('views.task_status.index.edit')
                        </a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {{ $taskStatuses->links() }}
@endsection
