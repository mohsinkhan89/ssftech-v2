@php($editing = isset($blog))
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="row g-3">
 <div class="col-md-8"><label>Title</label><input id="blogTitle" name="title" class="form-control form-control-custom" value="{{ old('title',$blog->title ?? '') }}" required></div>
 <div class="col-md-4"><label>Slug</label><input id="blogSlug" name="slug" class="form-control form-control-custom" value="{{ old('slug',$blog->slug ?? '') }}" required></div>
 <div class="col-md-6"><label>Category</label><input name="category" class="form-control form-control-custom" value="{{ old('category',$blog->category ?? '') }}" required></div>
 <div class="col-md-6"><label>Font Awesome Icon</label><input name="icon" class="form-control form-control-custom" value="{{ old('icon',$blog->icon ?? 'fa-solid fa-newspaper') }}" required></div>
 <div class="col-12"><label>Short Excerpt</label><textarea name="excerpt" rows="3" class="form-control form-control-custom" required>{{ old('excerpt',$blog->excerpt ?? '') }}</textarea></div>
 <div class="col-12"><label>Blog Description</label><textarea id="blogDescription" name="description" rows="14" class="form-control form-control-custom">{{ old('description',$blog->description ?? '') }}</textarea><small class="text-muted">Rich text content displayed on the blog detail page.</small></div>
 <div class="col-md-6"><label>Card Image {{ $editing?'(leave empty to keep current)':'' }}</label><input type="file" name="image" class="form-control form-control-custom" accept="image/*" {{ $editing?'':'required' }}></div>
 <div class="col-md-6"><label>Hero Banner</label><input type="file" name="hero_image" class="form-control form-control-custom" accept="image/*"></div>
 <div class="col-md-6"><label>Featured Content Image</label><input type="file" name="featured_image" class="form-control form-control-custom" accept="image/*"></div>
 <div class="col-md-6"><label>“Content That” Banner</label><input type="file" name="content_banner" class="form-control form-control-custom" accept="image/*"></div>
 <div class="col-md-4"><label>Author Name</label><input name="author_name" class="form-control form-control-custom" value="{{ old('author_name',$blog->author_name ?? 'Sarah Johnson') }}" required></div>
 <div class="col-md-4"><label>Author Role</label><input name="author_role" class="form-control form-control-custom" value="{{ old('author_role',$blog->author_role ?? '') }}"></div>
 <div class="col-md-4"><label>Read Time</label><input name="read_time" class="form-control form-control-custom" value="{{ old('read_time',$blog->read_time ?? '5 min read') }}" required></div>
 <div class="col-12"><label>Author Bio</label><textarea name="author_bio" rows="2" class="form-control form-control-custom">{{ old('author_bio',$blog->author_bio ?? '') }}</textarea></div>
 <div class="col-md-8"><label>Tags (comma separated)</label><input name="tags" class="form-control form-control-custom" value="{{ old('tags',$blog->tags ?? '') }}"></div>
 <div class="col-md-3"><label>Published Date</label><input type="date" name="published_at" class="form-control form-control-custom" value="{{ old('published_at',isset($blog)?$blog->published_at?->format('Y-m-d'):now()->format('Y-m-d')) }}" required></div>
 <div class="col-md-1 d-flex align-items-end"><div class="form-check mb-2"><input type="checkbox" name="status" value="1" class="form-check-input" id="status" @checked(old('status',$blog->status ?? true))><label for="status">Active</label></div></div>
</div>
<button class="btn btn-red w-100 mt-4 py-2"><i class="fa-solid fa-floppy-disk me-2"></i>{{ $editing?'Update':'Save' }} Blog</button>
@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#blogDescription'),{toolbar:['heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','undo','redo']}).catch(console.error);
const title=document.getElementById('blogTitle'),slug=document.getElementById('blogSlug');
title?.addEventListener('input',()=>{if(!slug.dataset.touched)slug.value=title.value.toLowerCase().trim().replace(/[^a-z0-9]+/g,'-').replace(/^-|-$/g,'')});
slug?.addEventListener('input',()=>slug.dataset.touched='1');
</script>
@endsection
