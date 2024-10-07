<div>
    @if (session()->has('error'))
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">Pilih Wilayah yang Akan di Set</h4>


    </div>


    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="mb-3">
                <select class="form-select" wire:model="wilayah">
                    <option value="">-- Pilih Wilayah --</option>
                    @foreach ($listWilayah as $key => $value)
                        <option value="{{ $value['id'] }}" {{ $wilayah == $value['id'] ? 'selected' : '' }}>
                            {{ $value['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <button wire:click="setWilayah()" class="btn btn-primary"> Set Wilayah</button>
            </div>
        </div>
    </div>


</div>
