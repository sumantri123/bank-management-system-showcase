@extends('layout.default')

@push('style')
<!-- Aditional Style CSS Here -->
@endpush

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Faq</h3>
        </div>
        <div class="title_right">
            <nav class=" pull-right ">
                <ol class="breadcrumb mb-10">
                    <li class="breadcrumb-item"><a href="">FAQ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><b>Tambah Pertanyaan</b></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Tambah Pertanyaan</h2>
                    <a href="{{ url('faq') }}" class="btn btn-default pull-right">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row">
                        <div class="col-md-12">

                            <form class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label>Pertanyaan</label>
                                    <input type="text" class="form-control" placeholder="Pertanyaan">
                                </div>
                                <div class="form-group">
                                    <label>Jawaban</label>
                                    <input type="text" class="form-control" placeholder="Jawaban">
                                </div>
                                <div class="form-group">
                                    <label>Urut</label>
                                    <input type="text" class="form-control" placeholder="Urutan">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Batal</button>
                                    <button class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /top tiles -->
@endsection

@push('scripts')
<!-- Aditional Scripts Here -->
@endpush
