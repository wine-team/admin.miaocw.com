<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">用户管理 <small></small>用户账号管理</h3>
            <?php echo breadcrumb(array('用户管理', 'user/grid'=>'用户账号管理','account_log/grid'=>'账户收支')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('account_log/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">用户UID</label>
                                    <div class="controls">
                                        <input type="text" name="uid" value="<?php echo $this->input->get('uid');?>" class="m-wrap medium" placeholder="请输入用户UID">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">订单编号</label>
                                    <div class="controls">
                                        <input type="text" name="order_id" value="<?php echo $this->input->get('order_id');?>" class="m-wrap medium">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">账户类型</label>
                                    <div class="controls">
                                        <select name="account_type" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach ($account_type as $type_id => $type_name) : ?>
                                                <option value="<?php echo $type_id ?>" <?php if($this->input->get('account_type')==$type_id): ?>selected="selected" <?php endif; ?>><?php echo $type_name ?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">资金用途</label>
                                    <div class="controls">
                                        <select name="flow" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach ($flow as $flow_id => $flow_name) : ?>
                                                <option value="<?php echo $flow_id ?>" <?php if($this->input->get('flow')==$flow_id): ?>selected="selected" <?php endif; ?>><?php echo $flow_name ?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">资金类别</label>
                                    <div class="controls">
                                        <select name="trade_type" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach ($trade_type as $trade_id => $trade_name) : ?>
                                                <option value="<?php echo $trade_id ?>" <?php if($this->input->get('trade_type')==$trade_id): ?>selected="selected" <?php endif; ?>><?php echo $trade_name ?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">创建时间</label>
                                    <div class="controls form-search-time">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="start_date" size="16" value="<?php echo $this->input->get('start_date') ?>" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                        <div class="input-append date date-picker">
                                            <input type="text" name="end_date" size="16" value="<?php echo $this->input->get('end_date')?>" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
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
                                        <th width="15"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th>编号</th>
                                        <th>用户UID</th>
                                        <th>订单ID</th>
                                        <th>账户类型</th>
                                        <th>资金用途</th>
                                        <th>资金类别</th>
                                        <th>金额</th>
                                        <th>说明</th>
                                        <th>创建时间</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $item->log_id;?></td>
                                        <td><?php echo $item->uid;?></td>
                                        <td><?php echo $item->order_id;?></td>
                                        <td><?php echo $account_type[$item->account_type];?></td>
                                        <td><?php echo $flow[$item->flow];?></td>
                                        <td><?php echo $trade_type[$item->trade_type];?></td>
                                        <td><?php echo $item->amount;?></td>
                                        <td><?php echo $item->note;?></td>
                                        <td><?php echo $item->created_at;?></td>
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