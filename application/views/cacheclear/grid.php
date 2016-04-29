<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>缓存管理 </small></h3>
            <?php echo breadcrumb(array('网站设置', '缓存管理')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('cacheclear/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">cache名称</label>
                                    <div class="controls">
                                        <input class="m-wrap medium" type="text" name="cache_name" value="<?php echo $this->input->get('cache_name')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">cache_id</label>
                                    <div class="controls">
                                        <input class="m-wrap medium" type="text" name="cache_id" value="<?php echo $this->input->get('cache_id')?>">
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
                            <a href="<?php echo base_url('cacheclear/clearAll') ?>">
                                <div class="btn-group">
                                    <button class="btn green"> 清理所有缓存</button>
                                </div>
                            </a>
                            <a href="<?php echo base_url('cacheclear/add') ?>" class="add-button-link">
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
                                    <th>cache名称</th>
                                    <th>cache_id</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($page_list->result() as $item) : ?>
                                <tr>
                                    <td width="20"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td width="50"><?php echo $item->id ;?></td>
                                    <td><?php echo $item->cache_name;?></td>
                                    <td><?php echo $item->cache_id;?></td>
                                    <td>
                                        <a class="btn mini green" href="<?php echo base_url('cacheclear/clear/'.$item->id) ?>">清除缓存</a>
                                        <a class="btn mini green" href="<?php echo base_url('cacheclear/delete/'.$item->id) ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
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