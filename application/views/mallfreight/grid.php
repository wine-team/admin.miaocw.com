<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理
                <small>运费模版</small>
            </h3>
            <?php echo breadcrumb(array('商品管理',"mall_freight/grid" => '运费模板'));?>
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
                    <form class="form-horizontal form-search"
                          action="<?php echo base_url('mall_freight/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">模板名称</label>
                                    <div class="controls">
                                        <input type="text" name="name" value="<?php echo $this->input->get('name'); ?>" placeholder="请输入模板名称" class="m-wrap medium">
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">模板所属（供应商）</label>
                                    <div class="controls">
                                        <input type="text" name="provider_name" value="<?php echo $this->input->get('provider_name'); ?>" placeholder="请输入供应商用户名或别名" class="m-wrap medium">
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
                            <a href="<?php echo base_url('mall_freight/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($list->num_rows > 0): ?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th width="15"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th>模板名称</th>
                                        <th>模板所属（供应商UID）</th>
                                        <th>计价方式</th>
                                        <th>配送方式</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list->result() as $item): ?>
                                    <tr>
                                        <th width="15"><input type="checkbox" class="group-checkable"></th>
                                        <td><?php echo $item->name ?></td>
                                        <td><?php echo ($item->phone ? $item->phone : $item->email).'<br />'.'('.$item->uid.')';?></td>
                                        <td><?php echo ($item->methods == 1) ? '按件计价' : '按重量计价'; ?></td>
                                        <td><?php echo ($item->logistics == 1) ? '快递' : '物流'; ?></td>
                                        <td width="100">
                                            <a class="btn mini green" href="<?php echo base_url('mall_freight/edit/' . $item->freight_id) ?>">编辑</a>
                                            <a class="btn mini green" href="<?php echo base_url('mall_freight/delete/' . $item->freight_id) ?>">删除</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="dataTables_info">
                                        <span>当前第</span><span style="color: red"><?php echo $pg_now ?></span>页
                                        <span>共</span><span style="color: red"><?php echo $all_rows ?></span>条数据
                                        <span>每页显示20条 </span>
                                        <?php echo $pg_list ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert"><p>未找到数据。<p></div>
                         <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer'); ?>