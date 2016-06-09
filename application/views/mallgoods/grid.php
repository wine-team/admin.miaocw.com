<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">妙网商城<small> 商品列表</small></h3>
            <?php echo breadcrumb(array('mallgoods/grid'=>'妙网商城', 'mallgoods/grid'=>'商品列表')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('mall_goods/grid') ?>" method="get">
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
                                    <label class="control-label">产品类型</label>
                                    <div class="controls">
                                        <select name="extension_code" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach ($extension_code as $good_type => $type_name) : ?>
                                            <option value="<?php echo $good_type ?>" <?php if($this->input->get('extension_code')==$good_type): ?>selected="selected" <?php endif; ?>><?php echo $type_name ?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">产品类型</label>
                                    <div class="controls">
                                        <select name="attr_set_id" class="m-wrap medium chosen">
                                            <option value="">请选择</option>
                                            <?php foreach ($attribute_set->result() as $attr) : ?>
                                                <option value="<?php echo $good_type ?>" <?php if ($this->input->get('attr_set_id')==$attr->attr_set_id): ?>selected="selected" <?php endif; ?>><?php echo $attr->attr_set_name ?> </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
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
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">省/市/区</label>
                                    <div class="controls">
                                        <?php $this->load->view('commonhtml/districtSelect');?>
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
                            <a href="<?php echo base_url('mall_goods/addstep1') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($mall_goods->num_rows()>0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th width="15"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>商品编号</th>
                                    <th>商品名称</th>
                                    <th>供应商</th>
                                    <th>价格</th>
                                    <th>库存</th>
                                    <th>限购</th>
                                    <th>审核状态</th>
                                    <th>上下架</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mall_goods->result() as $item): ?>
                                <tr>
                                    <th><input type="checkbox" class="checkboxes" ></th>
                                    <td width="80"><?php echo $item->goods_sku;?></td>
                                    <td width="150"><?php echo $item->goods_name;?></td>
                                    <td><?php echo $item->supplier_id;?></td>
                                    <td>
                                        <p>售：<?php echo $item->promote_price ?></p>
                                        <p>供：<?php echo $item->shop_price ?></p>
                                    </td>
                                    <td><?php echo $item->in_stock; ?></td>
                                    <td><?php echo $item->limit_num > 0 ? $item->limit_num :'无';?></td>
                                    <td style="width:95px">
                                        <?php if ($item->is_check == 1) :?>
                                            <?php echo $is_check[$item->is_check];?><br />
                                            <a class="btn mini green" href="<?php echo base_url('mall_goods/setIsCheckStatus/'.$item->goods_id.'/'.$item->is_check.'/'.$pg_now).'?'.$_SERVER['QUERY_STRING'];?>" onclick="return confirm('确定要审核通过？')">通过</a>
                                            <a class="btn mini green" href="<?php echo base_url('mall_goods/setIsCheckStatus/'.$item->goods_id.'/2/'.$pg_now).'?'.$_SERVER['QUERY_STRING'];?>" onclick="return confirm('确定要审核拒绝？')">拒绝</a>
                                        <?php else :?>
                                            <?php echo $is_check[$item->is_check];?>
                                        <?php endif;?>
                                    </td>
                                    <td width="45">
                                        <a class="btn mini green" href="<?php echo base_url('mall_goods/setIsOnSaleStatus/'.$item->goods_id.'/'.$item->is_on_sale.'/'.$pg_now).'?'.$_SERVER['QUERY_STRING'];?>" onclick="return confirm('确定要<?php echo $item->is_on_sale==1?'下架':'上架'?>？')">
                                            <?php echo $item->is_on_sale==1?'上架':'下架'; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $item->update_at ?></td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('mall_goods/images/'.$item->goods_id) ?>">图片管理</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_goods/edit/'.$item->goods_id.'?attr_set_id='.$item->attribute_set_id) ?>">编辑</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_goods/copy/'.$item->goods_id) ?>">复制</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_goods/delete/'.$item->goods_id) ?>">删除</a>
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
                                <?php echo $pg_link;?>
                            </div>
                        </div>
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