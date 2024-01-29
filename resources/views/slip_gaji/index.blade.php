@extends('layouts.app')
@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pay Slip</a></li>
                            <li class="breadcrumb-item active">Gaji Karyawan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Gaji Karyawan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('search.slip_gaji') }}" method="post" >
                            @csrf

                                 <div class="form-example-wrap mg-t-30">
                                     <div class="cmp-tb-hd cmp-int-hd">
                                         <h5>Cari Data Gaji</h5>
                                     </div>
                                     <div class="form-example-int form-horizental">
                                         <div class="form-group">
                                             <div class="row">
                                                 <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                     <label class="hrzn-fm">Pilih Periode</label>
                                                 </div>
                                                 <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                     <div class="nk-int-st">
                                                         <input type="month" name="month" class="form-control input-sm" required>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>


                                     <div class="form-example-int mg-t-15">
                                         <div class="row">
                                             <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                             </div>
                                             <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                 <button class="btn btn-success notika-btn-success">Cari</button>
                                             </div>
                                         </div>
                                     </div>
                                    </div>
                               </form>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->


    </div> <!-- container -->

</div>
@endsection

