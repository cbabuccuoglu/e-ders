<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AnswerItem;
use App\Classes;
use App\ExamQuestion;
use App\Gains;
use App\Lesson;
use App\TrialExam;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers=TrialExam::where('classNumber',Auth::user()->class->number)->orderBy('name','asc')->paginate(25);
        //->where('start_date','<',date('Y-m-d H:i',time()))->where('finish_date','>',date('Y-m-d H:i',time()))->
        return view('answer.index', compact(['answers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $examquestions=ExamQuestion::where('trialexam_id',$request->get('id'))->get();

        $sorgula=Answer::where('trialexam_id',$request->get('id'))->where('user_id',Auth::user()->id)->count();

        if($sorgula==0){
        $sinavbaslaid=Answer::create([
            'trialexam_id' => $request->get('id'),
            'user_id' => Auth::user()->id,
            'start_date' => date('d-m-Y H:i'),
        ])->id;
        return redirect()->route('answer.show',$sinavbaslaid);

        }else{
        $sorgula=Answer::where('trialexam_id',$request->get('id'))->where('user_id',Auth::user()->id)->first();
        return redirect()->route('answer.show',$sorgula->id);

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $quenstions=array();
        $answer = Answer::where('id',$id)->first();
        $sinavtype=$answer->trialexam->type;
       $baslangiczamani=strtotime($answer->start_date);
        $bitiszamani=$baslangiczamani+($answer->trialexam->time*60);
        $saniye=$bitiszamani-time();
        $answerItems = ExamQuestion::select('lessons.name', 'exam_questions.*')->leftJoin('lessons', function($join){ $join->on('lessons.id', '=', 'exam_questions.lesson_id');})->where('exam_questions.trialexam_id',$answer->trialexam->id)->orderBy('lessons.order','asc')->orderBy('exam_questions.order','asc')->get();
        $cevaplargetir=AnswerItem::where('answer_id',$id)->where('user_id',Auth::user()->id)->get();
        foreach ($cevaplargetir as $cevap){
            $cevaps[$cevap->examquestion_id]=$cevap->selectedoption;
        }
        $i=0;
        foreach ($answerItems as $answerItem ){
            if($i==0){
                $firstquestion=$answerItem;
                $i=$i+1;
            }
            $quenstions[$answerItem->lesson_id][]=$answerItem;
        }
        $next_record = ExamQuestion::where('id', '>', $firstquestion->id)->where('trialexam_id',$answer->trialexam->id)->orderBy('id')->first();

        if(!isset($next_record)){
            $next_record =ExamQuestion::where('trialexam_id',$answer->trialexam->id)->orderBy('id')->first();
        }

        $back_record = ExamQuestion::where('id', '<', $firstquestion->id)->where('trialexam_id',$answer->trialexam->id)->orderBy('id','desc')->first();
        if(!isset($back_record)){
            $back_record =ExamQuestion::where('trialexam_id',$answer->trialexam->id)->orderBy('id','desc')->first();
        }
        return view('answer.show', compact(['answer','quenstions','firstquestion','next_record','back_record','saniye','sinavtype','id','cevaps']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function getIdByQuestion(Request $request){

        $id=$request->get("id");
        $names = ExamQuestion::where('id',$id)->first();
        $selectform='';
        $selectform.='<button class="btn btn-primary" id="sorubosbirak" style="float: right;margin: 10px" onclick="tikladim(\''.$names->id.'\',\' \')">Soruyu Boş Bırak</button>';
        $selectform.='<h3 style="margin-top:5px;text-transform: uppercase;"><b>'.$names->lesson->name.' '.$names->order.'. SORU</b></h3>';

        if($names->questionstype==1) {
            $selectform .= '<img src="/upload/questions/' . $names->image . '"  style="width: 100%">';
        }else{
            $selectform .= '<div class="quiz">';
                        $selectform .= '<h4 class="quiz-question">'.$names->Wquestion.'</h4>';
                        $selectform .= '<ul data-quiz-question="1">';
                            $selectform .= '<li class="quiz-answer" data-quiz-answer="a">A)'.$names->WoptionA.'</li>';
                            $selectform .= '<li class="quiz-answer" data-quiz-answer="b">B)'.$names->WoptionB.'</li>';
                            $selectform .= '<li class="quiz-answer" data-quiz-answer="c">C)'.$names->WoptionC.'</li>';
                            $selectform .= '<li class="quiz-answer" data-quiz-answer="d">D)'.$names->WoptionD.'</li>';
                            $selectform .= '<li class="quiz-answer" data-quiz-answer="d">E)'.$names->WoptionE.'</li>';
                        $selectform .= '</ul>';
                    $selectform .= '</div>';
        }
        return $selectform;
    }

    function getIdByResultQuestion(Request $request){

        $id=$request->get("id");
        $answer = AnswerItem::where('id',$id)->first();
        $names = ExamQuestion::where('id',$answer->examquestion_id)->first();
        $next_record = AnswerItem::where('id', '>', $id)->where('answer_id',$answer->answer_id)->orderBy('id')->first();
        if(!isset($next_record)){
            $next_record =AnswerItem::where('answer_id',$answer->answer_id)->orderBy('id')->first();
        }
        $back_record = AnswerItem::where('id', '<', $id)->where('answer_id',$answer->answer_id)->orderBy('id','desc')->first();
        if(!isset($back_record)){
            $back_record =AnswerItem::where('answer_id',$answer->answer_id)->orderBy('id','desc')->first();
        }
        $selectform='';
        $selectform.='<button class="btn btn-primary" id="sorubosbirak" style="float: right;margin-top: 10px" onclick="soruyagit(\''.$next_record->id.'\')">></button>';
        $selectform.='<button class="btn btn-primary" id="sorubosbirak" style="float: right;margin-top: 10px;margin-right: 5px" onclick="soruyagit(\''.$back_record->id.'\')"><</button>';
        $selectform.='<h3 style="margin-top:5px;text-transform: uppercase;"><b>'.$names->lesson->name.' '.$names->order.'. SORU</b></h3>';
        if($names->questionstype==1) {
            $selectform .= '<img src="/upload/questions/' . $names->image . '">';
        }else{
            $selectform .= '<div class="quiz">';
            $selectform .= '<h4 class="quiz-question">'.$names->Wquestion.'</h4>';
            $selectform .= '<ul data-quiz-question="1">';
            $selectform .= '<li class="quiz-answer" data-quiz-answer="a">A)'.$names->WoptionA.'</li>';
            $selectform .= '<li class="quiz-answer" data-quiz-answer="b">B)'.$names->WoptionB.'</li>';
            $selectform .= '<li class="quiz-answer" data-quiz-answer="c">C)'.$names->WoptionC.'</li>';
            $selectform .= '<li class="quiz-answer" data-quiz-answer="d">D)'.$names->WoptionD.'</li>';
            $selectform .= '<li class="quiz-answer" data-quiz-answer="d">E)'.$names->WoptionE.'</li>';
            $selectform .= '</ul>';
            $selectform .= '</div>';
        }
        return $selectform;
    }

    function setResultQuestion(Request $request){

        $soru=$request->get("soru");
        $cevap=$request->get("cevap");
        $answerid=$request->get("answerid");
        $sorugetir=ExamQuestion::where('id',$soru)->first();
        $truetype=null;
        if($cevap==" " || $cevap==""){
            $truetype=null;
        }
        elseif($sorugetir->trueresult==$cevap){
            $truetype=1;
        }elseif($sorugetir->trueresult!=$cevap){
            $truetype=2;
        }
        $sorgula=AnswerItem::where('answer_id',$answerid)->where('user_id',Auth::user()->id)->where('examquestion_id',$soru)->count();
        if($sorgula==0){
            if($truetype!=null){
         $sınavsorular=AnswerItem::create([
                'answer_id' => $answerid,
                'user_id' => Auth::user()->id,
                'lesson_id' => $sorugetir->lesson_id,
                'gain_id' => $sorugetir->gains_id,
                'trueoption' => $sorugetir->trueresult,
                'selectedoption' => $cevap,
                'truetype' => $truetype,
                'examquestion_id' => $soru,
            ])->id;
            }
        }else{
        if($truetype!=null){
        $duzenle=AnswerItem::where('answer_id',$answerid)->where('user_id',Auth::user()->id)->where('examquestion_id',$soru)->update(['selectedoption'=>$cevap,'truetype'=>$truetype]);
        }else{
        $duzenle=AnswerItem::where('answer_id',$answerid)->where('user_id',Auth::user()->id)->where('examquestion_id',$soru)->delete();
        }
        }
    }

    function answerfinish(Request $request){
        $id=$request->post("answerid");
      /*  $answers = Answer::where("id",$id)->first();
        $answerItems = AnswerItem::where('answer_id',$id)->get();
        $i=0;
        foreach ($answerItems as $answerItem ){
            if($i==0){
                $firstquestion=$answerItem;
                $i=$i+1;
            }
            $quenstions[$answerItem->lesson_id][]=$answerItem;
        }
        $toplamnet=0;
        $toplamkatsayi=0;
        $lessons=array();
        $lessons['Türkçe']=0;
        $lessons['İngilizce']=0;
        $lessons['Türk Dili ve Edebiyatı']=0;
        $lessons['Tarih-1']=0;
        $lessons['Tarih-2']=0;
        $lessons['Coğrafya']=0;
        $lessons['Coğrafya-2']=0;
        $lessons['Felsefe Grubu']=0;
        $lessons['Din Kültürü ve Ahlak B.']=0;
        $lessons['Matematik']=0;
        $lessons['Fizik']=0;
        $lessons['Biyoloji']=0;
        $lessons['Kimya']=0;
        $lessons['Türkçe']=0;
        $lessons['Sosyal Bilimler']=0;
        $lessons['Matematik']=0;
        $lessons['Fen Bilimleri']=0;
        $sayisalpuan=0;
        $esitagirlikpuan=0;
        $sozelpuan=0;
        $tytpuan=0;
        $yabancidilpuan=0;
        foreach ($quenstions as $quenstion){


            $doğrucevap=0;
            $yanliscevap=0;
            $boscevap=0;
            $katsayi=0;
            foreach($quenstion as $answer){
                $katsayi=$answer->examquestion->point;
                if($answer->truetype==null){
                    $boscevap=$boscevap+1;
                }elseif($answer->truetype==1){
                    $doğrucevap=$doğrucevap+1;
                    $toplamkatsayi=$toplamkatsayi+$answer->lesson->point;
                    $toplamnet=$toplamnet+1;
                    $lessons[$answer->lesson->lesson_type]=$lessons[$answer->lesson->lesson_type]+1;

                }elseif($answer->truetype==2){
                    $yanliscevap=$yanliscevap+1;
                    if($answers->trialexam->dyType==1) {
                        $toplamnet = $toplamnet - 0.25;
                        $lessons[$answer->lesson->lesson_type]=$lessons[$answer->lesson->lesson_type]- 0.25;
                        $toplamkatsayi = $toplamkatsayi - ($answer->lesson->point / 4);
                    }elseif($answers->trialexam->dyType==2){
                        $toplamnet = $toplamnet - 0.33;
                        $lessons[$answer->lesson->lesson_type]=$lessons[$answer->lesson->lesson_type]- 0.33;
                        $toplamkatsayi = $toplamkatsayi - ($answer->lesson->point / 3);
                    }elseif($answers->trialexam->dyType==3){
                    }

                }
            }

        }

        foreach($lessons as $lesson => $net) {
            if ($net != 0) {
            $dersgetir = Lesson::where('lesson_type', $lesson)->first();
            $sayisalpuan = $sayisalpuan + ($net * $dersgetir->sayisal);
            $esitagirlikpuan = $esitagirlikpuan + ($net * $dersgetir->esitagirlik);
            $sozelpuan = $sozelpuan + ($net * $dersgetir->sozel);
        }

        }

        $sayisalpuan=$answers->trialexam->startpoint+$sayisalpuan;
        $esitagirlikpuan=$answers->trialexam->startpoint+$esitagirlikpuan;
        $sozelpuan=$answers->trialexam->startpoint+$sozelpuan;
        $puanhesapla=$answers->trialexam->startpoint+$toplamkatsayi;
        if($puanhesapla<0){
            $puanhesapla=0;
        }
*/
       $duzenle=Answer::where("id",$id)->where('user_id',Auth::user()->id)->update(['finish_date'=>date('d-m-Y H:i'), 'type'=>'1']);
        return redirect()->route('answer.index');
    }

    function answerresult($id){
        $quenstions=array();
        $lessons=array();
        $answer = Answer::where('id',$id)->first();
        $sinavtype=$answer->trialexam->type;
        $answerss=Answer::where('trialexam_id',$answer->trialexam_id)->orderByRaw("CAST(net as UNSIGNED) DESC")->get();
        $i=0;
        foreach ($answerss as $value) {
        $i++;
        if($value->user_id==$answer->user_id){
            $siralama=$i;
        }

        }
        $dogru=$answerItems = AnswerItem::where('answer_id',$id)->where('truetype','1')->count();
        $baslangiczamani=time();
        $bitiszamani=strtotime($answer->trialexam->finish_date);
        $saniye=$bitiszamani-$baslangiczamani;
        $yanlis=$answerItems = AnswerItem::where('answer_id',$id)->where('truetype','2')->count();
        $bos=$answerItems = AnswerItem::where('answer_id',$id)->where('truetype',null)->count();
        $answerItems = AnswerItem::where('answer_id',$id)->get();
        $i=0;
        foreach ($answerItems as $answerItem ){

            if($i==0){
                $firstquestion=$answerItem;
                $i=$i+1;
            }
            if(!isset($lessons[$answerItem->lesson_id][$answerItem->truetype])){
                $lessons[$answerItem->lesson_id][99]=$answerItem->lesson->name;
                $lessons[$answerItem->lesson_id][98]=$answerItem->lesson_id;
                $lessons[$answerItem->lesson_id][$answerItem->truetype]=0;
            }
            $lessons[$answerItem->lesson_id][$answerItem->truetype]=$lessons[$answerItem->lesson_id][$answerItem->truetype]+1;
            $quenstions[$answerItem->lesson_id][]=$answerItem;
        }
        $next_record = AnswerItem::where('id', '>', $firstquestion->id)->where('answer_id',$id)->orderBy('id')->first();
        if(!isset($next_record)){
            $next_record =AnswerItem::where('answer_id',$id)->orderBy('id')->first();
        }
        $back_record = AnswerItem::where('id', '<', $firstquestion->id)->where('answer_id',$id)->orderBy('id','desc')->first();
        if(!isset($back_record)){
            $back_record =AnswerItem::where('answer_id',$id)->orderBy('id','desc')->first();
        }
        return view('answer.result', compact(['answer','quenstions','firstquestion','next_record','back_record','saniye','sinavtype','dogru','yanlis','bos','lessons','siralama']));
    }

    function answerresults($id)
    {
        $answers=Answer::where('trialexam_id',$id)->orderByRaw("CAST(point as UNSIGNED) DESC")->get();
        $ortnet=Answer::where('trialexam_id',$id)->groupBy('user_id')->orderBy('net','desc')->avg('net');
        $ortpuan=Answer::where('trialexam_id',$id)->groupBy('user_id')->orderBy('net','desc')->avg('point');
        $totalstudents=Answer::where('trialexam_id',$id)->count();

        return view('answer.list', compact(['answers','ortnet','ortpuan','totalstudents']));
    }
    function answerstudentresults(Request $request,$id)
    {

        $type=$request->get('type');
        if(isset($type)){
            $answerid=$request->get('answerId');
            if($type==1){
            notify()->success('İşleminiz başarıyla gerçekleşti','Kullanıcının Sınavı İptal Edildi Tekrar Girebilir');
            $answers=Answer::where('id',$answerid)->delete();
            }
            elseif($type==2){
            notify()->success('İşleminiz başarıyla gerçekleşti','Kullanıcı Sınavına Devam Edebilir');
            $answers=Answer::where('id',$answerid)->update(['type'=>null,'finish_date'=>null]);
            }

        }

        $answers=Answer::where('user_id',$id)->groupBy('trialexam_id')->orderBy('net','desc')->get();
        $ortnet=Answer::where('user_id',$id)->groupBy('trialexam_id')->orderBy('net','desc')->avg('net');
        $ortpuan=Answer::where('user_id',$id)->groupBy('trialexam_id')->orderBy('net','desc')->avg('point');
        $totalstudents=Answer::where('user_id',$id)->count();

        return view('answer.studentList', compact(['answers','ortnet','ortpuan','totalstudents']));
    }
    function answersclassresults($id)
    {
        $students=User::where("class_id",$id)->get();
        $answerss=array();
        $answersTrials=array();
        $totalortnet=0;
        $totalortpuan=0;
        $totalexam=0;
        foreach ($students as $student) {
            $answers = Answer::where('user_id', $student->id)->where('net','!=',null)->orderByRaw("CAST(point as UNSIGNED) DESC")->orderBy('user_id','desc')->get();
            foreach ($answers as $answer) {
                $answerss[]=$answer;
                $answersTrials[$answer->trialexam_id][]=$answer;
            }
            $ortnet = Answer::where('user_id', $student->id)->avg('net');
            $ortpuan = Answer::where('user_id', $student->id)->avg('point');
            $totalstudents = Answer::where('user_id', $student->id)->count();
            if(isset($ortnet)){
                $totalortnet=$totalortnet+$ortnet;
            }
            if(isset($ortpuan)){
                $totalortpuan=$totalortpuan+$ortpuan;
            }
            if(isset($totalstudents)){
                $totalexam=$totalexam+$totalstudents;
            }

        }
        foreach ($answersTrials as $answersTrial){
            $katilankisi=0;
            $toplamnet=0;
            $toplampuan=0;
            foreach ($answersTrial as $answerq) {
                $katilankisi=$katilankisi+1;
                $toplamnet=$toplamnet+$answerq->net;
                $toplampuan=$toplampuan+$answerq->point;
            }
            $answersTrials[$answersTrial[0]->trialexam_id]['katilankisi']=$katilankisi;
            $answersTrials[$answersTrial[0]->trialexam_id]['ornet']=($toplamnet/$katilankisi);
            $answersTrials[$answersTrial[0]->trialexam_id]['ortpuan']=($toplampuan/$katilankisi);
        }

        return view('answer.classList', compact(['answerss','totalortnet','totalortpuan','totalexam','answersTrials']));
    }

    function answersgainsclassresults($id,$class){

        $students=User::where("class_id",$class)->get();
        $answerss=array();
        $gains=array();
        $totalortnet=0;
        $totalortpuan=0;
        $totalexam=0;
        foreach ($students as $student) {
            $answers = Answer::where('user_id', $student->id)->where('trialexam_id',$id)->orderBy('id', 'desc')->get();
            foreach ($answers as $answer) {
                $anwersItems = AnswerItem::where('user_id', $student->id)->where('answer_id',$answer->id)->get();
                foreach ($anwersItems as $anwersItem) {
                   if(!isset($gains[$anwersItem->gain_id])){
                       $gains[$anwersItem->gain_id]['dogru']=0;
                       $gains[$anwersItem->gain_id]['yanlis']=0;
                       $gains[$anwersItem->gain_id]['bos']=0;
                       $gains[$anwersItem->gain_id]['gainID']=$anwersItem->gain_id;
                   }
                    if($anwersItem->truetype=="1") {
                        $gains[$anwersItem->gain_id]['dogru'] = $gains[$anwersItem->gain_id]['dogru'] + 1;
                    }
                    if($anwersItem->truetype=="2") {
                        $gains[$anwersItem->gain_id]['yanlis'] = $gains[$anwersItem->gain_id]['yanlis'] + 1;
                    }
                    if($anwersItem->truetype==null) {
                        $gains[$anwersItem->gain_id]['bos'] = $gains[$anwersItem->gain_id]['bos'] + 1;
                    }
                    }
            }


        }
        return view('answer.classListGains', compact(['gains']));

    }

    function sonuclandir($id){

        $answerss=Answer::where('trialexam_id',$id)->get();
        foreach ($answerss as $answersid) {

        $id=$answersid->id;
        $answers = Answer::where("id",$id)->first();
        $answerItems = AnswerItem::where('answer_id',$id)->get();
        $quenstions=array();
        
        $i=0;
        foreach ($answerItems as $answerItem ){
            if($i==0){
                $firstquestion=$answerItem;
                $i=$i+1;
            }
            $quenstions[$answerItem->lesson_id][]=$answerItem;
        }
        $toplamnet=0;
        $toplamkatsayi=0;
        $lessons=array();
        $lessons['Türkçe']=0;
        $lessons['İngilizce']=0;
        $lessons['Türk Dili ve Edebiyatı']=0;
        $lessons['Tarih-1']=0;
        $lessons['Tarih-2']=0;
        $lessons['Coğrafya']=0;
        $lessons['Coğrafya-2']=0;
        $lessons['Felsefe Grubu']=0;
        $lessons['Din Kültürü ve Ahlak B.']=0;
        $lessons['Matematik']=0;
        $lessons['Fizik']=0;
        $lessons['Biyoloji']=0;
        $lessons['Kimya']=0;
        $lessons['Türkçe']=0;
        $lessons['Sosyal Bilimler']=0;
        $lessons['Matematik']=0;
        $lessons['Fen Bilimleri']=0;
        $sayisalpuan=0;
        $esitagirlikpuan=0;
        $sozelpuan=0;
        $tytpuan=0;
        $yabancidilpuan=0;

        foreach ($quenstions as $quenstion){


            $doğrucevap=0;
            $yanliscevap=0;
            $boscevap=0;
            $katsayi=0;
            foreach($quenstion as $answer){
                $katsayi=$answer->examquestion->point;
                if($answer->truetype==null){
                    $boscevap=$boscevap+1;
                }elseif($answer->truetype==1){
                    $doğrucevap=$doğrucevap+1;
                    $toplamkatsayi=$toplamkatsayi+$answer->lesson->point;
                    $toplamnet=$toplamnet+1;
                    $lessons[$answer->lesson->lesson_type]=$lessons[$answer->lesson->lesson_type]+1;

                }elseif($answer->truetype==2){
                    $yanliscevap=$yanliscevap+1;
                    if($answers->trialexam->dyType==1) {
                        $toplamnet = $toplamnet - 0.25;
                        $lessons[$answer->lesson->lesson_type]=$lessons[$answer->lesson->lesson_type]- 0.25;
                        $toplamkatsayi = $toplamkatsayi - ($answer->lesson->point / 4);
                    }elseif($answers->trialexam->dyType==2){
                        $toplamnet = $toplamnet - 0.33;
                        $lessons[$answer->lesson->lesson_type]=$lessons[$answer->lesson->lesson_type]- 0.33;
                        $toplamkatsayi = $toplamkatsayi - ($answer->lesson->point / 3);
                    }elseif($answers->trialexam->dyType==3){
                    }

                }
            }

        }

        foreach($lessons as $lesson => $net) {
            if ($net != 0) {
            $dersgetir = Lesson::where('lesson_type', $lesson)->first();
            $sayisalpuan = $sayisalpuan + ($net * $dersgetir->sayisal);
            $esitagirlikpuan = $esitagirlikpuan + ($net * $dersgetir->esitagirlik);
            $sozelpuan = $sozelpuan + ($net * $dersgetir->sozel);
        }

        }

        $sayisalpuan=$answers->trialexam->startpoint+$sayisalpuan;
        $esitagirlikpuan=$answers->trialexam->startpoint+$esitagirlikpuan;
        $sozelpuan=$answers->trialexam->startpoint+$sozelpuan;
        $puanhesapla=$answers->trialexam->startpoint+$toplamkatsayi;
        $sayisalpuan=$sayisalpuan+(($sayisalpuan/100)*30);
        $esitagirlikpuan=$esitagirlikpuan+(($esitagirlikpuan/100)*30);
        $sozelpuan=$sozelpuan+(($sozelpuan/100)*30);
        if($puanhesapla<0){
            $puanhesapla=0;
        }
      /*  $say=Answer::where('trialexam_id',7)->where('user_id',$answersid->user_id)->count();
        if($say>=1){
        $getir=Answer::where('trialexam_id',7)->where('user_id',$answersid->user_id)->orderBy('point','desc')->first();
        $sayisalpuan=((($getir->point/100)*30)-53.75)+$sayisalpuan;
        $esitagirlikpuan=((($getir->point/100)*30)-53.75)+$esitagirlikpuan;
        $sozelpuan=((($getir->point/100)*30)-53.75)+$sozelpuan;

        }else{
        $say2=Answer::where('trialexam_id',10)->where('user_id',$answersid->user_id)->count();
        	if($say2>=1){
        $getir=Answer::where('trialexam_id',10)->where('user_id',$answersid->user_id)->orderBy('point','desc')->first();
        $sayisalpuan=((($getir->point/100)*30)-53.75)+$sayisalpuan;
        $esitagirlikpuan=((($getir->point/100)*30)-53.75)+$esitagirlikpuan;
        $sozelpuan=((($getir->point/100)*30)-53.75)+$sozelpuan;
        	}
    	}
*/

       $duzenle=Answer::where("id",$id)->update(['finish_date'=>date('d-m-Y H:i'), 'type'=>'1','net'=>$toplamnet,'point'=>$puanhesapla,'tytpuan'=>$puanhesapla,'aytsayisal'=>$sayisalpuan,'aytesit'=>$esitagirlikpuan,'aytsozel'=>$sozelpuan]);


    }
    return back()->withInput();

}
    function copy($id){

    $trialexam=TrialExam::where('id',$id)->first();

      TrialExam::create([
                        'name' => $trialexam->name .' KOPYALANDI' ?? '',
                        'classNumber' => $trialexam->classNumber ?? '',
                        'startpoint' => $trialexam->startpoint ?? '',
                        'start_date' => $trialexam->start_date ?? '',
                        'finish_date' => $trialexam->finish_date ?? '',
                        'resulttype' => $trialexam->resulttype ?? '',
                        'type' => $trialexam->type ?? '',
                        'dyType' => $trialexam->dyType ?? '',
                        'opticsType' => $trialexam->opticsType ?? '',
                        'trial_type' => $trialexam->trial_type ?? '',
                    ]);

    $ExamQuestions=ExamQuestion::where('trialexam_id',$id)->get();
    $sonid=TrialExam::orderBy('id','desc')->first();

    foreach ($ExamQuestions as $ExamQuestion ){
            ExamQuestion::create([
                        'trialexam_id' => $sonid->id ?? '',
                        'lesson_id' => $ExamQuestion->lesson_id ?? '',
                        'gains_id' => $ExamQuestion->gains_id ?? '',
                        'point' => $ExamQuestion->point ?? '',
                        'image' => $ExamQuestion->image ?? '',
                        'questionstype' => $ExamQuestion->questionstype ?? '',
                        'order' => $ExamQuestion->order ?? '',
                        'trueresult' => $ExamQuestion->trueresult ?? '',
                        'Wquestion' => $ExamQuestion->Wquestion ?? '',
                        'WoptionA' => $ExamQuestion->WoptionA ?? '',
                        'WoptionB' => $ExamQuestion->WoptionB ?? '',
                        'WoptionC' => $ExamQuestion->WoptionC ?? '',
                        'WoptionD' => $ExamQuestion->WoptionD ?? '',
                        'WoptionE' => $ExamQuestion->WoptionE ?? '',
                    ]);
    }
    return back()->withInput();

    }

         function noanswers($id)
    {
        $student=array();
        $notstudent=array();
        $girenstudent=array();
        $trialexam=TrialExam::where('id',$id)->first();
        $classes=Classes::where('number',$trialexam->classNumber)->get();
        $answer=Answer::where('trialexam_id',$id)->get();
      
        foreach ($classes as $value) {
            $students=User::where('class_id',$value->id)->get();
                  foreach ($students as $value2) {
                    $student[$value2->id]=$value2->name;
            }
        }

        foreach ($answer as $value3) {
            $i=0;
               if (in_array($value3->user->name, $student)) {
                                $girenstudent[]=$value3->user->name;
            }else{
            }
       }

        foreach ($student as $value4) {
                 if (in_array($value4, $girenstudent)) {
                    
            }else{
                        $notstudent[]=$value4;

            }

        }




        return view('answer.nolist', compact(['notstudent']));
    }

}
