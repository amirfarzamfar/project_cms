@include('.Sidebar.brand')
<div class="sidebar" style="direction: ltr">
    <div style="direction: rtl">
        <!-- Sidebar user panel (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link user-panel mt-3 pb-3 mb-3 info">
                        3A پروفایل
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            {{--                            <a href="{{route('editProfile')}}" class="nav-link">--}}
                            <i class="fas fa-user-edit"></i>
                            <p>ویرایش پروفایل</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{--                            <a href="{{route('editProfPass')}}" class="nav-link">--}}
                            <i class="fas fa-lock"></i>
                            <p>تغییر رمز عبور</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{--                            <a href="{{route('editProfImage')}}" class="nav-link">--}}
                            <i class="fas fa-image"></i>
                            <p>تغییر عکس پروفایل</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('users.logout')}}" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>خروج</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>
                            داشبوردها
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./workplace" class="nav-link active">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>داشبورد اول</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->role=='admin')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="far fa-user-circle nav-icon"></i>
                            <p>
                                کاربران
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('users.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> کاربر جدید</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>لیست کاربران</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.status')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>در انتظار تایید</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->role=='admin')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-invoice nav-icon"></i>
                            <p>
                                فاکتورها
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('factors.create')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> فاکتور جدید</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('factors.trashed')}}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> فاکتورهای حذف شده</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('factors.index')}}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>لیست فاکتورها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->role == 'admin' || (auth()->user()->role == 'seller' && auth()->user()->status == 'تایید شده'))
                <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-tags nav-icon"></i>
                            <p>
                                محصولات
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('products.create')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p> محصول جدید</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('products.index')}}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>لیست محصولات</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cart-arrow-down nav-icon"></i>
                        <p>
                            سفارشات
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('orders.create')}}" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p> سفارش جدید</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>لیست سفارشات</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cash-register nav-icon"></i>
                        <p>
                            فرصت های فروش
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            {{--                            <a href="{{route('addOpportunity')}}" class="nav-link">--}}
                            <i class="fas fa-plus nav-icon"></i>
                            <p>ثبت فرصت جدید</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{--                            <a href="{{route('opportunities_data')}}" class="nav-link">--}}
                            <i class="fas fa-list nav-icon"></i>
                            <p> لیست فرصتها</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
</div>
