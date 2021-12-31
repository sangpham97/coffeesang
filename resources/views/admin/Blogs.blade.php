
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
                        <h1 class="h3 mb-0 text-gray-800">Blogs</h1>
                    </div>

                    <div class="row ">
                        <div class="col-md-10 col-sm-6">
                            <h4 class="h4 text-gray-600">
                                Create a Blogs
                            </h4>
                            <form action="/createblog" method="POST" enctype="multipart/form-data" class="p-4 border">
                                @csrf
                                <div class="form-group">
                                    <label >Title</label>
                                    <input class="form-control" type="text" name="title">
                                </div>
                                 <div class="form-group">
                                    <label >Description</label>
                                    <textarea name="desc" rows="10" class="form-control"></textarea>
                                </div>

                          <div class="form-group">
                                    <label >Image:</label>
                                    <input type="file" name="image">
                                </div>

                                <button class="btn btn-success">
                                    Create
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-11 col-sm-6">
                            <table class="table border m-3">
                                   <tr>
                                       <th>Title</th>
                                       <th >Description</th>
                                       <th>Image</th>
                                       <th>Delete</th>
                                       <th>Update</th>
                                   </tr>
                               @foreach ($blogs as $blog)
                                   <tr>
                                       <td>{{$blog->title}}</td>
                                       <td >{{ \Illuminate\Support\Str::limit($blog->desc, 57, $end='...') }}</td>
                                       <td ><img src="/storage/{{$blog->image}}" alt="" class="image image-fluid w-25 h-25"></td>
                                       <td><a href="/deleteblog/{{$blog->id}}" class="text-danger">delete</a></td>
                                       <td><admin-blog-component id='{{$blog->id}}' blog='{{$blog}}'></td>
                                   </tr>
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

