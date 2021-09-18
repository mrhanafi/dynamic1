<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Add/Remove Multiple Input Fields Example</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .container {
            max-width: 600px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="{{ url('store-input-fields') }}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td><input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter subject" class="form-control" />
                    </td>
                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Subject</button></td>
                </tr>
            </table>
            <button type="submit" class="btn btn-outline-success btn-block">Save</button>
        </form>
        <input type="number" name="estimated_ammount" id="estimated_ammount" class="form-control estimated_ammount" value="0" readonly>

    </div>
</body>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    var $arrLegal = [
                {id:0, catid:1, name: 'Professional Fee - Sale and Purchase Agreement',price:4300},
                {id:1, catid:1, name: 'Real Properties Gain Tax - CKHT Form 2A',price:300},
                {id:2, catid:1, name: 'Memorandum of Transfer',price:300},
                {id:3, catid:1, name: 'Consent of Transfer - Land Office & LPHS',price:300},
                {id:4, catid:1, name: 'Statutory Declaration',price:100},
            ];

    $(document).ready(function() {
        for(a=0;a<$arrLegal.length;a++)
            {
                
                $("#dynamicAddRemove").append('<tr>'+
                // '<td><input type="text" class="" </td>'+
                '<td><input type="text" id="'+i+'" name="addMoreInputFields[' + i +
                '][subject]" placeholder="Enter subject" class="form-control testVal" value="'+$arrLegal[i].price+'"/></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
                );
                ++i;
            }
            legalTotal()
            $(".testVal").change(function(){
                var value = $(this).val();
                var id = $(this).attr('id');
                $arrLegal[id].price = value;
                console.log($arrLegal[id].price);
                legalTotal()
            });
    });
    $("#dynamic-ar").click(function () {
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" id="addMoreInputFields[] name="addMoreInputFields[' + i +
            '][subject]" placeholder="Enter subject" class="form-control testVal1" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
        // console.log('test');
    });


    

//     $(".testVal").on('change', function(e){
//     console.log('test');
// });

function legalTotal() {
                var sum = 0;
                // $('.price').each(function(){
                //     var value = $(this).val();
                    //  var discount = $('#discount').val();
                    
                    //  var price_after_discount = parseFloat(value) - parseFloat(discount);
                    for(var q=0;q<$arrLegal.length;q++){
                sum += parseFloat($arrLegal[q].price);
                }
                $('#estimated_ammount').val(sum.toFixed(2));
                // });
                
            }

    function total_ammount_price() {
           var sum = 0;
           $('.addMoreInputFields').each(function(){
             var value = $(this).val();
            //  var discount = $('#discount').val();
            console.log(value);
            //  var price_after_discount = parseFloat(value) - parseFloat(discount);
            //  if(value.length != 0)
            //  {
            //    sum += parseFloat(value);
            //  }
            //  console.log(toWordsconver(sum));
           });
           $('#estimated_ammount').val(sum.toFixed(2));
         }
</script>
</html>