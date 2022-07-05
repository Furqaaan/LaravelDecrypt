<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function index() {
        return view('home.index');
    }

    public function decryptText() {
        $encodedText = Request::get('encodedText');
        $errResponse = [];

        try {
           return Crypt::decrypt($encodedText);
        }catch (\Exception $e) {
            $errResponse["code"] = 0;
            return $errResponse;
        }
    }

    public function encryptText() {
        $decodedText = Request::get('decodedText');
        $errResponse = [];

        try {
           return Crypt::encrypt($decodedText);
        }catch (\Exception $e) {
            $errResponse["code"] = 0;
            return $errResponse;
        }
    }
}
