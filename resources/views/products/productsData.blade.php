@php use Illuminate\Support\Facades\Storage; @endphp
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

        @include('.header.data.productsData_header')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="accordionHead">
                                <!-- SEARCH FORM -->
                                <form class="form-inline ml-3" method="get" action="{{route('product.search')}}">
                                    <div class="input-group input-group-sm">
                                        <input class="form-control form-control-navbar"  name="productSearch" type="search" placeholder="جستجو" aria-label="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-navbar" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>

                                        </div>
                                    </div>
                                </form>

                                <form role="form" method="get" action="{{ route('products.filter') }}">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <a class="btn btn-secondary" data-bs-toggle="collapse" href="#fillters">
                                                فیلتر ها
                                            </a>
                                        </div>
                                        <div class="collapse" id="fillters" data-bs-parent="#accordionHead">
                                            <div class="card-body">
                                                <div class="form-control">
                                                    @if(auth()->user()->role == 'admin')
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="filterEmail"> ایمیل فروشنده</label>
                                                                    <input type="text" class="form-control"
                                                                           id="filterEmail"
                                                                           name="filterEmail"
                                                                           placeholder="email"
                                                                           @if(isset($_GET['filterEmail']))
                                                                               value="{{$_GET['filterEmail']}}"
                                                                        @endif>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="filterFirstName">نام فروشنده</label>
                                                                    <input type="text" class="form-control"
                                                                           id="filterFirstName"
                                                                           name="filterFirstName" placeholder="نام"
                                                                           @if(isset($_GET['filterFirstName']))
                                                                               value="{{$_GET['filterFirstName']}}"
                                                                        @endif>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="filterLastName">نام خانوادگی فروشنده</label>
                                                                    <input type="text" class="form-control"
                                                                           id="filterLastName"
                                                                           name="filterLastName"
                                                                           placeholder="نام خانوادگی"
                                                                           @if(isset($_GET['filterLastName']))
                                                                               value="{{$_GET['filterLastName']}}"
                                                                        @endif>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="filterProductName">نام کالا</label>
                                                                <input type="text" class="form-control"
                                                                       id="filterProductName"
                                                                       name="filterProductName"
                                                                       placeholder="نام کاربری"
                                                                       @if(isset($_GET['filterProductName']))
                                                                           value="{{$_GET['filterProductName']}}"
                                                                    @endif>
                                                            </div>

                                                            <div class="col">
                                                                <div class="row">

                                                                    <div class="col">
                                                                        <label for="filterPrice">قیمت</label>
                                                                        <label for="filterPriceMin"
                                                                               id="filterPriceMin">از</label>
                                                                        <input type="number" class="form-control"
                                                                               id="filterPriceMin" name="filterPriceMin"
                                                                               placeholder="از"
                                                                               @if(isset($_GET['filterPriceMin']))
                                                                                   value="{{$_GET['filterPriceMin']}}"
                                                                            @endif>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="filterPriceMax">تا</label>
                                                                        <input type="number" class="form-control"
                                                                               id="filterPriceMax" name="filterPriceMax"
                                                                               placeholder="تا"
                                                                               @if(isset($_GET['filterPriceMax']))
                                                                                   value="{{$_GET['filterPriceMax']}}"
                                                                            @endif>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="row">

                                                                    <div class="col">
                                                                        <label for="filterInventory ">موجودی</label>
                                                                        <label for="filterInventoryMin"
                                                                               id="filterInventoryMin">از</label>
                                                                        <input type="number" class="form-control"
                                                                               id="filterInventoryMin"
                                                                               name="filterInventoryMin"
                                                                               placeholder="از"
                                                                               @if(isset($_GET['filterInventoryMin']))
                                                                                   value="{{$_GET['filterInventoryMin']}}"
                                                                            @endif>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="filterInventoryMax">تا</label>
                                                                        <input type="number" class="form-control"
                                                                               id="filterInventoryMax"
                                                                               name="filterInventoryMax"
                                                                               placeholder="تا"
                                                                               @if(isset($_GET['filterInventoryMax']))
                                                                                   value="{{$_GET['filterInventoryMax']}}"
                                                                            @endif>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="filterDescription">توضیحات</label>
                                                                <textarea class="form-control" placeholder="توضیحات"
                                                                          name="filterDescription"
                                                                          id="filterDescription" cols="30"
                                                                          rows="4">
                                                                    @if(isset($_GET['filterDescription']))
                                                                        {{$_GET['filterDescription']}}
                                                                    @endif
                                                                </textarea>
                                                            </div>
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
                            </div>

                            <table id="Data" class="table table-bordered table-striped table table-hover">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>نام کالا</th>
                                    <th>فروشنده</th>
                                    <th>قیمت</th>
                                    <th>موجودی</th>
                                    <th>توضیحات</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($temp = 0)
                                @foreach ($products as $product)
                                    @if($product->status == 'enable')
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->user->first_name.' '.$product->user->last_name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->inventory }}</td>
                                            <td>{{ $product->description }}</td>

                                            <td>
                                                <form action="{{ route('products.edit', ['id' => $product->id]) }}"
                                                      method="get">
                                                    <button type="submit"><i
                                                            class="fa-regular fa-pen-to-square fa-flip-horizontal"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('products.destroy', ['id' => $product->id]) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"><i
                                                            class="fa-regular fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
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
            "autoWidth": true,
            "pageLength": 5
        });
    });
</script>

</body>
</html>
