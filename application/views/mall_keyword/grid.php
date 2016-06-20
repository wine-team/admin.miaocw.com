<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">热门搜索<small>搜索列表</small></h3>
            <?php echo breadcrumb(array('热门搜索', 'keyword_search/grid'=>'搜索列表')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('mall_keyword/grid');?>" method="get">
                        <div class="row-fluid">
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">关键词</label>
                                    <div class="controls">
                                        <input type="text" name="key_word" value="<?php echo trim($this->input->get('key_word'));?>" class="m-wrap medium" placeholder="请输入你要搜索的关键词">
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
                                        <th>关键词</th>
                                        <th>搜索次数</th>
                                        <th>排序</th>
                                        <th>创建时间</th>
                                        <th>更新时间</th>
                                        <th width="125">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($res_list->result() as $r) : ?>
                                    <tr>
                                        <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $r->id;?></td>
                                        <td><?php echo $r->key_word;?></td>
                                        <td><?php echo $r->number;?></td>
                                        <td><?php echo $r->sort;?></td>
                                        <td><?php echo $r->created_at;?></td>
                                        <td><?php echo $r->updated_at;?></td>
                                        <td>
                                            <a class="btn mini green" href="<?php echo base_url('mall_keyword/edit/'.$r->id); ?>" ><i class="icon-edit"></i> 修改</a>
                                            <a class="btn mini green" href="<?php echo base_url('mall_keyword/delete/'.$r->id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
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