@extends('admin_layout')
@section('admin_content')

<h3>Xem tài liệu: {{ $document->ten_tai_lieu }}</h3>

<iframe src="{{ asset('public/' .$document->file_url) }}" width="100%" height="600px"></iframe>

@endsection