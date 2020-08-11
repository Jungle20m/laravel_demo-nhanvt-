<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="css/demo.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <title>Document</title>
    </head>
    <body>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12 mx-auto bg-white rounded shadow">
                    <!-- Fixed header table-->
                    <div class="table-responsive">
                        <table class="table table-fixed" id="zotas_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="col-2">#</th>
                                    <th scope="col" class="col-4">ID</th>
                                    <th scope="col" class="col-6">RESPONSE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($zotas as $index => $zota)
                                    <tr>
                                        <td class="col-2"><strong>{{ $index+1 }}</strong></th>
                                        <td class="col-4">{{ $zota->ID }}</td>
                                        <td class="col-6">{{ $zota->RESPONSE }}</td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                        <form action="" method="" id="zotas-form">
                            <input type="hidden" name="picked_id" id="picked_id_input">
                            <div class="form-group pt-4">
                                <label for="id"><strong>ID</strong></label>
                                <input type="text" name="id" class="form-control" id="id_input">
                                <div id="id_validate"></div>
                            </div>
                            <div class="form-group">
                                <label for="response"><strong>RESPONSE</strong></label>
                                <input type="text" name="response" class="form-control" id="response_input">
                                <div id="response_validate"></div>
                            </div>
                            <button type="" class="btn btn-primary" id="add_btn">Thêm</button>
                            <button type="" class="btn btn-secondary">Sửa</button>
                            <button type="" class="btn btn-danger" id="remove_btn">Xóa</button>
                            
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
        $(document).ready(function(){
            $('#zotas_table tbody tr').on('click', function(){
                var id = $(this).find('td:eq(1)').text()
                var response = $(this).find('td:eq(2)').text()
                $('#picked_id_input').val(id);
                $('#id_input').val(id);
                $('#response_input').val(response);
            });

            $('#add_btn').click(function(e){
                e.preventDefault();
                $.ajax({
                    url: '{{ route("zotas.store") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#zotas-form').serialize(),
                    success: function(data) {
                        if(data.status == 'success'){
                            location.reload();
                        }
                    },
                    error: function(reject){
                        if( reject.status === 422 ) {
                            var errors = $.parseJSON(reject.responseText);
                            alert("error");
                        }
                    }
                })
            });

            $('#remove_btn').click(function(e){
                e.preventDefault();
                $.ajax({
                    url: '{{ route("zotas.destroy") }}',
                    type: 'DELETE',
                    dataType: 'json',
                    data: $('#zotas-form').serialize(),
                    success: function(data) {
                        if(data.status == 'success'){
                            location.reload();
                        }
                    },
                    error: function(reject){
                        if( reject.status === 422 ) {
                            var errors = $.parseJSON(reject.responseText);
                            console.log("error");
                        }
                    }
                })
            });

        });
    </script>



    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>