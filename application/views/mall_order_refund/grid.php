<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品订单 <small>退款审核</small></h3>
            <?php echo breadcrumb(array('商品订单 ', 'mall_order_refund/grid'=>'退款审核')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('mall_order_refund/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">用户名搜索</label>
                                    <div class="controls">
                                        <input type="text" name="item" value="<?php echo $this->input->get('item');?>" class="m-wrap medium" placeholder="请输入用户名称、电话、退款原因、拒绝原因">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">申请状态</label>
                                    <div class="controls">
                                        <select name="state" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach($status_arr as $k1=>$status) :?>
                                            <option <?php if($this->input->get('status')==$k1)echo 'selected="selected"';?> value="<?php echo $k1;?>"><?php echo $status;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">退款状态</label>
                                    <div class="controls">
                                        <select name="flag" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach($flag_arr as $k2=>$flag) :?>
                                            <option <?php if($this->input->get('flag')==$k2)echo 'selected="selected"';?> value="<?php echo $k2;?>"><?php echo $flag;?></option>
                                            <?php endforeach;?>
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
                                    <label class="control-label">创建时间</label>
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
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">审核时间</label>
                                    <div class="controls form-search-time">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="verify_sta_time" size="16" value="<?php echo date('Y-m-d',strtotime('-1 week'));?>" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                        <div class="input-append date date-picker">
                                            <input type="text" name="verify_end_time" size="16" value="<?php echo date('Y-m-d');?>" class="m-wrap m-ctrl-medium date-picker date">
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
                                    <th>退款产品</th>
                                    <th>退款数量</th>
                                    <th>手续费</th>
                                    <th>申请状态</th>
                                    <th>退款状态</th>
                                    <th>快递</th>
                                    <th>退款原因</th>
                                    <th>拒绝理由</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res_list as $r) : ?>
                                <tr>
                                    <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $r->refund_id;?></td>
                                    <td><?php echo $r->user_name.'</br>'.$r->cellphone;?></td>
                                    <td>
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_base/edit/'.$r->order_id); ?>">订单</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_goods_base/edit/'.$r->goods_id); ?>">商品</a>
                                    </td>
                                    <td>原：<?php echo $r->existing;?></br>退：<?php echo $r->number;?></td>
                                    <td><?php echo $r->counter_fee;?></td>
                                    <td><?php echo $status_arr[$r->status];?></td>
                                    <td><?php echo $flag_arr[$r->flag];?></td>
                                    <td><?php if ($r->deliver_order_id) :?>快递ID（<?php echo $r->deliver_order_id;?>）<?php else :?>未发货<?php endif;?></td>
                                    <td><?php echo $r->refund_content;?></td>
                                    <td><?php echo $r->reject_content;?></td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_refund/edit/'.$r->refund_id); ?>"><i class="icon-edit"></i>查看</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_refund/delete/'.$r->refund_id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
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