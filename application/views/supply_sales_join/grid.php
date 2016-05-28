<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">用户账号管理<small>分销加盟申请</small></h3>
            <?php echo breadcrumb(array('用户账号管理', 'supply_sales_join/grid'=>'分销供应申请')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('supply_sales_join/grid');?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">项目</label>
                                    <div class="controls">
                                        <input type="text" name="item" value="<?php echo trim($this->input->get('item'));?>" placeholder="用户名、公司、地址、电话" class="m-wrap span12">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">分类</label>
                                    <div class="controls">
                                        <select name="type" class="m-wrap span12">
                                            <option value="">请选择</option>
                                            <option value="1" <?php if($this->input->get('type')==1)echo 'selected="selected"';?>>分销申请</option>
                                            <option value="2" <?php if($this->input->get('type')==2)echo 'selected="selected"';?>>供应申请</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">状态</label>
                                    <div class="controls">
                                        <select name="flag" class="m-wrap span12">
                                            <option value="">请选择</option>
                                            <option value="1" <?php if($this->input->get('flag')==1)echo 'selected="selected"';?>>刚申请</option>
                                            <option value="2" <?php if($this->input->get('flag')==2)echo 'selected="selected"';?>>已处理</option>
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
                        <?php if ($all_rows > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>用户名</th>
                                    <th>公司</th>
                                    <th>地址</th>
                                    <th>电话</th>
                                    <th>分类</th>
                                    <th>状态</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res_list as $r) : ?>
                                <tr>
                                    <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $r->id;?></td>
                                    <td><?php echo $r->user_name;?></td>
                                    <td><?php echo $r->company;?></td>
                                    <td><?php echo $r->address;?></td>
                                    <td><?php echo $r->phone;?></td>
                                    <td><?php if($r->type==1)echo '分销申请'; else echo '供应申请';?></td>
                                    <td><?php if($r->flag==1)echo '刚申请'; else echo '已处理';?></td>
                                    <td><?php echo $r->creat;?></td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('supply_sales_join/edit/'.$r->id); ?>"><i class="icon-edit"></i> 编辑</a>
                                        <a class="btn mini green" href="<?php echo base_url('supply_sales_join/delete/'.$r->id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
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
                                    <?php echo $pg_link ?>
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