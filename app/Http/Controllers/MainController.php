<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    public function display():View
    {
        $data=DB::table('pracproducts')->paginate(4);
        return view('product')->with(['allinfo'=>$data]);
    }
    
    public function addproduct(Request $request) {
    //     $request->validate([
    //         name=>'required',
    //         price=>'required'
    //     ],
    // );
    // echo $request->name;
        $name=$request->input('name');
        $price=$request->input('price');
            $data=[
                'name'=>$name,
                'price'=>$price,
            ];
            DB::table('pracproducts')->insert($data);
            return response()->json([
                'status'=>'success',
            ]);
    }

    public function updateproduct(Request $request) {
            $id= $request->input('uid');
            $name=$request->input('uname');
            $price=$request->input('uprice');
                $data=[
                    'name'=>$name,
                    'price'=>$price,
                ];
                DB::table('pracproducts')->where('id','=',$id)->update($data);
                return response()->json([
                    'status'=>'success',
                ]);
    }

    public function deleteproduct(Request $request)
    {
        $userid=$request->input('pro_id');
        DB::table('pracproducts')->where('id','=',$userid)->delete();
        return response()->json([
            'status'=>'success',
        ]);
    }

    public function pagination (Request $request) {
        $data=DB::table('pracproducts')->paginate(4);
        return view('pagination_product')->with(['allinfo'=>$data])->render();
    }

    //search product
    public function searchproduct (Request $request) {
        $search= $request->input('search');
        $products = DB::table('pracproducts')->where('name', 'like', '%'.$search.'%')
        ->orWhere('price', 'like', '%'.$search. '%')->paginate(4);
        // echo $products;die;

        if($products->count()>=1)
        {
            // echo $products;die;

            return view('pagination_product')->with(['allinfo'=>$products])->render();
        }else{
            return response()->json([
                'status'=>'nothing found',
            ]);
        }
    }

    public function generateCsv(){
        $data = DB::table('pracproducts')->get();
        $filename = "application.csv";
        $fp=fopen($filename, "w+");
        fputcsv($fp, array('Id', 'Product Name', 'Product Price'));
        foreach($data as $row) {
        fputcsv($fp, array($row->id, $row->name, $row->price));
        }
        fclose($fp);
        $headers = array('Content-Type' => 'text/csv');
        return response()->download($filename, 'application.csv', $headers);
    }
}
