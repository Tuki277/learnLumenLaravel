<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
  public function sendMail(Request $request) {
    $data = array(
      'msg' => $request->msg
    );

    // Mail::send('contact_email', $data, function($message) {
    //   $message->to('tranhoanghuy091413618@gmail.com')->subject('Test send mail');
    //   $message->from('huybeos2707@gmail.com', 'Hello World');
    // });

    // return response()->json([
    //     "error" => "false",
    //     "message" => "send done"
    // ]);
        for ($i=0; $i < 3; $i++) {
            $string = "Hello " . $i;

            Mail::raw('Hi, welcome user!', function ($message) use($string) {
                $message->from('huybeos2707@gmail.com');

                $message->to('tranhoanghuy091413618@gmail.com')->subject($string);
            });


        }
  }
}

