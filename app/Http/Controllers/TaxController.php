<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UserExport;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailer;
use DB;
use PDF;
use Excel;


class TaxController extends Controller
{
    public function taxExcelSearch($wholesaleCode) {
        DB::table('users')->paginate(10);
        // {{ $변수s->links() }}
        return response()->json($wholesaleCode,200);
    }

    /** 엑셀 다운로드 
    * https://www.youtube.com/watch?v=CoQa_Iaa320
    * https://stackoverflow.com/questions/75285913/badmethodcallexception-method-illuminate-foundation-applicationshare-does-not
    */
    public function exportToExcel() {
        return Excel::download(new UserExport, 'user-excel.xls');
    }

    /* PDF 다운로드
    * https://www.youtube.com/watch?v=baUslJ_OnnY
    * https://github.com/barryvdh/laravel-dompdf
    * https://www.youtube.com/watch?v=zfZFygg3T6c
    */
    public function exportPdf () {
        $data = ['data1' => '데이타1','data2' => '데이타2'] ;
        $pdf = PDF::loadview('welcome',compact('data'));
        return $pdf->download('home.pdf');   
        //return view('welcome',compact('data'));
    }

    /* 이메일 보내기 (Gmail)
    * https://www.youtube.com/watch?v=TRH5cDOa53w
    * https://www.youtube.com/watch?v=D8CCivAJBLk
    */
    public function eMailSend() {
        $mailData = ['title' =>"subject" ,'body'=>"BODY",'name'=>"JSON"]; 
        Mail::to('받는사람')->send(new Mailer($mailData));
        print "이메일 전송 성공";
    }
    /* 이메일 + PDF
    * MailTrap + PDF : https://www.youtube.com/watch?v=60jEIQ8LtS0
    */
    public function attachSend() {
        $data['email'] = '받는사람';
        $data['title'] = 'TITLE';
        $data['body'] = "CONTENT";
        $pdf = PDF::loadview('welcome',compact('data')); //pdf 스크린샷 view
        $data['pdf'] = $pdf;
        Mail::to($data['email'])->send(new Mailer($data));
        print "메일 + PDF 성공";
    }
}
