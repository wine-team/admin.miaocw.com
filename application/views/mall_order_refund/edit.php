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
                            <li>编号：<?php echo $refund->refund_id;?></li>
                            <li>订单产品编号：<?php echo $refund->order_product_id;?></li>
                            <li>订单：<a class="btn mini green" href="<?php echo base_url('mall_order_base/edit/'.$refund->order_id); ?>">查看订单</a></li>
                            <li>商品：<a class="btn mini green" href="<?php echo base_url('mall_goods_base/edit/'.$refund->goods_id); ?>">查看商品</a></li>
                            <li>退货前数量：<?php echo $refund->existing;?></li>
                            <li>退货数量：<?php echo $refund->number;?></li>
                            <li>供应商编号：<?php if ($refund->seller_uid) :?><a class="btn mini green" href="<?php echo base_url('/'.$refund->seller_uid);?>">查看供应商</a><?php else :?>自营<?php endif;?></li>
                            <li>用户：<?php $refund->user_name?></li>
                            <li>电话：<?php echo $refund->cellphone;?></li>
                            <li>申请状态：<?php echo $status_arr[$refund->status];?></li>
                            <li>手续费：￥<?php echo $refund->counter_fee;?></li>
                            <li>快递编号：<?php echo $refund->deliver_order_id;?></li>
                            <li>图片：<?php echo $refund->images;?></li>
                            <li>退款状态：<?php echo $flag_arr[$refund->flag];?></li>
                            <li>退款原因：<?php echo $refund->refund_content;?></li>
                            <li>拒绝理由：<?php echo $refund->reject_content;?></li>
                            <li>创建时间：<?php echo $refund->created_at;?></li>
                            <li>审核时间：<?php echo $refund->verify_time;?></li>
                        </ul>
                    </div>
                </div>
                </div>
                <div class="span6">
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
                            <li>创建时间：<?php echo $delivery->row()->create_at;?></li>
                            <li>更新时间：<?php echo $delivery->row()->update_at;?></li>
                        </ul>
                        <?php else :?>
                        <p>暂无快递信息</p>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>