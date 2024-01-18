<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | جدول داده</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('.styleSheets.dataStyle')
    @include('.styleSheets.styleSheets')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include('.navbar.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        @include('.Sidebar.Sidebar')
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        @include('.header.data.ordersData_header')
        <!-- Main content -->

        <form role="form" method="get" action="{{ route('orders.filter') }}">
            <div class="card">
                <div class="card-header bg-light">
                    <a class="btn btn-secondary" data-bs-toggle="collapse" href="#fillters">
                        فیلتر ها
                    </a>
                </div>
            </div>
            <div class="collapse" id="fillters" data-bs-parent="#accordionHead">
                <div class="card-body">
                    <div class="form-control">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="filterTitle"> عنوان سفارش</label>
                                        <input type="text" class="form-control"
                                               id="filterTitle"
                                               name="filterTitle"
                                               placeholder="عنوان سفارش"
                                               @if(isset($_GET['filterTitle']))
                                                   value="{{$_GET['filterTitle']}}"
                                            @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="filterCostumer"> مشتری</label>
                                        <input type="text" class="form-control"
                                               id="filterCostumer"
                                               name="filterCostumer"
                                               placeholder="مشتری"
                                               @if(isset($_GET['filterCostumer']))
                                                   value="{{$_GET['filterCostumer']}}"
                                            @endif>
                                    </div>
                                </div>
                            </div>
                            </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">فیلتر</button>
                        <a href="{{--{{ route('Users_data') }}--}}">
                            <button type="button" class="btn btn-warning">حذف فیلتر ها</button>
                        </a>
                    </div>
                            </div>
                            </div>

        </form>



        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{--<div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>--}}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="container">
                                <table id="Data" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>اسم سفارش</th>
                                        <th>مشتری</th>
                                        <th>لیست محصولات</th>
                                        <th>قیمت کل</th>
                                        <th>ویرایش</th>
                                        <th>حذف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $temp = 0; @endphp
                                    @if(!($orders->isEmpty()))
                                    @foreach ($orders as $order)

                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->title}}</td>
                                            <td> {{$order->user->first_name}}</td>
                                            <td>
                                                <a class="btn" data-bs-toggle="collapse"
                                                   href="#collapseP{{$order->id}}">
                                                    همه محصولات
                                                </a>
                                                <div id="collapseP{{$order->id}}" class="collapse"
                                                     data-bs-parent="#accordion">
                                                    <div class="card-body">
                                                        <table>

                                                            @foreach($order->products as $product)

                                                                <tr>
                                                                    <td>محصول: {{$product->title}}</td>
                                                                    <td>قیمت: {{$product->price}}</td>
                                                                    <td>تعداد: {{$product->pivot->count}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>
                                                <form class="" action="{{route('orders.edit',['id'=>$order->id])}}"
                                                      method="get">
                                                    <button type="submit">
                                                        <i class="fa-regular fa-pen-to-square fa-flip-horizontal"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form class="" action="{{route('orders.destroy',['id'=>$order->id])}}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Are you sure?')">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                    {{--<tfoot>
                                    <tr>
                                        <th>مشتری</th>
                                        <th>فروشنده</th>
                                        <th>توضیحات</th>
                                        <th>لیست محصولات</th>
                                        <th>قیمت کل</th>
                                        <th>بدهی</th>
                                        <th>ویرایش</th>
                                        <th>حذف</th>
                                    </tr>
                                    </tfoot>--}}
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('.footer.main_footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- page script -->

<script>
    $(function () {
        $('#Data').DataTable({
            "language":
                {
                    "paginate":
                        {
                            "next": "بعدی",
                            "previous": "قبلی"
                        },
                    "search": "جست و جو : ",
                },

            "info": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "autoWidth": true
        });
    });
</script>

</body>
</html>
