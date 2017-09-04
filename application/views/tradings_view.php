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

    <style>

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

                    <ol class="breadcrumb">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="tradings">Tradings</a></li>
                    </ol>

                    <div class="container-fluid">
                        <div data-widget-group="group1">
                            <div class="row">
                                <div class="col-md-12">

                                    <div id="div_trading_list">
                                        <div class="panel panel-default">
                                            <div class="panel-body table-responsive">
                                                <table id="tbl_tradings" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Qty</th>
                                                        <th>Unit Price</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>sample</td>
                                                        <td>sample</td>
                                                        <td>sample</td>
                                                        <td>sample</td>
                                                        <td>sample</td>
                                                    </tr>
                                                    <tr>
                                                        <td>sample1</td>
                                                        <td>sample1</td>
                                                        <td>sample1</td>
                                                        <td>sample1</td>
                                                        <td>sample1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>sample2</td>
                                                        <td>sample2</td>
                                                        <td>sample2</td>
                                                        <td>sample2</td>
                                                        <td>sample2</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="panel-footer">
                                                <button class="btn btn-default btn-sm"><i class="fa fa-question fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F1-HELP</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-search fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F2-PLU</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-money fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F3-RFND</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-times-circle fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F4-VOID</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-file-o fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F5-JOURNAL</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-credit-card fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F6-PYMN</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-folder-o fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F7-ADMIN</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-times-circle-o fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F8-CANCEL</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-sign-out fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F9-LOGOUT</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-ticket fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F10-DISC</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-tachometer fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F11-QTY</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-folder-open-o fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>F12-MENU</p></button>
                                                <button class="btn btn-default btn-sm"><p style="padding-top: 12.5px;">View low on <br>Stock</p></button>
                                                <button class="btn btn-default btn-sm"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true" style="padding-top: 15px;"></i><p>END BATCH</p></button>
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

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<!--<script>-->
<!---->
<!--$(document).ready(function(){-->
<!--    var dt; var _txnMode; var _selectedID; var _selectRowObj;-->
<!---->
<!--    var initializeControls=function(){-->
<!--        dt=$('#tbl_tradings').DataTable({-->
<!--            "dom": '<"toolbar">frtip',-->
<!--            "bLengthChange":false,-->
<!--            "ajax" : "tradings/transaction/list",-->
<!--            "columns": [-->
<!---->
<!--                { targets:[0],data: "trading_desc" },-->
<!--                { targets:[1],data: "trading_qty" },-->
<!--                { targets:[2],data: "trading_unit" },-->
<!--                { targets:[3],data: "trading_discount" },-->
<!--                { targets:[4],data: "trading_total" }-->
<!--            ]-->
<!--        });-->
<!---->
<!--//        var createToolBarButton=function(){-->
<!--//            var _btnNew='<button class="btn btn-primary"  id="btn_new" style="text-transform: capitalize;font-family: Tahoma, Georgia, Serif;" data-toggle="modal" data-target="" data-placement="left" title="New trading" >'+-->
<!--//                '<i class="fa fa-users"></i> New trading</button>';-->
<!--//            $("div.toolbar").html(_btnNew);-->
<!--//        }();-->
<!--    }();-->
<!---->
<!--    var bindEventHandlers=(function(){-->
<!--        var detailRows = [];-->
<!---->
<!--        $('#tbl_tradings tbody').on( 'click', 'tr td.details-control', function () {-->
<!--            var tr = $(this).closest('tr');-->
<!--            var row = dt.row( tr );-->
<!--            var idx = $.inArray( tr.attr('id'), detailRows );-->
<!---->
<!--            if ( row.child.isShown() ) {-->
<!--                tr.removeClass( 'details' );-->
<!--                row.child.hide();-->
<!---->
<!--                detailRows.splice( idx, 1 );-->
<!--            }-->
<!--            else {-->
<!--                tr.addClass( 'details' );-->
<!---->
<!--                row.child( format( row.data() ) ).show();-->
<!---->
<!--                if ( idx === -1 ) {-->
<!--                    detailRows.push( tr.attr('id') );-->
<!--                }-->
<!--            }-->
<!--        } );-->
<!---->
<!--        $('#btn_new').click(function(){-->
<!--            _txnMode="new";-->
<!--            showList(false);-->
<!--        });-->
<!---->
<!--        $('#tbl_tradings tbody').on('click','button[name="edit_info"]',function(){-->
<!--            _txnMode="edit";-->
<!--            _selectRowObj=$(this).closest('tr');-->
<!--            var data=dt.row(_selectRowObj).data();-->
<!--            _selectedID=data.trading_id;-->
<!---->
<!--            $('input,textarea').each(function(){-->
<!--                var _elem=$(this);-->
<!--                $.each(data,function(name,value){-->
<!--                    if(_elem.attr('name')==name){-->
<!--                        _elem.val(value);-->
<!--                    }-->
<!--                });-->
<!--            });-->
<!--            showList(false);-->
<!--        });-->
<!---->
<!--        $('#tbl_tradings tbody').on('click','button[name="remove_info"]',function(){-->
<!--            _selectRowObj=$(this).closest('tr');-->
<!--            var data=dt.row(_selectRowObj).data();-->
<!--            _selectedID=data.trading_id;-->
<!---->
<!--            $('#modal_confirmation').modal('show');-->
<!--        });-->
<!---->
<!--        $('#btn_yes').click(function(){-->
<!--            removetrading().done(function(response){-->
<!--                showNotification(response);-->
<!--                dt.row(_selectRowObj).remove().draw();-->
<!--            });-->
<!--        });-->
<!---->
<!--        $('input[name="file_upload[]"]').change(function(event){-->
<!--            var _files=event.target.files;-->
<!---->
<!--            $('#div_img_trading').hide();-->
<!--            $('#div_img_loader').show();-->
<!---->
<!--            var data=new FormData();-->
<!--            $.each(_files,function(key,value){-->
<!--                data.append(key,value);-->
<!--            });-->
<!---->
<!--            console.log(_files);-->
<!---->
<!--            $.ajax({-->
<!--                url : 'tradings/transaction/upload',-->
<!--                type : "POST",-->
<!--                data : data,-->
<!--                cache : false,-->
<!--                dataType : 'json',-->
<!--                processData : false,-->
<!--                contentType : false,-->
<!--                success : function(response){-->
<!--                    $('#div_img_loader').hide();-->
<!--                    $('#div_img_trading').show();-->
<!--                }-->
<!--            });-->
<!--        });-->
<!---->
<!--        $('#btn_cancel').click(function(){-->
<!--            showList(true);-->
<!--        });-->
<!---->
<!--        $('#btn_save').click(function(){-->
<!--            if(validateRequiredFields()){-->
<!--                if(_txnMode=="new"){-->
<!--                    createtrading().done(function(response){-->
<!--                        showNotification(response);-->
<!--                        dt.row.add(response.row_added[0]).draw();-->
<!--                        clearFields();-->
<!---->
<!--                    }).always(function(){-->
<!--                        showSpinningProgress($('#btn_save'));-->
<!--                    });-->
<!--                }else{-->
<!--                    updatetrading().done(function(response){-->
<!--                        showNotification(response);-->
<!--                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();-->
<!--                        clearFields();-->
<!--                        showList(true);-->
<!--                    }).always(function(){-->
<!--                        showSpinningProgress($('#btn_save'));-->
<!--                    });-->
<!--                }-->
<!--            }-->
<!--        });-->
<!--    })();-->
<!---->
<!--    var validateRequiredFields=function(){-->
<!--        var stat=true;-->
<!---->
<!--        $('div.form-group').removeClass('has-error');-->
<!--        $('input[required],textarea','#frm_trading').each(function(){-->
<!--            if($(this).val()==""){-->
<!--                showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});-->
<!--                $(this).closest('div.form-group').addClass('has-error');-->
<!--                stat=false;-->
<!--                return false;-->
<!--            }-->
<!--        });-->
<!--        return stat;-->
<!--    };-->
<!---->
<!--    var createtrading=function(){-->
<!--        var _data=$('#frm_trading').serializeArray();-->
<!---->
<!--        return $.ajax({-->
<!--            "dataType":"json",-->
<!--            "type":"POST",-->
<!--            "url":"tradings/transaction/create",-->
<!--            "data":_data,-->
<!--            "beforeSend": showSpinningProgress($('#btn_save'))-->
<!--        });-->
<!--    };-->
<!---->
<!--    var updatetrading=function(){-->
<!--        var _data=$('#frm_trading').serializeArray();-->
<!--        _data.push({name : "trading_id" ,value : _selectedID});-->
<!---->
<!--        return $.ajax({-->
<!--            "dataType":"json",-->
<!--            "type":"POST",-->
<!--            "url":"tradings/transaction/update",-->
<!--            "data":_data,-->
<!--            "beforeSend": showSpinningProgress($('#btn_save'))-->
<!--        });-->
<!--    };-->
<!---->
<!--    var removetrading=function(){-->
<!--        return $.ajax({-->
<!--            "dataType":"json",-->
<!--            "type":"POST",-->
<!--            "url":"tradings/transaction/delete",-->
<!--            "data":{trading_id : _selectedID}-->
<!--        });-->
<!--    };-->
<!---->
<!--    var showList=function(b){-->
<!--        if(b){-->
<!--            $('#div_trading_list').show();-->
<!--            $('#div_trading_fields').hide();-->
<!--        }else{-->
<!--            $('#div_trading_list').hide();-->
<!--            $('#div_trading_fields').show();-->
<!--        }-->
<!--    };-->
<!---->
<!--    var showNotification=function(obj){-->
<!--        PNotify.removeAll();-->
<!--        new PNotify({-->
<!--            title:  obj.title,-->
<!--            text:  obj.msg,-->
<!--            type:  obj.stat-->
<!--        });-->
<!--    };-->
<!---->
<!--    var showSpinningProgress=function(e){-->
<!--        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');-->
<!--    };-->
<!---->
<!--    var clearFields=function(){-->
<!--        $('input[required],textarea','#frm_trading').val('');-->
<!--        $('form').find('input:first').focus();-->
<!--    };-->
<!---->
<!--    function format ( d ) {-->
<!--        return '<br /><table style="margin-left:10%;width: 80%;">' +-->
<!--        '<thead>' +-->
<!--        '</thead>' +-->
<!--        '<tbody>' +-->
<!--        '<tr>' +-->
<!--        '<td>trading Name : </td><td><b>'+ d.trading_name+'</b></td>' +-->
<!--        '</tr>' +-->
<!--        '<tr>' +-->
<!--        '<td>trading Description : </td><td>'+ d.trading_desc+'</td>' +-->
<!--        '</tr>' +-->
<!--        '</tbody></table><br />';-->
<!--    };-->
<!--});-->
<!---->
<!--</script>-->

</body>

</html>