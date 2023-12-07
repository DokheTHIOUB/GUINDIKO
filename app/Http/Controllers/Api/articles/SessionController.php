<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditSessionRequest;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\CreateEditSessionRequest;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status_code'=>200,
            'status_message'=>'la session a été supprimé',
            'data'=>Session::all(),
        ]);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     /*

            $table->date('date');
            $table->string('lieu');
            $table->string('theme'
    */
    public function store(CreateSessionRequest $request)
    {
        try {
            //code...
       
            $session = new Session();
            
            
            $session->date = $request->date;
            $session->lien_google_meet = $request->lien_google_meet;
            $session->theme =$request->theme;
            $session->save();
            $session->mentore_id = $request->input('mentore_id');
            $session->mentor_id = $request->input('mentor_id');

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la session est enregistré',
                'data'=>$session
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditSessionRequest $request,Session $session )
    {
        try {
        
        $session->date = $request->date;
        $session->lien_google_meet = $request->lien_google_meet;
        $session->theme =$request->theme;
        $session->save();
        $session->mentore_id = $request->input('mentore_id');
        $session->mentor_id = $request->input('mentor_id');

        return response()->json([
            'status_code'=>200,
            'status_message'=>'la session a été modifié',
            'data'=>$session
        ]);
       } catch (Exception $e) {
        return response()->json($e);
    }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {   
        try {
         
        if($session)
        {
            $session->delete();
       
                   
            return response()->json([
                'status_code'=>200,
                'status_message'=>'la session a été supprimé',
                'data'=>$session
            ]);
        }

    } catch (Exception $e) {
        return response()->json($e);
    }
       
}
}
    


