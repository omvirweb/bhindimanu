<?php
    $this->load->view('header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Weight Detail</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Job No.</th>
                                            <th>Date</th>
                                            <th>Touch</th>
                                            <th>Sr. No</th>
                                            <th>Party Name</th>
                                            <th>Tree Weight</th>
                                            <th>Gold Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: right;">201</td>
                                            <td>1,Sep,2019</td>
                                            <td style="text-align: right;">92.000</td>
                                            <td style="text-align: right;">1</td>
                                            <td>Pc Jewellers</td>
                                            <td style="text-align: right;">68.220</td>
                                            <td style="text-align: right;">102.330</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">202</td>
                                            <td>2,Sep,2019</td>
                                            <td style="text-align: right;">75.000</td>
                                            <td style="text-align: right;">2</td>
                                            <td>Kamlesh Jewellers</td>
                                            <td style="text-align: right;">70.350</td>
                                            <td style="text-align: right;">105.525</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">201</td>
                                            <td>3,Sep,2019</td>
                                            <td style="text-align: right;">92.000</td>
                                            <td style="text-align: right;">3</td>
                                            <td>Pc Jewellers</td>
                                            <td style="text-align: right;">45.600</td>
                                            <td style="text-align: right;">68.400</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">202</td>
                                            <td>4,Sep,2019</td>
                                            <td style="text-align: right;">75.000</td>
                                            <td style="text-align: right;">4</td>
                                            <td>Kamlesh Jewellers</td>
                                            <td style="text-align: right;">56.400</td>
                                            <td style="text-align: right;">84.600</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php
    $this->load->view('footer');
?>