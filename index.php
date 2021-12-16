<!DOCTYPE html>
<html>
    <head>
        <title>CRUD SYSTEM</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <style>
            .crdt{
                font-size: 12px;
            }
            .crdtc{
                text-align: center;
            }
        </style>

    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <center><h1 class="page-header">CRUD System <small>DataTables</small> </h1> </center>

                    <div class="removeMessages"></div>

                    <button class="btn btn-success pull pull-right"style="float: right;" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
                        <span class="glyphicon glyphicon-plus-sign"></span> Add Member
                    </button>

                    <br /> <br /> <br />

                    <table class="table table-bordered table-hover" id="membersTable">                  
                        <thead style="background: #000;color: #fff;font-size: 14px;text-align: center;">
                            <tr>
                                <th style="padding:10px;" rowspan="2">S.no</th>
                                <th style="padding:10px;" rowspan="2">Name</th>                                                   
                                <th style="padding:10px;" rowspan="2">Address</th>
                                <th style="padding:10px;" rowspan="2">Contact</th>                                
                                <th style="padding:10px;" rowspan="2">Active</th>
                                <th style="padding:0px;" colspan="2">Action</th>
                            </tr>
                            <tr>
                                <th style="padding: 0px;">Edit</th>
                                <th style="padding: 0px;">Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!-- add modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addMember">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>  Add Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="col-sm-12 mx-auto">
                        <form class="form-horizontal" id="createMemberForm"onsubmit="return false"style="width: 100%">

                            <div class="modal-body">
                                <div class="messages"></div>

                                <div class="form-group form-inline"> <!--/here teh addclass has-error will appear -->
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <input type="hidden" class="form-control col-sm-10 cclass" id="mid" name="mid" value="">
                                    <input type="text" class="form-control col-sm-10 cclass" id="name" name="name" placeholder="Name">
                                </div>
                                <div class="form-group form-inline">
                                    <label for="address" class="col-sm-2 control-label">Address</label>
                                    <input type="text" class="form-control col-sm-10 cclass" id="address" name="address" placeholder="Address">
                                </div>
                                <div class="form-group form-inline">
                                    <label for="contact" class="col-sm-2 control-label">Contact</label>
                                    <input type="text" maxlength="11" class="form-control col-sm-10 cclass" id="contact" name="contact" placeholder="Contact">
                                </div>
                                <div class="form-group form-inline">
                                    <label for="active" class="col-sm-2 control-label">Active</label>
                                    <select class="form-control col-sm-10 cclass" name="active" id="active">
                                        <option value="">~~SELECT~~</option>
                                        <option value="1">Activate</option>
                                        <option value="2">Deactivate</option>
                                    </select>
                                </div>                   

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <span class="btn btn-primary"id="loaderCom"style="width: 125px;display: none;"><img src="assests/images/loading.gif"width="30px"></span>
                                <a href="javascript:void()"id="savbtn"type="button"class="btn btn-primary btn-small"onclick="addMembersData()">Save Changes</a>
                            </div>
                        </form> 
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /add modal -->

        <!-- jquery plugin --> 

        <link rel="stylesheet" type="text/css" href="assests/table/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="assests/table/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
                                    fetch_members();
                                    function createAutoClosingAlert(selector, delay) {
                                        var alert = $(selector).alert();
                                        window.setTimeout(function () {
                                            alert.alert('close');
                                        }, delay);
                                    }

                                    function addMembersData() {
                                        if (($('#name').val() == '') || ($('#address').val() == '') || ($('#contact').val() == '') || ($('#active').val() == '')) {
                                            $('.cclass').addClass('border-danger');
                                        } else {
                                            $.ajax({
                                                type: 'POST',
                                                url: 'includes/members/addNewMember.php',
                                                data: $('#createMemberForm').serialize(),
                                                beforeSend: function () {
                                                    $('#savbtn').hide();
                                                    $('#loaderCom').show();
                                                },
                                                success: function (data) {
                                                    $('#savbtn').show();
                                                    $('#loaderCom').hide();
                                                    if (data == '1') {
                                                        $('#createMemberForm')[0].reset();
                                                        $('#addMember').modal('hide');
                                                        $('.removeMessages').html('<div class="alert alert-branch alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Operation success....</strong></div>');
                                                        createAutoClosingAlert(".alert-branch", 2000);
                                                        $('#membersTable').DataTable().destroy();
                                                        fetch_members();
                                                    } else {
                                                        $('.removeMessages').html('<div class="alert alert-branch alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!something went wrong...</strong></div>');
                                                        createAutoClosingAlert(".alert-branch", 2000);
                                                    }
                                                }
                                            });
                                        }
                                    }

                                    function fetch_members() {
                                        var membersTable = $('#membersTable').DataTable({
                                            "ajax": {
                                                "url": "includes/members/getMembersData.php",
                                                "dataSrc": ""
                                            },
                                            "columns": [
                                                {data: "sn", "class": "crdt crdtc"},
                                                {data: "name", "class": "crdt"},
                                                {data: "address", "class": "crdt"},
                                                {data: "contact", "class": "crdt crdtc"},
                                                {data: "active", "class": "crdt crdtc", "render": function (data, type, row, meta) {
                                                        if (data == '1') {
                                                            return '<span class="btn btn-success"style="width:100px;">Activate</span>';
                                                        } else {
                                                            return '<span class="btn btn-danger"style="width:100px;">Deactivate</span>';
                                                        }
                                                    }
                                                },
                                                {data: "id", "class": "crdt crdtc", "render": function (data, type, row, meta) {
                                                        return '<a href="javascript:void()"type="button"class="btn btn-info btn-small"onclick="updateMembers(' + data + ')"title="Edit">Edit</a>';
                                                    }
                                                },
                                                {data: "id", "class": "crdt crdtc", "render": function (data, type, row, meta) {
                                                        return '<a href="javascript:void()"type="button"class="btn btn-danger btn-small"onclick="removeMembers(' + data + ')"title="Delete">Delete</a>';
                                                    }
                                                },
                                            ]
                                        });
                                    }

                                    function updateMembers(id) {
                                        var conEdit = confirm('Are you sure to edit ?');
                                        if (conEdit == true) {
                                            $('#addMember').modal('show');
                                            $.ajax({
                                                type: 'POST',
                                                url: 'includes/members/getMembersById.php',
                                                dataType: 'JSON',
                                                data: {mem_id: id},
                                                success: function (data) {
                                                    $('#mid').val(data.id);
                                                    $('#name').val(data.name);
                                                    $('#address').val(data.address);
                                                    $('#contact').val(data.contact);
                                                    $('#active').val(data.active);
                                                }
                                            });

                                        } else {
                                            return false;
                                        }
                                    }

                                    function removeMembers(id) {
                                        var conDel = confirm('Are you sure to delete ?');
                                        if (conDel == true) {
                                            $.ajax({
                                                type: 'POST',
                                                url: 'includes/members/deleteMembers.php',
                                                data: {mem_id: id},
                                                success: function (data) {
                                                    if (data == '1') {
                                                        $('.removeMessages').html('<div class="alert alert-branch alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Operation success....</strong></div>');
                                                        createAutoClosingAlert(".alert-branch", 2000);
                                                        $('#membersTable').DataTable().destroy();
                                                        fetch_members();
                                                    } else {
                                                        $('.removeMessages').html('<div class="alert alert-branch alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!something went wrong...</strong></div>');
                                                        createAutoClosingAlert(".alert-branch", 2000);
                                                    }
                                                }
                                            });
                                        } else {
                                            return false;
                                        }
                                    }
        </script>
    </body>
</html>