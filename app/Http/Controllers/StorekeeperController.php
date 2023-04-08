<?php

namespace App\Http\Controllers;

use App\Models\WaitingDriver;
use Illuminate\Http\Request;

class StorekeeperController extends Controller
{
    public function index(){
        if ($drivers = WaitingDriver::all()){
            return response()->json(['data' => [
                'code' => 200,
                'message' => 'Все машины',
                'drivers' => $drivers
            ]], 200);
        }
    }
}
