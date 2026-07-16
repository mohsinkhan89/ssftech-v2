@extends('admin.layouts.admin')
@section('title', 'Add Social Link')
@section('page_title', 'Add Social Link')
@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="custom-table-container"><div class="table-title-area"><h3 class="table-title">Add Social Link</h3><a href="{{ route('admin.settings.index') }}" class="btn btn-dark-custom">Back</a></div><form action="{{ route('admin.social-links.store') }}" method="POST">@csrf @include('admin.social-links._form')<div class="d-grid mt-4"><button class="btn btn-red">Save Social Link</button></div></form></div></div></div>
@endsection
