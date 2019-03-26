<html>
    <head>
        <title>
            Daftar Siswa
        </title>
    </head>
    <body>
        <h1>SMA Suka Maju</h1>
        <h2>Daftar Siswa</h2>
        <table class="table table-sm table-responsive-sm table-hover">
            <thead>
                <tr>
                    <th>{{ __('student.table_no') }}</th>
                    <th>{{ __('student.name') }}</th>
                    <th>{{ __('student.description') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $key => $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
