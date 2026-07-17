@extends('admin.layouts.admin')
@section('title', 'Manage Blogs')
@section('page_title', 'Blogs')
@section('content')
<div class="custom-table-container">
 <div class="table-title-area"><h3 class="table-title"><i class="fa-solid fa-newspaper text-red me-2"></i> Blogs</h3>@if(Auth::user()->role !== 'author')<a href="{{ route('admin.blogs.create') }}" class="btn btn-red"><i class="fa-solid fa-plus me-2"></i>Add Blog</a>@endif</div>
 @if($blogs->isEmpty())<div class="text-center py-5 text-muted">No blogs found.</div>@else
 <div class="table-responsive"><table class="table custom-table"><thead><tr><th>Image</th><th>Blog</th><th>Category</th><th>Published</th><th>Status</th>@if(Auth::user()->role !== 'author')<th class="text-end">Actions</th>@endif</tr></thead><tbody>
 @foreach($blogs as $blog)<tr><td><img src="{{ url($blog->image) }}" alt="" style="width:76px;height:50px;object-fit:cover;border-radius:8px"></td><td><strong>{{ $blog->title }}</strong><br><small class="text-muted">/{{ $blog->slug }}</small></td><td>{{ $blog->category }}</td><td>{{ $blog->date }}</td><td>@if(Auth::user()->role !== 'author')<form action="{{ route('admin.blogs.toggle-status',$blog) }}" method="POST">@csrf @method('PATCH')<button class="status-toggle-btn {{ $blog->status?'is-active':'is-inactive' }}">{{ $blog->status?'Active':'Inactive' }}</button></form>@else {{ $blog->status?'Active':'Inactive' }} @endif</td>@if(Auth::user()->role !== 'author')<td class="text-end"><a class="action-btn btn-edit" href="{{ route('admin.blogs.edit',$blog) }}"><i class="fa-solid fa-pencil"></i></a><form class="d-inline" action="{{ route('admin.blogs.destroy',$blog) }}" method="POST" onsubmit="return confirm('Delete this blog?')">@csrf @method('DELETE')<button class="action-btn btn-delete"><i class="fa-solid fa-trash-can"></i></button></form></td>@endif</tr>@endforeach
 </tbody></table></div>@endif
</div>
@endsection
