@extends('layout.master')

@section('title','Sınav Sonuçları')

@section('content')

    <div class="content">

        <div class="card" style="margin-top:20px">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Kazanım Sonuçları</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Ders</th>
                        <th>Kazanım Ünitesi</th>
                        <th>Kazanım Adı</th>
                        <th>Toplam Soru</th>
                        <th>Toplam Doğru Cevap</th>
                        <th>Toplam Yanlış Cevap</th>
                        <th>Toplam Boş Cevap</th>
                        <th>Kazanım oranı</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=0; @endphp
                    @foreach($gains as $gain)
                        @php
                            $gainim=\App\Gains::where('id',$gain['gainID'])->first();
                            $toplamsoru=$gain['dogru']+$gain['yanlis']+$gain['bos'];
                            $oran=((100/$toplamsoru)*$gain['dogru']);
                        @endphp
                            <tr>
                                <td>{{$gainim->lesson->name ?? ''}}</td>
                                <td>{{$gainim->units}}</td>
                                <td>{{$gainim->name}}</td>
                                <td>{{$toplamsoru}}</td>
                                <td>{{$gain['dogru']}}</td>
                                <td>{{$gain['yanlis']}}</td>
                                <td>{{$gain['bos']}}</td>
                                <td>{{$oran}}</td>

                            </tr>




                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>




@endsection
