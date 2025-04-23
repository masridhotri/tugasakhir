@extends('layouts.app')

@section('content')
    <section class="vh-150">
        <div class="container py-5 h-200">
            <div class="row d-flex justify-content-center align-items-center h-200">
                <div class="col-md-12 col-xl-4">

                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <div class="mt-3 mb-4">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                                    class="rounded-circle img-fluid" style="width: 100px;" />
                            </div>
                            <h4 class="mb-2">{{ Auth::user()->name }} </h4>
                            <div class="d-flex justify-content-between text-center mt-5 mb-2">
                                <div>
                                    <p class="mb-2 h5">8471</p>
                                    <p class="text-muted mb-0">Wallets Balance</p>
                                </div>
                                <div class="px-3">
                                    <p class="mb-2 h5">8512</p>
                                    <p class="text-muted mb-0">Income amounts</p>
                                </div>
                                <div>
                                    <p class="mb-2 h5">4751</p>
                                    <p class="text-muted mb-0">Total Transactions</p>
                                </div>
                            </div>
                        </div>
                        <div class="me-3 ">
                            <div class="mb-3">
                                <input type="text" name="nama" value="{{Auth::user()->name}}"
                                    class="form-control @error('judul') is-invalid @enderror" id="inputnama"
                                    aria-describedby="judulHelp" class="border border-3" readonly>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="email" value="{{Auth::user()->email}}"
                                    class="form-control @error('judul') is-invalid @enderror" id="inputnama"
                                    aria-describedby="judulHelp" readonly>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
