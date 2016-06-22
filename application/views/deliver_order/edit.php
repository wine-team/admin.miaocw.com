<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">快递管理<small> 快递订单记录详情</small></h3>
            <?php echo breadcrumb(array('快递管理', '快递订单记录', '快递订单记录详情')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span6">
            <div class="portlet sale-summary">
                <div class="portlet-title">
                    <div class="caption">快递订单记录详情</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <ul class="unstyled">
                    <li>
                        <span class="sale-info">编号</span>
                        <span class="sale-num"><?php echo $deliverOrder->deliver_order_id ?></span>
                    </li>
                    <li>
                        <span class="sale-info">订单编号</span>
                        <span class="sale-num"><?php echo $deliverOrder->order_id ?></span>
                    </li>
                    <li>
                        <span class="sale-info">用户编号</span>
                        <span class="sale-num"><?php echo $deliverOrder->uid ?></span>
                    </li>
                    <li>
                        <span class="sale-info">快递名称</span>
                        <span class="sale-num"><?php echo $deliverOrder->deliver_name ?></span>
                    </li>
                    <li>
                        <span class="sale-info">快递标识</span>
                        <span class="sale-num"><?php echo $deliverOrder->deliver_flag ?></span>
                    </li>
                    <li>
                        <span class="sale-info">快递单号</span>
                        <span class="sale-num"><?php echo $deliverOrder->deliver_number ?></span>
                    </li>
                    <li>
                        <span class="sale-info">快递结果状态</span>
                        <span class="sale-num"><?php echo $ischeck[$deliverOrder->ischeck] ?></span>
                    </li>
                    <li>
                        <span class="sale-info">快递当前状态</span>
                        <span class="sale-num"><?php echo $state[$deliverOrder->state] ?></span>
                    </li>
                    <li>
                        <span class="sale-info">快递添加时间</span>
                        <span class="sale-num"><?php echo $deliverOrder->created_at ?></span>
                    </li>
                    <li>
                        <span class="sale-info">快递更新时间</span>
                        <span class="sale-num"><?php echo $deliverOrder->updated_at ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="span6">
            <div class="portlet sale-summary">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>快递订单跟踪</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <?php $context = $deliverOrder->context; ?>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th class="hidden-480">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Hardware</td>
                        <td class="hidden-480">Server hardware purchase</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Furniture</td>
                        <td class="hidden-480">Office furniture purchase</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>