<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    //
    public function upload(Request $request){
        $request->validate([
            'file'=> 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');

        $data = Excel::import(new DataImport,$file);
        return redirect()->back()->with('success', 'Data Upload Successfully');
    }
}
