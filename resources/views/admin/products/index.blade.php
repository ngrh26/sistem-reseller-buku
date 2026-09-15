@extends('layouts.cyber-master')

@section('title', 'Manajemen Produk')

@section('content')
<style>
    .product-page {
        padding-bottom: 40px;
    }

    /* =========================
       PAGE HEADER
    ========================== */
    .product-page-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #1A2B5C 0%, #2E5B9C 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
    }

    .product-page-header::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
        right: -50px;
        top: -70px;
    }

    .product-page-header h2 {
        position: relative;
        z-index: 1;
        font-weight: 700;
        font-size: 1.45rem;
        margin-bottom: 5px;
    }

    .product-page-header p {
        position: relative;
        z-index: 1;
        font-size: .9rem;
        opacity: .85;
        margin-bottom: 0;
    }

    .product-page-header .header-action {
        position: relative;
        z-index: 2;
    }

    .btn-header {
        background: #fff;
        color: #1A2B5C;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: .85rem;
        font-weight: 600;
        transition: .2s ease;
    }

    .btn-header:hover {
        background: #f4f7fb;
        color: #1A2B5C;
        transform: translateY(-1px);
    }

    /* =========================
       ALERT
    ========================== */
    .product-alert {
        border-radius: 12px;
        border: 1px solid transparent;
        font-size: .85rem;
    }

    /* =========================
       CARD
    ========================== */
    .product-card {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
    }

    /* =========================
       FILTER
    ========================== */
    .product-filter {
        padding: 20px;
        margin-bottom: 24px;
    }

    .product-filter label {
        font-size: .8rem;
        font-weight: 600;
        color: #344054;
        margin-bottom: 7px;
    }

    .product-filter .form-control {
        border: 1px solid #dce3ed;
        border-radius: 9px;
        font-size: .85rem;
        padding: 10px 12px;
        min-height: 42px;
    }

    .product-filter .input-group-text {
        background: #fff;
        border: 1px solid #dce3ed;
        border-right: none;
        border-radius: 9px 0 0 9px;
        color: #687587;
    }

    .product-filter .input-group .form-control {
        border-left: none;
        border-radius: 0 9px 9px 0;
    }

    .product-filter .form-control:focus {
        border-color: #2E5B9C;
        box-shadow: 0 0 0 3px rgba(46, 91, 156, .08);
    }

    .product-filter .input-group:focus-within .input-group-text {
        border-color: #2E5B9C;
    }

    .btn-search {
        background: #1A2B5C;
        border: 1px solid #1A2B5C;
        color: #fff;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: .85rem;
        font-weight: 600;
        min-height: 42px;
    }

    .btn-search:hover {
        background: #142149;
        border-color: #142149;
        color: #fff;
    }

    /* =========================
       TABLE HEADER
    ========================== */
    .product-table-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e9edf5;
    }

    .product-table-title {
        color: #1A2B5C;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0;
    }

    .product-count {
        display: inline-flex;
        align-items: center;
        background: #edf3fb;
        color: #2E5B9C;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: .72rem;
        font-weight: 700;
        margin-left: 7px;
    }

    /* =========================
       TABLE
    ========================== */
    .product-table-wrapper {
        overflow-x: auto;
    }

    .product-table {
        width: 100%;
        min-width: 950px;
        margin-bottom: 0;
    }

    .product-table thead th {
        background: #f8faff;
        color: #687587;
        padding: 13px 16px;
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        border-bottom: 1px solid #e9edf5;
        white-space: nowrap;
    }

    .product-table tbody td {
        padding: 15px 16px;
        color: #475467;
        font-size: .82rem;
        border-bottom: 1px solid #edf0f5;
        vertical-align: middle;
    }

    .product-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-table tbody tr:hover {
        background: #fafcff;
    }

    .product-table .product-cell {
        padding-left: 22px;
    }

    .product-table .action-cell {
        padding-right: 22px;
    }

    /* =========================
       PRODUCT COVER
    ========================== */
    .product-cover {
        width: 55px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e9edf5;
        background: #f8faff;
    }

    .product-cover-empty {
        width: 55px;
        height: 70px;
        border-radius: 8px;
        background: #f1f4f8;
        color: #98a2b3;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .product-name {
        color: #344054;
        font-weight: 700;
        font-size: .83rem;
        line-height: 1.35;
    }

    .product-id {
        color: #98a2b3;
        font-size: .72rem;
        margin-top: 3px;
    }

    /* =========================
       BADGES
    ========================== */
    .product-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: .68rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-category {
        background: #edf3fb;
        color: #2E5B9C;
    }

    .badge-stock-good {
        background: #e8f7ee;
        color: #18794e;
    }

    .badge-stock-low {
        background: #fff4d6;
        color: #8a6800;
    }

    .badge-stock-empty {
        background: #fdeaea;
        color: #b42318;
    }

    /* =========================
       PRICE
    ========================== */
    .product-price {
        color: #1A2B5C;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================
       ACTION BUTTON
    ========================== */
    .btn-product-edit {
        background: #edf3fb;
        border: 1px solid #d7e4f5;
        color: #2E5B9C;
        border-radius: 8px;
        padding: 7px 11px;
        font-size: .72rem;
        font-weight: 600;
    }

    .btn-product-edit:hover {
        background: #e2ecf8;
        color: #1A2B5C;
        border-color: #c9d9ed;
    }

    .btn-product-delete {
        background: #fdeaea;
        border: 1px solid #f5cccc;
        color: #b42318;
        border-radius: 8px;
        padding: 7px 11px;
        font-size: .72rem;
        font-weight: 600;
    }

    .btn-product-delete:hover {
        background: #f9dcdc;
        color: #991b1b;
        border-color: #efb8b8;
    }

    /* =========================
       EMPTY STATE
    ========================== */
    .product-empty {
        text-align: center;
        padding: 65px 20px;
    }

    .product-empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #edf3fb;
        color: #2E5B9C;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }

    .product-empty-icon i {
        font-size: 1.8rem;
    }

    .product-empty h5 {
        color: #344054;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .product-empty p {
        color: #8a94a3;
        font-size: .82rem;
        margin-bottom: 22px;
    }

    .btn-empty {
        background: #1A2B5C;
        border: 1px solid #1A2B5C;
        color: #fff;
        border-radius: 9px;
        padding: 10px 18px;
        font-size: .82rem;
        font-weight: 600;
    }

    .btn-empty:hover {
        background: #142149;
        border-color: #142149;
        color: #fff;
    }

    /* =========================
       PAGINATION
    ========================== */
    .product-pagination {
        padding: 18px 22px;
        border-top: 1px solid #e9edf5;
    }

    .product-pagination nav {
        margin: 0;
    }

    /*
     * Pagination Laravel sebelumnya menggunakan
     * style bawaan yang membuat tombol Previous/Next
     * terlalu besar.
     *
     * Style berikut dibuat khusus untuk halaman Produk
     * agar ukuran tombol mengikuti desain halaman ini.
     */
    .product-pagination nav a,
    .product-pagination nav span {
        font-size: .72rem !important;
        font-weight: 600 !important;
        line-height: 1.2 !important;
    }

    .product-pagination nav a {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-height: 32px !important;
        padding: 7px 11px !important;
        margin: 0 2px !important;
        border: 1px solid #e1e6ee !important;
        border-radius: 7px !important;
        background: #fff !important;
        color: #526071 !important;
        text-decoration: none !important;
        box-shadow: none !important;
        transition: .2s ease !important;
    }

    .product-pagination nav a:hover {
        background: #edf3fb !important;
        border-color: #d7e3f3 !important;
        color: #2E5B9C !important;
    }

    .product-pagination nav span {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-height: 32px !important;
        padding: 7px 11px !important;
        margin: 0 2px !important;
        border: 1px solid #e1e6ee !important;
        border-radius: 7px !important;
        background: #f8faff !important;
        color: #98a2b3 !important;
        box-shadow: none !important;
    }

    /*
     * Jika pagination menggunakan .page-link Bootstrap,
     * tetap dipaksa menggunakan ukuran yang sama.
     */
    .product-pagination .pagination {
        margin-bottom: 0 !important;
        gap: 0 !important;
    }

    .product-pagination .page-item {
        margin: 0 !important;
    }

    .product-pagination .page-link {
        min-height: 32px !important;
        padding: 7px 11px !important;
        margin: 0 2px !important;
        border: 1px solid #e1e6ee !important;
        border-radius: 7px !important;
        color: #526071 !important;
        background: #fff !important;
        font-size: .72rem !important;
        font-weight: 600 !important;
        line-height: 1.2 !important;
        box-shadow: none !important;
    }

    .product-pagination .page-link:hover {
        background: #edf3fb !important;
        border-color: #d7e3f3 !important;
        color: #2E5B9C !important;
    }

    .product-pagination .page-item.active .page-link {
        background: #1A2B5C !important;
        border-color: #1A2B5C !important;
        color: #fff !important;
    }

    .product-pagination .page-item.disabled .page-link {
        background: #f8faff !important;
        border-color: #e1e6ee !important;
        color: #98a2b3 !important;
    }

    /* =========================
       RESPONSIVE
    ========================== */
    @media (max-width: 767.98px) {
        .product-page-header {
            padding: 22px 20px;
            border-radius: 16px;
        }

        .product-page-header h2 {
            font-size: 1.25rem;
        }

        .product-page-header p {
            font-size: .82rem;
        }

        .product-filter {
            padding: 16px;
        }

        .product-table-header {
            padding: 16px;
        }

        .product-table .product-cell {
            padding-left: 16px;
        }

        .product-table .action-cell {
            padding-right: 16px;
        }

        .product-pagination {
            padding: 16px;
            overflow-x: auto;
        }

        .product-pagination nav a,
        .product-pagination nav span,
        .product-pagination .page-link {
            min-height: 31px !important;
            padding: 6px 9px !important;
            font-size: .7rem !important;
        }
    }
</style>

<div class="container-fluid product-page">

    {{-- =========================
         PAGE HEADER
    ========================== --}}
    <div class="product-page-header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>
                <h2>
                    <i class="bi bi-book me-2"></i>
                    Manajemen Produk
                </h2>

                <p>
                    Kelola katalog buku dan stok produk reseller.
                </p>
            </div>

            <div class="header-action">
                <a href="{{ route('admin.products.create') }}"
                   class="btn btn-header">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Produk
                </a>
            </div>

        </div>
    </div>

    {{-- =========================
         ALERT SUCCESS
    ========================== --}}
    @if(session('success'))
        <div class="alert alert-success product-alert alert-dismissible fade show shadow-sm mb-4"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>
    @endif

    {{-- =========================
         ALERT ERROR
    ========================== --}}
    @if($errors->any())
        <div class="alert alert-danger product-alert alert-dismissible fade show shadow-sm mb-4"
             role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ $errors->first() }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>
    @endif

    {{-- =========================
         SEARCH
    ========================== --}}
    <div class="product-card product-filter">

        <form method="GET"
              action="{{ route('admin.products.index') }}">

            <div class="row g-3 align-items-end">

                <div class="col-md-10">

                    <label for="search">
                        Cari Produk
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text"
                               id="search"
                               name="search"
                               class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Cari berdasarkan judul atau penulis...">

                    </div>

                </div>

                <div class="col-md-2">

                    <button type="submit"
                            class="btn btn-search w-100">

                        <i class="bi bi-search me-1"></i>
                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

    {{-- =========================
         PRODUCT TABLE
    ========================== --}}
    <div class="product-card">

        <div class="product-table-header">

            <div class="d-flex justify-content-between align-items-center gap-3">

                <div class="d-flex align-items-center flex-wrap">

                    <h5 class="product-table-title">
                        Daftar Produk
                    </h5>

                    <span class="product-count">
                        {{ $products->total() }} produk
                    </span>

                </div>

                <div class="text-muted">
                    <i class="bi bi-box-seam fs-4"></i>
                </div>

            </div>

        </div>

        @if($products->count())

            <div class="product-table-wrapper">

                <table class="table product-table align-middle">

                    <thead>

                        <tr>

                            <th class="product-cell">
                                Produk
                            </th>

                            <th>
                                Penulis
                            </th>

                            <th>
                                Kategori
                            </th>

                            <th>
                                Harga
                            </th>

                            <th>
                                Stok
                            </th>

                            <th class="text-end action-cell">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($products as $product)

                            <tr>

                                {{-- Produk --}}
                                <td class="product-cell">

                                    <div class="d-flex align-items-center gap-3">

                                        @if($product->cover_image)

                                            <img src="{{ $product->cover_url }}"
                                                 alt="{{ $product->title }}"
                                                 class="product-cover">

                                        @else

                                            <div class="product-cover-empty">
                                                <i class="bi bi-book fs-4"></i>
                                            </div>

                                        @endif

                                        <div>

                                            <div class="product-name">
                                                {{ $product->title }}
                                            </div>

                                            <div class="product-id">
                                                ID Produk #{{ $product->id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>

                                {{-- Penulis --}}
                                <td>
                                    {{ $product->author }}
                                </td>

                                {{-- Kategori --}}
                                <td>

                                    @if($product->category)

                                        <span class="product-badge badge-category">
                                            {{ $product->category }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>

                                {{-- Harga --}}
                                <td>

                                    <span class="product-price">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>

                                </td>

                                {{-- Stok --}}
                                <td>

                                    @if($product->stock > 10)

                                        <span class="product-badge badge-stock-good">
                                            {{ $product->stock }} tersedia
                                        </span>

                                    @elseif($product->stock > 0)

                                        <span class="product-badge badge-stock-low">
                                            {{ $product->stock }} tersedia
                                        </span>

                                    @else

                                        <span class="product-badge badge-stock-empty">
                                            Stok Habis
                                        </span>

                                    @endif

                                </td>

                                {{-- Aksi --}}
                                <td class="text-end action-cell">

                                    <div class="d-inline-flex gap-2">

                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="btn btn-product-edit"
                                           title="Edit Produk">

                                            <i class="bi bi-pencil"></i>

                                        </a>

                                        <form method="POST"
                                              action="{{ route('admin.products.destroy', $product) }}"
                                              class="d-inline delete-product-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-product-delete"
                                                    title="Hapus Produk">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="product-pagination">
                {{ $products->links() }}
            </div>

        @else

            {{-- Empty State --}}
            <div class="product-empty">

                <div class="product-empty-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <h5>
                    Belum Ada Produk
                </h5>

                <p>
                    Belum ada produk yang tersedia atau sesuai dengan pencarian.
                </p>

                <a href="{{ route('admin.products.create') }}"
                   class="btn btn-empty">

                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Produk

                </a>

            </div>

        @endif

    </div>

</div>

<script>
document.querySelectorAll('.delete-product-form').forEach(function (form) {

    form.addEventListener('submit', function (event) {

        event.preventDefault();

        Swal.fire({
            title: 'Hapus produk?',
            text: 'Produk yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then(function (result) {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});
</script>
@endsection