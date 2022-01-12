<?php
    $this->load->view('header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Job Card Entry</h1>
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
                        <form class="form-horizontal" action=""  method="post"  novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Party"> Party<span style="color:red"> *</span></label>
                                        <select name="Party_id" id="Party_id" class="form-control">
                                            <option>Select Party</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Party"> Job No<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control" name="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Party"> Melting<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control" name="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Party"> Order Date<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control input-datepicker" name="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Party"> Delivery Date<span style="color:red"> *</span></label>
                                        <input type="text" class="form-control input-datepicker" name="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Party"> PECH - TAR<span style="color:red"> *</span></label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Party"> Latkan<span style="color:red"> *</span></label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Party"> Remark<span style="color:red"> *</span></label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sr. No</th>
                                                <th>Item</th>
                                                <th>Design No</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: right;">1</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>Select Item</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>Select Design No</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: right;">2</td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>Select Item</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>Select Design No</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="" class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-info float-right">Save</button>
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