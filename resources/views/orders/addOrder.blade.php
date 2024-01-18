<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | داشبورد اول</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('styleSheets.styleSheets')
    <link rel="stylesheet" href="{{asset('persenalCss/app.css')}}">
    <link href="{{asset('bt5.css')}}" rel="stylesheet">
    <script src="{{asset('js/bt5.js')}}"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    @include('navbar.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        @include('Sidebar.Sidebar')
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        @include('header.adding.addOrder_header')
        <!-- /.content-header -->
        <!-- Main row -->
        <section class="content">
            <!-- form start -->
            <div class="container-fluid">
                <form role="form" method="post" action="{{route('orders.store')}}">
                    @csrf
                    <div class="form-group">
                        <div class="col">
                            <label for="order_title">عنوان سفارش</label>
                            <input type="text" class="form-control" id="order_title" name="order_title"
                                   placeholder="عنوان سفارش">
                            @error('order_title')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <label for="user_id">کاربر</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">
                                    نام: {{$user->first_name}},
                                    نام خانوادگی: {{$user->last_name}},
                                    ایمیل: {{$user->email}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product_id">محصولات در دسترس</label>
                            <div class="accordion" id="productAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="productHeading">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#productCollapse" aria-expanded="true"
                                                aria-controls="productCollapse">
                                            اطلاعات محصولات
                                        </button>
                                    </h2>
                                    <div id="productCollapse" class="accordion-collapse collapse show"
                                         aria-labelledby="productHeading">
                                        <div class="accordion-body">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>نام محصول</th>
                                                    <th>فروشنده</th>
                                                    <th>قیمت محصول</th>
                                                    <th>تعداد محصول</th>
                                                    <th>تعداد سفارش</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>{{$product->title}}</td>
                                                        <td>{{$product->user->first_name.' '.$product->user->last_name}}</td>
                                                        <td>{{$product->price}}</td>
                                                        <td>{{$product->inventory}}</td>
                                                        <td>
                                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                                <button class="btn btn-link px-2" type="button"
                                                                        onclick="changeProductQuantity(this, -1)">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <input min="0" name="product_{{$product->id}}" value="0"
                                                                       type="number"
                                                                       max="{{$product->inventory}}"
                                                                       class="form-control form-control-sm"
                                                                       style="width: 70px;"/>
                                                                <button class="btn btn-link px-2" type="button"
                                                                        onclick="changeProductQuantity(this, 1)">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function changeProductQuantity(button, step) {
                                    var input = button.parentNode.querySelector('input[type=number]');
                                    input.stepUp(step);
                                }
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="explanations">توضیحات</label>
                            <textarea class="form-control" id="explanations" name="explanations"
                                      placeholder="توضیحات"></textarea>
                            @error('explanations')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <!-- /.card -->


    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
<!-- /.content -->
<!-- /.content-wrapper -->

@include('.footer.main_footer')

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- ./wrapper -->
@include('.scripts')
</body>

</html>

