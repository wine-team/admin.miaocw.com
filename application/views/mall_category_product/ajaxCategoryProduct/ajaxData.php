<?php if ($page_list->num_rows() > 0) :?>
    <table class="table table-striped table-bordered table-hover" id="sample_1">
        <thead class="flip-content">
        <tr>
            <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
            <th>商品编号</th>
            <th>商品名称</th>
            <th>商品SKU</th>
            <th>库存</th>
            <th>排序</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($page_list->result() as $item) : ?>
            <tr>
                <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                <td><?php echo $item->goods_id;?></td>
                <td><?php echo $item->goods_name;?></td>
                <td><?php echo $item->goods_sku;?></td>
                <td><?php echo $item->in_stock;?></td>
                <td><?php echo $item->position;?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php $this->load->view('layout/pagination');?>
<?php else: ?>
    <div class="alert"><p>未找到数据。<p></div>
<?php endif ?>

<script type="text/javascript">
    $(document).ready(function(){
        //table list 全选或全不选操作
        jQuery('#sample_1 .group-checkable, #sample_1 .group-checkable2').change(function () {
            var set = jQuery(this).attr('data-set');
            var checked = jQuery(this).is(':checked');
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop('checked', true);
                } else {
                    $(this).attr('checked', false);
                }
            });
            jQuery.uniform.update(set);
        });
    });
</script>
