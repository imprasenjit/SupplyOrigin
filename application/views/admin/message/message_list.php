
    <div class="container-fluid">
      <div class="mb-4">
        <?=$this->breadcrumbs->show();?>
      </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Message List</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <link href="<?= base_url('public/datatables/css/loading.css') ?>" rel="stylesheet" />
                        <link href="<?= base_url('public/datatables/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
                        <script src="<?= base_url('public/datatables/js/jquery.dataTables.min.js') ?>"></script>
                        <script src="<?= base_url('public/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $.extend($.fn.DataTable.ext.classes, {
                                    sWrapper: "dataTables_wrapper dt-bootstrap4",
                                });
                                $("#dtbl").DataTable({
                                    "columnDefs": [{
                                        className: 'text-right',
                                        orderable: false,
                                        targets: 4
                                    }],
                                    "columns": [
                                        {"data": "slno"},
                                        {"data": "send_to"},
                                        {"data": "subject"},
                                        {"data": "message"},
                                        {"data": "id", width: 200}
                                    ],
                                    "processing": true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": "<?= base_url("admin/message/get_dtrecords") ?>",
                                        "dataType": "json",
                                        "type": "POST",
                                    },
                                    language: {
                                        processing: "<div class='loading'></div>",
                                    },
                                    "order": [[0, 'asc']],
                                    "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]]
                                });
                            });
                        </script>
                        <table class="table table-bordered" id="dtbl">
                            <thead>
                                <tr>
                                    <th>(#)</th>
                                    <th>Sent to</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
