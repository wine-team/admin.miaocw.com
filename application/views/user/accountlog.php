<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">账户管理<small> 用户管理</small></h3>
            <?php echo breadcrumb(array('账户管理','user/grid'=>'用户列表','账户收支详细')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('user/accountlog') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">关联编号</label>
                                    <div class="controls">
                                        <input type="text" name="order_id" value="<?php echo $this->input->get('order_id');?>" class="m-wrap medium" placeholder="请输入关联的编号"/>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">交易类型</label>
                                    <div class="controls">
                                        <select name="product_type" class="m-wrap medium">
                                            <option  value="0" >全部</option>
                                            <?php foreach ($product_type as $kk=>$vv) : ?>
                                            <option value="<?php echo $kk;?>" <?php if ($kk == $this->input->get('product_type')):?> selected="selected"<?php endif;?>><?php echo $vv;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">用户帐号</label>
                                    <div class="controls">
                                        <input type="text" name="username" value="<?php echo $this->input->get('username');?>" class="m-wrap medium" placeholder="请输入用户名称或别名"/>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">后台充值</label>
                                    <div class="controls">
                                        <input type="text" name="admin_user" value="<?php echo $this->input->get('admin_user');?>" class="m-wrap medium" placeholder="请输入后台充值用户UID"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">账户类型</label>
                                    <div class="controls">
                                        <select name="type" class="m-wrap medium">
                                            <option  value="0" >全部</option>
                                            <?php foreach ($type as $k=>$v) : ?>
                                            <option value="<?php echo $k;?>" <?php if ($k == $this->input->get('type')):?> selected="selected"<?php endif;?>><?php echo $v;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">资金类型</label>
                                    <div class="controls">
                                        <select name="account_type" class="m-wrap medium">
                                            <option  value="0" >全部</option>
                                            <?php foreach ($account_type as $key=>$value) : ?>
                                            <option value="<?php echo $k;?>" <?php if ($key == $this->input->get('account_type')):?> selected="selected"<?php endif;?>><?php echo $value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">开始时间</label>
                                    <div class="controls">
                                        <div class="input-append date form_datetime">
                                            <input type="text" name="start_time" size="16" value="<?php echo $this->input->get('start_time') ?>" class="m-wrap m-ctrl-medium">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">结束时间</label>
                                    <div class="controls">
                                        <div class="input-append date form_datetime">
                                            <input type="text" name="end_time" size="16" value="<?php echo $this->input->get('end_time') ?>" class="m-wrap m-ctrl-medium">
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
                                    <th>关联编号</th>
                                    <th>用户帐号</th>
                                    <th>交易类型</th>
                                    <th>账户类型</th>
                                    <th>资金类型</th>
                                    <th>交易金额</th>
                                    <th>交易时间</th>
                                    <th>可提现金额</th>
                                    <th>后台充值（UID）</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($page_list->result() as $item) : ?>
                                <tr>
                                    <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $item->order_id;?></td>
                                    <td>
                                        <p><?php echo $item->user_name;?>（<?php echo $item->uid;?>）</p>
                                        <p><?php echo $item->alias_name;?></p>
                                    </td>
                                    <td><?php echo $product_type[$item->product_type];?></td>
                                    <td><?php echo $type[$item->type];?></td>
                                    <td><?php echo $account_type[$item->account_type];?></td>
                                    <td><?php echo $item->amount;?></td>
                                    <td><?php echo $item->date;?></td>
                                    <td><?php echo $item->amount_carry;?></td>
                                    <td><?php echo $item->remittance_person;?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="row-fluid">
                            <div class="dataTables_info">
                                <span>当前第</span><span style="color: red"><?php echo $pg_now?></span>页 
                                <span>共</span><span style="color: red"><?php echo $all_rows?></span>条数据
                                <span>每页显示20条 </span>
                                <?php echo $pg_list ?>
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