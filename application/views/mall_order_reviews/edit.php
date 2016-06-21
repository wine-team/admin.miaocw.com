<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品订单 <small>评价管理</small></h3>
            <?php echo breadcrumb(array('商品订单 ', 'mall_order_reviews/grid'=>'评价管理')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="span6">
                <div class="portlet  box green">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-search"></i>评价详情</div>
                        <div class="tools">
                            <a class="collapse" href="javascript:;"></a>
                            <a class="remove" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul>
                            <li>编号：<?php echo $reviews->reviews_id;?></li>
                            <li>订单产品编号：<?php echo $reviews->order_product_id;?></li>
                            <li>订单：<a class="btn mini green" href="<?php echo base_url('mall_order_base/edit/'.$reviews->order_id); ?>">查看订单</a></li>
                            <li>商品：<a class="btn mini green" href="<?php echo base_url('mall_goods_base/edit/'.$reviews->goods_id); ?>">查看商品</a></li>
                            <li>商品名称：<?php echo $reviews->goods_name;?></li>
                            <li>商品属性：<?php echo json_decode($reviews->goods_attr);?></li>
                            <li>用户：<?php echo $reviews->user_name;?></li>
                            <li>评价：<?php echo $reviews->content;?></li>
                            <li>评分：<?php echo $reviews->score;?></li>
                            <li>图片：
                            <?php foreach(explode('|', $reviews->slide_show) as $img) :?>
                            <?php if($img) :?>
                            <img src="<?php echo $this->config->images_url.$img;?>" style="max-height:120px;max-width:100px;">
                            <?php endif;?>
                            <?php endforeach;?>
                            </li>
                            <li>状态：<?php echo $status_arr[$reviews->status];?></li>
                            <li>评价时间：<?php echo $reviews->created_at;?></li>
                            <li>更新时间：<?php echo $reviews->updated_at;?></li>
                        </ul>
                    </div>
                    <?php if($reviews->status==1) :?>
                    <div class="portlet-body form" style="border-top: 1px solid #e5e5e5;">
                        <form class="form-horizontal line-form" action="<?php echo base_url('mall_order_reviews/editPost') ?>" method="get" enctype="multipart/form-data">
                            
                            <input type="hidden" name="reviews_id" value="<?php echo $reviews->reviews_id;?>">
                            
                            <div class="control-group">
                                <label class="control-label"><em>* </em>审核</label>
                                <div class="controls">
                                    <label class="radio">
                                    	<input type="radio" class="required" name="status" value="2" checked="checked"/> 审核通过
                                    </label>
                                    <label class="radio">
                                    	<input type="radio" class="required" name="status" value="3" />审核不通过
                                    </label>
                                </div>
                            </div>
                            
                            
                            <div class="form-actions">
                                <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                                <a href="<?php echo base_url('mall_address/grid') ?>">
                                    <button class="btn" type="button">返回</button>
                                </a>
                            </div>
                        </form>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>