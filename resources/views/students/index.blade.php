<!DOCTYPE html>
<html>

<head>
    <title>Student Data</title>
</head>

<body>
    <h2>Upload Student Excel</h2>

    @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <a href="{{ route('students.export') }}">Download Excel</a>

    <h3>Student List</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Roll</th>
            <th>Class</th>
            <th>Section</th>
            <th>Phone</th>
        </tr>
        @foreach($students as $s)
        <tr>
            <td>{{ $s->name }}</td>
            <td>{{ $s->roll }}</td>
            <td>{{ $s->class }}</td>
            <td>{{ $s->section }}</td>
            <td>{{ $s->phone }}</td>
        </tr>
        @endforeach
    </table>

    {{ $students->links() }}
</body>

</html>