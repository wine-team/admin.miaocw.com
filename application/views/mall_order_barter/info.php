<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品订单
                <small>换货详情</small>
            </h3>
            <?php echo breadcrumb(array('mall_order_base/grid' => '商品订单', 'mall_order_barter/grid' => '退货详情')); ?>
        </div>
    </div>
    <?php echo execute_alert_message();?>
    <div class="row-fluid">
        <div class="span6">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>换货详情</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_order_barter/verify')?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label">名称商品</label>
                            <div class="controls">
                                <input type="hidden" value="<?php echo $barter->barter_id ?>" name="barter_id">
                                <input type="text" value="<?php echo $barter->goods_name ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">换货数量</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $barter->number ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">供应商</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $barter->alias_name ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">申请人</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $barter->user_name ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">手机号码</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $barter->cellphone ?>" class="m-wrap span8 required" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">附件：</label>
                            <div class="controls">
                                <a target="_blank" href="<?php echo $this->config->show_image_url('mall', $barter->images);?>">
                                    <img src="skins/admin/images/photo5.jpg" data-original="<?php echo $this->config->show_image_url('mall', $barter->images);?>" width="150" height="150">
                                </a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>换货原因</label>
                            <div class="controls">
                                <textarea name="refund_content" class="m-wrap span10"><?php echo $barter->refund_content;?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">拒绝原因</label>
                            <div class="controls">
                                <textarea name="reject_content" class="m-wrap span10"><?php echo $barter->reject_content; ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>审核状态</label>
                            <div class="controls">
                                <select name="status" class="m-wrap span8">
                                    <?php foreach ($barterStatus as $key => $value): ?>
                                        <option value="<?php echo $key ?>" <?php if ($key == $barter->status): ?>selected="selected" <?php endif; ?>><?php echo $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>换货状态</label>
                            <div class="controls">
                                <select name="flag" class="m-wrap span8">
                                    <?php foreach ($barterFlag as $key => $value): ?>
                                        <option value="<?php echo $key ?>" <?php if ($key == $barter->flag): ?>selected="selected" <?php endif; ?>><?php echo $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">创建时间</label>
                            <div class="controls">
                                <span class="help-inline"><?php echo $barter->created_at;?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">审核时间</label>
                            <div class="controls">
                                <span class="help-inline"><?php echo $barter->verify_time;?></span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('mall_order_barter/grid');?>">
                                <button class="btn" type="button">返回</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-picture"></i>
                        <span>物流：<?php if($logistics->num_rows() > 0){echo $logistics->row()->deliver_name;}  ?></span>
                        <span>快递单号：<?php echo $barter->logistics;?></span>
                    </div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php if($barter->logistics): ?>
                    <table class="table table-condensed table-hover">
                        <tr>
                            <th>时间</th>
                            <th>地点和跟踪进度</th>
                        </tr>
                        <?php if($logistics->num_rows() > 0): ?>
                            <?php $logistics = $logistics->row(); ?>
                            <?php if($logistics->context): ?>
                                <?php $data = json_decode($logistics->context); ?>
                                <?php foreach($data as $value): ?>
                                    <tr>
                                        <td><?php echo $value->time; ?></td>
                                        <td><?php echo $value->context; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php endif ?>
                        <?php else: ?>
                            未填写快递单号
                        <?php endif ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>