<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置<small>用户反馈</small></h3>
            <?php echo breadcrumb(array('网站设置', "feedback/grid"=>'用户反馈')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('feedback/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">反馈类型</label>
                                    <div class="controls">
                                        <select name="ms_type" class="m-wrap medium">
                                            <option value="0">请选择</option>
                                            <?php foreach ($feedBackType as $key=>$value):?>
                                            <option value="<?php echo $key?>" <?php if($key == $this->input->get('ms_type')):?>selected="selected"<?php endif;?>><?php echo $value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">电话号码</label>
                                    <div class="controls">
                                        <input type="text" name="ms_tel" value="<?php echo $this->input->get('ms_tel');?>" placeholder="请输入电话号码" class="m-wrap medium">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">反馈时间</label>
                                    <div class="controls form-search-time">
                                        <div class="input-append date date-picker">
                                            <input type="text" name="start_date" size="16" value="<?php echo $this->input->get('start_date') ?>" class="m-wrap m-ctrl-medium date-picker date">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                        <div class="input-append date date-picker">
                                            <input type="text" name="end_date" size="16" value="<?php echo $this->input->get('end_date')?>" class="m-wrap m-ctrl-medium date-picker date">
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
                    <?php if ($resultObj->num_rows()>0) : ?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th width="30"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>反馈类型</th>
                                    <th>留言内容</th>
                                    <th>电话号码</th>
                                    <th>电子邮件</th>
                                    <th>创建时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($resultObj->result() as $item) : ?>
                                <tr>
                                    <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $item->id ?></td>
                                    <td><?php echo $feedBackType[$item->ms_type]; ?></td>
                                    <td><?php echo $item->ms_content ?></td>
                                    <td><?php echo $item->ms_tel ?></td>
                                    <td><?php echo $item->ms_email; ?></td>
                                    <td><?php echo $item->created_at ?></td>
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