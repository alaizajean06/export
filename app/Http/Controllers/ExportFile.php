<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;

class ExportFile extends Controller
{
    public static function export(Request $request) {
        $users = DB::table('users') ->get();
        $filename = "users-masterlist.csv";

        $header = [
            'Content-Type' => 'test/csv',
            'Content-Disposition' => 'attachement; filename = " '.$filename.'"'
        ];


        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['fname', 'Lname', 'Age']);

        foreach($users as $user) {
            fputcsv($handle,  [$user->fname, $user->lname, $user->age]);
        }

        fclose($handle);

        return Response::make('', 200, $header);

    }
}
