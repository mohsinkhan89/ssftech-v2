@extends('admin.layouts.admin')
@section('title','Edit Blog')
@section('page_title','Edit Blog')
@section('content')<div class="custom-table-container"><div class="table-title-area mb-4"><h3 class="table-title">Edit Blog</h3><a href="{{ route('admin.blogs.index') }}" class="btn btn-dark-custom btn-sm">Back</a></div><form action="{{ route('admin.blogs.update',$blog) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT') @include('admin.blogs._form')</form></div>@endsection
