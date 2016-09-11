<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品订单 <small>订单管理</small></h3>
            <?php echo breadcrumb(array('商品订单 ', 'mall_order_base/grid'=>'订单管理')); ?>
        </div>
    </div>
    <?php  echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="span6">
                <div class="portlet  box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-search"></i>订单详情</div>
                        <div class="tools">
                            <a class="collapse" href="javascript:;"></a>
                            <a class="remove" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul>
                            <li>编号：<?php echo $order->order_id;?></li>
                            <li>订单状态：<?php echo $state_arr[$order->state];?></li>
                            <li>当前状态：<?php echo $status_arr[$order->status];?></li>
                            <li>供应商编号：<?php if ($order->seller_uid) :?><a class="btn mini green" href="<?php echo base_url('user/edit/'.$order->seller_uid);?>">查看供应商 (<?php echo $order->seller_uid;?>)</a><?php else :?>自营<?php endif;?></li>
                            <li>用户名称：<?php echo $order->user_name;?></li>
                            <li>支付方式：<?php echo $order->pay_method==1 ? '在线支付': '到付';?></li>
                            <li>支付银行：<?php echo $order->pay_bank;?></li>
                            <li>快递：<?php if ($order->deliver_order_id) :?>已发货<?php else :?>未发货<?php endif;?></li>
                            <li>运费：<?php echo $order->	deliver_price;?></li>
                            <?php $del = json_decode($order->delivery_address);?>
                            <li>收货地址：（收货人：<?php echo $del->receiver_name;?>，电话：<?php echo $del->tel;?>，地址：<?php echo $del->detailed;?>）</li>
                            <li>供应价格：￥<?php echo $order->order_supply_price;?></li>
                            <li>实际支付：￥<?php echo $order->actual_price;?></li>
                            <li>订单余额（实际支付-退款现金）：￥<?php echo $order->order_pay_price;?></li>
                            <li>促销编码：<?php echo $order->coupon_code;?></li>
                            <li>促销金额：￥<?php echo $order->coupon_price;?></li>
                            <li>使用积分：<?php echo $order->integral;?></li>
                            <li>发票信息：<?php echo json_decode($order->order_invoice);?></li>
                            <li>订单备注：<?php echo $order->order_note;?></li>
                            <li>来源：<?php echo $is_form_arr[$order->is_form];?></li>
                            <li>支付时间：<?php echo $order->pay_time;?></li>
                            <li>下单时间：<?php echo $order->created_at;?></li>
                            <li>最后更新时间：<?php echo $order->updated_at;?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="portlet  box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-search"></i>订单操作记录</div>
                        <div class="tools">
                            <a class="collapse" href="javascript:;"></a>
                            <a class="remove" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="dataTables_wrapper form-inline">
                            <?php if (count($status_history) > 0) :?>
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead class="flip-content">
                                        <tr>
                                            <th>编号</th>
                                            <th>上次操作编号</th>
                                            <th>订单状态</th>
                                            <th>操作说明</th>
                                            <th>操作时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($status_history as $h) : ?>
                                        <tr>
                                            <td><?php echo $h->history_id;?></td>
                                            <td><?php echo $h->parent_id;?></td>
                                            <td><?php echo $h->status;?></td>
                                            <td><?php echo $h->comment;?></td>
                                            <td><?php echo $h->created_at;?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert"><p>未找到数据。<p></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="portlet  box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-search"></i>快递详情</div>
                        <div class="tools">
                            <a class="collapse" href="javascript:;"></a>
                            <a class="remove" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php if($delivery->num_rows() > 0) :?>
                            <ul>
                                <li>快递编号：<?php echo $delivery->row()->deliver_order_id;?></li>
                                <li>快递名称：<?php echo $delivery->row()->deliver_name;?></li>
                                <li>快递标示：<?php echo $delivery->row()->deliver_flag;?></li>
                                <li>快递单号：<?php echo $delivery->row()->deliver_number;?></li>
                                <li>查询结果：<?php echo $delivery_ischeck_arr[$delivery->row()->ischeck];?></li>
                                <li>快递状态：<?php echo $delivery_state_arr[$delivery->row()->state];?></li>
                                <li>快递内容：<?php echo json_decode($delivery->row()->context);?></li>
                                <li>创建时间：<?php echo $delivery->row()->created_at;?></li>
                                <li>更新时间：<?php echo $delivery->row()->updated_at;?></li>
                            </ul>
                        <?php else :?>
                            <p>暂无快递信息</p>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>订单产品列表</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="dataTables_wrapper form-inline">
                        <?php if (count($product) > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th>编号</th>
                                    <th>商品ID</th>
                                    <th>商品名称</th>
                                    <th>规格属性</th>
                                    <th>商品分类</th>
                                    <th>购买数量</th>
                                    <th>换货数量</th>
                                    <th>退货数量</th>
                                    <th>销售价</th>
                                    <th>贝竹价</th>
                                    <th>供应价</th>
                                    <th>可用积分</th>
                                    <th>实际支付单价</th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($product as $p) : ?>
                                <tr>
                                    <td><?php echo $p->order_product_id;?></td>
                                    <td><?php echo $p->goods_id;?></td>
                                    <td><?php echo $p->goods_name;?></td>
                                    <td><?php echo json_decode($p->attr_value);?></td>
                                    <td><?php echo $extension_code_arr[$p->extension_code];?></td>
                                    <td><?php echo $p->number;?></td>
                                    <td><?php echo $p->barter_num;?></td>
                                    <td><?php echo $p->refund_num;?></td>
                                    <td><?php echo $p->market_price;?></td>
                                    <td><?php echo $p->shop_price;?></td>
                                    <td><?php echo $p->supply_price;?></td>
                                    <td><?php echo $p->integral;?></td>
                                    <td><?php echo $p->pay_amount;?></td>
                                    <td><?php echo $p->created_at;?></td>
                                    <td><?php echo $p->updated_at;?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
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