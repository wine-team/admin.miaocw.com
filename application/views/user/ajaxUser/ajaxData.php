<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
    <h3>选择用户</h3>
</div>
<div class="modal-body">
    <div class="well">
        <form class="form-horizontal ajaxSearch">
            <span>用户昵称 <input type="text" name="username" value="<?php echo $this->input->get('username');?>" placeholder="用户UID或昵称" class="m-wrap small"></span>
            <span>手机号 <input type="text" name="phone" value="<?php echo $this->input->get('phoneEmail');?>" placeholder="手机/邮箱" class="m-wrap small"></span>
            <span>用户类型
                <select name="user_type" class="m-wrap small">
                    <option value="">请选择</option>
                    <?php foreach ($user_type->result() as $item) :?>
                        <option value="<?php echo $item->type_id;?>" <?php if ($item->type_id == $this->input->get('user_type')):?> selected="selected"<?php endif;?>><?php echo $item->type_name;?></option>
                    <?php endforeach;?>
                </select>
            </span>
            <button class="btn green"><i class="icon-search"></i> 搜索</button>
        </form>
    </div>
    <?php if ($page_list->num_rows() > 0) :?>
        <table class="table table-striped table-bordered table-hover">
            <thead class="flip-content">
                <tr>
                    <th width="30">选择</th>
                    <th width="40">编号</th>
                    <th>用户昵称</th>
                    <th>手机/邮箱</th>
                    <th>用户类型</th>
                    <th>上级</th>
                    <th>注册时间</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($page_list->result() as $item) : ?>
                <tr>
                    <td><input type="radio" name="uid" value="<?php echo $item->uid?>"></td>
                    <td><?php echo $item->uid;?></td>
                    <td><?php echo $item->alias_name;?></td>
                    <td>
                        <p><?php echo $item->phone;?></p>
                        <p><?php echo $item->email;?></p>
                    </td>
                    <td>
                        <?php foreach ($user_type->result() as $type): ?>
                            <?php if ($item->user_type&(int)$type->type_id):?>
                                <?php echo $type->type_name;?>,
                            <?php endif;?>
                        <?php endforeach;?>
                    </td>
                    <td><?php echo $item->parent_id;?></td>
                    <td><?php echo $item->created_at;?></td>
                    <td><?php echo $item->flag==1 ? '正常' : '已冻结';?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php $this->load->view('layout/pagination');?>
    <?php else : ?>
        <div class="alert"><p>未找到数据。<p></div>
    <?php endif;?>
</div>
<div class="modal-footer"></div>