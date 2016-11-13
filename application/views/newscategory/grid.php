<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">新闻管理 <small>新闻管理 </small></h3>
            <?php echo breadcrumb(array('新闻管理', '妙处网公告分类')); ?>
        </div>
    </div>
    <?php echo execute_alert_message();?>
    <div class="row-fluid">
        <div class="span12">
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
                            <a href="<?php echo base_url('newscategory/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th width="20"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th width="50">编号</th>
                                    <th>新闻分类</th>
                                    <th>是否上架</th>
                                    <th>子目录</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($page_list->result() as $item) : ?>
                                <tr>
                                    <td width="20"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td width="50"><?php echo $item->class_id;?></td>
                                    <td><?php echo $item->class_name;?></td>
                                    <td><?php echo $item->status == 1 ? '是' : '否';?></td>
                                    <td> <a class="btn mini red" href="<?php echo base_url('newscontent/search?class_id='.$item->class_id) ?>"><i class="icon-edit"></i>查看</a></td>
                                    <td><?php echo $item->sort;?></td>
                                    <td>
                                        <a class="btn mini green" href="<?php echo base_url('newscategory/edit/'.$item->class_id) ?>"><i class="icon-edit"></i> 编辑</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php $this->load->view('layout/pagination');?>
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