<div>
    @if (session()->has('deletesuccess'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('deletesuccess') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">Paslon</h4>

        <div style="float: right;">
            <div class="row">
                <div class="col-md-6"><button class="d-inline-block float-end btn btn-info mb-3 " data-bs-toggle="modal"
                        data-bs-target="#modalPaslon" wire:click.prevent="tambah()">Tambah</button></div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-4 col-sm-12"><input wire:model.live="search" type="text" class="form-control mb-3"
                placeholder="Cari Paslon"></div>
    </div>



    <div class="modal" id="modalPaslon" tabindex="-1" aria-labelledby="modalPaslonLabel1" aria-hidden="true"
        style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalPasienLabel1">
                        {{ $selectedId ? 'Ubah Data Paslon' : 'Tambah Data Paslon' }}
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_paslon" class="form-label">Nama Paslon</label>
                                    <input type="text" class="form-control" id="nama_paslon"
                                        wire:model="nama_paslon">
                                    @error('nama_paslon')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_urut" class="form-label">Nomor Urut</label>
                                    <input type="text" class="form-control" id="no_urut" wire:model="no_urut">
                                    @error('no_urut')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" wire:model="foto">
                                    @error('foto')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="wilayah" class="form-label">Wilayah</label>
                                    <select class="form-select" wire:model="wilayah">
                                        <option value="">-- Pilih Wilayah --</option>
                                        @foreach ($listWilayah as $key => $value)
                                            <option value="{{ $value['id'] }}"
                                                {{ $wilayah == $value['id'] ? 'selected' : '' }}>{{ $value['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('wilayah')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img style="width:100%"
                                    src="{{ asset('/') }}storage/foto_paslon/{{ $foto }}" alt="">
                            </div>
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


    <div class="modal" id="deletePaslon" tabindex="-1" aria-labelledby="deletePaslonLabel1" aria-hidden="true"
        style="display: {{ $isOpenDelete ? 'block' : 'none' }};">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deletePaslonLabel1">
                        Hapus Data Paslon
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>

                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data an. <strong>{{ @$nama_paslon }}</strong> ?
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
                    <th>Nama Paslon</th>
                    <th>No Urut</th>
                    <th>Foto</th>
                    <th>Wilayah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paslon as $key => $pass)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $pass->nama_paslon }}</td>
                        <td>{{ $pass->no_urut }}</td>
                        <td><img width="80" src="{{ asset('/') }}storage/foto_paslon/{{ $pass->foto }}"
                                alt="">
                        </td>
                        <td>
                            @if ($pass->wilayah_id)
                                {{ \App\Models\Kabupaten::find($pass->wilayah_id)->nama_kabupaten }}
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalPaslon" wire:click.prevent="edit('{{ $pass->id }}')"><i
                                    class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deletePaslon"
                                wire:click.prevent="deleteshow('{{ $pass->id }}')"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $paslon->links() }}
    </div>
</div>
