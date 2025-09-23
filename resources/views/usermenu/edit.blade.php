<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg custom-card">
                <div class="text-gray-900">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h4 fw-semibold">Edit User: {{ $user->name }}</h2>
                    </div>

                    <form action="{{ route('usermenu.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama User</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email User</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" value="admin" readonly>
                            <input type="hidden" name="role" value="admin">
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('usermenu.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    /* Card styling */
    .custom-card {
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 1.5rem;
    }

    /* Form label styling */
    .custom-card label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: inline-block;
    }

    /* Input styling */
    .custom-card .form-control {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
    }
    .custom-card .form-control:focus {
        box-shadow: 0 0 0 3px rgba(59,130,246,0.3);
        border-color: #3b82f6;
    }

    /* Button styling */
    .custom-card .btn-primary {
        background-color: #3b82f6;
        border: none;
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
        border-radius: 0.5rem;
        transition: background-color 0.2s ease;
    }
    .custom-card .btn-primary:hover {
        background-color: #2563eb;
    }
    .custom-card .btn-secondary {
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
        border-radius: 0.5rem;
    }
</style>
