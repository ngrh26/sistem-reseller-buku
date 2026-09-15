@extends('layouts.cyber-master')

@section('title', 'Tambah Produk')

@section('content')
<style>
    .product-form-page {
        padding-bottom: 40px;
    }

    /* =========================
       PAGE HEADER
    ========================== */
    .product-form-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #1A2B5C 0%, #2E5B9C 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
    }

    .product-form-header::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .07);
        right: -50px;
        top: -70px;
    }

    .product-form-header h2,
    .product-form-header p,
    .product-form-header .breadcrumb-area,
    .product-form-header .header-action {
        position: relative;
        z-index: 2;
    }

    .product-form-header h2 {
        font-weight: 700;
        font-size: 1.45rem;
        margin-bottom: 5px;
    }

    .product-form-header p {
        font-size: .9rem;
        opacity: .85;
        margin-bottom: 0;
    }

    .product-breadcrumb {
        font-size: .78rem;
        margin-bottom: 8px;
    }

    .product-breadcrumb a {
        color: rgba(255,255,255,.75);
        text-decoration: none;
    }

    .product-breadcrumb a:hover {
        color: #fff;
    }

    .product-breadcrumb span {
        color: rgba(255,255,255,.55);
    }

    .btn-form-header {
        background: rgba(255,255,255,.95);
        color: #1A2B5C;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: .85rem;
        font-weight: 600;
    }

    .btn-form-header:hover {
        background: #fff;
        color: #1A2B5C;
    }

    /* =========================
       ALERT
    ========================== */
    .product-form-alert {
        border-radius: 12px;
        border: 1px solid transparent;
        font-size: .82rem;
    }

    /* =========================
       CARD
    ========================== */
    .product-form-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26,43,92,.05);
        overflow: hidden;
    }

    .product-form-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #e9edf5;
    }

    .product-form-card-header h5 {
        color: #1A2B5C;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .product-form-card-header p {
        color: #8a94a3;
        font-size: .8rem;
        margin-bottom: 0;
    }

    .product-form-card-body {
        padding: 22px;
    }

    /* =========================
       FORM
    ========================== */
    .product-form-label {
        font-size: .8rem;
        font-weight: 600;
        color: #344054;
        margin-bottom: 7px;
    }

    .product-form-label .required {
        color: #b42318;
    }

    .product-form-control {
        border: 1px solid #dce3ed;
        border-radius: 9px;
        font-size: .85rem;
        padding: 10px 12px;
        color: #344054;
    }

    .product-form-control:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46,91,156,.08);
    }

    textarea.product-form-control {
        resize: vertical;
    }

    .product-input-group .input-group-text {
        background: #f8faff;
        border-color: #dce3ed;
        color: #526071;
        font-size: .82rem;
        font-weight: 600;
    }

    .product-input-group .form-control {
        border-color: #dce3ed;
        font-size: .85rem;
    }

    .product-input-group .form-control:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46,91,156,.08);
    }

    .invalid-feedback,
    .product-error {
        font-size: .75rem;
    }

    /* =========================
       COVER
    ========================== */
    .product-cover-preview {
        height: 320px;
        background: #f8faff;
        border: 1px solid #e9edf5;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .product-cover-preview img {
        max-height: 100%;
        width: 100%;
        object-fit: contain;
    }

    .product-empty-preview {
        text-align: center;
        color: #98a2b3;
        padding: 20px;
    }

    .product-empty-preview i {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 12px;
        color: #b0bac8;
    }

    .product-empty-preview .title {
        color: #667085;
        font-size: .82rem;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .product-empty-preview small {
        font-size: .72rem;
    }

    .product-file {
        border: 1px solid #dce3ed;
        border-radius: 9px;
        font-size: .8rem;
        padding: 9px 10px;
    }

    .product-file:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46,91,156,.08);
    }

    .product-help {
        color: #8a94a3;
        font-size: .72rem;
        line-height: 1.5;
    }

    /* =========================
       INFO CARD
    ========================== */
    .product-info-card {
        background: #f8faff;
        border: 1px solid #e3ebf7;
        border-radius: 14px;
        padding: 18px;
    }

    .product-info-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #edf3fb;
        color: #2E5B9C;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .product-info-card h6 {
        color: #344054;
        font-weight: 700;
        font-size: .82rem;
        margin-bottom: 6px;
    }

    .product-info-card p {
        color: #8a94a3;
        font-size: .75rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* =========================
       ACTION
    ========================== */
    .product-action-card {
        margin-top: 24px;
    }

    .btn-product-cancel {
        background: #f1f4f8;
        border: 1px solid #e1e6ee;
        color: #526071;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: .82rem;
        font-weight: 600;
    }

    .btn-product-cancel:hover {
        background: #e8edf3;
        color: #344054;
    }

    .btn-product-save {
        background: #1A2B5C;
        border: 1px solid #1A2B5C;
        color: #fff;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: .82rem;
        font-weight: 600;
    }

    .btn-product-save:hover {
        background: #142149;
        border-color: #142149;
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 767.98px) {
        .product-form-header {
            padding: 22px 20px;
            border-radius: 16px;
        }

        .product-form-header h2 {
            font-size: 1.25rem;
        }

        .product-form-header p {
            font-size: .82rem;
        }

        .product-form-card-header,
        .product-form-card-body {
            padding: 18px;
        }

        .product-cover-preview {
            height: 280px;
        }
    }
</style>

<div class="container-fluid product-form-page">

    {{-- =========================
         PAGE HEADER
    ========================== --}}
    <div class="product-form-header">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>

                <div class="product-breadcrumb breadcrumb-area">

                    <a href="{{ route('admin.products.index') }}">
                        Produk
                    </a>

                    <span class="mx-2">/</span>

                    <span>
                        Tambah Produk
                    </span>

                </div>

                <h2>
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Produk
                </h2>

                <p>
                    Tambahkan data buku baru ke katalog reseller.
                </p>

            </div>

            <div class="header-action">

                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-form-header">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

            </div>

        </div>

    </div>

    {{-- =========================
         VALIDATION ERRORS
    ========================== --}}
    @if ($errors->any())

        <div class="alert alert-danger product-form-alert shadow-sm mb-4"
             role="alert">

            <div class="d-flex align-items-start">

                <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i>

                <div>

                    <strong>
                        Data belum dapat disimpan.
                    </strong>

                    <ul class="mb-0 mt-2 ps-3">

                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif

    <form action="{{ route('admin.products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row g-4">

            {{-- =========================
                 FORM UTAMA
            ========================== --}}
            <div class="col-lg-8">

                <div class="product-form-card">

                    <div class="product-form-card-header">

                        <h5>
                            <i class="bi bi-book me-2"></i>
                            Informasi Buku
                        </h5>

                        <p>
                            Lengkapi informasi utama produk.
                        </p>

                    </div>

                    <div class="product-form-card-body">

                        {{-- Judul --}}
                        <div class="mb-4">

                            <label for="title"
                                   class="product-form-label">
                                Judul Buku
                                <span class="required">*</span>
                            </label>

                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}"
                                   class="form-control product-form-control @error('title') is-invalid @enderror"
                                   placeholder="Contoh: Pemrograman Laravel untuk Pemula"
                                   required>

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Penulis --}}
                        <div class="mb-4">

                            <label for="author"
                                   class="product-form-label">
                                Penulis
                                <span class="required">*</span>
                            </label>

                            <input type="text"
                                   id="author"
                                   name="author"
                                   value="{{ old('author') }}"
                                   class="form-control product-form-control @error('author') is-invalid @enderror"
                                   placeholder="Nama penulis"
                                   required>

                            @error('author')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Harga & Stok --}}
                        <div class="row g-3 mb-4">

                            <div class="col-md-6">

                                <label for="price"
                                       class="product-form-label">
                                    Harga Buku
                                    <span class="required">*</span>
                                </label>

                                <div class="input-group product-input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input type="number"
                                           id="price"
                                           name="price"
                                           value="{{ old('price') }}"
                                           class="form-control @error('price') is-invalid @enderror"
                                           placeholder="0"
                                           min="0"
                                           step="0.01"
                                           required>

                                </div>

                                @error('price')
                                    <div class="product-error text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label for="stock"
                                       class="product-form-label">
                                    Stok
                                    <span class="required">*</span>
                                </label>

                                <div class="input-group product-input-group">

                                    <input type="number"
                                           id="stock"
                                           name="stock"
                                           value="{{ old('stock') }}"
                                           class="form-control @error('stock') is-invalid @enderror"
                                           placeholder="0"
                                           min="0"
                                           required>

                                    <span class="input-group-text">
                                        Buku
                                    </span>

                                </div>

                                @error('stock')
                                    <div class="product-error text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                        {{-- Kategori --}}
                        <div class="mb-4">

                            <label for="category"
                                   class="product-form-label">
                                Kategori
                            </label>

                            <input type="text"
                                   id="category"
                                   name="category"
                                   value="{{ old('category') }}"
                                   class="form-control product-form-control @error('category') is-invalid @enderror"
                                   placeholder="Contoh: Teknologi, Bisnis, Pendidikan">

                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Deskripsi --}}
                        <div>

                            <label for="description"
                                   class="product-form-label">
                                Deskripsi
                            </label>

                            <textarea id="description"
                                      name="description"
                                      rows="7"
                                      class="form-control product-form-control @error('description') is-invalid @enderror"
                                      placeholder="Masukkan deskripsi buku...">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            {{-- =========================
                 COVER BUKU
            ========================== --}}
            <div class="col-lg-4">

                <div class="product-form-card">

                    <div class="product-form-card-header">

                        <h5>
                            <i class="bi bi-image me-2"></i>
                            Cover Buku
                        </h5>

                        <p>
                            Upload gambar cover buku.
                        </p>

                    </div>

                    <div class="product-form-card-body">

                        {{-- Preview --}}
                        <div id="imagePreviewContainer"
                             class="product-cover-preview mb-3">

                            <div id="emptyPreview"
                                 class="product-empty-preview">

                                <i class="bi bi-image"></i>

                                <div class="title">
                                    Belum ada cover
                                </div>

                                <small>
                                    Preview gambar akan muncul di sini.
                                </small>

                            </div>

                            <img id="imagePreview"
                                 src=""
                                 alt="Preview Cover"
                                 class="d-none">

                        </div>

                        <label for="cover_image"
                               class="product-form-label">
                            File Cover
                        </label>

                        <input type="file"
                               id="cover_image"
                               name="cover_image"
                               class="form-control product-file @error('cover_image') is-invalid @enderror"
                               accept="image/jpeg,image/png,image/webp">

                        @error('cover_image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="product-help mt-2">
                            Format JPG, PNG, atau WEBP.
                            Maksimal 2 MB.
                        </div>

                    </div>

                </div>

                {{-- Informasi --}}
                <div class="product-form-card mt-4">

                    <div class="product-form-card-body">

                        <div class="product-info-card">

                            <div class="d-flex align-items-start gap-3">

                                <div class="product-info-icon">
                                    <i class="bi bi-info-circle-fill"></i>
                                </div>

                                <div>

                                    <h6>
                                        Informasi Produk
                                    </h6>

                                    <p>
                                        Harga yang dimasukkan merupakan harga dasar
                                        buku. Diskon reseller akan dihitung secara
                                        otomatis berdasarkan paket reseller saat
                                        checkout.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- =========================
             ACTION
        ========================== --}}
        <div class="product-form-card product-action-card">

            <div class="product-form-card-body">

                <div class="d-flex flex-column flex-md-row justify-content-end gap-2">

                    <a href="{{ route('admin.products.index') }}"
                       class="btn btn-product-cancel">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-product-save">
                        <i class="bi bi-check-circle me-2"></i>
                        Simpan Produk
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('cover_image');
    const preview = document.getElementById('imagePreview');
    const emptyPreview = document.getElementById('emptyPreview');

    if (!input || !preview || !emptyPreview) {
        return;
    }

    input.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {

            preview.src = '';
            preview.classList.add('d-none');
            emptyPreview.classList.remove('d-none');

            return;
        }

        if (!file.type.startsWith('image/')) {

            input.value = '';

            preview.src = '';
            preview.classList.add('d-none');
            emptyPreview.classList.remove('d-none');

            Swal.fire({
                icon: 'error',
                title: 'File tidak valid',
                text: 'Silakan pilih file gambar JPG, PNG, atau WEBP.'
            });

            return;
        }

        if (file.size > 2 * 1024 * 1024) {

            input.value = '';

            preview.src = '';
            preview.classList.add('d-none');
            emptyPreview.classList.remove('d-none');

            Swal.fire({
                icon: 'warning',
                title: 'Ukuran file terlalu besar',
                text: 'Ukuran cover maksimal 2 MB.'
            });

            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            preview.src = e.target.result;

            preview.classList.remove('d-none');
            emptyPreview.classList.add('d-none');

        };

        reader.readAsDataURL(file);

    });

});
</script>
@endpush