<div>
    @if (session()->has('deletesuccess'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('deletesuccess') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">INPUT SUARA</h4>


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
                        <h4><strong>{{ $nama_tps }} DESA/KEL. {{ $nama_kelurahan }} KEC.
                                {{ $nama_kecamatan }}
                                {{ $nama_kabupaten }}</strong>
                        </h4>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>

                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            @if (session()->has('success'))
                                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                    role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        @foreach ($listPaslon as $lpaslon)
                            <div class="row mt-3">
                                <div class="col-md-9">
                                    <h6>
                                        <img class="pull-left m-r-20 m-b-10" width="60" alt="user"
                                            src="{{ asset('/') }}storage/foto_paslon/{{ $lpaslon->foto }}">
                                        {{ $lpaslon->no_urut }}.
                                        {{ $lpaslon->nama_paslon }}
                                    </h6>

                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <label for="jumlah_suara">Jml Suara No Urut {{ $lpaslon->no_urut }}</label>
                                    <input type="text" class="form-control" id="jumlah_suara"
                                        placeholder="Jumlah suara" wire:model="jumlah_suara.{{ $lpaslon->id }}">
                                    @error('jumlah_suara.{{ $lpaslon->id }}')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        @endforeach
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="jumlah_surat_suara"><strong>Jumlah Surat Suara</strong> </label>
                                    <input type="text" class="form-control" wire:model="jumlah_surat_suara"
                                        placeholder="Masukan Jumlah Surat Suara ">
                                    @error('jumlah_surat_suara')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jml_surat_suara_sah"><strong>Jumlah Surat Suara Sah</strong></label>
                                    <input type="text" class="form-control" wire:model="jml_surat_suara_sah"
                                        placeholder="Masukan Jumlah Surat Suara Sah">
                                    @error('jml_surat_suara_sah')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jml_surat_suara_tidak_sah"><strong>Jumlah Surat Suara Tidak
                                            Sah</strong></label>
                                    <input type="text" class="form-control" wire:model="jml_surat_suara_tidak_sah"
                                        placeholder="Masukan Jumlah Surat Suara Tidak Sah">
                                    @error('jml_surat_suara_tidak_sah')
                                        <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" wire:click.prevent="update">Submit</button>
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
                    <th>Suara Terkumpul</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tps as $key => $tp)
                    @php
                        // Hitung suara terkumpul untuk TPS ini
                        $suaraterkumpul = \App\Models\Suara::where('tps_id', $tp->id)->sum('jumlah_suara');
                        $jumlah_surat_suara_sah = \App\Models\Tps::find($tp->id)->jml_surat_suara_sah;

                        // Hitung persentase suara
                        $suara = $jumlah_surat_suara_sah > 0 ? ($suaraterkumpul / $jumlah_surat_suara_sah) * 100 : 0;
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tp->kelurahan->nama_kelurahan }}</td>
                        <td>{{ $tp->kecamatan->nama_kecamatan }}</td>
                        <td>{{ $tp->kecamatan->kabupaten->nama_kabupaten }}</td>
                        <td>{{ $tp->nama_tps }}</td>
                        <td class="text-center">
                            {{ number_format($suara, 2, ',', '.') }}%
                            <div class="progress m-t-30">
                                <div class="progress-bar progress-animated bg-success"
                                    id="progress-bar-{{ $tp->id }}"
                                    style="width: {{ $suara }}%; height:6px;" role="progressbar">

                                </div>
                            </div>
                        </td>
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
    @if ($closeModalTps)
        <script>
            var modalElement = document.getElementById('modalTps');
            bootstrap.Modal.getInstance(modalElement);
            modal.hide();
        </script>
    @endif

</div>
