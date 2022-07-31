@extends('layouts.app')

@section('content')
    <h1 class="mb-5">@lang('views.task_status.index.header')</h1>

    @can('create', App\Models\Label::class)
        <a href="{{ route('labels.create') }}" class="btn btn-primary">
            @lang('views.label.index.create_button')
        </a>
    @endcan

    <table class="table mt-2">
        <thead>
            <tr>
                <th>@lang('views.label.index.id')</th>
                <th>@lang('views.label.index.name')</th>
                <th>@lang('views.label.index.description')</th>
                <th>@lang('views.label.index.created_at')</th>
                @can('seeActions', App\Models\Label::class)
                    <th>@lang('views.label.index.actions')</th>
                @endcan
            </tr>
        </thead>
        @foreach($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->created_at->format('d.m.Y') }}</td>
                <td>
                    @can('delete', $label)
                        <a
                            data-confirm="@lang('views.label.index.delete_confirmation')"
                            data-method="delete"
                            class="text-danger text-decoration-none"
                            href="{{ route('labels.destroy', $label) }}"
                        >
                            @lang('views.label.index.delete')
                        </a>
                    @endcan
                    @can('update', $label)
                        <a class="text-decoration-none" href="{{ route('labels.edit', $label) }}">
                            @lang('views.label.index.edit')
                        </a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {{ $labels->links() }}
@endsection
