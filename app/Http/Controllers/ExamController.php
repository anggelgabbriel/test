<?php

namespace App\Http\Controllers;

use App\Mail\ExamResultMail;
use App\Models\Exam;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ExamResultNotification;

class ExamController extends Controller
{
    public function store(Request $request)
    {

        $schedule = Exam::create([
            'user_id' => Auth::id(),
            'date' => $request->date
        ]);

        return json_encode($schedule);
    }

    public function exams()
    {
        $marked = Exam::whereNull('type')->with('user')->get();
        $waiting = Exam::where('type', -1)->with('user')->get();
        $finalized = Exam::whereIn('type', [0, 1, 2])->with('user')->get();
        return json_encode(['marked' => $marked, 'waiting' => $waiting, 'finalized' => $finalized]);
    }

    public function doExam(Request $request)
    {
        $exam = Exam::where('id', $request->id)->with('user')->first();
        $exam->type = -1;
        $exam->save();
        return json_encode($exam);
    }

    public function testeEmail()
    {

        $exam = Exam::where('id', 1)->first();

        $pdf = PDF::loadView('pdf.examresultpdf');
        $exam->user->sendExam($pdf);
//        $exam->sendExam();
//        error_log("awqui");
//        $pdf = PDF::loadView('pdf.examresultpdf');
//        $to_email = "angel@gmail.com";
//        Mail::to($to_email)->send(new ExamResultMail($pdf));


        return response()->json(['status' => 'success', 'message' => 'Report has been sent successfully.']);
    }

    public function setExamType(Request $request)
    {
        $exam = Exam::where('id', $request->id)->with('user')->first();
        $exam->type = $request->type;
        $exam->save();
        $data = compact('exam');

        $pdf = PDF::loadView('pdf.examresultpdf', $data);
        $exam->user->sendExam($pdf);

        return json_encode($exam);
    }

    public function dashboard()
    {
        $user = Auth::user();

        $exam = Exam::where('user_id', Auth::id())->first();
        if ($user->isadmin) {
            return redirect('/admin');
        } else {
            return view('app.dashboard', ['exam' => $exam]);
        }
    }

    public function check()
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $user_name = $user->first_name;
        $exam = Exam::where('user_id', Auth::id())->first();

        if ($exam == null) {
            return redirect('/dashboard')->with('msg', 'Você não possui exames agendados');
        }

        $all = Exam::whereNotNull('type')->count();
        $covid = Exam::where('type', 1)->count();
        $delta = Exam::where('type', 2)->count();

        return view('app.check',
            [
                'exam' => $exam,
                'user' => Auth::user(),
                'user_name' => $user_name,
                'covid' => $covid,
                'delta' => $delta,
                'all' => $all
            ]
        );
    }

    public function admin()
    {
        if (Gate::allows('is-admin')) {
            return view('app.admin');
        } else {
            abort(403);
        }
    }

}
