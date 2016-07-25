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
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-search"></i>搜索</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal form-search" action="<?php echo base_url('mall_order_reviews/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">用户名搜索</label>
                                    <div class="controls">
                                        <input type="text" name="item" value="<?php echo $this->input->get('item');?>" class="m-wrap medium" placeholder="请输入用户名称、产品名、评价内容" />
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">审核状态</label>
                                    <div class="controls">
                                        <select name="status" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach($status_arr as $k1=>$status) :?>
                                            <option <?php if($this->input->get('status')==$k1):?>selected="selected"<?php endif;?>> value="<?php echo $k1;?>"><?php echo $status;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">评分</label>
                                    <div class="controls">
                                        <select name="score" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php for($i=1;$i<6;$i++) :?>
                                            <option <?php if($this->input->get('score')==$i):?>selected="selected"<?php endif;?>> value="<?php echo $i;?>"><?php echo $i;?>分</option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">订单ID</label>
                                    <div class="controls">
                                        <input type="number" name="order_id" value="<?php echo $this->input->get('order_id');?>" class="m-wrap medium" placeholder="请输入订单ID">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">商品ID</label>
                                    <div class="controls">
                                        <input type="number" name="goods_id" value="<?php echo $this->input->get('goods_id');?>" class="m-wrap medium" placeholder="请输入商品ID">
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
                                    <th>商品</th>
                                    <th>商品属性</th>
                                    <th>评价内容</th>
                                    <th>评分</th>
                                    <th>审核状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res_list->result() as $r) : ?>
                                <tr>
                                    <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $r->reviews_id;?></td>
                                    <td><?php echo $r->user_name;?></td>
                                    <td><?php echo $r->goods_name;?><br>
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_base/edit/'.$r->order_id); ?>">订单</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_goods_base/edit/'.$r->goods_id); ?>">商品</a>
                                    </td>
                                    <td><?php echo json_decode($r->goods_attr);?></td>
                                    <td><?php echo $r->content;?></td>
                                    <td><?php echo $r->score;?></td>
                                    <td>
                                    <?php if($r->status==1) :?>
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_reviews/editPost?status=2&reviews_id='.$r->reviews_id); ?>">审核通过</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_reviews/editPost?status=3&reviews_id='.$r->reviews_id); ?>">审核不通过</a>
                                    <?php else :?>
                                    <?php echo $status_arr[$r->status];?>
                                    <?php endif;?>
                                    </td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_reviews/edit/'.$r->reviews_id); ?>">详情</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_order_reviews/delete/'.$r->reviews_id); ?>" onclick="return confirm('确定要删除？')">删除</a>
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