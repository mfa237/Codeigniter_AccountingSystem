<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>JCORE - <?php echo $title; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">

    <?php echo $_def_css_files; ?>

    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">

    <style>
        html{
            zoom: 0.8;
            zoom: 80%;
        }

        .toolbar{
            float: left;
        }

        td.details-control {
            background: url('assets/img/Folder_Closed.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/Folder_Opened.png') no-repeat center center;
        }

        .child_table{
            padding: 5px;
            border: 1px #ff0000 solid;
        }

        .glyphicon.spinning {
            animation: spin 1s infinite linear;
            -webkit-animation: spin2 1s infinite linear;
        }

        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

        .select2-container {
            min-width: 100%;
            z-index: 999999999;
        }

        .image {
          object-fit: none; /* Do not scale the image */
          object-position: center; /* Center the image within the element */
          height: 50px;
          width: 50px;
          background-size: cover;

        }

    </style>

</head>

<body class="animated-content">

<?php echo $_top_navigation; ?>

<div id="wrapper">
    <div id="layout-static">

        <?php echo $_side_bar_navigation;?>

        <div class="static-content-wrapper white-bg">
            <div class="static-content"  >
                <div class="page-content"><!-- #page-content -->

                    <ol class="breadcrumb" style="margin:0;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Online_users">Online Users</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_user_list">
                                       <!--  <div class="panel panel-default" style="width:70%!important;">
                                            <div class="panel-heading">
                                                <b style="color: white; font-size: 12pt;"><i class="fa fa-bars"></i>&nbsp; Users Online</b>
                                            </div> -->
                                            <div class="panel-body table-responsive">
                                            <h2 class="h2-panel-heading">Online Users</h2> <hr>
                                                <table id="tbl_user" cellspacing="0"  class="table table-striped" width="100%">

                                                    <thead class="">
                                                    <tr>
                                                        <th width="5%">User</th>
                                                        <th width="25%">Name</th>
                                                        <th width="15%">Email</th>
                                                        <th width="10%">Mobile Number</th>
                                                        <th width="5%">Status</th>
                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="panel-footer"></div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div> <!-- .container-fluid -->

                </div> <!-- #page-content -->
            </div>

           
            <footer role="contentinfo">
                <div class="clearfix">
                    <ul class="list-unstyled list-inline pull-left">
                        <li><h6 style="margin: 0;">&copy; 2017 - JDEV OFFICE SOLUTIONS</h6></li>
                    </ul>
                    <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                </div>
            </footer>

        </div>
    </div>
</div>


<?php echo $_switcher_settings; ?>
<?php echo $_def_js_files; ?>

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>

<script src="assets/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _cboAccountType;

    var initializeControls=function(){
        dt=$('#tbl_user').DataTable({
            "dom": '<"toolbar">frtip',
            "bLengthChange":false,
            "ajax" : "Online_users/transaction/list",
            "language": {
                "searchPlaceholder":"Search User"
            },
            "columns": [
                { targets:[0],data: null, render: function (data,type,row){
                    var image='<img src="'+data.photo_path+'" class="image"  style="object-fit: cover;">';
                    return image;
                }},
                 { targets:[1], data: null, render: function ( data, type, row ) {
                return data.user_fname+' '+data.user_lname; 
                } },
                { targets:[2], data:"user_email"},
                { targets:[3], data:"user_mobile"},
                { targets:[4], data: null, render: function ( data, type, row ) {
                if (data._isonline == 1){
                   var btn='<img src="assets/img/online.png" style="width:25px;height25px;">';
                   return '<center>' +btn+ '</center>';
                }
                else{
                    var btn1='<img src="assets/img/offline.png" style="width:25px;height25px;">';
                   return '<center>' +btn1+ '</center>';
                }
            } },




            ]
        });
        $('.dataTables_filter').addClass('pull-left');
        setInterval( function () {
            dt.ajax.reload();
        }, 3000 );
    }();


});

</script>

</body>

</html>