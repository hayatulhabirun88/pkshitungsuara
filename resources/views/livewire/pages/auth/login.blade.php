<div>
    <section id="wrapper" class="login-register login-sidebar"
        style="background-image:url({{ asset('/') }}/gambarpks.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material text-center mt-3" id="loginform" wire:submit="login">
                    <img width="100" src="{{ asset('/') }}/logopks.png" alt="Home" />
                    <h4 class="mt-5"><strong>Sistem Informasi <br> Hitung Suara <br></strong></h4>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" wire:model="email" required=""
                                placeholder="Email" value="{{ old('email') }}" autofocus>
                            @error('email')
                                <span class="text text-danger float-left">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" wire:model="password" required=""
                                placeholder="Password">
                            @error('password')
                                <span class="text text-danger float-left">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg w-100 text-uppercase btn-rounded text-white"
                                type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
