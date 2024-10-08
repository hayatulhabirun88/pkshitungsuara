<div>
    <div class="row">
        <div class="col-12">
            <div class="row g-0">
                <div class="col-lg-3 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icons-Add-File"></i></h3>
                                            <p class="text-muted">PASLON</p>
                                        </div>
                                        <div class="ms-auto">
                                            <h2 class="counter text-primary">
                                                {{ number_format(@$totalPaslon, 0, ',', '.') }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icons-Heart"></i></h3>
                                            <p class="text-muted">SAKSI</p>
                                        </div>
                                        <div class="ms-auto">
                                            <h2 class="counter text-cyan">{{ number_format(@$totalSaksi, 0, ',', '.') }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icons-Envelope"></i></h3>
                                            <p class="text-muted">TPS</p>
                                        </div>
                                        <div class="ms-auto">
                                            <h2 class="counter text-purple">{{ number_format(@$totalTps, 0, ',', '.') }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div>
                                            <h3><i class="icons-Milk-Bottle"></i></h3>
                                            <p class="text-muted">DPT</p>
                                        </div>
                                        <div class="ms-auto">
                                            <h2 class="counter text-success">
                                                {{ number_format(@$totalDpt, 0, ',', '.') }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
