<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理
                <small>运费模板添加</small>
            </h3>
            <?php echo breadcrumb(array('商品管理', 'mall_freight/grid' => '运费模板', 'mall_freight/add' => '运费模板添加')); ?>
        </div>
    </div>
    <div class="alert alert-error" style="display: none;">
        <button data-dismiss="alert" class="close"></button>
        <a href="javascript:;" class="glyphicons no-js remove_2"><i></i><p></p></a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>运费模板设置</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_freight/addPost') ?>" method="post" enctype="multipart/form-data" id="goods_form">
                        <div class="alert alert-success">基本信息</div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group ">
                                    <label class="control-label">模板名称</label>
                                    <div class="controls">
                                        <input type="text" class="m-wrap large required" name="name" placeholder="模板名称"/>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group add-supplieruid-html">
                                    <label class="control-label">模板所属</label>
                                    <div class="controls">
                                        <input type="text" class="m-wrap large required supplieruid" name="uid" placeholder="双击指定用户uid"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="control-group">
                                <div class="span6">
                                    <label class="control-label"><em>* </em>配送方式</label>
                                    <div class="controls">
                                        <label class="checkbox">
                                            <input value="1" name="logistics" type="radio" checked="checked"/>快递
                                        </label>
                                        <label class="checkbox">
                                            <input value="2" name="logistics" type="radio"/>物流
                                        </label>
                                    </div>
                                </div>
                                <div class="span6">
                                    <label class="control-label"><em>* </em>计价方式</label>
                                    <div class="controls">
                                        <label class="checkbox">
                                            <input value="1" name="methods" type="radio" checked="checked"/>按件计价
                                        </label>
                                        <label class="checkbox">
                                            <input value="2" name="methods" type="radio"/>按重量计价
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-success">运费模板</div>
                        <div class="row-fluid">
                            <div class="control-group">
                                <label class="control-label"><em>* </em>默认运费</label>
                                <div class="controls">
                                     <input type="text" name="price_first" class="m-wrap required number small" placeholder="0">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">（元）,首件/重</label>
                                <div class="controls">
                                     <input type="text" name="unit_first" class="m-wrap  small number" placeholder="0">
                                </div>
                               
                            </div>
                            <div class="control-group">
                                <label class="control-label">(件/重),每增加</label>
                                <div class="controls">
                                     <input name="unit_add" type="text" class="m-wrap required number small" placeholder="0">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">件/重，增加运费</label>
                                <div class="controls">
                                     <input type="text" name="price_add" class="m-wrap required small number" placeholder="0">
                                </div>
                            </div>
                            <div class="control-group ">
                                 <div class="controls">
                                      <a id="profit_add" class="btn green required" href="javascript:void(0);">设置指定城市运费
                                            <i class="m-icon-swapright m-icon-white "></i>
                                      </a>
                                 </div>
                            </div>
                    
                        </div>
                        <style type="text/css">
                            .wl50 {width: 90% !important;}
                            .td1 {text-align: center;width: 10%;}
                            .td5 {text-align: center;width: 50%;}
                            .h_nav_over {background: #DFF0D8;}
                        </style>
                        <div class="row-fluid margin-bottom-40 ">
                            
                        </div>
                        <div class="pricing-footer">
                            <p style="font-size: 16px;color:red;"></p>
                        </div>
                        <div class="row-fluid">
                            <ul class="pricing-content unstyled"></ul>
                            <div class="pricing-footer">
                                <p style="font-size: 16px;color:red;"></p>
                                <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="mould-responsive" class="modal hide fade" style="display: none; width: 800px;" main aria-hidden="true">
    
</div>
<script type="text/javascript">
    html_create();
    function html_create() {
        var htmlObj = $('.margin-bottom-40');
        var tableObj = $('<table width="100%" id="tem" border="1" text-align="center" class="add-supplieruid" bordercolor="#D6E9C6">');
        var tr1 = $('<tr>');
        var td1 = $('<td class="td5">地区</td>');
        var td2 = $('<td class="td1">首件/重</td>');
        var td3 = $('<td class="td1">首价</td>');
        var td4 = $('<td class="td1">续件/重</td>');
        var td5 = $('<td class="td1">续价</td>');
        var td6 = $('<td class="td1">操作</td>');
        td1.appendTo(tr1);
        td2.appendTo(tr1);
        td3.appendTo(tr1);
        td4.appendTo(tr1);
        td5.appendTo(tr1);
        td6.appendTo(tr1);
        tr1.appendTo(tableObj);
        tableObj.appendTo(htmlObj);
    }
    function tr_create() {
        var key = (new Date()).valueOf() + parseInt(1000 * Math.random());
        var tr2 = $('<tr class="templet">');
        var td7 = $('<td class="td5 "><input type="text" readonly class="m-wrap wl50 required mould" placeholder="双击设置指定城市" name="list[' + key + '][area]"> </td>');
        var td8 = $('<td class="td1"><input type="text" class="m-wrap small required" placeholder="千克/件数" name="list[' + key + '][first_unit]"></td>');
        var td9 = $('<td class="td1"><input type="text" class="m-wrap small required" placeholder="元" name="list[' + key + '][first_price]"></td>');
        var td10 = $('<td class="td1"><input type="text" class="m-wrap small required" placeholder="千克/件数" name="list[' + key + '][add_unit]"></td>');
        var td11 = $('<td class="td1"><input type="text" class="m-wrap small required" placeholder="元" name="list[' + key + '][add_price]"></td>');
        var td12 = $('<td class="td1 tem_del"><a href="javascript:;"> 删除</a></td>');
        td7.appendTo(tr2);
        td8.appendTo(tr2);
        td9.appendTo(tr2);
        td10.appendTo(tr2);
        td11.appendTo(tr2);
        td12.appendTo(tr2);
        return tr2;
    }
    function ajaxGetUser(url) {
        $.ajax({
            type: 'get',
            async: false,
            dataType: 'json',
            url: url ? url : hostUrl() + '/mall_freight/ajaxGetTemplet',
            data: url ? {} : $('.ajaxUserSearch').serialize(),
            success: function (json) {
                if (json.status) {
                    $('#mould-responsive').html(json.html);
                    App.initUniform();
                }
            }
        });
    }
    window.onload = function () {
        $('#mould-responsive').on('show', function (e) {
            ajaxGetUser();
        });
        $('#mould-responsive').on('submit', '.ajaxSearch', function (e) {
            e.preventDefault();
            var str = '';
            $("input[name='area']:checked").each(function () {
                str += $(this).val() + ","
            })
            supplieruid.val(str);
            $('#mould-responsive').modal('hide');
        });
        $('#profit_add').on('click', function () {
            var tem = $('#tem');
            var tr = tr_create();
            tr.appendTo(tem);
        })
        $('.add-supplieruid').on('dblclick', '.mould', function (e) {
            supplieruid = $(this);
            $('#mould-responsive').modal();
            e.stopPropagation();
        });
        $('.add-supplieruid').on('mouseover', '.templet', function (e) {
            $(this).addClass("h_nav_over");
        });
        $('.add-supplieruid').on('mouseout', '.templet', function (e) {
            $(this).removeClass("h_nav_over");
        })
    }

    $('div .add-supplieruid').on('click', '.tem_del', function () {
        $(this).parent('tr').remove();
    })
    $('#goods_form').click(function(){
        $('#goods_form').valid();
    })
</script>
<?php $this->load->view('layout/footer'); ?>
<?php $this->load->view('user/addSupplierUid/ajaxGetUser'); ?>
