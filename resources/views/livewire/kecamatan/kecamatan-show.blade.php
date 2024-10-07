<div>

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">Kecamatan</h4>


    </div>


    <div class="table-responsive">
        <table id="tblDokter" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kecamatan</th>
                    <th>Id Kabupaten</th>
                    <th>Id Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kecamatan as $key => $kec)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $kab->nama_kabupaten }}</td>
                        <td>{{ $kab->kabupaten_id }}</td>
                        <td>{{ $kab->kecamatan_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kecamatan->links() }}
    </div>
</div>
