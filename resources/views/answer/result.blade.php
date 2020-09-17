@extends('layout.master')

@section('title','Deneme Sınavı Sonuçları')

@section('content')


    <!-- Content area -->
    <div class="content">

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Sınav Sonuçları</h5>
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
                        <th>Sınav İsmi</th>
                        <th>Sınav Başlangıç Zamanı</th>
                        <th>Sıanv Bitiş Zamanı</th>
                        <th>Sınav Sıralamanız</th>
                        <th>Toplam Doğru</th>
                        <th>Toplam Yanlış</th>
                        <th>Toplam Boş</th>
                        <th>Toplam Net</th>
                        @if($answer->trialexam->trial_type==1)
                        <th>Toplam Puan</th>
                        @elseif($answer->trialexam->trial_type==2)
                        <th>TYT Puanınız</th>
                        @else
                        <th>AYT Sözel Puanınız</th>
                        <th>AYT Eşit Ağırlık Puanınız</th>
                        <th>AYT Sayısal Puanınız</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$answer->trialexam->name ?? ''}}</td>
                        <td>{{$answer->start_date}}</td>
                        <td>{{$answer->finish_date}}</td>
                        <td>{{$siralama}}.Sıradasınız</td>
                        <td>{{$dogru}}</td>
                        <td>{{$yanlis}}</td>
                        <td>{{$bos}}</td>
                        <td>{{$answer->net}}</td>
                        @if($answer->trialexam->trial_type==1)
                            <td>{{$answer->point}}</td>
                        @elseif($answer->trialexam->trial_type==2)
                            <td>{{$answer->tytpuan}}</td>
                        @else
                            <td>{{$answer->aytsozel}}</td>
                            <td>{{$answer->aytesit}}</td>
                            <td>{{$answer->aytsayisal}}</td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
  <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Sınav Sonuç Detayları</h5>
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
                        <th>Ders İsmi</th>
                        <th>Doğru Sayısı</th>
                        <th>Yanlış Sayısı</th>
                        <th>Boş Sayısı</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($lessons as $lesson)
                        @php
                        $bossoru=0;
                        $answer = \App\Answer::where('id',$answer->id)->first();
                        $sorusorgula=\App\ExamQuestion::where('trialexam_id',$answer->trialexam_id)->where('lesson_id',$lesson[98])->count();
                        if(!isset($lesson[1])){
                        $lesson[1]=0;
                        }
                        if(!isset($lesson[2])){
                        $lesson[2]=0;
                        }
                        $bossoru=$sorusorgula-$lesson[1]-$lesson[2];
                        @endphp
                    <tr>
                        <td>{{$lesson[99] ?? 'Ders Bilinmiyor'}}</td>
                        <td>{{$lesson[1] ?? '0'}}</td>
                        <td>{{$lesson[2] ?? '0'}}</td>
                        <td>{{$bossoru ?? '0'}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>

        <!-- Dashboard content -->
        <div class="row">
            @if($firstquestion->examquestion->trialexam->opticsType==2)
            <div class="col-lg-9" style="background: white;text-align: center" id="soruview">
        		<button class="btn btn-primary" id="sorubosbirak" style="float: right;margin-top: 10px" onclick="soruyagit('{{$next_record->id}}')">></button>
        		<button class="btn btn-primary" id="sorubosbirak" style="float: right;margin-top: 10px;margin-right: 5px" onclick="soruyagit('{{$back_record->id}}')"><</button>
                <h3 style="margin-top:5px;text-transform: uppercase;"><b>{{$firstquestion->examquestion->lesson->name ?? ''}} {{$firstquestion->examquestion->order ?? ''}}. SORU</b></h3>

                @if($firstquestion->examquestion->questionstype==1)
                    <img src="/upload/questions/{{$firstquestion->examquestion->image}}" style="width: 100%">
                @else
                    <div class="quiz">
                        <h4 class="quiz-question">{{$firstquestion->examquestion->Wquestion ?? ''}}</h4>
                        <ul data-quiz-question="1">
                            <li class="quiz-answer" data-quiz-answer="a">A) {{$firstquestion->examquestion->WoptionA ?? ''}}</li>
                            <li class="quiz-answer" data-quiz-answer="b">B) {{$firstquestion->examquestion->WoptionB ?? ''}}</li>
                            <li class="quiz-answer" data-quiz-answer="c">C) {{$firstquestion->examquestion->WoptionC ?? ''}}</li>
                            <li class="quiz-answer" data-quiz-answer="d">D) {{$firstquestion->examquestion->WoptionD ?? ''}}</li>
                        </ul>
                    </div>
                @endif

        	</div>
            @endif
        	<div class="col-lg-@if($firstquestion->examquestion->trialexam->opticsType==2){{'3'}}@else{{'12'}}@endif">

            <div class="card-group-control card-group-control-right" id="accordion-control">
                    @php $i=0; @endphp
                    @foreach($quenstions as $quenstion)
                        @php $i=$i+1; @endphp
                    <div class="card mb-2">
								<div class="card-header">
									<h6 class="card-title">
										<a class="text-default" data-toggle="collapse" href="#question{{$i}}" aria-expanded="false">
											{{$quenstion[0]->lesson->name ?? ''}} - {{count($quenstion)}} Soru
										</a>
									</h6>
								</div>

								<div id="question{{$i}}" class="optics collapse @if($i==1) show @endif" data-parent="#accordion-control" style="">
                                    @foreach($quenstion as $answer)

                                        <div class="cevaplar">
                                            <div class="soru"><a href="javascript:void()" onclick="soruyagit('{{$answer->id}}')">{{$answer->examquestion->order}}</a></div>
                                            <div class="siklar" id="soru{{$answer->id}}">
                                                <button class="button button5 @if($answer->selectedoption == "A") secili @endif  @if($answer->trueoption == "A") dogru @endif" id="A" onclick="tikladim('{{$answer->id}}','A')">A</button>
                                                <button class="button button5 @if($answer->selectedoption == "B") secili @endif @if($answer->trueoption == "B") dogru @endif" id="B" onclick="tikladim('{{$answer->id}}','B')">B</button>
                                                <button class="button button5 @if($answer->selectedoption == "C") secili @endif @if($answer->trueoption == "C") dogru @endif" id="C" onclick="tikladim('{{$answer->id}}','C')">C</button>
                                                <button class="button button5 @if($answer->selectedoption == "D") secili @endif @if($answer->trueoption == "D") dogru @endif" id="D" onclick="tikladim('{{$answer->id}}','D')">D</button>
                                              
                                            </div>
                                        </div>

								@endforeach
							</div>

							</div>
                    @endforeach




						</div>
        	</div>

        </div>
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
                        <th>Soru</th>
                        <th>Cevap</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=0; @endphp
                    @foreach($quenstions as $quenstion)
                             @foreach($quenstion as $answer)
                                 <tr @if($answer->truetype==1) class="kazanimbasarili" @elseif($answer->truetype==2) class="kazanimbasarisiz" @else class="kazanimbos"  @endif>
                                     <td>{{$quenstion[0]->lesson->name ?? ''}}</td>
                                     <td>{{$answer->gains->units ?? ''}}</td>
                                     <td>{{$answer->gains->name ?? ''}}</td>
                                     <td>{{$answer->examquestion->order}}. Soru</td>
                                     <td>@if($answer->truetype==1) Doğru @elseif($answer->truetype==2) Yanlış @else Boş @endif</td>

                                 </tr>
                                @endforeach



                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
<script type="text/javascript">
    @if($sinavtype==1)
    $(document).ready(function(){

        var ilkRakam ={{$saniye}};
        var dakika=ilkRakam/60;
        var kalansaniye=ilkRakam%60;
        $.saymayaBasla = function(){
            if(ilkRakam > 0){
                ilkRakam--;
                var dakika=ilkRakam/60;
                var kalansaniye=ilkRakam%60;

                $(".dakika").html(Math.floor(dakika));
                $(".saniye").html(kalansaniye);
            }
            else{

            }
        }
        $(".dakika").html(Math.floor(dakika));
        $(".saniye").html(kalansaniye);
        setInterval("$.saymayaBasla()",1000);
    });
@endif
</script>



<style type="text/css">

	.button {
  border: 2px solid black;
  color: black;
  background:white;
  width: 30px;
  height: 30px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  cursor: pointer;
  border-radius: 60%;
}
.cevaplar{
	margin-top:5px;
	margin-bottom:5px;
	float: left;
	width: 100%
}
.soru{
	float: left;
    font-size: 20px;
    font-weight: bold;
    margin-left: 10px;
    width: 40px;
    text-align: center;
}
.soru a{
	color: black;
}
.siklar{
	float: left;
}

.optics {
	height: 500px;
	overflow: auto;
}

    .secili{
        color: white !important;
        background:#a90000  !important;
    }
    .dogru{
        color: white !important;
        background:#009a2f  !important;
    }


    .kazanimbasarili {
        background: #009226;
        color: white;
    }
    .kazanimbasarisiz{
        background: #a90000;
        color: white;
    }
    .kazanimbos{
        background: #fff;
        color: black;
    }
    .quiz {
        padding:0 30px 20px 30px;
        max-width:600px;
        margin:0 auto;

    ul {
        list-style:none;
        padding:0;
        margin:0;
    }
    }

    .quiz ul{
        padding:0;
    }
    .quiz-question {
        font-weight:bold;
        display:block;
        padding:30px 0 10px 0;
        margin:0;
    }
    .quiz-answer {

        margin: 0;
        padding: 10px;
        background: #f7f7f7;
        margin-bottom: 5px;
        list-style-type: none;
        text-align: left;
    }

</style>

    <style>

        @media only screen and (max-width: 600px) {
            #soruview img {
                width: 100%;
            }
        }
    </style>
<script type="text/javascript">

function tikladim(soru,cevap){
    $.ajax({
        type: 'GET',
        url: "{{route('set.examquestion')}}?soru="+soru+"&cevap="+cevap,
        success:
            function (response) {
            }
    });

    $("#soru"+soru+" button").removeClass("secili");
	$("#soru"+soru+" #"+cevap).addClass("secili");



}


function soruyagit(soru){

    $.ajax({
        type: 'GET',
        url: "{{route('get.resultexamquestion')}}?id="+soru,
        success:
            function (response) {
                $("#soruview").html(response);

            }
    });



}



</script>
    @endsection
