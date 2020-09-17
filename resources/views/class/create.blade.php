@extends('layout.master')

@section('title','Sınıf Tanımlama')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Form horizontal -->
               <div class="card">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title">Yeni Sınıf Tanımla</h6>
                                <div class="header-elements">
                                    <div class="list-icons">
                                        <a class="list-icons-item" data-action="collapse"></a>
                                        <a class="list-icons-item" data-action="reload"></a>
                                        <a class="list-icons-item" data-action="remove"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                        {{Form::open(['route'=>'class.store' , 'method'=>'POST' , 'class' => 'form-horizontal'])}}
                        @csrf
                                    <div class="form-group">
                                        <label>Sınıf Seçiniz:</label>
                                        <select name="number"  required   class="form-control" >
                                        @for($i=1;$i<=12;$i++)
                                        <option value="{{$i}}">{{$i}}.Sınıf </option>
                                        @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Şube İsmi:</label>
                                        <input type="text" class="form-control" name="name" required placeholder="Lütfen Şube İsmini Giriniz" value="{{ old('name') }}">
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center" style="float: right">
                                        <button type="submit" class="btn bg-blue ml-3">Kaydet <i class="icon-paperplane ml-2"></i></button>
                                    </div>
                        {{Form::close()}}
                             </div>
                        </div>
                <!-- /form horizontal -->

            </div>
        </div>
        <!-- /dashboard content -->


        @section('css')
            {{Html::style('select2/select2.min.css')}}
        @stop
        @section('js')
            {{ Html::script('select2/select2.min.js') }}

            <script>
                $(document).ready(function() {
                    $('.select2').select2();
                });
            </script>
@stop
@endsection
