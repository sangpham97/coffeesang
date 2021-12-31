
@extends('layouts.app')

@section('content')
 <div id="wrapper">

        <!-- Sidebar -->
    @include('admin.SideBar')

    <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Product Cart</h1>
                    </div>

                   <span><a href="/home/cart/menus">Back to Menu Cart</a></span>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-11 col-sm-6">
                            <table class="table border m-3">
                                   <tr>
                                       <th>User</th>
                                       <th>Item</th>
                                       <th>Price</th>
                                       <th>Quanity</th>
                                       <th>ToTal</th>
                                       <th>Delete</th>
                                   </tr>

                            @foreach ($cart as $item)
                                @if($item->type == 2)
                                <tr>
                                    {{-- {{$item->id}} --}}
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->price}}$</td>
                                    <td class="d-flex">{{$item->quantity}} <admin-updateqty-component  id="{{$item->id}}" qty='{{$item->quantity}}' total='{{$item->total}}' price='{{$item->price}}'/></td>
                                     <td>{{$item->total}}$</td>
                                    <td><a href="/deleteCartItem/{{$item->id}}">delete</a> </td>
                                </tr>
                                @endif
                                @endforeach
                               </table>
                        </div>
                    </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
    </div>
</div>
@endsection

