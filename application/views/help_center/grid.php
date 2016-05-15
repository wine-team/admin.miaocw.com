<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>所有网站设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'advert/grid'=>'广告管理')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('help_center/grid');?>" method="get">
                        <div class="row-fluid">
                            <div class="span5">
                                <div class="control-group">
                                    <div class="controls">
                                        <input type="text" name="item" value="<?php echo trim($this->input->get('item'));?>" placeholder="分类、标题、内容" class="m-wrap medium">
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
                            <a href="<?php echo base_url('help_center/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <p style="color:red;">建议不能删除编号1-20的内容，不能修改标题，只能修改内容！</p>
                        
<!-- 
*底部一般固定，也可以传值，数组类型，id=>sub_title，
*新手上路：$new_hand
*支付方式：$pay_type
*订购方式：$order_way
*配送与售后：$delivery_sale
*帮助中心：$help_center
-->
                        
                        
                        <?php if ($all_rows > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>分类</th>
                                    <th>标题</th>
                                    <th>作者</th>
                                    <th>时间</th>
                                    <th>内容</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res_list as $r) : ?>
                                <tr>
                                    <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $r->id;?></td>
                                    <td><?php echo $r->title;?></td>
                                    <td><?php echo $r->sub_title;?></td>
                                    <td><?php echo $r->author;?></td>
                                    <td><?php echo $r->time;?></td>
                                    <td><div style="max-height:100px;overflow-y: scroll;"><?php echo $r->help_info;?></div></td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('help_center/edit/'.$r->id); ?>"><i class="icon-edit"></i> 编辑</a>
                                        <a class="btn mini green" href="<?php echo base_url('help_center/delete/'.$r->id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
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