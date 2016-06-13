<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品订单 <small>订单管理</small></h3>
            <?php echo breadcrumb(array('商品订单 ', 'mall_order_base/grid'=>'订单管理')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('mall_order_base/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">用户名搜索</label>
                                    <div class="controls">
                                        <input type="text" name="item" value="<?php echo $this->input->get('item');?>" class="m-wrap medium" placeholder="请输入用户名称、订单备注">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">订单状态</label>
                                    <div class="controls">
                                        <select name="state" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <option <?php if($this->input->get('state')==1)echo 'selected="selected"';?> value="1">未付款</option>
                                            <option <?php if($this->input->get('state')==2)echo 'selected="selected"';?> value="2">已付款</option>
                                            <option <?php if($this->input->get('state')==3)echo 'selected="selected"';?> value="3">电脑端</option>
                                            <option <?php if($this->input->get('state')==4)echo 'selected="selected"';?> value="4">已完成</option>
                                            <option <?php if($this->input->get('state')==5)echo 'selected="selected"';?> value="5">退款</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">当前状态</label>
                                    <div class="controls">
                                        <select name="status" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <option <?php if($this->input->get('status')==1)echo 'selected="selected"';?> value="1">取消订单</option>
                                            <option <?php if($this->input->get('status')==2)echo 'selected="selected"';?> value="2">未付款</option>
                                            <option <?php if($this->input->get('status')==3)echo 'selected="selected"';?> value="3">已付款</option>
                                            <option <?php if($this->input->get('status')==4)echo 'selected="selected"';?> value="4">已发货</option>
                                            <option <?php if($this->input->get('status')==5)echo 'selected="selected"';?> value="5">已收货</option>
                                            <option <?php if($this->input->get('status')==6)echo 'selected="selected"';?> value="6">已评价</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">供应商ID</label>
                                    <div class="controls">
                                        <input type="number" name="seller_uid" value="<?php echo $this->input->get('seller_uid');?>" class="m-wrap medium" placeholder="请输入供应商ID">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">来源</label>
                                    <div class="controls">
                                        <select name="is_form" class="m-wrap medium">
                                            <option  value="">请选择</option>
                                            <option <?php if($this->input->get('is_form')==1)echo 'selected="selected"';?> value="1">电脑端</option>
                                            <option <?php if($this->input->get('is_form')==2)echo 'selected="selected"';?> value="2">手机端</option>
                                            <option <?php if($this->input->get('is_form')==3)echo 'selected="selected"';?> value="3">其他</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">下单时间</label>
                                    <div class="controls form-search-time">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="sta_time" size="16" value="<?php echo date('Y-m-d',strtotime('-1 week'));?>" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                        <div class="input-append date date-picker">
                                            <input type="text" name="end_time" size="16" value="<?php echo date('Y-m-d');?>" class="m-wrap m-ctrl-medium date-picker date">
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
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>用户名</th>
                                    <th>订单状态</th>
                                    <th>当前状态</th>
                                    <th>快递</th>
                                    <th>价格</th>
                                    <th>备注</th>
                                    <th>下单时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res_list as $r) : ?>
                                <tr>
                                    <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $r->order_id;?></td>
                                    <td><?php echo $r->user_name;?></td>
                                    <td>
                                    <?php switch ($r->state) {
                                        case 1 : echo '未付款';break;
                                        case 2 : echo '已付款';break;
                                        case 3 : echo '已完成';break;
                                        case 4 : echo '评价';break;
                                        case 5 : echo '退款';break;
                                    }?>
                                    </td>
                                    <td>
                                    <?php switch ($r->status) {
                                        case 1 : echo '取消订单';break;
                                        case 2 : echo '未付款';break;
                                        case 3 : echo '已付款';break;
                                        case 4 : echo '已发货';break;
                                        case 5 : echo '已收货';break;
                                        case 6 : echo '已评价';break;
                                    }?>
                                    </td>
                                    <td>
                                        <?php echo '运费：￥'.$r->deliver_price.'</br>地址：'.json_decode($r->delivery_address).'</br>';?>
                                        <?php if ($r->deliver_order_id) :?><a class="btn mini green delivery" data-deliver_order_id="<?php echo $r->deliver_order_id;?>">查看快递</a><?php else :?>未发货<?php endif;?>
                                    </td>
                                    <td>
                                        <?php echo '供应价：￥'.$r->order_supply_price.'</br>支付价：￥'.$r->actual_price.'</br>使用积分'.$r->integral;?>
                                    </td>
                                    <td><?php echo $r->order_note;?></td>
                                    <td>
                                    <?php switch ($r->is_form) {
                                        case 1 : echo '电脑端';break;
                                        case 2 : echo '手机端';break;
                                        case 3 : echo '其他';break;
                                    }
                                    echo '</br>'.$r->pay_time; 
                                    ?>
                                    </td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_base/edit/'.$r->order_id); ?>"><i class="icon-edit"></i>查看</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_base/delete/'.$r->order_id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
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
<?php $this->load->view('mall_order_base/delivery/ajaxGetDelivery');?>