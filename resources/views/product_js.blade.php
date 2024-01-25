<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function(){
            // alert();
            $(document).on('click','.add_product',function(e){
                e.preventDefault();
                var name=$('#name').val();
                var price=$('#price').val();
                // console.log(name+price);

                $.ajax({
                    url: '{{ route("add.product") }}',
                    method: 'post',
                    data: { name: name, price: price },
                    success: function (res) {

                        // console.log('Success:', res);
                        if(res.status=='success')
                        {
                            $('#addModal').hide();
                            $('#showmessage1').show();
                            setTimeout(function () {
                            location.reload();
                        }, 3000);
                        }
                    },
                    error: function (err) {
                        let error = err.responseJSON;
                        $.each(error.errors, function (index, value) {
                            $('#errMsgContainer').append('<span class="text-danger">' + value + '</span>');
                        });
                    }
                });
            });
            // edit_value_form
            $(".update_form").on('click', function(){
                var id= $(this).data('id');
                var name= $(this).data('name');
                var price= $(this).data('price');
                // alert(id+name+price);
                $('#uid').val(id);
                $('#uname').val(name);
                $('#uprice').val(price);

            });
            //update_values
            $(document).on('click','.update_product',function(e){
                e.preventDefault();
                var uid=$('#uid').val();
                var uname=$('#uname').val();
                var uprice=$('#uprice').val();
                // console.log(uid+uname+uprice);
                $.ajax({
                    url: '{{ route("update.product") }}',
                    method: 'post',
                    data: { uid:uid, uname: uname, uprice: uprice },
                    success: function (res) {

                        // console.log('Success:', res);
                        if(res.status=='success')
                        {
                            $('#updateModal').hide();
                            $('.table').load(location.href+' .table');
                            Command: toastr["success"]("Product Updated Successfullly!")

                            toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                            setTimeout(function () {
                            location.reload();
                        }, 3000);
                        }
                    },
                    error: function (error) {
                        console.error('Error:', error);
                        // Handle error, e.g., show an error message
                    }
                });
            });

            //delete_values
            $(document).on('click','.delete_product',function(e){
                e.preventDefault();
                var pro_id= $(this).data('id');
                // alert(pro_id);
                if(confirm('Are you sure you want to delete this product?')){
                        $.ajax({
                        url: '{{ route("delete.product") }}',
                        method: 'post',
                        data: { pro_id:pro_id},
                        success: function (res) {

                            // console.log('Success:', res);
                            if(res.status=='success')
                            {
                                $('.table').load(location.href+' .table');
                                Command: toastr["info"]("Product Deleted!")

                                toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                                }
                                
                            }
                        }
                    });
                }
                
            });

            //pagination
            $(document).on('click','.pagination a', function(e){ 
                e.preventDefault();
            let page = $(this).attr('href').split('page=')[1] 
            product(page)
            })

            function product (page){
            $.ajax({
            url:"/pagination/paginate-data?page="+page,
            success: function(res) {
            $('.table-data').html(res);
            }
            })
            }

            //search function
            $(document).on('keyup',function(e){
                e.preventDefault();
                let search=$('#search').val();
                // console.log(search);

                $.ajax({
                url:'{{ route("search.product") }}', 
                method: 'GET',
                data:{search:search},
                success: function(res) {
                $('.table-data').html(res);
                if(res.status=='nothing found'){
                    $('.table-data').html('<span class="alert alert-danger">'+'Nothing Found'+'</span>');
                }
                }
                });
            })
        });
    </script>