<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
    <h3>选择供应商</h3>
</div>
<div class="modal-body">
    <div class="well">
        <form class="form-horizontal ajaxSearch">
            <span>用户编号 <input type="text" name="uid" value="<?php echo $this->input->get('uid');?>" class="m-wrap small" placeholder="用户UID"></span>
            <span>供应商名称 <input type="text" name="supplier_name" value="<?php echo $this->input->get('supplier_name');?>" class="m-wrap small" placeholder="供应商名称"></span>
            <span>状态
                <select name="is_check" class="m-wrap small">
                    <option value="">全部状态</option>
                    <?php foreach (array('1'=>'正常', '2'=>'已冻结') as $key=>$value) :?>
                    <option value="<?php echo $key;?>" <?php if ($key == $this->input->get('is_check')):?> selected="selected"<?php endif;?>><?php echo $value;?></option>
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
                    <th>用户UID</th>
                    <th>供应商名称</th>
                    <th>手机号</th>
                    <th>注册时间</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($page_list->result() as $item) : ?>
                <tr>
                    <td><input type="radio" name="uid" value="<?php echo $item->uid?>"></td>
                    <td><?php echo $item->uid;?></td>
                    <td><?php echo $item->supplier_name;?></td>
                    <td><?php echo $item->phone;?></td>
                    <td><?php echo $item->apply_time;?></td>
                    <td><?php echo $item->is_check==1 ? '正常' : '已冻结';?></td>
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