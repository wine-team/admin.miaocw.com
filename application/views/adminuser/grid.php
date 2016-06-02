<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">员工管理<small> 后台权限菜单管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', '员工管理')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('adminuser/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">用户名</label>
                                    <div class="controls">
                                        <input type="text" class="m-wrap medium" placeholder="搜索用户名、真实姓名" name="username" value="<?php echo $this->input->get('username')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">角色</label>
                                    <div class="controls">
                                        <select class="medium m-wrap" name="role_id">
                                            <option value="">请选择</option>
                                            <?php foreach ($role->result() as $value) :?>
                                                <option value="<?php echo $value->id ?>" <?php if ($value->id == $this->input->get('role_id')): ?>selected="selected"<?php endif?>><?php echo $value->name; ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">状态</label>
                                    <div class="controls">
                                        <select class="medium m-wrap" name="flag">
                                            <option value="">请选择</option>
                                            <option value="0" <?php if ('0' === $this->input->get('flag')): ?>selected="selected"<?php endif?>>冻结</option>
                                            <option value="1" <?php if (1 == $this->input->get('flag')): ?>selected="selected"<?php endif?>>正常</option>
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
                        <div class="clearfix">
                            <a href="<?php echo base_url('adminuser/add') ?>" class="add-button-link">
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
                                        <th>用户名</th>
                                        <th>真实姓名</th>
                                        <th>角色</th>
                                        <th>Email地址</th>
                                        <th>状态</th>
                                        <th>注册时间</th>
                                        <th>最后登录时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $item->id;?></td>
                                        <td><?php echo $item->name;?></td>
                                        <td><?php echo $item->realname;?></td>
                                        <td><?php echo isset($item->role_name) ? $item->role_name :'暂无角色'; ?></td>
                                        <td><?php echo $item->email;?></td>
                                        <td><?php echo $item->flag == 1 ? '正常' : '冻结';?></td>
                                        <td><?php echo $item->created_at;?></td>
                                        <td><?php echo $item->updated_at;?></td>
                                        <td width="145">
                                            <a href="<?php echo base_url('adminuser/edit/'.$item->id) ?>" class="btn mini green"><i class="icon-edit"></i> 编辑</a>
                                            <a href="<?php echo base_url('adminuser/delete/'.$item->id) ?>" class="btn mini green" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a><p></p>
                                            <a href="<?php echo base_url('adminuser/resetpwd/'.$item->id) ?>" class="btn mini green" onclick="return confirm('密码为123456, 确定要重置？')" > 重置密码</a>
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