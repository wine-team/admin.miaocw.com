<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>所有网站设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'help_category/grid'=>'帮助中心','添加栏目')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('help_category/add_help_center');?>" method="get">
                        <div class="row-fluid">
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">标题</label>
                                    <div class="controls">
                                         <input type="text" name="sub_title" value="<?php echo trim($this->input->get('sub_title'));?>" placeholder="标题" class="m-wrap medium">
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
                            <a href="<?php echo base_url('help_category/add_help_center?category_id='.$category_id) ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>所属分类</th>
                                    <th>标题</th>
                                    <th>作者</th>
                                    <th>排序</th>
                                    <th>上下架</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pg_list->result() as $item) : ?>
                                <tr>
                                    <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $item->id;?></td>
                                    <td><?php echo $item->help_category_name;?></td>
                                    <td><?php echo $item->sub_title;?></td>
                                    <td><?php echo $item->author;?></td>
                                    <td><?php echo $item->sort?></td>
                                    <td>
                                        <a class="btn mini green" href="<?php echo base_url('help_category/up_down/'.$item->id.'/'.$item->flag.'?category_id='.$item->help_category_id); ?>"  onclick="return confirm('<?php echo ($item->flag==1) ? '确定下架' : '确定上架';?>')">
                                         <?php echo ($item->flag==1) ? '上架' : '下架';?>
                                        </a>
                                    </td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('help_category/edit_help_center/'.$item->id.'?category_id='.$item->help_category_id); ?>"><i class="icon-edit"></i> 编辑</a>
                                        <a class="btn mini green" href="<?php echo base_url('help_category/delete_help_center/'.$item->id.'?category_id='.$item->help_category_id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
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