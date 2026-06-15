@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Profile</h4>
</div>
@endsection

@section('content')
<div class="row">                                                                       
    <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informasi Profil</h4>
            </div>

            <div class="card-body">

            <form action="{{ route('profile.photo') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="text-center mb-4">

                        <img src="{{ auth()->user()->photo
                            ? asset('storage/' . auth()->user()->photo)
                            : asset('assets/img/scm-logo.png') }}"
                            alt="Profile"
                            class="rounded-circle border"
                            width="120"
                            height="120"
                            style="object-fit: cover;">

                        <br><br>

                        <input type="file"
                            id="photo"
                            name="photo"
                            accept="image/*"
                            style="display:none;"
                            onchange="this.form.submit()">

                        <label for="photo"
                            class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-camera me-1"></i>
                            Ubah
                        </label>

                    </div>

                </form>

                <div class="mb-4">
                    <label class="form-label fw-bold">Nama</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light">
                        {{ auth()->user()->name }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Email</label>
                    <p class="form-control-plaintext border rounded p-2 bg-light">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Role</label>
                    <input type="text"
                        class="form-control"
                        value="{{ auth()->user()->role }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <input type="text"
                        class="form-control"
                        value="Active"
                        readonly>
                </div>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">
                        <i class="fas fa-user-edit me-1"></i>
                        Edit Profile
                    </button>

                    <button type="button" class="btn btn-outline-secondary"
                        data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal">
                        <i class="fas fa-key me-1"></i>
                        Change Password
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ auth()->user()->name }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ auth()->user()->email }}"
                               required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-secondary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Password Lama</label>
                        <input type="password"
                               name="current_password"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-secondary">
                        Update Password
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection