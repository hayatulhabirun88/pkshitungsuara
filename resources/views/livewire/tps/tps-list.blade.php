<div>
    @if (session()->has('deletesuccess'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('deletesuccess') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">TPS</h4>

    </div>

    <div class="row">
        <div class="col-md-4 col-sm-12">
            <input wire:model.live="search" type="text" class="form-control mb-3" placeholder="Cari Data">
        </div>
    </div>

    <div class="modal" id="modalTps" tabindex="-1" aria-labelledby="modalTpsLabel1" aria-hidden="true"
        style="display: {{ $isOpen ? 'block' : 'none' }};">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTpsLabel1">
                        {{ $selectedId ? 'Ubah Data TPS' : 'Tambah Data TPS' }}
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
                            <label for="nama_tps" class="form-label">Nama TPS</label>
                            <input type="text" class="form-control" id="nama_tps" wire:model="nama_tps" readonly>
                            @error('nama_tps')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" wire:model="kelurahan" readonly>
                            @error('kelurahan')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" wire:model="kecamatan" readonly>
                            @error('kecamatan')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kabupaten" class="form-label">Kabupaten</label>
                            <input type="text" class="form-control" id="kabupaten" wire:model="kabupaten" readonly>
                            @error('kabupaten')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_dpt" class="form-label">Jumlah DPT</label>
                            <input type="text" class="form-control" placeholder="Masukan jumlah TPS" id="jumlah_dpt"
                                wire:model="jumlah_dpt" required>
                            @error('jumlah_dpt')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_surat_suara" class="form-label">Jumlah Surat Suara</label>
                            <input type="text" class="form-control" placeholder="Masukan jumlah Surat Suara"
                                id="jumlah_surat_suara" wire:model="jumlah_surat_suara" required>
                            @error('jumlah_surat_suara')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jml_surat_suara_sah" class="form-label">Jumlah Surat Suara Sah</label>
                            <input type="text" class="form-control" placeholder="Masukan jumlah Surat Suara"
                                id="jml_surat_suara_sah" wire:model="jml_surat_suara_sah" required>
                            @error('jml_surat_suara_sah')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jml_surat_suara_tidak_sah" class="form-label">Jumlah Surat Suara
                                Tidak Sah</label>
                            <input type="text" class="form-control" placeholder="Masukan jumlah Surat Suara"
                                id="jml_surat_suara_tidak_sah" wire:model="jml_surat_suara_tidak_sah" required>
                            @error('jml_surat_suara_tidak_sah')
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



    <div class="table-responsive">
        <table id="tblDokter" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelurahan</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Nama TPS</th>
                    <th>Jml DPT</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tps as $key => $tp)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tp->kelurahan->nama_kelurahan }}</td>
                        <td>{{ $tp->kecamatan->nama_kecamatan }}</td>
                        <td>{{ $tp->kecamatan->kabupaten->nama_kabupaten }}</td>
                        <td>{{ $tp->nama_tps }}</td>
                        <td>{{ $tp->jumlah_dpt }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTps"
                                wire:click.prevent="edit('{{ $tp->id }}')"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tps->links() }}
    </div>
</div>
