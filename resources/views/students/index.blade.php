@extends('layouts.app')

@section('title', __('student.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Student)
            <a href="{{ route('students.create') }}" class="btn btn-success">{{ __('student.create') }}</a>
        @endcan
            <a href="{{ route('students.export_excel') }}" class="btn btn-primary">{{ __('student.export_excel') }}</a>
            <a href="{{ route('students.export_pdf') }}" class="btn btn-warning" target="_blank">{{ __('student.export_pdf') }}</a>
    </div>
    <h1 class="page-title">{{ __('student.list') }} <small>{{ __('app.total') }} : {{ $students->total() }} {{ __('student.student') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('student.search') }}</label>
                        <input placeholder="{{ __('student.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('student.search') }}" class="btn btn-secondary">
                    <a href="{{ route('students.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('student.name') }}</th>
                        <th>{{ __('student.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $key => $student)
                    <tr>
                        <td class="text-center">{{ $students->firstItem() + $key }}</td>
                        <td>{!! $student->name_link !!}</td>
                        <td>{{ $student->description }}</td>
                        <td class="text-center">
                            @can('view', $student)
                                <a href="{{ route('students.show', $student) }}" id="show-student-{{ $student->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $students->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
