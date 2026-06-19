@extends('admin.layouts.admin')

@section('title', 'Add New Client')
@section('page_title', 'Create Client')

@section('content')
<div class="row">
    <div class="col-lg-8 col-xl-6 mx-auto">
        <div class="custom-table-container">
            <div class="table-title-area mb-4">
                <h3 class="table-title"><i class="fa-solid fa-plus text-red me-2"></i> Add New Client</h3>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-dark-custom btn-sm">
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

            <form action="{{ route('admin.clients.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name">Client Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-custom" placeholder="e.g. TechNova, Finvest" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label for="icon">FontAwesome Icon Class String</label>
                    <div class="input-group">
                        <input type="text" name="icon" id="icon" class="form-control form-control-custom" placeholder="e.g. fa-solid fa-bolt" value="{{ old('icon') }}" required>
                        <span class="input-group-text bg-dark text-white border-secondary" style="border-radius: 0 10px 10px 0; min-width: 60px; justify-content: center;">
                            <i id="icon-preview" class="fa-solid fa-circle-question fs-5"></i>
                        </span>
                    </div>
                    <small class="text-muted d-block mt-2">You can use any free class name from <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="text-info text-decoration-none">FontAwesome v6 Free Library</a> (e.g. <code>fa-solid fa-bolt</code>, <code>fa-brands fa-apple</code>, etc.)</small>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-red py-2 fw-semibold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Save Client
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const iconInput = document.getElementById('icon');
    const iconPreview = document.getElementById('icon-preview');

    if (iconInput && iconPreview) {
        iconInput.addEventListener('input', function() {
            const iconClass = this.value.trim();
            if (iconClass) {
                iconPreview.className = iconClass;
            } else {
                iconPreview.className = 'fa-solid fa-circle-question';
            }
        });
    }
</script>
@endsection
