<div>
    @if (session()->has('deletesuccess'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('deletesuccess') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">User</h4>

        <div style="float: right;">
            <div class="row">
                <div class="col-md-6"><button class="d-inline-block float-end btn btn-info mb-3 " data-bs-toggle="modal"
                        data-bs-target="#modalUser" wire:click.prevent="tambah()">Tambah</button></div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-4 col-sm-12"><input wire:model.live="search" type="text" class="form-control mb-3"
                placeholder="Cari Pengguna"></div>
    </div>

    <div class="modal" id="modalUser" tabindex="-1" aria-labelledby="modalUserLabel1" aria-hidden="true"
        style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalUserLabel1">
                        {{ $selectedId ? 'Ubah Data Pengguna' : 'Tambah Data Pengguna' }}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>

                </div>
                <div class="modal-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form>


                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="Masukan username" id="username"
                                wire:model="username">
                            @error('username')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Masukan email" id="email"
                                wire:model="email">
                            @error('email')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-select" id="level" wire:model="level">
                                <option value="">Pilih level</option>
                                <option value="admin" {{ $level == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="saksi" {{ $level == 'saksi' ? 'selected' : '' }}>Saksi</option>
                            </select>
                            @error('level')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Masukan password" id="password"
                                wire:model="password">
                            @error('password')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" placeholder="Konfirmasi password"
                                id="confirm_password" wire:model="confirm_password">
                            @error('confirm_password')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"
                        wire:click.prevent="{{ $selectedId ? 'update' : 'save' }}">{{ $selectedId ? 'Ubah' : 'Tambah' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel1" aria-hidden="true"
        style="display: {{ $isOpenDelete ? 'block' : 'none' }};">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteUserLabel1">
                        Hapus Data Pengguna
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>

                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data <strong>{{ @$username }}</strong> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" wire:click="delete('{{ $selectedId }}')"
                        data-bs-dismiss="modal">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="tblDokter" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $key => $usr)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $usr->username }}</td>
                        <td>{{ $usr->email }}</td>
                        <td>{{ $usr->level }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUser"
                                wire:click.prevent="edit('{{ $usr->id }}')"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUser"
                                wire:click.prevent="deleteshow('{{ $usr->id }}')"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $user->links() }}
    </div>
</div>
