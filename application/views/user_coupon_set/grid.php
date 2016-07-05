<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">优惠劵设置<small> 优惠劵设置</small></h3>
            <?php echo breadcrumb(array('优惠劵设置', '优惠劵设置', '优惠劵设置列表')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('user_coupon_set/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">优惠劵名称</label>
                                    <div class="controls">
                                        <input type="text" name="coupon_name" value="<?php echo $this->input->get('coupon_name') ?>" class="m-wrap span12">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">优惠劵类型</label>
                                    <div class="controls">
                                        <select name="scope" class="m-wrap span12">
                                            <option value="0">全部</option>
                                            <?php foreach ($scope as $key=>$value):?>
                                                <option value="<?php echo $key?>" <?php if($key == $this->input->get('scope')):?>selected="selected"<?php endif;?>><?php echo $value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">使用有效期</label>
                                    <div class="controls form-search-time">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="start_date" size="16" value="<?php echo $this->input->get('start_date') ?>" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                        <div class="input-append date date-picker">
                                            <input type="text" name="end_date" size="16" value="<?php echo $this->input->get('end_date') ?>" class="m-wrap m-ctrl-medium date-picker date">
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
                            <a href="<?php echo base_url('user_coupon_set/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th>编号</th>
                                        <th>优惠劵名称</th>
                                        <th>优惠劵类型</th>
                                        <th>关联编号</th>
                                        <th>优惠劵金额</th>
                                        <th>剩余数量</th>
                                        <th>满减条件</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th width="100">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $item->coupon_set_id;?></td>
                                        <td><?php echo $item->coupon_name;?></td>
                                        <td><?php echo $scope[$item->scope];?></td>
                                        <td><?php echo $item->related_id;?></td>
                                        <td><?php echo $item->amount;?></td>
                                        <td><?php echo $item->number;?></td>
                                        <td><?php echo $item->condition;?></td>
                                        <td><?php echo $item->start_time;?></td>
                                        <td><?php echo $item->end_time;?></td>
                                        <td>
                                            <a href="<?php echo base_url('user_coupon_set/edit/'.$item->coupon_set_id) ?>" class="btn mini green">编辑</a>
                                            <a href="<?php echo base_url('user_coupon_set/delete/'.$item->coupon_set_id) ?>" class="btn mini green" onclick="return confirm('确定要删除？')"> 删除</a><p></p>
                                            <a href="<?php echo base_url('user_coupon_get/grid').'?coupon_set_id='.$item->coupon_set_id ?>" class="btn mini green">领取记录</a>
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