@extends('admin.layouts.admin')

@section('title', 'Add New Project')
@section('page_title', 'Create Project')

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-7 mx-auto">
        <div class="custom-table-container">
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-plus text-red me-2"></i> Add New Project</h3>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-dark-custom btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger bg-danger-subtle border-danger-subtle text-danger alert-dismissible fade show rounded-3 p-3 mb-4" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title">Project Title</label>
                    <input type="text" name="title" id="title" class="form-control form-control-custom" placeholder="e.g. Inspire FM, Granny Annexe..." value="{{ old('title') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-select form-select-custom" required>
                            <option value="" disabled selected>Select Category</option>
                            <option value="website" {{ old('category') == 'website' ? 'selected' : '' }}>Website</option>
                            <option value="ecommerce" {{ old('category') == 'ecommerce' ? 'selected' : '' }}>E-Commerce</option>
                            <option value="webapp" {{ old('category') == 'webapp' ? 'selected' : '' }}>Web App</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="project_url">Project URL (Optional)</label>
                        <input type="text" name="project_url" id="project_url" class="form-control form-control-custom" placeholder="e.g. https://example.com" value="{{ old('project_url') }}">
                    </div>
                </div>

                <div class="row mb-4">
                    <!-- Desktop Image -->
                    <div class="col-md-4 mb-3">
                        <label for="image_desktop" class="fw-semibold">Desktop Image (Required)</label>
                        <input type="file" name="image_desktop" id="image_desktop" class="form-control form-control-custom" accept="image/*" required onchange="previewDeviceImage(event, 'desktop')">
                        <small class="text-muted d-block mt-2">Format: PNG, JPG, WEBP. Max: 5MB.</small>
                        <div class="mt-3 d-none" id="previewContainer_desktop">
                            <div class="rounded overflow-hidden border border-secondary" style="width: 100%; height: 120px;">
                                <img id="imagePreview_desktop" src="#" alt="Desktop Preview" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Tablet Image -->
                    <div class="col-md-4 mb-3">
                        <label for="image_tablet" class="fw-semibold">Tablet Image (Optional)</label>
                        <input type="file" name="image_tablet" id="image_tablet" class="form-control form-control-custom" accept="image/*" onchange="previewDeviceImage(event, 'tablet')">
                        <small class="text-muted d-block mt-2">Format: PNG, JPG, WEBP. Max: 5MB.</small>
                        <div class="mt-3 d-none" id="previewContainer_tablet">
                            <div class="rounded overflow-hidden border border-secondary" style="width: 100%; height: 120px;">
                                <img id="imagePreview_tablet" src="#" alt="Tablet Preview" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Image -->
                    <div class="col-md-4 mb-3">
                        <label for="image_mobile" class="fw-semibold">Mobile Image (Optional)</label>
                        <input type="file" name="image_mobile" id="image_mobile" class="form-control form-control-custom" accept="image/*" onchange="previewDeviceImage(event, 'mobile')">
                        <small class="text-muted d-block mt-2">Format: PNG, JPG, WEBP. Max: 5MB.</small>
                        <div class="mt-3 d-none" id="previewContainer_mobile">
                            <div class="rounded overflow-hidden border border-secondary" style="width: 100%; height: 120px;">
                                <img id="imagePreview_mobile" src="#" alt="Mobile Preview" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-red py-2 fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Save Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function previewDeviceImage(event, device) {
        const input = event.target;
        const container = document.getElementById('previewContainer_' + device);
        const preview = document.getElementById('imagePreview_' + device);
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('d-none');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            container.classList.add('d-none');
        }
    }
</script>
@endsection
