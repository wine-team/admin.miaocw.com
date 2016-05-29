<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
    <h3>选择供应商</h3>
</div>
<div class="modal-body">
    <div class="well">
        <form class="form-horizontal ajaxUserSearch">
            <span>关键字<input type="text" name="item" value="<?php echo $this->input->get('item');?>" placeholder="产品名称、产品描述" class="m-wrap small"></span>
            <button class="btn green"><i class="icon-search"></i> 搜索</button>
        </form>
    </div>
    <?php if ($all_rows > 0) :?>
        <table class="table table-striped table-bordered table-hover">
            <thead class="flip-content">
                <tr>
                    <th width="30">选择</th>
                    <th width="40">属性id</th>
                    <th>商品类型ID</th>
                    <th>商品属性名称</th>
                    <th>属性类型</th>
                    <th>可选值</th>
                    <th>检索</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($res_list as $r) : ?>
                <tr>
                    <td><input type="radio" name="attr_id" value="<?php echo $r->attr_id;?>" ></td>
                    <td><?php echo $r->attr_id;?></td>
                    <td><?php echo $r->type_id;?></td>
                    <td><?php echo $r->attr_name;?></td>
                    <td><?php switch ($r->attr_type){
                        case 1 : echo '唯一属性';break;
                        case 2 : echo '单选属性';break;
                        case 3 : echo '复选属性';break;
                    }?></td>
                    <td class="attr_values"><?php echo $r->attr_values;?></td>
                    <td><?php echo ($r->attr_index == 2) ?  '关键字检索' : '不需要检索'; ?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="dataTables_info">
            <span>当前第</span><span style="color: red"><?php echo $pg_now?></span>页 
            <span>共</span><span style="color: red"><?php echo $all_rows?></span>条数据
            <span>每页显示10条 </span>
            <?php echo $pg_link ?>
        </div>
    <?php else : ?>
        <div class="alert"><p>未找到数据。<p></div>
    <?php endif;?>
</div>
<div class="modal-footer"></div>