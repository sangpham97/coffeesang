@extends('layouts.app')

@section('content')
 <div id="wrapper">

        <!-- Sidebar -->
       @include('admin.SideBar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        @include('admin.Content')
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

@endsection
