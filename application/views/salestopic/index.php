<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">促销管理 <small>所有促销</small></h3>
            <?php echo breadcrumb('促销管理'); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-search"></i>搜索</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal form-search" action="<?php echo base_url('salestopic/index') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">促销名称</label>
                                    <div class="controls">
                                        <input type="text" class="m-wrap medium" placeholder="促销名称" name="sales_name" value="<?php echo $this->input->get('sales_name');?>">
                                    </div>
                                </div>
                            </div>
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">促销状态</label>
                                    <div class="controls">
                                        <select class="medium m-wrap" name="status">
                                            <option value="">全部</option>
                                            <?php foreach ($status as $key=>$value) :?>
                                                <option value="<?php echo $key;?>" <?php if ($key == $this->input->get('status')): ?>selected="selected"<?php endif?>><?php echo $value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit">搜索</button>
                            <button class="btn reset_button_search" type="button">重置条件</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>列表</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="dataTables_wrapper form-inline">
                        <div class="clearfix">
                            <a href="<?php echo base_url('salestopic/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加促销</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>促销名称</th>
                                    <th>状态</th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $item->sales_id;?></td>
                                        <td><?php echo $item->sales_name;?></td>
                                        <td>
                                            <a href="javascript:;" class="modify-status glyphicons <?php if ($item->status == 1 ):?>ok_2<?php elseif ( $item->status== 2 ):?>remove_2<?php endif;?>" data-id="<?php echo $item->sales_id?>" data-state="<?php echo $item->status;?>">
                                                <i></i>
                                            </a>
                                        </td>
                                        <td><?php echo $item->created_at;?></td>
                                        <td><?php echo $item->updated_at;?></td>
                                        <td>
                                            <a class="btn mini green" href="<?php echo base_url('salestopiccategory/index?sales_id='.$item->sales_id, 'sales_name=', $item->sales_name) ?>"><i class="icon-edit"></i> 促销分类</a>
                                            <a class="btn mini green" href="<?php echo base_url('salestopic/images/'.$item->sales_id) ?>"><i class="icon-edit"></i> 图片管理</a>
                                            <br>
                                            <a class="btn mini green" href="<?php echo base_url('salestopic/edit/'.$item->sales_id) ?>"><i class="icon-edit"></i> 编辑</a>
                                            <a class="btn mini green" href="<?php echo base_url('salestopic/delete/'.$item->sales_id) ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i>删除</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="dataTables_info">
                                        <span>当前第</span><span style="color: red"><?php echo $pg_now?></span>页
                                        <span>共</span><span style="color: red"><?php echo $all_rows?></span>条数据
                                        <span>每页显示20条 </span>
                                        <?php echo $pg_list ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert"><p>未找到数据。<p></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
<script type="text/javascript">
    $(function() {
        $('.modify-status').click(function(){
            var status = '下架';
            if ($(this).hasClass('remove_2')) {
                status = '上架';
            }
            if (confirm('确定要'+status+'?')) {
                var obj = $(this);
                var state = $(this).attr('data-state');
                var id = $(this).attr('data-id');
                $.ajax({
                    url:"<?php echo base_url()?>salestopic/toggle",
                    type:'POST',
                    dataType:'json',
                    data: "id="+id+'&status='+state,
                    success: function(data) {
                        if (data.status == 2) {
                            obj.attr('data-state', data.status).addClass('remove_2').removeClass('ok_2');
                        } else if(data.status == 1) {
                            obj.attr('data-state', data.status).addClass('ok_2').removeClass('remove_2');
                        } else {
                            alert('操作失败');
                        }
                    }
                });
            }
        });
    });
</script>