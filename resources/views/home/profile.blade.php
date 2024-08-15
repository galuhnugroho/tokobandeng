@extends('layout.home')

@section('title', 'Profile')
    
@section('content')
<div class="container my-5">
    <h1 class="mb-4">Profile</h1>
    <form>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="confirm-password" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection