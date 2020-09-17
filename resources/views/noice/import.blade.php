@extends('layout.master')

@section('title','Kazanım İçeri Aktarma')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Kazanım İmport İşlemleri</h6>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{Form::open(['route'=>'imported.gains' , 'method'=>'POST' , 'files'=> 'true' , 'class' => 'form-horizontal'])}}
                        @csrf
                        <div class="form-group">
                            <label>Excel Dosyası:</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                        <div class="d-flex justify-content-start align-items-center" style="float: right">
                            <button type="submit" class="btn bg-blue ml-3">İçeri Aktar <i class="icon-paperplane ml-2"></i></button>
                        </div>






                    </div>
                </div>
                <!-- /form horizontal -->

            </div>
        </div>




        <!-- /dashboard content -->
@endsection
