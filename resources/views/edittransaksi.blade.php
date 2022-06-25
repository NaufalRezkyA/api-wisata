@extends('layouts.main')

@section('container')

<section>
<h1 class="text-center">EDIT DATA TRANSAKSI</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="/updatetransaction/{{ $data->id }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1"
                                    class="form-label">Payment status</label>
                                <input type="text" name="payment_status" class="form-control"
                                     value="{{ $data->payment_status }}">
                            </div>
                            <button type="submit"
                                class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

@endsection
