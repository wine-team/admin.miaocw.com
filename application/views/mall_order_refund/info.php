<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品订单 <small>退款审核</small></h3>
            <?php echo breadcrumb(array('商品订单 ', 'mall_order_refund/grid'=>'退款审核')); ?>
        </div>
    </div>
    <?php echo execute_alert_message();?>
    <div class="row-fluid">
    	<div class="span6">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>退款详情</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_order_refund/editPost')?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label">名称商品</label>
                            <div class="controls">
                                <input type="hidden" name="refund_id" value="<?php echo $refund->refund_id ?>">
                                <input type="hidden" name="order_product_id" value="<?php echo $refund->order_product_id;?>"/>
                                <input type="text" name="goods_name" value="<?php echo $refund->goods_name; ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">退货数量</label>
                            <div class="controls">
                                <input type="text" name="number" value="<?php echo $refund->number ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">供应商</label>
                            <div class="controls">
                                <input type="text" name="alias_name" value="<?php echo $refund->alias_name ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">申请人</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $refund->user_name ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">手机号码</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $refund->cellphone ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                       <div class="control-group">
                            <label class="control-label"><em>* </em>退款手续费</label>
                            <div class="controls">
                                <input type="text" name='counter_fee' value="<?php echo $refund->counter_fee ?>" class="m-wrap span8 required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">附件：</label>
                            <div class="controls">
                                <a target="_blank" href="<?php echo $this->config->show_image_url('mall', $refund->images) ?>">
                                    <img src="<?php echo $this->config->show_image_url('mall', $refund->images) ?>" width="150" height="150">
                                </a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>换货原因</label>
                            <div class="controls">
                                <textarea name="refund_content" class="m-wrap span10 required"><?php echo $refund->refund_content; ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>拒绝原因</label>
                            <div class="controls">
                                <textarea name="reject_content" class="m-wrap span10"><?php echo $refund->reject_content; ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>退款状态</label>
                            <div class="controls">
                                <select name="status" class="span8 m-wrap">
                                    <?php foreach ($status_arr as $key => $value): ?>
                                        <option value="<?php echo $key ?>" <?php if ($key == $refund->status): ?>selected="selected" <?php endif; ?>><?php echo $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否退款</label>
                            <div class="controls">
                                <select name="flag" class="span8 m-wrap" disabled="disabled">
                                    <?php foreach ($flag_arr as $k => $v): ?>
                                        <option value="<?php echo $k ?>" <?php if ($k == $refund->flag): ?>selected="selected" <?php endif; ?>><?php echo $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">创建时间</label>
                            <div class="controls">
                                <span class="help-inline"><?php echo $refund->created_at?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">审核时间</label>
                            <div class="controls">
                                <span class="help-inline"><?php echo $refund->verify_time?></span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('mall_order_refund/grid') ?>">
                                <button class="btn" type="button">返回</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if($delivery->num_rows() > 0):?>
        <?php $deliveryResult = $delivery->row(0);?>
        <div class="span6">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-picture"></i>
                        <span>物流：<?php echo $deliveryResult->deliver_name;?></span>
                        <span>快递单号：<?php echo $deliveryResult->deliver_number;?></span>
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
                        <?php if(!empty($deliveryResult->context)): ?>
                            <?php $data = json_decode($deliveryResult->context); ?>
                            <?php foreach($data as $value): ?>
                               <tr>
                                   <td><?php echo $value->time; ?></td>
                                   <td><?php echo $value->context; ?></td>
                               </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </table>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>   
</div>
<?php $this->load->view('layout/footer');?>