<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">财务管理 <small>虚拟充值</small></h3>
            <?php echo breadcrumb(array('财务管理', 'recharge/index'=>'虚拟充值')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('useraccount/rechargelogsearch') ?>" method="get">
                      <div class="row-fluid">
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">开始日期</label>
                                    <div class="controls">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="startDate" size="16" value="<?php echo $this->input->get('startDate') ?>" class="m-wrap m-ctrl-medium date-picker date required">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">结束日期</label>
                                    <div class="controls">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="endDate" size="16" value="<?php echo $this->input->get('endDate') ?>" class="m-wrap m-ctrl-medium date-picker date required">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">充值人</label>
                                    <div class="controls">
                                        <input type="text" name="userName" value="<?php echo $this->input->get('userName') ?>" placeholder="充值人" class="m-wrap medium">
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
                                    <th>记录编号</th>
                                    <th>被充值者用户名</th>
                                    <th>充值金额</th>
                                    <th>收支类型</th>
                                    <th>充值操作人</th>
                                    <th>操作时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultObj->result() as $item) : ?>
                                <tr>
                                    <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $item->log_id;?></td>
                                    <td><?php echo $item->user_name.'/'.$item->alias_name;?></td>
                                    <td><?php echo $item->amount;?></td>
                                    <td><?php echo account_type($item->type);?></td>
                                    <td><?php echo $item->name;?><?php echo $item->realname ? '/'.$item->realname : '';?></td>
                                    <td><?php echo $item->date;?></td>
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