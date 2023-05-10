<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request){
        try{
            $data['pin'] = 4;
            $data['type'] = 'number';
            if (isset($request['number_pin'])) {
                $data['pin'] = $request['number_pin'];
            }
            if (isset($request['type'])) {
                $data['type'] = $request['type'];
            }
            $data['setkey'] = $data['pin'] - 1;
            return view('Test.index',compact('data'));
        }catch (\Exception $exception){
            abort(500);
        }
    }
}
