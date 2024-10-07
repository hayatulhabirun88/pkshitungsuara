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
                        {{ $kelurahan_id ? 'Ubah Data Jumlah TPS' : 'Tambah Data Paslon' }}
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
                            <label for="jumlah_tps" class="form-label">Jumlah TPS</label>
                            <input type="text" class="form-control" placeholder="Masukan jumlah TPS" id="jumlah_tps"
                                wire:model="jumlah_tps" required>
                            @error('jumlah_tps')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" wire:click.prevent="hapus">Hapus</button>
                    <button type="submit" class="btn btn-primary"
                        wire:click.prevent="{{ $kelurahan_id ? 'update' : 'save' }}">{{ $kelurahan_id ? 'Ubah' : 'Tambah' }}</button>
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
                    <th>Jumlah TPS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tps as $key => $tp)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tp->nama_kelurahan }}</td>
                        <td>{{ $tp->kecamatan->nama_kecamatan }}</td>
                        <td>{{ $tp->kecamatan->kabupaten->nama_kabupaten }}</td>
                        <td>{{ \App\Models\Tps::where('kelurahan_id', $tp->id)->count() }}</td>
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
