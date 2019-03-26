<table class="table table-sm table-responsive-sm table-hover">
    <thead>
        <tr>
            <th>{{ __('app.table_no') }}</th>
            <th>{{ __('student.name') }}</th>
            <th>{{ __('student.description') }}</th>
            <th>{{ __('app.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $key => $student)
        <tr>
            <td>{{ $students-> 1 + $key }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
