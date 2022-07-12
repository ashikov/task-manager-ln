@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.task_status.index.header')</h1>
    <table class="table mt-2">
        <thead>
            <tr>
                <th>@lang('views.task_status.index.id')</th>
                <th>@lang('views.task_status.index.name')</th>
                <th>@lang('views.task_status.index.created_at')</th>
            </tr>
        </thead>
        @foreach($taskStatuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at->format('d.m.Y') }}</td>
            </tr>
        @endforeach
    </table>
    {{ $taskStatuses->links() }}
@endsection
