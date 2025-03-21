@extends('layouts.app')
@section('content')
    <h2>Danh sách người dùng</h2>
    <a href="{{ route('nguoi_dung.create') }}">Thêm nguời dùng</a>
    
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>SÐT</th>
            <th>Thao tác</th>
        </tr>
        @foreach ($nguoi_dung as $nd)
        <tr>
            <td>{{ $nd->id }}</td>
            <td>{{ $nd->ho_ten }}</td>
            <td>{{ $nd->email }}</td>
            <td>{{ $nd->sdt }}</td>
            <td>
                <a href="{{ route('nguoi_dung.show', $nd->id) }}">Xem</a>
                <a href="{{ route('nguoi_dung.edit', $nd->id) }}">Sửa</a>
                <form action="{{ route('nguoi_dung.destroy', $nd->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
