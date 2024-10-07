<div>

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">Kelurahan</h4>


    </div>


    <div class="table-responsive">
        <table id="tblDokter" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelurahan</th>
                    <th>Nama Kecamatan</th>
                    <th>Id Desa Kelurahan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelurahan as $key => $kel)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $kel->nama_kelurahan }}</td>
                        <td>{{ $kel->kecamatan->nama_kecamatan }}</td>
                        <td>{{ $kel->id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kelurahan->links() }}
    </div>
</div>
