@extends('layout.master')

@section('title','Deneme Sınavı')

@section('content')


    <!-- Content area -->
    <div class="content">




        <!-- Dashboard content -->
        <div class="row">
            @if($firstquestion->trialexam->opticsType==2)
        	<div class="col-lg-9" style="background: white;text-align: center" id="soruview">
        		<button class="btn btn-primary" id="sorubosbirak" style="float: right;margin: 10px" onclick="tikladim('1',' ')">Soruyu Boş Bırak</button>
                <h3 style="margin-top:5px;text-transform: uppercase;"><b>{{$firstquestion->lesson->name}} {{$firstquestion->order}}. SORU</b></h3>
                @if($firstquestion->questionstype==1)
                <img src="/upload/questions/{{$firstquestion->image}}" style="width: 100%">
                @else
                    <div class="quiz">
                        <h4 class="quiz-question">{{$firstquestion->Wquestion}}</h4>
                        <ul data-quiz-question="1">
                            <li class="quiz-answer" data-quiz-answer="a">A) {{$firstquestion->WoptionA}}</li>
                            <li class="quiz-answer" data-quiz-answer="b">B) {{$firstquestion->WoptionB}}</li>
                            <li class="quiz-answer" data-quiz-answer="c">C) {{$firstquestion->WoptionC}}</li>
                            <li class="quiz-answer" data-quiz-answer="d">D) {{$firstquestion->WoptionD}}</li>
                        </ul>
                    </div>
                @endif
        	</div>
            @endif
        	<div class="col-lg-3">

            <div class="card-group-control card-group-control-right" id="accordion-control">
                @if($sinavtype==1) <p>Sınavın Süresinin Bitmesine<b> <span class="dakika"></span> Dakika <span class="saniye"></span> Saniye Kalmıştır </b></p> @endif

                    {{Form::open(['route'=>'set.answerfinish' , 'method'=>'POST' , 'class' => 'form-horizontal' ,'onsubmit' => 'return confirm("Sınavı Tamamlamak İstediğine Emin misin ? ")'])}}
                <input type="hidden" name="answerid" value="{{$id}}">
                <button class="btn btn-primary" id="sorubosbirak" style="width: 100%;margin-bottom: 10px;">SINAVI BİTİR</button>
                    {{Form::close()}}
            <p style="text-align: center">İstediğiniz Soru Numarasına Tıklayarak Soruyu Görüntüleyebilirsiniz. </p>

                    @php $i=0; @endphp
                    @foreach($quenstions as $quenstion)
                        @php $i=$i+1; @endphp
                    <div class="card mb-2">
								<div class="card-header">
									<h6 class="card-title">
										<a class="text-default" data-toggle="collapse" href="#question{{$i}}" aria-expanded="false">
											{{$quenstion[0]->lesson->name}} - {{count($quenstion)}} Soru
										</a>
									</h6>
								</div>

								<div id="question{{$i}}" class="optics collapse @if($i==1) show @endif" data-parent="#accordion-control" style="">
                                    @foreach($quenstion as $answer)
									<div class="cevaplar">
									<div class="soru"><a href="javascript:void()" onclick="soruyagit('{{$answer->id}}')">{{$answer->order}}</a></div>
									<div class="siklar" id="soru{{$answer->id}}">
										<button class="button button5 @if(isset($cevaps[$answer->id])) @if($cevaps[$answer->id] == "A") secili @endif @endif" id="A" onclick="tikladim('{{$answer->id}}','A')">A</button>
										<button class="button button5 @if(isset($cevaps[$answer->id])) @if($cevaps[$answer->id] == "B") secili @endif @endif" id="B" onclick="tikladim('{{$answer->id}}','B')">B</button>
										<button class="button button5 @if(isset($cevaps[$answer->id])) @if($cevaps[$answer->id] == "C") secili @endif @endif" id="C" onclick="tikladim('{{$answer->id}}','C')">C</button>
										<button class="button button5 @if(isset($cevaps[$answer->id])) @if($cevaps[$answer->id] == "D") secili @endif @endif" id="D" onclick="tikladim('{{$answer->id}}','D')">D</button>
										
									</div>
								</div>

								@endforeach
							</div>

							</div>
                    @endforeach




						</div>
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
                window.location.href = 'http://onlinelise.everestkurs.com/answer';    
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
  background:#333  !important;
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
        url: "{{route('set.examquestion')}}?soru="+soru+"&cevap="+cevap+"&answerid=<?=$id?>",
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
        url: "{{route('get.examquestion')}}?id="+soru,
        success:
            function (response) {
                $("#soruview").html(response);

            }
    });



}



</script>
    @endsection
