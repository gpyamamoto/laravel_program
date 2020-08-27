<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index () 
    {
        $pref = config('formapp.pref-env');
        return view('index', compact('pref'));
    }
    public function confirm (Request $request) 
    {

        $validator = Validator::make($request->all(), [
            'name_sei' => 'required|max:10',
            'name_mei' => 'required|max:10',
            'kana_sei' => 'required|max:10|regex:/^[ァ-ヶ 　]+$/u',
            'kana_mei' => 'required|max:10|regex:/^[ァ-ヶ 　]+$/u',

        ]);

        if ($validator->fails()) {
            return redirect('/form')
                        ->withErrors($validator)
                        ->withInput();
        }

        $inputs = $request->all();
        return view('confirm', compact('inputs'));
    }
    public function complete () 
    {
        $hello = 'Hello,World!';
        $hello_array = ['Hello', 'こんにちは', 'ニーハオ'];

        return view('complete', compact('hello', 'hello_array'));
    }
}
