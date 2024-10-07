@section('title', 'Kabupaten - Hitung Suara')
<x-app-layout>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">KABUPATEN</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Kabupaten</li>
                </ol>
                {{-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i
                        class="fa fa-plus-circle"></i> Create New</button> --}}
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @livewire('kabupaten.kabupaten-show')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
