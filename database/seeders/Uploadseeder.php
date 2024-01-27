<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\LazyCollection;

class Uploadseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::disableQueryLog();

        LazyCollection::make(function(){
        $handle = fopen(public_path('application.csv'),'r'); //readpath
        while (($line = fgetcsv($handle, 4096)) != false) {
        $dataString = implode(', ',$line);
        $row = explode(',',$dataString);
        yield $row;
        }
        fclose($handle);
        })
        ->skip(1)
        ->chunk(100)
        ->each(function(LazyCollection $chunk) {
        $records= $chunk->map(function($row) {
        return [
        'name' => $row[1],
        'email' => $row[2],
        'address' => $row[3],
        ];
        })->toArray();

        DB::table('upload')->insert($records);
        });
    }
}
