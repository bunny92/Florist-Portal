<?php $this->load->view('header') ?>
<style>
#luggage_expenses-error, #stock_out_date-error{
    color:red;
}
</style>
<div class="wrapper">
    <?php $this->load->view('navbar') ?>
    <div class="main-panel">
        <?php $this->load->view('topnav') ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="green">
                                <i class="material-icons">assignment</i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">Orders List</h4>
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div class="material-datatables">
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>Customer</th> 
                                                <th>Phone</th>
                                                <th>Pin code</th>
                                                <th>Total Price</th>
                                                <!--<th>Total +Bal</th>-->
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th>Paid on</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            foreach ($orders as $value) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-warning btn-raised btn-round view_model" id="<?php echo $value->record_id ?>">
                                                            Orders
                                                        </a>
                                                         <a href="#" class="btn btn-sm btn-info btn-raised btn-round edit_model" id="<?php echo $value->record_id ?>">
                                                                Edit
                                                            </a>
                                                        <!--                                                        <a href="#" onclick="sendInvoice()" class="btn btn-sm btn-info btn-raised btn-round">
                                                                                                                    Send Invoice
                                                                                                                    <input type="hidden" value="<?php echo $value->record_id ?>" id="record_id">
                                                                                                                    <input type="hidden" value="<?php echo $value->customer_email ?>" id="customer_email">
                                                                                                                </a>-->
                                                                                                            </td>
                                                                                                            <td><?= $value->first_name . ' ' . $value->last_name ?></td>
                                                                                                            <td><?= $value->customer_phone ?></td>
                                                                                                            <td><?= $value->customer_pincode ?></td>
                                                                                                            <td class="total"><?= $value->product_price ?></td>
                                                                                                            <td><?= $value->paid_amount ?></td>
                                                                                                            <td class="balance"><?= $value->balance_amount ?></td>
                                                                                                            <td><?= date("d-m-Y",strtotime($value->paid_date)) ?></td>

                                                                                                        </tr>
                                                                                                    <?php } ?>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <!--Start Model-->
                                                                                <div class="modal fade" id="orders_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                                                    <i class="material-icons">clear</i>
                                                                                                </button>
                                                                                                <h4 class="modal-title text-center text-warning">Ordered Flowers</h4>
                                                                                            </div>
                                                                                            <div class="modal-body" id="order_detail">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="modal fade" id="edit_orders_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                                                    <i class="material-icons">clear</i>
                                                                                                </button>
                                                                                                <h4 class="modal-title text-center text-warning">Modify Order</h4>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="material-datatables">
                                                                                                    <form action="<?php echo base_url()?>product/ajax_updateOrderQunatity" method="POST">
                                                                                                    <table class="table table-no-bordered" id="table_del" cellspacing="0" width="100%" style="width:100%">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th>Id</th>
                                                                                                                <th>Flower Name</th> 
                                                                                                                <th>Flower Price</th>
                                                                                                                <th>Quantity</th>
                                                                                                                <th>Total Price</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody id="edit_order_detail">

                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <center>
                                                                                                       <button type="submit" id="updateGroup-submit" class="btn btn-finish btn-fill btn-danger">Modify</button>
                                                                                                    </center>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="modal fade" id="pay_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                                                        <i class="material-icons">clear</i>
                                                                                                    </button>
                                                                                                    <h4 class="modal-title text-center text-warning text-uppercase">Customer balance amount</h4>
                                                                                                </div>
                                                                                                <div class="modal-body" id="pay_detail">

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--End Model-->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </body>
                                                        <?php $this->load->view('footer') ?>
                                                        <script type="text/javascript">

                                                            $(".product").addClass('active');
                                                            $(".viewProduct").addClass('active');
                                                            $(".navbar-brand").append("List of Orders");
                                                            $(document).ready(function () {

                                                                $('#datatables').DataTable({
                                                                    "pagingType": "full_numbers",
                                                                    "lengthMenu": [
                                                                    [10, 25, 50, -1],
                                                                    [10, 25, 50, "All"]
                                                                    ],
                                                                    responsive: true,
                                                                    language: {
                                                                        search: "_INPUT_",
                                                                        searchPlaceholder: "Search records",
                                                                    }

                                                                });
                                                                $('#datatables tbody').on('click', '.view_model', function () {
                                                                    var record_id = $(this).attr("id");
                                                                    
                                                                    $.ajax({
                                                                        url: baseurl + "product/ajax_viewOrdersById",
                                                                        method: "post",
                                                                        data: {record_id: record_id},
                                                                        success: function (data) {
                                                                            $('#order_detail').html(data);
                                                                            $('#orders_model').modal("show");
                                                                        }
                                                                    });
                                                                });

                                                                $('#datatables tbody').on('click', '.edit_model', function () {
                                                                    
                                                                    var record_id = $(this).attr("id");
                                                                     if ($(".editOrder").length) {
                                                                         $(".editOrder").remove();
                                                                     }
                                                                    $.ajax({
                                                                        url: baseurl + "product/ajax_viewOrdersdataById",
                                                                        method: "post",
                                                                        data: {record_id: record_id},
                                                                        success: function (data) {
                                                                            var jsonobj = JSON.parse(data);
                                                                            console.log(data);
                                                                            $('#edit_orders_model').modal("show");

                                                                            var htmlText = '';
                                                                            var index = 1;
                                                                            var total_price = 0;
                                                                            for (var key in jsonobj) {
                                                                                for(var jsondata in jsonobj[key]){
                                                                                   var order_id = jsonobj[key][jsondata]['id'];
                                                                                   var customer_id =  jsonobj[key][jsondata]['customer_id'];
                                                                                   var flower_id =    jsonobj[key][jsondata]['flower_id'];
                                                                                   var flower_name =  jsonobj[key][jsondata]['flower_name'];
                                                                                   var flower_price = jsonobj[key][jsondata]['flower_price'];
                                                                                   var quantity =     jsonobj[key][jsondata]['quantity'];
                                                                                   var total =        jsonobj[key][jsondata]['total_price'];
                                                                                   htmlText += '<tr class="editOrder"><td>' + index++ + '</td><td>' + flower_name + '</td><td><input type="text" name="flower_price[]" onblur="Javascript: changeQuantity('+ flower_id +');" value="'+ flower_price+'" id="edit_flower_price_'+flower_id+'"  class="form-control"></td>';
                                                                                   htmlText += '<td><input type="hidden" name="record_id" value="'+ record_id +'"><input type="hidden" name="customer_id" value="'+ customer_id +'"><input type="hidden" name="order_id[]" value="'+ order_id +'"><input type="text" name="quantity[]" value="'+ quantity+'" id="edit_quantity_'+flower_id+'" onblur="Javascript: changeQuantity('+flower_id+');"  class="form-control"></td>';
                                                                                   htmlText += '<td id="totalprice_'+flower_id+'">'+total+'</td></tr>';
                                                              
                                                                                }
                                                                               
                                                                            }
                                                                            // htmlText += '<tr class="editOrder"><td style="border: none;"><td style="border: none;"></td><td style="border: none;"></td><td class="text-warining">Total Price</td><td id="total_price"><b>' +total_price+ '</b></td></tr>';
      
                                                                            $('#edit_order_detail').append(htmlText);
                                                                        }
                                                                    });
                                                                });

                                                                window.switchModal = function (record_id) {
                                                                    $('#orders_model').modal('hide');
                                                                    setTimeout(function () {
                                                                        $.ajax({
                                                                            url: baseurl + "product/ajax_updatePayment",
                                                                            method: "post",
                                                                            data: {record_id: record_id},
                                                                            success: function (data) {
                                                                                $('#pay_detail').html(data);
                                                                                $('#pay_model').modal("show");
                                                                            }
                                                                        });
                                                                    }, 500);
            // the setTimeout avoid all problems with scrollbars
        };
    });
function sendInvoice() {
    var record_id = document.getElementById("record_id").value;
    var customer_email = document.getElementById("customer_email").value;
    $.ajax({
        url: baseurl + "product/sendInvoiceEmail",
        method: "post",
        data: {customer_email: customer_email, record_id: record_id},
        success: function (data) {
            if (data == 'success') {
                notifications('Greate.!', 'Invoice sent successfully', 'success');
            } else {
                notifications('Oops..!', 'Somthing went wrong, while sending Invoice', 'danger');
            }
        }
    });
}
function changeQuantity(flowerId) {
   var quantity =  $('#edit_quantity_' + flowerId).val();
   var flower_price =  $('#edit_flower_price_' + flowerId).val();
   var product  = (quantity * flower_price);
  document.getElementById('totalprice_' + flowerId).innerHTML = product;
}

function checkPaidAmount() {
    var balance_payment = document.getElementById("balance_payment").value;
    var balance_amount = document.getElementById("balance_amount").value;
    if (balance_payment > balance_amount) {
        document.getElementById("pay-submit").disabled = true;
        notifications('Alert..!', 'Paid amount shouldn`t be greater than Balance price', 'danger');
    } else {
        document.getElementById("pay-submit").disabled = false;
    }
}

function notifications(title, message, type) {
    $.notify({
        icon: "notifications",
        title: title,
        message: message

    }, {
        type: type,
        timer: 1000,
        placement: {
            from: 'bottom',
            align: 'center'
        }
    });
}

    //  var sum = $('.total').text();
    //  $('tr').find('.balance').each(function () {
    //      var bal = $(this).text();
    //      if (!isNaN(bal) && bal.length !== 0) {
    //          sum += parseFloat(bal);
    //      }
    //  });

    //  $('.total-bal').html(sum);

    function updatePaymentForm() {
        var data = $("#pay-form").serialize();
        $.ajax({
            type: "POST",
            url: baseurl + "product/ajax_updateOrderPayment",
            data: data,
            beforeSend: function () {
                $("#error").fadeOut();
                $("#pay-submit").html(
                    '<span class="glyphicon glyphicon-transfer"></span> &nbsp; updating ...'
                    );
            },
            success: function (response) {
                console.log(response);
                if (response = 'success') {
                    console.log("Payment added Success..!");
                    $("#pay-submit").html("Updating ...");
                    swal({
                        title: "Good job!",
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-success",
                        type: "success",
                        html: '<b class="text-success">Payement got updated</b><br/><a class="btn btn-round btn-warning" href=' + baseurl + 'product/printInvoice/' + response + '><i class="fa fa-print"></i>&nbsp; Invoice</a> &nbsp; <a class="btn btn-round btn-info" href=' + baseurl + 'product/autoPrintInvoice/' + response + '><i class="fa fa-print"></i>&nbsp; Print Invoice</a>'
                    }).then(function () {
                        location.reload();
                    }
                    );

                } else if (response = 'required') {
                    document.getElementById("pay-submit").disabled = true;
                    $("#pay-submit").html('Pay');
                    notifications('Alert..!', 'Minimum amount should be paid', 'danger');
                } else {
                    $("#error").html(response).show();
                }
            }
        });
        return false;
    }
</script>
</html>