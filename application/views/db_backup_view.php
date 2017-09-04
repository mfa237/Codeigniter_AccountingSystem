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
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <style>
        .select2-container{
            min-width: 100%;
        }


        .select2-dropdown{
            z-index: 9999999999;
        }

        .datepicker-dropdown{
            z-index: 9999999999;
        }

        .dropdown-menu{
            z-index: 9999999999;
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
                    <ol class="breadcrumb" style="margin:0%;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Balance_sheet">Balance Sheet</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div data-widget-group="group1">

                            <div id="modal_backup" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header modal-erp">
                                            <h4 class="modal-title" style="color: white;"> <i class="fa fa-hdd-o"></i> Backup Database</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-xs-12 col-sm-12 progress-container">
                                                <div class="progress progress-striped active">
                                                    <div class="progress-bar progress-bar-success" style="width:0%"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <div class="row">
                                                <div class="col-xs-12">

                                                    <button id="btn_backup" class="btn btn-success" style="text-transform: none;"><span class=""></span> <i class="fa fa-hdd-o"></i> Backup Database</button>
                                                    <button class="btn btn-red" data-dismiss="modal" style="text-transform: none;">Close</button>
                                                </div>
                                            </div>
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
                        <li><h6 style="margin: 0;">&copy; 2016 - Paul Christian Rueda</h6></li>
                    </ul>
                    <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                </div>
            </footer>
        </div>
    </div>
</div>


<?php echo $_switcher_settings; ?>
<?php echo $_def_js_files; ?>


<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        var showSpinningProgress=function(e){
            $(e).toggleClass('disabled');
            $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
        };

        var showNotification=function(obj){
            PNotify.removeAll(); //remove all notifications
            new PNotify({
                title:  obj.title,
                text:  obj.msg,
                type:  obj.stat
            });
        };

        $('.progress-container').hide();

       $('#modal_backup').modal('show');

        $('#btn_backup').click(function(){
            var btn = $(this);

            $.ajax({

                 "dataType":"json",
                "type":"POST",
                "url":"DBBackup/start",
                "beforeSend" : function(){
                    showSpinningProgress(btn);

                    $('.progress-container').show();
                    //Upload progress

                    $(".progress-bar").animate({
                        width: "70%"
                    }, 1000 );


                }
            }).done(function(response){
                showNotification(response);

                setTimeout(function() {
                    $(".progress-bar").attr('style','width:100%');
                    window.location = response.path;
                }, 500);


            }).always(function(){
                setTimeout(function() {
                    $(".progress-bar").attr('style','width:0%');
                    $('.progress-container').hide();
                }, 1000);
                showSpinningProgress(btn);
            });


        });


    })();
</script>

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>
<script src="assets/plugins/select2/select2.full.min.js"></script>
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>


</body>

</html>