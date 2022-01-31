<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Exam;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\ExamResultNotification;
use App\Http\Controllers\ExamController;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
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

Route::get('/', function () {
    return view('app.welcome');
});

Route::get('/notification', function () {
    $user = User::find(1);

    return (new CustomVerifyEmail($user))
        ->toMail($user);
});
//
//Route::get('/notification1', function () {
//    $exam = Exam::where('id', 3)->with('user')->first();
//    $data = compact('exam');
//    $pdf = PDF::loadView('pdf.examresultpdf', $data);
//    return (new ExamResultNotification($pdf))
//        ->toMail($exam->user);
//});
//
//Route::get('/testpdf', function () {
////    return view('pdf.examresultpdf');
//    $exam = Exam::where('id', 1)->with('user')->first();
//    $data = compact('exam');
//    return PDF::loadView('pdf.examresultpdf', $data)->stream('teste.pdf');
//});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::middleware(['auth:sanctum'])->get('/dashboard', [ExamController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth:sanctum'])->get('/schedule', function () {
    return view('app.schedule');
})->name('schedule');

Route::middleware(['auth:sanctum'])->get('/check', [ExamController::class, 'check'])->name('check');

Route::middleware(['auth:sanctum'])->get('/do_schedule', [ExamController::class, 'store'])->name('do_schedule');

Route::middleware(['auth:sanctum'])->get('/exams', [ExamController::class, 'exams'])->name('schedule');

Route::middleware(['auth:sanctum'])->get('/admin', [ExamController::class, 'admin'])->name('admin');

Route::middleware(['auth:sanctum'])->post('/do_exam', [ExamController::class, 'doExam'])->name('do_exam');

Route::middleware(['auth:sanctum'])->post('/set_exam_type', [ExamController::class, 'setExamType'])->name('do_exam');

Route::get("/testemail", [ExamController::class, "testeEmail"]);


