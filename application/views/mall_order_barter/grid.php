<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品订单
                <small> 换货审核</small>
            </h3>
            <?php echo breadcrumb(array('商品管理', '商品订单', "mall_order_barter/grid" => '换货审核')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('mall_order_barter/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">订单ID</label>
                                    <div class="controls">
                                        <input type="text" name="order_id" value="<?php echo $this->input->get('order_id'); ?>" placeholder="请输入订单ID" class="m-wrap medium">
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">商品搜索</label>
                                    <div class="controls">
                                        <input type="text" name="goods_name" value="<?php echo $this->input->get('goods_name'); ?>" placeholder="请输入产品名称或产品编号" class="m-wrap medium">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">供应商</label>
                                    <div class="controls">
                                        <input type="text" name="seller_name" value="<?php echo $this->input->get('seller_name'); ?>" placeholder="请输供应商账户名或别名" class="m-wrap medium">
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">申请人</label>
                                    <div class="controls">
                                        <input type="text" name="user_name" value="<?php echo $this->input->get('user_name'); ?>" placeholder="请输入申请人或uid或手机号码" class="m-wrap medium">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">换货状态</label>
                                    <div class="controls">
                                        <select name="status" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach ($barterStatus as $key => $value) : ?>
                                                <option value="<?php echo $key; ?>" <?php if ($key == $this->input->get('status')): ?> selected="selected"<?php endif; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">进度</label>
                                    <div class="controls">
                                        <select name="flag" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach ($barterFlag as $key => $value) : ?>
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
                    <?php if ($all_rows > 0) : ?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>商品订单</th>
                                    <th>产品名称</th>
                                    <th>数量</th>
                                    <th>供应商</th>
                                    <th>申请人</th>
                                    <th>状态</th>
                                    <th>进度</th>
                                    <th>创建时间</th>
                                    <th>审核时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td width="25"><input type="checkbox" class="checkboxes" value="1"></td>
                                        <td width="40"><?php echo $item->barter_id; ?></td>
                                        <td>
                                            <p>订单ID：<?php echo $item->order_id; ?></p>
                                            <p>订单产品ID：<?php echo $item->order_product_id; ?></p>
                                            <p>产品ID：<?php echo $item->goods_attr_id; ?></p>
                                        </td>
                                        <td width="150"><?php echo $item->goods_name; ?></td>
                                        <td><?php echo $item->number; ?></td>
                                        <td>
                                            <p><?php echo $item->alias_name; ?>（<?php echo $item->seller_uid; ?>）</p>
                                        </td>
                                        <td>
                                            <p><?php echo $item->user_name; ?>（<?php echo $item->uid; ?>）</p>
                                            <p><?php echo $item->cellphone; ?></p>
                                        </td>
                                        <td><?php echo $barterStatus[$item->status]; ?></td>
                                        <td><?php echo $barterFlag[$item->flag]; ?></td>
                                        <td><?php echo $item->created_at; ?></td>
                                        <td><?php echo $item->verify_time; ?></td>
                                        <td width="50">
                                            <a class="btn mini green" href="<?php echo base_url('mall_order_barter/info/'.$item->barter_id)?>">详情</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="row-fluid">
                            <div class="dataTables_info">
                                <span>当前第</span><span style="color: red"><?php echo $pg_now ?></span>页
                                <span>共</span><span style="color: red"><?php echo $all_rows ?></span>条数据
                                <span>每页显示20条 </span>
                                <?php echo $pg_list ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert"><p>未找到数据。<p></div>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer'); ?>