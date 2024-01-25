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