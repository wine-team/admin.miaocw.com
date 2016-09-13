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
                                    <label class="control-label">订 单 号</label>
                                    <div class="controls">
                                        <input type="text" name="order_id" value="<?php echo $this->input->get('order_id');?>" class="m-wrap span12" placeholder="订单ID">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">订单状态</label>
                                    <div class="controls">
                                        <select name="order_status" class="m-wrap span12">
                                            <option value="">请选择</option>
                                            <?php foreach($orderStatus as $k2=>$status) :?>
                                                <option <?php if ($this->input->get('order_status')==$k2):?>selected="selected"<?php endif;?> value="<?php echo $k2;?>"><?php echo $status;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">销售来源</label>
                                    <div class="controls">
                                        <select name="is_form" class="m-wrap medium">
                                            <option  value="">请选择</option>
                                            <?php foreach($is_form as $k3=>$form) :?>
                                                <option <?php if($this->input->get('is_form')==$k3):?>selected="selected"<?php endif;?> value="<?php echo $k3;?>"><?php echo $form;?></option>
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
                                        <input type="text" name="seller_uid" value="<?php echo $this->input->get('seller_uid');?>" class="m-wrap span12" placeholder="请输入供应商UID">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">购 买 者</label>
                                    <div class="controls">
                                        <input type="text" name="payer_uid" value="" class="m-wrap span12" placeholder="请输入购买者用户UID">
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
                        <?php if ( $all_rows > 0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th>订单号</th>
                                        <th>供应商UID</th>
                                        <th>购买者</th>
                                        <th>收货人</th>
                                        <th>订单状态</th>
                                        <th>价格</th>
                                        <th>下单时间</th>
                                        <th width="50">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $item->order_id;?></td>
                                        <td><?php echo $item->seller_uid;?></td>
                                        <td>
                                            <p>账号：<?php echo $item->user_name;?></p>
                                            <p>UID：<?php echo $item->payer_uid;?></p>
                                        </td>
                                        <td>
                                            <?php $delivery = json_decode($item->delivery_address);?>
                                            <p><?php echo $delivery->detailed ?></p>
                                            <p><?php echo $delivery->receiver_name.'/'.$delivery->tel ?></p>
                                        </td>
                                        <td><?php echo $orderStatus[$item->order_status];?></td>
                                        <td>
                                            <p>供应价：<?php echo $item->order_supply_price ?></p>
                                            <p>使用积分：<?php echo $item->integral ?></p>
                                            <p>运费：<?php echo $item->deliver_price ?></p>
                                            <p>支付价：<?php echo $item->actual_price ?></p>
                                        </td>
                                        <td>
                                            <p><?php echo $item->pay_time ?></p>
                                            <p class="btn mini blue"><?php echo $is_form[$item->is_form] ?></p>
                                        </td>
                                        <td>
                                            <a class="btn mini green" href="<?php echo base_url('mall_order_base/info/'.$item->order_id); ?>">详情</a>
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