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
    public function index(Request $request)
    {
        $query = Session::query();
        $search = $request->input('search');

        if($search){
            $query->whereRaw("mentor LIKE '%". $search . "%'");
        }
        $total= $query->count();

        return response()->json([
            'status_code'=>200,
            'status_message'=>'la liste de tous les enregistrements',
            'data'=>Session::all(),
            'total session'=>$total
        ]);
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



public function nombreTotalSession()
{
   
    try {
        
        $totalSession = Session::count();
    
 
    return response()->json([
        'status_code' => 200,
        'status_message' => 'Le nombre total de session',
        'data' => [
            'NombreTotalSession' => $totalSession,
        ]
    ]);
        
    } catch (Exception $e) {
        return response()->json($e);
    }


}

public function archive(Session $session)
{
    $session->update(['archives' => true]);

    return response()->json(['message' => 'les données du session ont été archivés']);
}

public function desarchive(Session $session)
{
    $session->update(['archives' => false]);

    return response()->json(['message' => 'les données du session sont plus archivés']);
}


public function compteSessionNonArchives()
{
    $nombreSessionNonArchives = Session::where('archives', false)->count();

    return response()->json(['nombre_utilisateurs_non_archives' => $nombreSessionNonArchives]);
}


public function compterSessionsArchives()
{
    $nombreSessionsArchives = Session::where('archives', true)->count();

    return response()->json(['nombre_utilisateurs_archives' => $nombreSessionsArchives]);
}
}
    


