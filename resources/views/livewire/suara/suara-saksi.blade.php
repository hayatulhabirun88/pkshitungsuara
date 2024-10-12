<div>

    <form wire:submit.prevent="simpan">
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
                    <input type="text" class="form-control" id="jumlah_suara" placeholder="Jumlah suara"
                        wire:model="jumlah_suara.{{ $lpaslon->id }}">
                    @error('jumlah_suara.' . $lpaslon->id)
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
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="bukti"><strong>Foto Form C1 atau Plano</strong></label>
                            <input type="file" class="form-control" wire:model="bukti">
                            @error('bukti')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>
                    @if (auth()->user()->saksi->tps->bukti)
                        <div class="col-md-4">
                            <label for="bukti">Bukti</label>
                            <button type="button" class="form-control btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modalBukti">
                                Lihat Bukti
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalBukti" tabindex="-1" aria-labelledby="modalBuktiLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalBuktiLabel">Form C1 / Plano</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img style="width:100%"
                                                src="{{ asset('/') }}storage/bukti/{{ auth()->user()->saksi->tps->bukti }}"
                                                alt="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>

        </div><br><br>

        <button type="submit" class="btn btn-primary" wire:click.prevent="simpan">Submit</button>
    </form>
    <div class="row mt-3">
        @if (session()->has('success'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
