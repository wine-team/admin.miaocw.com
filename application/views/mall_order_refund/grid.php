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
                                    <label class="control-label">订单ID</label>
                                    <div class="controls">
                                        <input type="text" name="order_id" value="<?php echo $this->input->get('order_id'); ?>" class="m-wrap span12" placeholder="请输入订单ID">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">商品搜索</label>
                                    <div class="controls">
                                        <input type="text" name="goods_name" value="<?php echo $this->input->get('goods_name'); ?>" class="m-wrap span12" placeholder="请输入产品名称或产品编号">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">供应商</label>
                                    <div class="controls">
                                        <input type="text" name="seller_name" value="<?php echo $this->input->get('seller_name'); ?>" class="m-wrap span12" placeholder="请输供应商账户名或别名">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">

                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">申请人</label>
                                    <div class="controls">
                                        <input type="text" name="user_name" value="<?php echo $this->input->get('user_name'); ?>" class="m-wrap span12" placeholder="请输入申请人或uid或手机号码">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">退款状态</label>
                                    <div class="controls">
                                        <select name="status" class="m-wrap span12">
                                            <option value="">请选择</option>
                                            <?php foreach ($status_arr as $key => $value) : ?>
                                                <option value="<?php echo $key; ?>" <?php if ($key == $this->input->get('status')): ?> selected="selected"<?php endif; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">是否退款</label>
                                    <div class="controls">
                                        <select name="flag" class="m-wrap span12">
                                            <option value="">请选择</option>
                                            <?php foreach (array('1' => '未退款', '2' => '已退款') as $key => $value) : ?>
                                                <option value="<?php echo $key; ?>" <?php if ($key == $this->input->get('flag')): ?> selected="selected"<?php endif; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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
                                        <th>商品订单</th>
                                        <th>商品名称</th>
                                        <th>退货数量</th>
                                        <th>供应商</th>
                                        <th>申请人</th>
                                        <th>手续费</th>
                                        <th>退款状态</th>
                                        <th>是否退款</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $r) : ?>
                                    <tr>
                                        <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $r->refund_id;?></td>
                                        <td>
                                            <p>订单ID：<?php echo $r->order_id; ?></p>
                                            <p>订单产品ID：<?php echo $r->order_product_id; ?></p>
                                            <p>产品ID：<?php echo $r->goods_id; ?></p>
                                        </td>
                                        <td>
                                            <?php echo $r->goods_name; ?>
                                        </td>
                                        <td>
                                            <p>原：<?php echo $r->existing;?></p>
                                            <p>退：<?php echo $r->number;?></p>
                                        </td>
                                        <td><?php echo $r->alias_name; ?></td>
                                        <td>
                                           <p><?php echo $r->user_name; ?>（<?php echo $r->uid; ?>）</p>
                                           <p><?php echo $r->cellphone; ?></p>
                                        </td>
                                        <td><?php echo $r->counter_fee; ?></td>
                                        <td>
                                            <?php echo $status_arr[$r->status];?>
                                        </td>
                                        <td width="100">
                                           <p><?php echo $flag_arr[$r->flag]; ?></p>
                                           <?php if ($r->status==2 && $r->flag==1) :?>
                                                <a class="btn mini green" href="<?php echo base_url('mall_order_refund/confirm/'.$r->refund_id.'/'.$pg_now) ?>" onclick="return confirm('将跳转到支付宝退款页面，确定要退款？')"> 确认退款</a>
                                           <?php endif;?>
                                        </td>
                                        <td><?php echo $r->created_at; ?></td>
                                        <td width="145">
                                            <a class="btn mini green" href="<?php echo base_url('mall_order_refund/info/'.$r->refund_id); ?>"><i class="icon-edit"></i>查看</a>
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