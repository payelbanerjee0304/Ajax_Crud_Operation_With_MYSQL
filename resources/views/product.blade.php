<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <title>ajax_crud</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body{
            background-image:url('img/1.jpg');
            background-size:100%;
        }
        #n1{
            text-align: center;
            color: yellow;
            text-decoration: underline;
            text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
        }
        #t1{
            background-color: #02E3CB;
        
        }
        .csvbtn
        {
            float: right;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h2 id="n1" class="my-3">
                        Laravel AjaxCrud
                    </h2>
                    <div id="showmessage1" class="alert alert-success alert-dismissible" style="display:none">Product Added Successfully</div>
                    
                    <a href="" class="btn btn-info my-3"  data-toggle="modal" data-target="#addModal">Add Product</a>

                    <div class="csvbtn">
                    <a href="{{ route('download.csv') }}" class="btn btn-primary">Download
                    CSV</a>
                    </div>
                    <input type="text" name="search" id="search" class=" mb-3 form-control" placeholder="Search Here...">
                    <div class="table-data">
                    <table class="table table-bordered" id="t1">
                        <thead>
                            <tr>
                            <th scope="col">SL.No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allinfo as $key=>$product)
                            <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <a href="" class="btn btn-success update_form" data-toggle="modal" data-target="#updateModal" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}"><i class="las la-edit"></i></a>
                                <a href="" class="btn btn-danger delete_product"  data-id="{{$product->id}}"><i class="las la-trash-alt"></i></a>
                                
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <div class="row">
	                        {{$allinfo->links()}}
	                    </div>
                    </div>
                </div>
            </div>
        </div>
        @include('add_product_modal')
        @include('update_product_modal')
        @include('product_js')
        {!! Toastr::message() !!}
  </body>
</html>