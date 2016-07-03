<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
    <h3>选择商品属性</h3>
</div>
<div class="modal-body">
    <div class="well">
        <form class="form-horizontal ajaxSearch">
            <span>商品属性编号 <input type="text" name="attr_set_id" value="<?php echo $this->input->get('attr_set_id');?>" class="m-wrap small"></span>
            <span>商品属性名称 <input type="text" name="attr_set_name" value="<?php echo $this->input->get('attr_set_name');?>" class="m-wrap small"></span>
            <span>属性状态
                <select name="enabled" class="m-wrap small">
                    <option value="">全部状态</option>
                    <?php foreach (array('1'=>'正常', '2'=>'已冻结') as $key=>$value) :?>
                    <option value="<?php echo $key;?>" <?php if ($key == $this->input->get('enabled')):?> selected="selected"<?php endif;?>><?php echo $value;?></option>
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
                    <th>商品属性编号</th>
                    <th>商品属性名称</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($page_list->result() as $item) : ?>
                <tr>
                    <td><input type="radio" name="attr_set_id" value="<?php echo $item->attr_set_id?>"></td>
                    <td><?php echo $item->attr_set_id;?></td>
                    <td><?php echo $item->attr_set_name;?></td>
                    <td><?php echo $item->enabled==1 ? '正常' : '已冻结';?></td>
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