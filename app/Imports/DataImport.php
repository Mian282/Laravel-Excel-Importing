<?php

namespace App\Imports;
use App\Models\File;
use App\Models\FileColumn;
use App\Models\FileData;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class DataImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {

        $file = File::create([
            'name' =>'file'.time(),
        ]);

         $coumnnames = $collection[0];
         $collection->forget(0);   
         $headerkeys = array();
        foreach ($coumnnames as $singlecolumnname) 
        {
            $filecloumn = FileColumn::create([
                'file_id'=> $file->id,
                'name' => $singlecolumnname,
            ]);
            array_push($headerkeys, $filecloumn->id);
        }
        foreach($collection as $data){
            foreach($data as $key => $singledata){
                FileData::create([
                    'column_id'=> $headerkeys[$key],
                    'data' => $singledata,
                ]);
            }
        }
     }
    }
