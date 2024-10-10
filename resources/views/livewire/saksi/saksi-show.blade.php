<div>
    @if (session()->has('deletesuccess'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('deletesuccess') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">Saksi</h4>

        <div style="float: right;">
            <div class="row">
                <div class="col-md-6"><button class="d-inline-block float-end btn btn-info mb-3 " data-bs-toggle="modal"
                        data-bs-target="#modalSaksi" wire:click.prevent="tambah()">Tambah</button></div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-4 col-sm-12"><input wire:model.live="search" type="text" class="form-control mb-3"
                placeholder="Cari Saksi"></div>
    </div>

    <div class="modal" id="modalSaksi" tabindex="-1" aria-labelledby="modalSaksiLabel1" aria-hidden="true"
        style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalSaksiLabel1">
                        {{ $selectedId ? 'Ubah Data Saksi' : 'Tambah Data Saksi' }}
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
                            <label for="nama_saksi" class="form-label">Nama Saksi</label>
                            <input type="text" class="form-control" placeholder="Yuni Sarah" id="nama_saksi"
                                wire:model="nama_saksi">
                            @error('nama_saksi')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" placeholder="081311223214" id="no_hp"
                                wire:model="no_hp">
                            @error('no_hp')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" wire:model="status">
                                <option value="">--Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            @error('status')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5" wire:model="alamat"></textarea>
                            @error('alamat')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>


                        @if (!$selectedId)
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
                                <input type="email" class="form-control" placeholder="Masukan email"
                                    id="email" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Masukan password"
                                    id="password" wire:model="password">
                                @error('password')
                                    <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" placeholder="Masukan password"
                                    id="confirm_password" wire:model="confirm_password">
                                @error('confirm_password')
                                    <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div class="row">
                                <h4>Data TPS</h4>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select class="form-control" name="kecamatan" id="kecamatan"
                                            wire:model.live="kecamatan">
                                            <option value="">--Pilih Kecamatan</option>
                                            @foreach ($listKecamatan as $kec)
                                                <option value="{{ $kec->id }}"
                                                    {{ $kecamatan == $kec->id ? 'selected' : '' }}>
                                                    {{ $kec->nama_kecamatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kecamatan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                @if ($kecamatan)

                                    @php
                                        $tpskecamatan = \App\Models\Tps::where('kecamatan_id', $kecamatan)->first();
                                    @endphp
                                    @if ($tpskecamatan)
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="kelurahan">Kelurahan</label>
                                                <select class="form-control" name="kelurahan" id="kelurahan"
                                                    wire:model.live="kelurahan">
                                                    <option value="">--Pilih Kelurahan</option>
                                                    @foreach ($listKelurahan as $kel)
                                                        <option value="{{ $kel->id }}"
                                                            {{ $kelurahan == $kel->id ? 'selected' : '' }}>
                                                            {{ $kel->nama_kelurahan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kelurahan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <br>
                                            <span class="text-danger mt-3">Tps Belum di Input</span>
                                        </div>
                                    @endif


                                @endif

                                @if ($kelurahan)
                                    @php
                                        $tpskelurahan = \App\Models\Tps::where('kelurahan_id', $kelurahan)->first();
                                    @endphp
                                    @if ($tpskelurahan)

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="tps">TPS</label>
                                                <select class="form-control" name="tps" id="tps"
                                                    wire:model.live="tps">
                                                    <option value="">--Pilih TPS--</option>
                                                    @foreach ($listTps as $tp)
                                                        <option value="{{ $tp->id }}"
                                                            {{ $tps == $tp->id ? 'selected' : '' }}>
                                                            {{ $tp->nama_tps }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tps')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <br>
                                            <span class="text-danger mt-3">Tps Belum di Input</span>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        @endif


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"
                        wire:click.prevent="{{ $selectedId ? 'update' : 'save' }}">{{ $selectedId ? 'Ubah' : 'Tambah' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="deleteSaksi" tabindex="-1" aria-labelledby="deleteSaksiLabel1" aria-hidden="true"
        style="display: {{ $isOpenDelete ? 'block' : 'none' }};">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteSaksiLabel1">
                        Hapus Data Saksi
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>

                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data an. <strong>{{ @$nama_saksi }}</strong> ?
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
                    <th>Nama Saksi</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Nama TPS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saksi as $key => $sak)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $sak->nama_lengkap }}</td>
                        <td>{{ substr($sak->alamat, 0, 100) . ' ...' }}</td>
                        <td>{{ $sak->no_hp }}</td>
                        <td>
                            @if ($sak->status == 'Aktif')
                                <span class="badge bg-success">{{ $sak->status }}</span>
                            @else
                                <span class="badge bg-danger">{{ $sak->status }}</span>
                            @endif
                        </td>
                        <td>{{ @$sak->tps->nama_tps }} {{ @$sak->tps->kelurahan->nama_kelurahan }}
                            {{ @$sak->tps->kecamatan->nama_kecamatan }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalSaksi" wire:click.prevent="edit('{{ $sak->id }}')"><i
                                    class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteSaksi"
                                wire:click.prevent="deleteshow('{{ $sak->id }}')"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $saksi->links() }}
    </div>
</div>
