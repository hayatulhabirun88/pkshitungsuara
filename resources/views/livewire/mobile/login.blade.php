<div>
    <form wire:submit.prevent = "proses_login">
        @if (session()->has('error'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
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

        <button class="btn btn-primary w-100" type="submit">Masuk</button>
    </form>
</div>
