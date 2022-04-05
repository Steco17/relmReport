@extends('layouts.front_layout.front_layout')
@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mini-stat">
                                <span class="mini-stat-icon bg-purple me-0 float-end"><i class="mdi mdi-basket"></i></span>
                                <div class="mini-stat-info">
                                    <span class="counter text-purple">25140</span>
                                   Reports
                                </div>
                                <p class=" mb-0 mt-4 text-muted">Total reports: $22506 <span class="float-end"><i class="fa fa-caret-up me-1"></i>10.25%</span></p>
                            </div>
                        </div>
                    </div>
                </div> <!--End col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mini-stat">
                                <span class="mini-stat-icon bg-blue-grey me-0 float-end"><i class="mdi mdi-black-mesa"></i></span>
                                <div class="mini-stat-info">
                                    <span class="counter text-blue-grey">65241</span>
                                    Messages
                                </div>
                                <p class="text-muted mb-0 mt-4">Total messages: $22506 <span class="float-end"><i class="fa fa-caret-up me-1"></i>10.25%</span></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- End col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mini-stat">
                                <span class="mini-stat-icon bg-brown me-0 float-end"><i class="mdi mdi-buffer"></i></span>
                                <div class="mini-stat-info">
                                    <span class="counter text-brown">85412</span>
                                    Hours Worked
                                </div>
                                <p class="text-muted mb-0 mt-4">Total Working Hours: 22506 hours <span class="float-end"><i class="fa fa-caret-up me-1"></i>10.25%</span></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- End col -->
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mini-stat">
                                <span class="mini-stat-icon bg-teal me-0 float-end"><i class="mdi mdi-coffee"></i></span>
                                <div class="mini-stat-info">
                                    <span class="counter text-teal">20544</span>
                                    Unique Visitors
                                </div>
                                <p class="text-muted mb-0 mt-4">Total income: 22506 <span class="float-end"><i class="fa fa-caret-up me-1"></i>10.25%</span></p>
                            </div>
                        </div>
                    </div>
                </div><!--end col -->
            </div> <!-- end row-->


            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Messages From admin</h4>

                            <div class="table-responsive">
                                <table class="table table-centered table-vertical table-nowrap mb-0">

                                    <tbody>

                                        <tr>
                                            <td>
                                                <img src="{{ asset('images/front_images/users/avatar-4.jpg') }}" alt="user-image"
                                                    class="avatar-sm rounded-circle me-2">
                                                Nikolaj S. Henriksen
                                            </td>
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm
                                            </td>
                                            <td>
                                                $954
                                                <p class="m-0 text-muted font-size-14">Amount</p>
                                            </td>
                                            <td>
                                                8/11/2016
                                                <p class="m-0 text-muted font-size-14">Date</p>
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-secondary btn-sm waves-effect">Edit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>

@endsection
