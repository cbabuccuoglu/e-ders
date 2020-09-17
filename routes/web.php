<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('login/submit','UserController@loginSubmit')->name('user.login.submit');

Route::middleware(['auth'])->group(function () {

  Route::get('/', 'HomeController@index')->name('/');
   Route::resource('class','ClassController');
   Route::resource('lesson','LessonController');
   Route::resource('teacher','TeacherController');
   Route::resource('student','StudentController');
    Route::resource('gains','GainsController');
    Route::resource('trialexam','TrialExamController');
    Route::resource('examquestion','ExamQuestionController');
    Route::resource('answer','AnswerController');
    Route::resource('videos','VideosController');
    Route::resource('guardian','GuardianController');
    Route::resource('noice','NoiceController');

    Route::match(['post','get'],'list/noice','NoiceController@lists')->name('list.noice');
    Route::post('answerfinish','AnswerController@answerfinish')->name('set.answerfinish');
    Route::match(['post','get'],'result/answer/{id}','AnswerController@answerresult')->name('view.answerresult');
    Route::match(['post','get'],'results/answer/{id}','AnswerController@answerresults')->name('list.answerresult');
    Route::match(['post','get'],'results/noanswers/{id}','AnswerController@noanswers')->name('list.noanswers');
    Route::match(['post','get'],'results/students/answer/{id}','AnswerController@answerstudentresults')->name('list.student.answerresult');
    Route::match(['post','get'],'results/class/answer/{id}','AnswerController@answersclassresults')->name('list.class.answerresult');
    Route::match(['post','get'],'results/gains/class/answer/{id}/{class}','AnswerController@answersgainsclassresults')->name('list.class.gains.answerresult');
    Route::match(['post','get'],'import/students/','StudentController@studentimport')->name('import.student');
    Route::match(['post','get'],'import/guardian/','GuardianController@guardianimport')->name('import.guardian');
    Route::match(['post','get'],'imported/students/','StudentController@studentimported')->name('imported.student');
    Route::match(['post','get'],'imported/guardian/','GuardianController@guardianimported')->name('imported.guardian');
    Route::match(['post','get'],'imported/gains/','GainsController@gainsimported')->name('imported.gains');
    Route::match(['post','get'],'watch/videos/{id}','VideosController@watchvideos')->name('watch.videos');
    Route::match(['post','get'],'watch/video/{id}','VideosController@watchvideo')->name('watch.video');
    Route::match(['post','get'],'watch/students/{id}','VideosController@watchvideosstudent')->name('watch.videos.students');
    Route::match(['post','get'],'watchs/guardians','VideosController@watchvideosguardians')->name('watch.videos.guardians');
    Route::match(['post','get'],'finish/answer/{id}','AnswerController@sonuclandir')->name('answer.finish');
    Route::match(['post','get'],'copy/answer/{id}','AnswerController@copy')->name('copy.finish');


    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

});

Route::prefix('ajax/v1')->group(function(){

    Route::get('getGains','GainsController@getIdByGains')->name('get.gains');
    Route::get('getPoints','LessonController@getIdByPoints')->name('get.points');
    Route::get('getQuestions','AnswerController@getIdByQuestion')->name('get.examquestion');
    Route::get('getResultQuestions','AnswerController@getIdByResultQuestion')->name('get.resultexamquestion');
    Route::get('setQuestions','AnswerController@setResultQuestion')->name('set.examquestion');
    Route::get('setVideosWatch','VideosController@setVideosWatch')->name('set.videoswatch');

});

Auth::routes();
