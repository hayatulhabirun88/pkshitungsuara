<div>

    <div class="d-flex justify-content-between mb-3">
        <h4 class="d-inline">Paslon</h4>


    </div>


    <div class="table-responsive">
        <table id="tblDokter" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kabupaten Kota</th>
                    <th>Id Kabupaten</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kabupaten as $key => $kab)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $kab->nama_kabupaten }}</td>
                        <td>{{ $kab->id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kabupaten->links() }}
    </div>
</div>
