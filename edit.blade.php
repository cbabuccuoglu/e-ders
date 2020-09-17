@extends('layouts.master')

@section('title','Kayıt Düzenleme')

@section('content')


    <div class="row" style="display: block;">



        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Demirbaşlar</h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">{{ session()->get('message') }}</span>
                        </div>
                    @endif
                    <br>

                        {{ Form::model($inventories, array('route' => array('inventories.update', $inventories->id), 'method' => 'PUT', 'class'=>'form-horizontal')) }}


                    

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Resim<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="image_path" name="image_path" class="form-control" value="{{$inventories->image_path ?? ''}}">
                            </div>
                        </div>

                                                       <div class="item form-group">
                                     <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Kategori: </label>
                                     <div class="col-md-6 col-sm-6 ">
                                    <select name="category_id" class='form-control select2'>
                                        <option value="">Kategori Seçiniz</option>
                                        @foreach ($units AS $kategori)
                                    <option value="{{$kategori->id}}" @if($kategori->id==$inventories->category_id) selected @endif >{{$kategori->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                                  </div>

                                    <div class="item form-group">
                                     <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Zimmet: </label>
                                     <div class="col-md-6 col-sm-6 ">
                                    <select name="staff_id" class='form-control select2'>
                                        <option value="">Zimmet Seçiniz</option>
                                        @foreach ($staffs AS $kategori)
                                    <option value="{{$kategori->id}}" @if($kategori->id==$inventories->staff_id) selected @endif >{{$kategori->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                                  </div>

                                       <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Varlık Adı<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="image_path" name="name" class="form-control" value="{{$inventories->name ?? ''}}">
                            </div>
                        </div>

                           <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Marka<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="image_path" name="brand" class="form-control" value="{{$inventories->brand ?? ''}}">
                            </div>
                        </div>

                           <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Model<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="image_path" name="model" class="form-control" value="{{$inventories->model ?? ''}}">
                            </div>
                        </div>

                             <div class="item form-group">
                        <div class="col-md-3 col-sm-3 offset-md-3">
                            <button type="submit" class="btn btn-success">Kaydet</button>
                        </div>

                     
                        </div>

                    </div>


                    <div class="ln_solid"></div>
                

                </div>


            </div>
        </div>







    </div>


@endsection

@section('js')
    {{ Html::script('vendors/select2/dist/js/select2.min.js') }}


    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });


    </script>
@endsection


@section('css')
    {{Html::style('/vendors/select2/dist/css/select2.min.css')}}
@endsection
