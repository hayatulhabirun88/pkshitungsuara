<div>
    <div class="container direction-rtl">
        <div class="card mb-3">
            <div class="card-body">
                <div class="form-group">
                    <form wire:submit.prevent="simpan">
                        @foreach ($listPaslon as $paslon)
                            <div class="row mb-3">
                                <div class="col-3">
                                    <img src="{{ asset('/') }}storage/foto_paslon/{{ $paslon->foto }}" alt="">
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <label class="form-label" for="exampleInputText">{{ $paslon->no_urut }}.
                                            {{ substr($paslon->nama_paslon, 0, 20) . ' ...' }}</label>
                                        <input class="form-control form-control-clicked" id="exampleInputText"
                                            type="text" placeholder="Masukan jumlah suara"
                                            wire:model="jumlah_suara.{{ $paslon->id }}">
                                        @error('jumlah_suara.' . $paslon->id)
                                            <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <hr>
                        <div class="form-group">
                            <label class="form-label" for="jumlah_surat_suara">Jumlah Surat Suara</label>
                            <input class="form-control form-control-clicked" id="jumlah_surat_suara" type="text"
                                placeholder="Masukan jumlah suara" wire:model="jumlah_surat_suara">
                            @error('jumlah_surat_suara')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="jml_surat_suara_sah">Jumlah Surat Suara Sah</label>
                            <input class="form-control form-control-clicked" id="jml_surat_suara_sah" type="text"
                                placeholder="Masukan jumlah suara" wire:model="jml_surat_suara_sah">
                            @error('jml_surat_suara_sah')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="jml_surat_suara_tidak_sah">Jumlah Surat Suara Tidak
                                Sah</label>
                            <input class="form-control form-control-clicked" id="jml_surat_suara_tidak_sah"
                                type="text" placeholder="Masukan jumlah suara"
                                wire:model="jml_surat_suara_tidak_sah">
                            @error('jml_surat_suara_tidak_sah')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="bukti">Bukti Form C1</label>
                            <input class="form-control form-control-clicked" id="bukti" type="file"
                                placeholder="Masukan jumlah suara" wire:model="bukti">
                            @error('bukti')
                                <span class="text-danger" style="font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (@auth()->user()->saksi->tps->bukti)
                            <label for="bukti">Bukti</label>
                            <button type="button"
                                class="btn btn-success w-100 d-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modalBukti">
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
                        @endif
                        <hr>
                        <br>

                        <button type="submit"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                            type="button">
                            Submit
                        </button>

                        <br>

                        @if (session()->has('success'))
                            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                                role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
