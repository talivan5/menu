<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Illuminate\Http\Request;
use App\Helpers\UserSystemInfoHelper;
class UserSystemInfoController extends Controller
{
    function index()
    {
        $getip = UserSystemInfoHelper::get_ip();
        $getbrowser = UserSystemInfoHelper::get_browsers();
        $getdevice = UserSystemInfoHelper::get_device();
        $getos = UserSystemInfoHelper::get_os();

        $response = [
            'status' => true,
            'response' => array([
                'ip'=>$getip,
                'browser'=>$getbrowser,
                'nomuser'=>$getdevice,
                'os'=>$getos
            ])
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        Bitacora::create([
            'ip'=> $request->ip,
            'browser'=> $request->browser,
            'nomuser'=>$request->nomuser,
            'os'=>$request->os
        ]);

        return response()->json([
                'status' => false,
                'slug' => 'DATA_CANNOT_BE_SAVED'
            ], 500);
    }

    public function listar(){
        return view('bitacora.index');
    }
}
