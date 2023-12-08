<?php

namespace App\Http\Controllers\Api\articles;

use Exception;
use App\Models\Mentore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MentoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Mentore::query();
        $search = $request->input('search');

        if($search){
            $query->whereRaw("nom LIKE '%". $search . "%'");
        }
        $total= $query->count();

        return response()->json([
            'status_code'=>200,
            'status_message'=>'la liste de tous les enregistrements',
            'data'=>Mentore::all(),
            'total mentorés'=>$total
          ]);

    }


    public function nombreTotalMentore()
    {
       
        try {
            
        $totalmentore = Mentore::count();
        
     
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le nombre total de mentorés',
            'data' => [
                'NombreTotalMentore' => $totalmentore,
            ]
        ]);
            
        } catch (Exception $e) {
            return response()->json($e);
        }


    }



    public function archive(Mentore $mentore)
    {
        $mentore->update(['archives' => true]);

        return response()->json(['message' => 'les données du mentoré ont été archivés']);
    }

    public function desarchive(Mentore $mentore)
    {
        $mentore->update(['archives' => false]);

        return response()->json(['message' => 'les données du mentoré sont plus archivés']);
    }





    public function compterUtilisateursNonArchives()
{
    $nombreUtilisateursNonArchives = Mentore::where('archives', false)->count();

    return response()->json(['nombre_utilisateurs_non_archives' => $nombreUtilisateursNonArchives]);
}


public function compterUtilisateursArchives()
{
    $nombreUtilisateursArchives = Mentore::where('archives', true)->count();

    return response()->json(['nombre_utilisateurs_archives' => $nombreUtilisateursArchives]);
}

    
}
