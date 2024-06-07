@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Order No. {{ $orderDetails['id'] }} Detail</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight: 700">Order Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Order No.</td>
                                            <td>{{ $orderDetails['id'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Order Status</td>
                                            <td>{{ $orderDetails['order_status'] }} </td>
                                        </tr>
                                        <tr>
                                            <td>Order Total (LKR)</td>
                                            <td>LKR {{ number_format($orderDetails['grand_total'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Delivary Charges (LKR)</td>
                                            <td>{{ number_format($orderDetails['delivery_charges'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td>{{ $orderDetails['payment_method'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight: 700">Customer Details</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Customer No.</td>
                                            <td>{{ $orderDetails['user_id'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>{{ $orderDetails['name'] }} </td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $orderDetails['address'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td>{{ $orderDetails['city'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $orderDetails['email'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone 1</td>
                                            <td>{{ $orderDetails['mobile_1'] }}</td> 
                                        </tr>
                                        <tr>
                                          <td>Phone 2</td>
                                          <td>{{ $orderDetails['mobile_2'] }}</td> 
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title" style="font-weight: 700">Products Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Image</th>
                                                <th>Product Code</th>
                                                <th>Name</th>
                                                <th style="width: 40px">Size</th>
                                                <th>Quantity</th>
                                                <th>Product Price</th>
                                                <th>Finale Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderDetails['order_products'] as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}.</td>
                                                    <td><a href="{{ url('product/' . $item['product']['id']) }}">
                                                            <img src="{{ asset('front/images/products/' . $item['product']['product_image']) }}"
                                                                data-src="{{ asset('front/images/products/' . $item['product']['product_image']) }}"
                                                                class="lazy-image" width="75" height="100"
                                                                alt="Product Image">
                                                        </a></td>
                                                    <td>{{ $item['product']['product_code'] }}</td>
                                                    <td>
                                                        {{ $item['product_name'] }}
                                                    </td>
                                                    <td><span class="badge bg-danger">{{ $item['product_size'] }}</span>
                                                    </td>
                                                    <td style="text-align: center">
                                                        {{ $item['product_qty'] }}
                                                    </td>
                                                    <td>LKR {{ number_format($item['product_price'], 2) }}</td>
                                                    <td>LKR {{ number_format($item['product']['final_price'], 2) }}</td>
                                                    <td>LKR {{ number_format($item['product']['final_price'] * $item['product_qty'], 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                      
                    </div>
                   
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <!-- /.content -->
    </div>
@endsection

<!-- @section('scripts')
    -->
    <!-- <script>
        // Script to update order status
        $(document).ready(function() {
            $(".updateBannerStatus").click(function() {
                var status = $(this).children("i").attr("status");
                var banner_id = $(this).attr("banner_id");
                $.ajax({
                    type: 'post',
                    url: '/admin/update-order-status',
                    data: {
                        status: status,
                        banner_id: banner_id
                    },
                    success: function(resp) {
                        if (resp['status'] == 0) {
                            $("#order-" + banner_id).html(
                                "<i class='fas fa-toggle-off' status='Inactive'></i>");
                        } else if (resp['status'] == 1) {
                            $("#order-" + banner_id).html(
                                "<i class='fas fa-toggle-on' status='Active'></i>");
                        }
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            });

            // Script to confirm deletion of order
            $(".confirmDelete").click(function() {
                var record = $(this).attr("record");
                var recordid = $(this).attr("recordid");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/admin/delete-" + record + "/" + recordid;
                    }
                });
            });
        });
    </script>
@endsection -->
