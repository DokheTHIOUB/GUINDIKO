<?php

namespace App\Http\Controllers\Api\articles;

use App\Models\Mentore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MentoreController extends Controller
{
    public function index()
    {
        return response()->json([
            'status_code'=>200,
            'status_message'=>'la liste de tous les enregistrements',
            'data'=>Mentore::all(),
        ]);
    }
}
