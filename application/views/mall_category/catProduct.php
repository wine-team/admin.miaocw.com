<?php if ($catProduct->num_rows() > 0) :?>
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead class="flip-content">
        <tr>
            <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
            <th>商品编号</th>
            <th>商品名称</th>
            <th>商品SKU</th>
            <th>库存</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($catProduct->result() as $item) : ?>
            <tr>
                <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                <td><?php echo $item->goods_id;?></td>
                <td><?php echo $item->goods_name;?></td>
                <td><?php echo $item->goods_sku;?></td>
                <td><?php echo $item->in_stock;?></td>
                <td><?php echo $item->position;?></td>
                <td width="145">
                    <a class="btn mini green" href="<?php echo base_url('mall_brand/edit/'.$item->brand_id); ?>"><i class="icon-edit"></i> 编辑</a>
                    <a class="btn mini green" href="<?php echo base_url('mall_brand/delete/'.$item->brand_id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php $this->load->view('layout/pagination');?>
<?php else: ?>
    <div class="alert"><p>未找到数据。<p></div>
<?php endif ?>