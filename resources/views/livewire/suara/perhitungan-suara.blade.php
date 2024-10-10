<div class="container-fluid">
    <div class="row">
        @foreach ($paslon as $psln)
            @php
                $suaraterkumpul = \App\Models\Suara::where('paslon_id', $psln->id)->sum('jumlah_suara');
                $jumlah_surat_suara_sah = \App\Models\Tps::sum('jml_surat_suara_sah');
                $suara = $jumlah_surat_suara_sah > 0 ? ($suaraterkumpul / $jumlah_surat_suara_sah) * 100 : 0;
            @endphp
            <div class="col-lg-2 col-md-6 mb-3">
                <!-- Card -->
                <div class="card h-100">
                    <img class="card-img-top img-fluid" src="{{ asset('/') }}storage/foto_paslon/{{ $psln->foto }}"
                        alt="Card image cap" style="height: 300px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $psln->no_urut }}. {{ Str::limit($psln->nama_paslon, 15) }}</h6>
                        <h1 wire:poll.1000ms>
                            <strong>{{ number_format($suaraterkumpul, 0, ',', '.') }}</strong>
                        </h1>
                        <div class="progress m-t-30">
                            <div class="progress-bar bg-success" style="width: {{ $suara }}%; height:6px;"
                                role="progressbar">
                            </div>
                        </div>
                        <h3><strong>{{ number_format($suara, 2, ',', '.') }} %</strong></h3>
                    </div>
                </div>
                <!-- Card -->
            </div>
        @endforeach
    </div>

    <!-- JavaScript for Internet Connection Check -->
    <script>
        // Fungsi untuk memeriksa koneksi internet
        function checkConnection() {
            if (!navigator.onLine) {
                // Jika internet tidak terhubung, tampilkan alert
                alert('Koneksi internet terputus! Harap periksa sambungan internet Anda.');
            }
        }

        // Event listener untuk memeriksa ketika koneksi terputus
        window.addEventListener('offline', checkConnection);

        // Event listener untuk memeriksa ketika koneksi terhubung kembali
        window.addEventListener('online', function() {
            console.log('Koneksi internet kembali!');
        });
    </script>
</div>
