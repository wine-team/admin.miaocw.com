<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">用户管理 <small></small>用户账号管理</h3>
            <?php echo breadcrumb(array('用户管理', 'user/grid'=>'用户账号管理','user_log/grid'=>'用户日志')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('user_log/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">UID</label>
                                    <div class="controls">
                                        <input type="text" name="uid" value="<?php echo $this->input->get('uid');?>" placeholder="用户UID" class="m-wrap medium">
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
                                    <th width="15"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>UID</th>
                                    <th>手机/邮箱</th>
                                    <th>ip</th>
                                    <th>日志时间</th>
                                    <th>操作类型</th>
                                    <th>状态</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($user_log->result() as $item) : ?>
                                <tr>
                                    <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $item->uid;?></td>
                                    <td><?php echo ($item->phone?$item->phone:'无'). '/' .($item->email?$item->email:'无');?></td>
                                    <td><?php echo $item->ip_from;?></td>
                                    <td><?php echo $item->log_time;?></td>
                                    <td><?php echo $item->operate_type == 1 ? '登陆' : '注册';?></td>
                                    <td><?php echo $item->status==1 ? '成功' : '失败';?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="dataTables_info">
                                    <span>当前第</span><span style="color: red"><?php echo $pg_now?></span>页 
                                    <span>共</span><span style="color: red"><?php echo $all_rows?></span>条数据
                                    <span>每页显示20条 </span>
                                    <?php echo $pg_link ?>
                                </div>
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
<?php $this->load->view('layout/footer');?>