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
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="orders" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Order Amount</th>
                                            {{-- <th>Order Status</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            {{-- {@dd($order)} --}}
                                            <tr>
                                                <td>{{ $order['id'] }}</td>
                                                <td>{{ date('F j, Y', strtotime($order['created_at'])) }}</td>
                                                <td>{{ $order['name'] }}</td>
                                                <td>{{ $order['email'] }}</td>
                                                <td>LKR {{ $order['grand_total'] }}.00</td>
                                                {{-- <td>
                                                    @if ($order['order_status'] == 'new')
                                                        <span class="badge badge-primary">New</span>
                                                    @elseif ($order['order_status'] == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($order['order_status'] == 'cancelled')
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @elseif ($order['order_status'] == 'in_process')
                                                        <span class="badge badge-info">In Process</span>
                                                    @elseif ($order['order_status'] == 'delivered')
                                                        <span class="badge badge-success">Delivered</span>
                                                    @elseif ($order['order_status'] == 'paid')
                                                        <span class="badge badge-success">Paid</span>
                                                    @elseif ($order['order_status'] == 'Not Paid')
                                                        <span class="badge badge-success">Not Paid</span>
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <a href="{{ url('admin/orders/' . $order['id']) }}"><i
                                                            class="fas fa-eye"></i></a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    {{-- <a href="javascript:void(0)" class="confirmDelete" record="order" recordid="{{ $order['id'] }}"><i class="fas fa-trash"></i></a> --}}

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script>
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
@endsection
