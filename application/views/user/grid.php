<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">用户管理<small> 用户管理</small></h3>
            <?php echo breadcrumb(array('用户管理','用户列表')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('user/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">用户搜索</label>
                                    <div class="controls">
                                        <input type="text" name="username" value="<?php echo $this->input->get('username');?>" placeholder="请输入用户帐号或别名或UID" class="m-wrap span8">
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">上级用户</label>
                                    <div class="controls">
                                        <input type="text" name="parent_id" value="<?php echo $this->input->get('parent_id');?>" placeholder="上级用户UID或当前用户手机号" class="m-wrap span8">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">用户类型</label>
                                    <div class="controls">
                                        <select name="user_type" class="m-wrap span8">
                                            <option value="">请选择</option>
                                            <?php foreach ($user_type->result() as $item) :?>
                                            <option value="<?php echo $item->user_type_id;?>" <?php if ($item->user_type_id == $this->input->get('user_type')):?> selected="selected"<?php endif;?>><?php echo $item->user_type_name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">帐号状态</label>
                                    <div class="controls">
                                        <select name="flag" class="m-wrap span8">
                                            <option value="">请选择</option>
                                            <?php foreach (array('1'=>'正常', '2'=>'已冻结') as $key=>$value) :?>
                                            <option value="<?php echo $key;?>" <?php if ($key == $this->input->get('flag')):?> selected="selected"<?php endif;?>><?php echo $value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">开始时间</label>
                                    <div class="controls">
                                        <div class="input-append date form_datetime">
                                            <input type="text" name="start_time" size="16" value="<?php echo $this->input->get('start_time') ?>" class="m-wrap m-ctrl-medium">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">结束时间</label>
                                    <div class="controls">
                                        <div class="input-append date form_datetime">
                                            <input type="text" name="end_time" size="16" value="<?php echo $this->input->get('end_time') ?>" class="m-wrap m-ctrl-medium">
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
                            <a href="<?php echo base_url('user/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th width="15"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>用户名</th>
                                    <th>用户类型</th>
                                    <th>手机号码</th>
                                    <th>上级用户</th>
                                    <th>登陆次数</th>
                                    <th>注册时间</th>
                                    <th>帐号状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($page_list->result() as $item) : ?>
                                <tr>
                                    <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $item->uid;?></td>
                                    <td><?php echo $item->user_name;?></td>
                                    <td>
                                        <?php foreach ($user_type->result() as $type): ?>
                                            <?php if ($item->user_type&(int)$type->user_type_id):?>
                                                <?php echo $type->user_type_name;?>,
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </td>
                                    <td><?php echo $item->phone;?></td>
                                    <td><?php echo $item->parent_id;?></td>
                                    <td><?php echo $item->login_count;?></td>
                                    <td><?php echo $item->creat_at;?></td>
                                    <td>
                                        <a href="javascript:;" class="modify-user-uid glyphicons no-js <?php if ($item->flag == 1):?>ok_2<?php else :?>remove_2<?php endif;?>" data-uid="<?php echo $item->uid;?>" data-flag="<?php echo $item->flag ?>">
                                            <i></i>
                                        </a>
                                    </td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('user/accountlog?uid='.$item->uid); ?>">账户收支</a>
                                        <a class="btn mini green" href="<?php echo base_url('user/resetpwd/'.$item->uid); ?>" onclick="return confirm('密码为123456, 确定要重置？')"> 重置密码</a><p></p>
                                        <a class="btn mini green" href="<?php echo base_url('user/edit/'.$item->uid); ?>"><i class="icon-edit"></i> 编辑</a>
                                    </td>
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
                                    <?php echo $pg_list ?>
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
<script type="text/javascript">
$(function(){
    $('.modify-user-uid').click(function(){
        var status = '冻结帐号';
        if ($(this).hasClass('remove_2')) {
            status = '恢复帐号';
        }
        if (confirm('确定要'+status+'?')) {
            var obj = $(this);
            var uid = $(this).attr('data-uid');
            var flag = $(this).attr('data-flag');
            $.ajax({
                url:hostUrl()+'/user/toggle',
                type:'POST',
                dataType:'json',
                data: {uid:uid,flag:flag},
                success: function(data) {
                    if (data.flag == 2) {
                        obj.attr('data-flag', data.flag).addClass('remove_2').removeClass('ok_2');
                    } else if(data.flag == 1) {
                        obj.attr('data-flag', data.flag).addClass('ok_2').removeClass('remove_2');
                    } else {
                        alert('操作失败');
                    }
                }
            });
        }
    });
});
</script>