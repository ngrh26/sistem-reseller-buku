@extends('layouts.cyber-master')

@section('title', 'Pembayaran Pesanan #' . $order->id)

@push('styles')
<style>
    .payment-page {
        padding-bottom: 40px;
    }

    .page-header {
        background: linear-gradient(135deg, #1A2B5C 0%, #2E5B9C 100%);
        border-radius: 20px;
        padding: 28px 30px;
        color: #fff;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .page-header::after {
        content: '';
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        right: -55px;
        top: -75px;
    }

    .page-header-content {
        position: relative;
        z-index: 1;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,.8);
        text-decoration: none;
        font-size: .85rem;
        margin-bottom: 12px;
    }

    .back-link:hover {
        color: #fff;
    }

    .page-header h2 {
        font-weight: 700;
        font-size: 1.45rem;
        margin-bottom: 5px;
    }

    .page-header p {
        margin: 0;
        opacity: .85;
    }

    .card-custom {
        background: #fff;
        border: 1px solid #e9edf5;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(26, 43, 92, .05);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .card-header-custom {
        padding: 18px 22px;
        border-bottom: 1px solid #edf0f5;
    }

    .card-header-custom h5 {
        margin: 0;
        color: #1A2B5C;
        font-weight: 700;
        font-size: 1rem;
    }

    .card-body-custom {
        padding: 22px;
    }

    .payment-total {
        background: linear-gradient(135deg, #f5f8fd 0%, #edf3fb 100%);
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: center;
    }

    .payment-total-label {
        color: #6f7c8e;
        font-size: .82rem;
        margin-bottom: 5px;
    }

    .payment-total-value {
        color: #1A2B5C;
        font-size: 1.7rem;
        font-weight: 800;
    }

    .order-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .info-item {
        background: #f8faff;
        border-radius: 11px;
        padding: 13px;
    }

    .info-label {
        display: block;
        color: #7c8796;
        font-size: .74rem;
        margin-bottom: 4px;
    }

    .info-value {
        color: #344054;
        font-size: .88rem;
        font-weight: 600;
    }

    .upload-area {
        border: 2px dashed #cbd7e8;
        border-radius: 15px;
        padding: 35px 20px;
        text-align: center;
        background: #fafcff;
        transition: .25s ease;
        cursor: pointer;
    }

    .upload-area:hover,
    .upload-area.dragover {
        border-color: #2E5B9C;
        background: #f4f8fe;
    }

    .upload-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #eaf1fb;
        color: #2E5B9C;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 14px;
    }

    .upload-title {
        color: #273449;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .upload-description {
        color: #7c8796;
        font-size: .8rem;
        margin-bottom: 15px;
    }

    .file-input-wrapper {
        display: inline-block;
    }

    .btn-select-file {
        background: #1A2B5C;
        border-color: #1A2B5C;
        color: #fff;
        border-radius: 9px;
        padding: 9px 16px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-select-file:hover {
        background: #2E5B9C;
        border-color: #2E5B9C;
        color: #fff;
    }

    #proof_file {
        display: none;
    }

    .selected-file {
        display: none;
        align-items: center;
        gap: 10px;
        margin-top: 18px;
        padding: 12px 14px;
        background: #edf7f1;
        border: 1px solid #cce9d6;
        border-radius: 10px;
        text-align: left;
    }

    .selected-file.show {
        display: flex;
    }

    .selected-file-icon {
        color: #198754;
        font-size: 1.2rem;
    }

    .selected-file-info {
        min-width: 0;
        flex: 1;
    }

    .selected-file-name {
        color: #344054;
        font-size: .82rem;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .selected-file-size {
        color: #7c8796;
        font-size: .73rem;
    }

    .existing-proof {
        background: #fff8e8;
        border: 1px solid #f1dfad;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 18px;
    }

    .existing-proof-title {
        color: #7b5b00;
        font-weight: 700;
        font-size: .84rem;
        margin-bottom: 5px;
    }

    .existing-proof-text {
        color: #806d3c;
        font-size: .77rem;
        margin: 0;
    }

    .existing-proof-status {
        display: inline-block;
        margin-top: 8px;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: .7rem;
        font-weight: 700;
    }

    .proof-pending {
        background: #fff0c2;
        color: #8a6800;
    }

    .proof-rejected {
        background: #fde8e8;
        color: #b42318;
    }

    .btn-submit {
        background: #C9A84C;
        border-color: #C9A84C;
        color: #fff;
        border-radius: 10px;
        padding: 11px 18px;
        font-weight: 700;
        width: 100%;
    }

    .btn-submit:hover {
        background: #b8953e;
        border-color: #b8953e;
        color: #fff;
    }

    .btn-submit:disabled {
        opacity: .7;
        cursor: not-allowed;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 9px 0;
        font-size: .85rem;
        color: #687587;
    }

    .summary-row strong {
        color: #364152;
    }

    .summary-row.discount strong {
        color: #198754;
    }

    .summary-total {
        border-top: 1px solid #e5eaf1;
        margin-top: 7px;
        padding-top: 14px;
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .summary-total span {
        color: #687587;
        font-size: .82rem;
    }

    .summary-total strong {
        color: #1A2B5C;
        font-size: 1.15rem;
    }

    .instruction-list {
        margin: 0;
        padding-left: 20px;
    }

    .instruction-list li {
        color: #687587;
        font-size: .8rem;
        margin-bottom: 10px;
        line-height: 1.5;
    }

    .instruction-list li:last-child {
        margin-bottom: 0;
    }

    .security-note {
        background: #eef5ff;
        border: 1px solid #dce9fb;
        border-radius: 12px;
        padding: 13px 14px;
        color: #31577f;
        font-size: .77rem;
        line-height: 1.5;
        margin-top: 17px;
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 22px;
            border-radius: 16px;
        }

        .order-info {
            grid-template-columns: 1fr;
        }

        .card-body-custom {
            padding: 18px;
        }

        .payment-total-value {
            font-size: 1.45rem;
        }

        .upload-area {
            padding: 28px 15px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid payment-page">

    {{-- Header --}}
    <div class="page-header">
        <div class="page-header-content">

            <a
                href="{{ route('reseller.orders.show', $order) }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali ke Detail Pesanan
            </a>

            <h2>
                Pembayaran Pesanan #{{ $order->id }}
            </h2>

            <p>
                Upload bukti pembayaran untuk diproses oleh admin.
            </p>

        </div>
    </div>

    {{-- Error --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ $errors->first() }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- LEFT --}}
        <div class="col-lg-7">

            <div class="card-custom">

                <div class="card-header-custom">
                    <h5>
                        <i class="bi bi-cloud-arrow-up me-2"></i>
                        Upload Bukti Pembayaran
                    </h5>
                </div>

                <div class="card-body-custom">

                    @if($payment && $payment->status === 'pending')
                        <div class="existing-proof">

                            <div class="existing-proof-title">
                                <i class="bi bi-info-circle me-1"></i>
                                Bukti pembayaran sudah pernah diunggah
                            </div>

                            <p class="existing-proof-text">
                                Bukti pembayaran sebelumnya masih menunggu
                                verifikasi admin. Jika ingin menggantinya,
                                pilih file baru di bawah.
                            </p>

                            <span class="existing-proof-status proof-pending">
                                Menunggu Verifikasi
                            </span>

                        </div>
                    @elseif($payment && $payment->status === 'rejected')
                        <div class="existing-proof">

                            <div class="existing-proof-title">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                Bukti pembayaran ditolak
                            </div>

                            <p class="existing-proof-text">
                                Silakan unggah kembali bukti pembayaran
                                yang sesuai.
                            </p>

                            <span class="existing-proof-status proof-rejected">
                                Ditolak
                            </span>

                        </div>
                    @endif

                    <form
                        action="{{ route('reseller.payment.store', $order) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        id="payment-form"
                    >
                        @csrf

                        <div
                            class="upload-area"
                            id="upload-area"
                        >

                            <div class="upload-icon">
                                <i class="bi bi-receipt"></i>
                            </div>

                            <div class="upload-title">
                                Pilih Bukti Pembayaran
                            </div>

                            <div class="upload-description">
                                Format JPG, JPEG, PNG, WEBP atau PDF.
                                Maksimal ukuran 5 MB.
                            </div>

                            <div class="file-input-wrapper">

                                <label
                                    for="proof_file"
                                    class="btn btn-select-file"
                                >
                                    <i class="bi bi-folder2-open me-1"></i>
                                    Pilih File
                                </label>

                                <input
                                    type="file"
                                    name="proof_file"
                                    id="proof_file"
                                    accept=".jpg,.jpeg,.png,.webp,.pdf"
                                    required
                                >

                            </div>

                            <div
                                class="selected-file"
                                id="selected-file"
                            >
                                <div class="selected-file-icon">
                                    <i class="bi bi-file-earmark-check"></i>
                                </div>

                                <div class="selected-file-info">
                                    <div
                                        class="selected-file-name"
                                        id="selected-file-name"
                                    ></div>

                                    <div
                                        class="selected-file-size"
                                        id="selected-file-size"
                                    ></div>
                                </div>
                            </div>

                        </div>

                        <div class="security-note">
                            <i class="bi bi-shield-check me-1"></i>
                            Pastikan bukti pembayaran terlihat jelas,
                            terutama nominal, tanggal, dan informasi transaksi.
                        </div>

                        <div class="mt-3">

                            <button
                                type="submit"
                                class="btn btn-submit"
                                id="submit-button"
                            >
                                <i class="bi bi-send-check me-1"></i>
                                Kirim Bukti Pembayaran
                            </button>

                        </div>

                    </form>

                </div>

            </div>

            {{-- Instructions --}}
            <div class="card-custom">

                <div class="card-header-custom">
                    <h5>
                        <i class="bi bi-list-check me-2"></i>
                        Petunjuk Pembayaran
                    </h5>
                </div>

                <div class="card-body-custom">

                    <ol class="instruction-list">

                        <li>
                            Lakukan pembayaran sesuai total yang tertera
                            pada pesanan.
                        </li>

                        <li>
                            Simpan bukti transfer atau bukti pembayaran
                            Anda.
                        </li>

                        <li>
                            Pastikan bukti pembayaran dapat dibaca dengan jelas.
                        </li>

                        <li>
                            Pilih file bukti pembayaran melalui tombol
                            <strong>Pilih File</strong>.
                        </li>

                        <li>
                            Klik <strong>Kirim Bukti Pembayaran</strong>
                            untuk mengirim bukti kepada admin.
                        </li>

                        <li>
                            Tunggu proses verifikasi dari admin.
                        </li>

                    </ol>

                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="col-lg-5">

            {{-- Payment Summary --}}
            <div class="card-custom">

                <div class="card-header-custom">
                    <h5>
                        <i class="bi bi-receipt-cutoff me-2"></i>
                        Ringkasan Pembayaran
                    </h5>
                </div>

                <div class="card-body-custom">

                    <div class="payment-total">

                        <div class="payment-total-label">
                            Total yang harus dibayar
                        </div>

                        <div class="payment-total-value">
                            Rp {{ number_format($order->final_price, 0, ',', '.') }}
                        </div>

                    </div>

                    <div class="summary-row">

                        <span>
                            Nomor Pesanan
                        </span>

                        <strong>
                            #{{ $order->id }}
                        </strong>

                    </div>

                    <div class="summary-row">

                        <span>
                            Jumlah Buku
                        </span>

                        <strong>
                            {{ $order->items->sum('quantity') }} buku
                        </strong>

                    </div>

                    <div class="summary-row">

                        <span>
                            Subtotal
                        </span>

                        <strong>
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </strong>

                    </div>

                    <div class="summary-row discount">

                        <span>
                            Diskon Reseller
                        </span>

                        <strong>
                            - Rp {{ number_format($order->discount_amount, 0, ',', '.') }}
                        </strong>

                    </div>

                    <div class="summary-total">

                        <span>
                            Total Pembayaran
                        </span>

                        <strong>
                            Rp {{ number_format($order->final_price, 0, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </div>

            {{-- Order Info --}}
            <div class="card-custom">

                <div class="card-header-custom">
                    <h5>
                        <i class="bi bi-box-seam me-2"></i>
                        Informasi Pesanan
                    </h5>
                </div>

                <div class="card-body-custom">

                    <div class="order-info">

                        <div class="info-item">

                            <span class="info-label">
                                Status Pesanan
                            </span>

                            <span class="info-value">
                                {{ $order->statusLabel() }}
                            </span>

                        </div>

                        <div class="info-item">

                            <span class="info-label">
                                Tanggal Pesanan
                            </span>

                            <span class="info-value">
                                {{ $order->order_date?->format('d F Y') ?? '-' }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const fileInput = document.getElementById('proof_file');
        const uploadArea = document.getElementById('upload-area');
        const selectedFile = document.getElementById('selected-file');
        const selectedFileName = document.getElementById('selected-file-name');
        const selectedFileSize = document.getElementById('selected-file-size');
        const paymentForm = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');

        function formatFileSize(bytes) {
            if (bytes < 1024) {
                return bytes + ' B';
            }

            if (bytes < 1024 * 1024) {
                return (bytes / 1024).toFixed(1) + ' KB';
            }

            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        }

        function displaySelectedFile(file) {

            if (!file) {
                selectedFile.classList.remove('show');
                selectedFileName.textContent = '';
                selectedFileSize.textContent = '';
                return;
            }

            selectedFileName.textContent = file.name;
            selectedFileSize.textContent = formatFileSize(file.size);

            selectedFile.classList.add('show');
        }

        fileInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                displaySelectedFile(null);
                return;
            }

            if (file.size > 5 * 1024 * 1024) {

                alert('Ukuran file maksimal 5 MB.');

                this.value = '';
                displaySelectedFile(null);

                return;
            }

            displaySelectedFile(file);
        });

        uploadArea.addEventListener('dragover', function (event) {

            event.preventDefault();

            uploadArea.classList.add('dragover');

        });

        uploadArea.addEventListener('dragleave', function () {

            uploadArea.classList.remove('dragover');

        });

        uploadArea.addEventListener('drop', function (event) {

            event.preventDefault();

            uploadArea.classList.remove('dragover');

            const files = event.dataTransfer.files;

            if (!files.length) {
                return;
            }

            const file = files[0];

            if (file.size > 5 * 1024 * 1024) {

                alert('Ukuran file maksimal 5 MB.');

                return;
            }

            fileInput.files = files;

            displaySelectedFile(file);

        });

        paymentForm.addEventListener('submit', function (event) {

            if (!fileInput.files.length) {

                event.preventDefault();

                alert('Silakan pilih bukti pembayaran terlebih dahulu.');

                return;
            }

            submitButton.disabled = true;

            submitButton.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1"></span>' +
                ' Mengunggah Bukti...';

        });

    });
</script>
@endpush