<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">订单管理
                <small> 订单管理</small>
            </h3>
            <?php echo breadcrumb(array('订单管理', 'mall_order_base/grid' => '订单管理', '订单详情')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span4">
            <div class="portlet sale-summary">
                <div class="portlet-title">
                    <div class="caption">订单详情</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <ul class="unstyled">
                    <li>
                        <span class="sale-info">订单号 <i class="icon-img-down"></i></span>
                        <span class="sale-num"><?php echo $orderBase->order_id; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">支付状态</span>
                        <span class="sale-num"><?php echo $orderState[$orderBase->order_state]; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">订单状态</span>
                        <span
                            class="sale-num"><?php echo $orderStatus[$orderBase->order_status]; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">购买者（用户名/UID）</span>
                        <span class="sale-num"><?php echo $orderBase->user_name.' | '.$orderBase->payer_uid; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">供应商UID</span>
                        <span class="sale-num"><?php echo $orderBase->seller_uid; ?></span>
                    </li>
                    <?php $delivery = json_decode($orderBase->delivery_address);?>
                    <li>
                        <span class="sale-info">收货人</span>
                        <span class="sale-num"><?php echo $delivery->receiver_name; ?> | <?php echo $delivery->tel; ?> | <?php echo isset($delivery->code) ? $delivery->code : ''; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">收货地址</span>
                        <span class="sale-num"><?php echo $delivery->detailed; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">发票抬头</span>
                        <span class="sale-num"><?php //echo $orderBase->vanguard;?></span>
                    </li>
                    <li>
                        <span class="sale-info">订单备注</span>
                        <span class="sale-num"><?php echo $orderBase->order_note; ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="span4">
            <div class="portlet sale-summary">
                <div class="portlet-title">
                    <div class="caption">操作时间</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <ul class="unstyled">
                    <li>
                        <span class="sale-info">下单时间</span>
                        <span class="sale-num"><?php echo $orderBase->created_at; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">支付时间</span>
                        <span class="sale-num"><?php echo $orderBase->pay_time; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">发货时间</span>
                        <span class="sale-num"><?php echo $orderBase->send_time; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">收货时间</span>
                        <span class="sale-num"><?php echo $orderBase->receive_time; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">评价时间</span>
                        <span class="sale-num"><?php echo $orderBase->reviews_time; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">修改时间</span>
                        <span class="sale-num"><?php echo $orderBase->updated_at; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">下单设备</span>
                        <span class="sale-num"><?php echo $is_form[$orderBase->is_form] ?></span>
                    </li>
                    <li>
                        <span class="sale-info"></span>
                        <span class="sale-num"></span>
                    </li>
                    <?php if ($orderBase->order_status == 2) :?>
                        <?php $time = strtotime($orderBase->created_at) - time() + 3600 * 24?>
                        <?php if ($time > 0) :?>
                            <?php
                                $days = intval($time / 86400);
                                $remain = $time % 86400;
                                $hours = intval($remain / 3600);
                                $remain = $remain % 3600;
                                $mins = intval($remain / 60);
                                $secs = $remain % 60;
                            ?>
                            <li>
                                <span class="sale-info">距离支付时间还有</span>
                                <span class="sale-num"><span><?php echo $days ?>天<?php echo $hours ?>小时<?php echo $mins ?>分</span>来支付，超时订单自动取消</span>
                            </li>
                        <?php endif;?>
                    <?php elseif ($orderBase->order_status == 4) :?>
                        <?php $time = strtotime($orderBase->send_time) - time() + 3600 * 24 * 7?>
                        <?php if ($time > 0) :?>
                            <?php
                                $days = intval($time / 86400);
                                $remain = $time % 86400;
                                $hours = intval($remain / 3600);
                                $remain = $remain % 3600;
                                $mins = intval($remain / 60);
                                $secs = $remain % 60;
                            ?>
                            <li>
                                <span class="sale-info">距离收货时间还有</span>
                                <span class="sale-num"><span><?php echo $days ?>天<?php echo $hours ?>小时<?php echo $mins ?>分</span>来确认收货，超时订单自动确认收货</span>
                            </li>
                        <?php endif;?>
                    <?php elseif ($orderBase->order_status == 5) :?>
                        <?php $time = strtotime($orderBase->receive_time) - time() + 3600 * 24 * 7?>
                        <?php if ($time > 0) :?>
                            <?php
                                $days = intval($time / 86400);
                                $remain = $time % 86400;
                                $hours = intval($remain / 3600);
                                $remain = $remain % 3600;
                                $mins = intval($remain / 60);
                                $secs = $remain % 60;
                            ?>
                            <li>
                                <span class="sale-info">距离好评时间还有</span>
                                <span class="sale-num"><span><?php echo $days ?>天<?php echo $hours ?>小时<?php echo $mins ?>分</span>来评价，超时订单将自动好评</span>
                            </li>
                        <?php endif;?>
                    <?php endif;?>
                </ul>
            </div>
        </div>
        <div class="span4">
            <div class="portlet sale-summary">
                <div class="portlet-title">
                    <div class="caption">支付信息</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <ul class="unstyled">
                    <li>
                        <span class="sale-info">支付方式<i class="icon-img-up"></i></span>
                        <span class="sale-num"><?php echo $orderBase->pay_method == 1 ? '在线支付' : '到付'; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">支付银行 <i class="icon-img-down"></i></span>
                        <span class="sale-num"><?php echo $orderBase->pay_bank == 201 ? '微信支付' : (!empty($payMethod) ? $payMethod->bank_name : '未选择'); ?></span>
                    </li>
                    <li>
                        <span class="sale-info">供应总价</span>
                        <span class="sale-num">￥<?php echo $orderBase->order_supply_price;?></span>
                    </li>
                    <li>
                        <span class="sale-info">销售总价</span>
                        <span class="sale-num">￥<?php echo $orderBase->order_shop_price; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">优惠劵编码</span>
                        <span class="sale-num"><?php echo !empty($orderBase->coupon_code) ? $orderBase->coupon_code : '未使用'; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">优惠劵金额</span>
                        <span class="sale-num">￥<?php echo $orderBase->coupon_price; ?></span>
                    </li>
                    <li>
                        <span class="sale-info">运费价格</span>
                        <span class="sale-num">
                            <?php if ($orderBase->order_status == 2) : //未付款时 ?>
                                <span class="original-price">￥
                                    <span><?php echo $orderBase->deliver_price; ?></span>
                                    <a class="btn green edit-price" href="javascript:;">修改</a>
                                </span>
                                <span class="new-price" style="display:none">
                                    <input type="hidden" name="order_id" value="<?php echo $orderBase->order_id; ?>">
                                    <input type="text" name="deliver_price" value="<?php echo $orderBase->deliver_price; ?>" class="m-wrap span8">
                                    <a class="btn green save-price" href="javascript:;">保存</a>
                                </span>
                            <?php else :?>
                                <span>￥<?php echo $orderBase->deliver_price; ?></span>
                            <?php endif;?>
                        </span>
                    </li>
                    <li>
                        <span class="sale-info">退款金额</span>
                        <span class="sale-num">￥<?php echo bcsub($orderBase->actual_price, $orderBase->order_pay_price, 2); ?></span>
                    </li>
                    <li>
                        <span class="sale-info">实际支付</span>
                        <span class="sale-num">￥<?php echo bcadd($orderBase->actual_price, $orderBase->deliver_price, 2); ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption"><i class="icon-picture"></i>购买的产品</div>
            <div class="tools">
                <a class="collapse" href="javascript:;"></a>
                <a class="remove" href="javascript:;"></a>
            </div>
        </div>
        <div class="portlet-body">
            <?php if ($orderProduct->num_rows() > 0) : ?>
                <table class="table table-condensed table-hover">
                    <tr>
                        <th>订单产品ID</th>
                        <th>订单ID</th>
                        <th>产品ID</th>
                        <th>产品名称</th>
                        <th>购买数量</th>
                        <th>退货数量</th>
                        <th>换货数量</th>
                        <th>价格(销售价/贝竹价/供应价)</th>
                        <th>实际应付（元）</th>
                        <th>创建时间</th>
                        <th>更新时间</th>
                    </tr>
                    <?php foreach ($orderProduct->result() as $product) : ?>
                        <tr>
                            <td><?php echo $product->order_product_id; ?></td>
                            <td><?php echo $product->order_id; ?></td>
                            <td><?php echo $product->goods_id; ?></td>
                            <td><?php echo $product->goods_name; ?></td>
                            <td><?php echo $product->number; ?></td>
                            <td><?php echo bcsub($product->number, $product->refund_num, 0); ?></td>
                            <td><?php echo $product->barter_num; ?></td>
                            <td><?php echo $product->market_price; ?> / <?php echo $product->shop_price; ?> / <?php echo $product->supply_price; ?></td>
                            <td><?php echo $product->pay_amount; ?></td>
                            <td><?php echo $product->created_at; ?></td>
                            <td><?php echo $product->updated_at; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <div class="alert"><p>未找到数据。<p></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span6">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-picture"></i>用户分润</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php if ($orderProductProfit->num_rows() > 0) : ?>
                        <table class="table table-condensed table-hover">
                            <tr>
                                <th>订单产品ID</th>
                                <th>分钱用户</th>
                                <th>账户类型</th>
                                <th>金额（元）</th>
                                <th>资金流向</th>
                            </tr>
                            <?php foreach ($orderProductProfit->result() as $item) : ?>
                                <tr>
                                    <td><?php echo $item->order_product_id; ?></td>
                                    <td><?php echo $item->uid ?></td>
                                    <td><?php echo ($item->account_type == 1) ? '提现' : '月结'; ?></td>
                                    <td><?php echo $item->account; ?></td>
                                    <td><?php echo ($item->as == 1) ? '入账' : '出账'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else : ?>
                        <div class="alert"><p>未找到数据。<p></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-picture"></i>
                        <span>物流：<?php if ($deliverOrder->num_rows() > 0) echo $deliverOrder->row()->deliver_name ?></span>
                        <span>快递单号：<?php if ($deliverOrder->num_rows() > 0) echo $deliverOrder->row()->deliver_number ?></span>
                    </div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <th>时间</th>
                            <th>地点和跟踪进度</th>
                        </tr>
                        <?php if ($deliverOrder->num_rows() > 0): ?>
                            <?php $logistics = $deliverOrder->row(); ?>
                            <?php if ($logistics->context): ?>
                                <?php $data = json_decode($logistics->context); ?>
                                <?php foreach($data as $value): ?>
                                    <tr>
                                        <td><?php echo $value->time; ?></td>
                                        <td><?php echo $value->context; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php else: ?>
                            <tr>
                                <td>快递未订阅成功</td>
                                <td><a href="<?php echo base_url('tourismorder/expressRecord/'.$orderBase->order_id) ?>">从新订阅</a></td>
                            </tr>
                        <?php endif ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-picture"></i>订单操作记录</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php if ($orderHistory->num_rows() > 0) : ?>
                        <table class="table table-condensed table-hover">
                            <tr>
                                <th>自增ID</th>
                                <th>订单ID</th>
                                <th>操作时间</th>
                                <th>用户UID</th>
                                <th>操作类型</th>
                                <th>操作说明</th>
                            </tr>
                            <?php foreach ($orderHistory->result() as $item) : ?>
                                <tr>
                                    <td><?php echo $item->history_id ?></td>
                                    <td><?php echo $item->order_id ?></td>
                                    <td><?php echo $item->operate_time ?></td>
                                    <td><?php echo $item->uid ?></td>
                                    <td><?php echo $operateType[$item->operate_type] ?></td>
                                    <td><?php echo $item->comment ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else : ?>
                        <div class="alert"><p>未找到数据。<p></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-actions">
    <a href="<?php echo base_url('mall_order_base/grid') ?>">
        <button class="btn" type="button">返回</button>
    </a>
</div>
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.edit-price').click(function(){
            $('.original-price').hide();
            $('.new-price').show().children('input[name=deliver_price]').focus();
        });
        $('.save-price').click(function(){
            var deliverPrice = parseFloat($('input[name=deliver_price]').val());
            $.ajax({
                type: 'post',
                async: true,
                dataType: 'json',
                url: hostUrl() + '/mall_order_base/modifyDeliverPrice',
                data: {deliver_price:deliverPrice,order_id:$('input[name=order_id]').val()},
                success: function (data) {
                    if (data.status) {
                        $('.original-price').show().children('span').text(deliverPrice);
                        $('.new-price').hide();
                    } else {
                        alert(data.messages);
                    }
                }
            });
        });
    });
</script>
