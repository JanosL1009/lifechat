<?php

namespace App\Http\Controllers;

use App\Models\User;
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


    public function searchbyuser(Request $request)
    {
        $query = $request->input('query');
        
        $users = collect(); 

        if ($query) {
            $users = User::with(['latestlog' => function($query) {
                $query->latest(); // Optional: sort by latest log
            }])
            ->where('email', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->orWhere('username', 'like', '%' . $query . '%')
            ->get();
            
        
        }
        return view('UserIpList.Searchbyuser')->with('users',$users);
    }

    public function exportUserData($userId)
    {
        $logs = UserLog::where('user_id', $userId)
            ->orderByDesc('created_at') 
            ->get();

        return $this->exportToCSV($logs);
    }

    public function exportToCSV($logs)
    {
        $csvData = [];
        $csvData[] = ['User ID', 'IP Address', 'Created At']; 

        foreach ($logs as $log) {
            $csvData[] = [
                $log->user_id,
                $log->ip_address,
                $log->created_at->format('Y-m-d H:i:s') 
            ];
        }

        $fileName = 'user_logs_' . now()->format('Y_m_d_H_i_s') . '.csv';
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $handle = fopen('php://output', 'w');
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
