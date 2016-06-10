<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
    <h3>选择关联产品</h3>
</div>
<div class="modal-body">
    <div class="well">
        <form class="form-horizontal ajaxGoodsBaseSearch">
            <span>商品名称 <input type="text" name="goods_name" value="<?php echo $this->input->get('goods_name');?>" placeholder="商品名称 " class="m-wrap small"></span>
            <span>商品编号<input type="text" name="goods_sku" value="<?php echo $this->input->get('goods_sku');?>" placeholder="商品编号" class="m-wrap small"></span>
            <span>
                <select name="is_check" class="m-wrap small">
                    <option value="">审核状态</option>
                    <?php foreach (array('1'=>'未审核', '2'=>'审核通过','3'=>'未通过') as $key=>$value) :?>
                    <option value="<?php echo $key;?>" <?php if ($key == $this->input->get('is_check')):?> selected="selected"<?php endif;?>><?php echo $value;?></option>
                    <?php endforeach;?>
                </select>
            </span>
            <span>
                <select name="is_on_sale" class="m-wrap small">
                    <option value="">上下架</option>
                    <?php foreach (array('1'=>'上架', '2'=>'下架') as $key=>$value) :?>
                    <option value="<?php echo $key;?>" <?php if ($key == $this->input->get('is_on_sale')):?> selected="selected"<?php endif;?>><?php echo $value;?></option>
                    <?php endforeach;?>
                </select>
            </span>
            <button class="btn green" type="submit">搜索</button>
            <button class="btn yellow" type="button">确定</button>
        </form>
        
    </div>
    <?php if ($page_list->num_rows() > 0) :?>
        <table class="table table-striped table-bordered table-hover">
            <thead class="flip-content">
                <tr>
                    <th width="30">选择</th>
                    <th width="40">编号</th>
                    <th>商品名称</th>
                    <th>商品编号</th>
                    <th>市场价</th>
                    <th>供应价</th>
                    <th>审核状态</th>
                    <th>上下架</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($page_list->result() as $item) : ?>
                <tr>
                    <td><input type="checkbox" name="goods_id" value="<?php echo $item->goods_id;?>" class="checked"></td>
                    <td><?php echo $item->goods_id;?></td>
                    <td><?php echo $item->goods_name;?></td>
                    <td><?php echo $item->goods_sku;?></td>
                    <td><?php echo $item->market_price;?></td>
                    <td><?php echo $item->shop_price;?></td>
                    <td><?php switch ($item->is_check){
                    	          case '1': echo '未审核';break;
                    	          case '2': echo '审核通过';break;
                    	          case '3': echo '未通过'; break;
                    };?></td>
                    <td><?php echo $item->is_on_sale==1 ? '上架' : '下架';?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="dataTables_info">
            <span>当前第</span><span style="color: red"><?php echo $pg_now;?></span>页 
            <span>共</span><span style="color: red"><?php echo $all_rows;?></span>条数据
            <span>每页显示15条 </span>
            <?php echo $pg_list;?>
        </div>
    <?php else : ?>
        <div class="alert"><p>未找到数据。<p></div>
    <?php endif;?>
</div>
<div class="modal-footer"></div>