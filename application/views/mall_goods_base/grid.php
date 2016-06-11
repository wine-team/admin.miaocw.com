<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">妙网商城<small> 商品列表</small></h3>
            <?php echo breadcrumb(array('mall_goods_base/grid'=>'妙网商城', 'mall_goods_base/grid'=>'商品列表')); ?>
        </div>
    </div>
    <?php echo execute_alert_message();?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('mall_goods_base/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">商品搜索</label>
                                    <div class="controls">
                                        <input type="text" name="goods_search" value="<?php echo $this->input->get('goods_search');?>" class="m-wrap medium" placeholder="请输入商品编号或商品名称">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">审核状态</label>
                                    <div class="controls">
                                        <select name="is_check" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach ($is_check as $kk=>$vv):?>
                                                <option value="<?php echo $kk;?>" <?php if ($this->input->get('is_check')==$kk):?>selected="selected"<?php endif;?>><?php echo $vv;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">上下架</label>
                                    <div class="controls">
                                        <select name="is_on_sale" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <option value="1" <?php if($this->input->get('is_on_sale')==1){echo 'selected';}?> >上架</option>
                                            <option value="2" <?php if($this->input->get('is_on_sale')==2){echo 'selected';}?>>下架</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">供应商</label>
                                    <div class="controls">
                                        <input type="text" name="username" value="<?php echo $this->input->get('username');?>" class="m-wrap medium" placeholder="请输入供应商帐号或别名">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">省/市/区</label>
                                    <div class="controls">
                                        <?php $this->load->view('commonhtml/districtSelect');?>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">开始时间</label>
                                    <div class="controls form-search-time">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="start_date" size="16" value="2016-05-26" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                        <div class="input-append date date-picker">
                                            <input type="text" name="end_date" size="16" value="2016-06-02" class="m-wrap m-ctrl-medium date-picker date">
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
                        <div class="clearfix">
                            <a href="<?php echo base_url('mall_goods_base/addstep1') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($page_list->num_rows()>0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th width="15"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th>编号</th>
                                        <th>商品编号</th>
                                        <th width="150">商品名称</th>
                                        <th>商品类型</th>
                                        <th>商品属性</th>
                                        <th>供应商</th>
                                        <th>价格</th>
                                        <th>库存</th>
                                        <th width="95">审核状态</th>
                                        <th>上下架</th>
                                        <th width="125">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item): ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkboxes" ></td>
                                        <td><?php echo $item->goods_id;?></td>
                                        <td><?php echo $item->goods_sku;?></td>
                                        <td><?php echo $item->goods_name;?></td>
                                        <td><?php echo $extension[$item->extension_code];?></td>
                                        <td><?php echo $attribute_set[$item->attribute_set_id]['attr_set_name'];?></td>
                                        <td><?php echo $item->supplier_id;?></td>
                                        <td>
                                            <p>售：<?php echo $item->promote_price ?></p>
                                            <p>供：<?php echo $item->shop_price ?></p>
                                        </td>
                                        <td><?php echo $item->in_stock; ?></td>
                                        <td>
                                            <p><?php echo $is_check[$item->is_check];?></p>
                                            <?php if ($item->is_check == 1) :?>
                                                <a class="btn mini green is-check-status" href="javascript:;" data-goods-id="<?php echo $item->goods_id ?>" data-status="2">通过</a>
                                                <a class="btn mini green is-check-status" href="javascript:;" data-goods-id="<?php echo $item->goods_id ?>" data-status="3">拒绝</a>
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="modify-updown glyphicons no-js <?php if ($item->is_on_sale == 1):?>ok_2<?php else :?>remove_2<?php endif;?>" data-goods-id="<?php echo $item->goods_id;?>" data-flag="<?php echo $item->is_on_sale ?>">
                                                <i></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn mini green" href="<?php echo base_url('mall_goods_base/images/'.$item->goods_id) ?>">图片管理</a>
                                            <a class="btn mini green" href="<?php echo base_url('mall_goods_base/edit/'.$item->goods_id.'?attr_set_id='.$item->attribute_set_id) ?>">编辑</a><p></p>
                                            <a class="btn mini green" href="<?php echo base_url('mall_goods_base/copy/'.$item->goods_id) ?>">复制</a>
                                            <a class="btn mini green" href="<?php echo base_url('mall_goods_base/delete/'.$item->goods_id) ?>">删除</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php $this->load->view('layout/pagination');?>
                        <?php else : ?>
                            <div class="alert"><p>未找到数据。<p></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>