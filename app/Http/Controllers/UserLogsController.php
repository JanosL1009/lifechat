<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


/**
 * A felhasznalok adatainak logolasa
 */
class UserLogsController extends Controller
{
    
    /*** 
     * Megjelniti a felhasznalok alap adait, név, email és az ip címet.
     * Táblázat lesz.
     * 
     */
    public function UserIpList()
    {
        $useriplist = UserLog::paginate(30);
        return view('UserIpList.index')->with('useriplist',$useriplist);
    }

    public function export()
    {
        $userlog = UserLog::all();

        $csvHeaders = ['ID', 'Név', 'Email cím','Ip cím'];
        $fileName = 'userlog' . date('Ymd') . '.csv';

        $callback = function() use ($userlog, $csvHeaders) {
        $file = fopen('php://output', 'w');

        fputcsv($file, $csvHeaders);

        foreach ($userlog as $log) {
            $user = $log->user;
            $row = [
                $log->id,
                $user->name ?? 'N/A',        
                $user->email ?? 'N/A',       
                $log->ip_address             
            ];

            fputcsv($file, $row); 
        }

        fclose($file);
    };

        return Response::stream($callback, 200, [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ]);
    }
}
