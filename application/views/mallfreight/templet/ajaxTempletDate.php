<form class="ajaxSearch">
    <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
        <h3>选择地区</h3>
    </div>
    <div class="modal-body">
        <table class="table table-striped table-bordered table-hover" id="sample_1">
            <tr>
                <th width="150" colspan="2">
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"> <strong>全选</strong>
                        </label>
                    </div>
                </th>
            </tr>
            <?php foreach ($regionAll as $k => $region) : ?>
            <tr>
                <td width="150">
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" class="checkboxes group-checkable2" value="1" data-set="#sample_1 .checkboxes<?php echo $k;?>"> <strong><?php echo $region['state_name']; ?></strong>
                        </label>
                    </div>
                </td>
                <td>
                    <div class="controls">
                    <?php foreach($region['level_name'] as $key => $value): ?>
                        <label class="checkbox">
                            <input type="checkbox" name="area" value="<?php echo $value ?>" class="checkboxes checkboxes<?php echo $k;?>" />
                            <span style="font-size: 12px;"><?php echo $value ?></span>
                        </label>
                    <?php endforeach;?>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn green"><i class="icon-ok"></i> 保存</button>
        <button type="button" data-dismiss="modal" class="btn">取消</button>
    </div>
</form>
<script type="text/javascript">
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
</script>