<div>
    <form wire:submit.prevent = "daftar">
        @if (session()->has('error'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif

        <div class="form-group">
            <input class="form-control" type="text" id="nama" placeholder="Masukan  Lengkap" wire:model="nama">
            @error('nama')
                <span class="text-danger" style="margin-left: 12px; font-size:12px;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="username" placeholder="Masukan Username"
                wire:model="username">
            @error('username')
                <span class="text-danger" style="margin-left: 12px; font-size:12px;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="alamat" placeholder="Masukan Alamat" wire:model="alamat">
            @error('alamat')
                <span class="text-danger" style="margin-left: 12px; font-size:12px;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="no_hp" placeholder="Masukan No Handphone"
                wire:model="no_hp">
            @error('no_hp')
                <span class="text-danger" style="margin-left: 12px; font-size:12px;">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="email" id="email" placeholder="Masukan Email" wire:model="email">
            @error('email')
                <span class="text-danger" style="margin-left: 12px; font-size:12px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group position-relative">
            <input class="form-control" id="psw-input" type="password" placeholder="Masukan Kata Sandi"
                wire:model="password">
            @error('password')
                <span class="text-danger" style="margin-left: 12px; font-size:12px;">{{ $message }}</span>
            @enderror
            <div class="position-absolute" id="password-visibility">
                <i class="bi bi-eye"></i>
                <i class="bi bi-eye-slash"></i>
            </div>
        </div>

        <button class="btn btn-primary w-100" type="submit">Daftar</button>
    </form>
</div>
