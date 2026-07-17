@extends('admin.layouts.admin')
@section('title','Add Blog')
@section('page_title','Create Blog')
@section('content')<div class="custom-table-container"><div class="table-title-area mb-4"><h3 class="table-title">Add Blog</h3><a href="{{ route('admin.blogs.index') }}" class="btn btn-dark-custom btn-sm">Back</a></div><form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">@csrf @include('admin.blogs._form')</form></div>@endsection
