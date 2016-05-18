<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>所有网站设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'advert/grid'=>'广告管理')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            
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
                            <a href="<?php echo base_url('mall_category/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th ></th>
                                    <th >编号</th>
                                    <th >分类名称</th>
                                    <th >上级ID</th>
                                    <th >显示状态</th>
                                    <th >排序</th>
                                    <th >商品属性ID</th>
                                    <th >操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res as $r) : ?>
                                <?php if($r->parent_id == 0) :?>
                                <tr class="p_cat">
                                    <td style="table-layout:fixed;width:20px;"><i class="icon-plus"></i></td>
                                    <td style="table-layout:fixed;width:40px;"><?php echo $r->cat_id;?></td>
                                    <td style="table-layout:fixed;width:120px;"><?php echo $r->cat_name;?></td>
                                    <td style="table-layout:fixed;width:120px;"><?php echo $r->parent_id;?></td>
                                    <td style="table-layout:fixed;width:120px;"><?php echo $r->is_show;?></td>
                                    <td style="table-layout:fixed;width:50px;"><?php echo $r->sort_order;?></td>
                                    <td style="table-layout:fixed;"><?php echo $r->filter_attr;?></td>
                                    <td style="table-layout:fixed;width:153px;">
                                        <a class="btn mini green" href="<?php echo base_url('mall_category/edit/'.$r->cat_id); ?>"><i class="icon-edit"></i> 编辑</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_category/delete/'.$r->cat_id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
                                    </td>
                                </tr>
                                <tr class="p_cat1" style="display:none;"><td colspan="8"><table class="table-striped table-bordered table-hover">
                                    <?php foreach ($res as $r1) : ?>
                                    <?php if($r->cat_id == $r1->parent_id) :?>
                                    <tr class="p_cat2">
                                        <td style="table-layout:fixed;width:10px;" ><i class="icon-plus"></i></td>
                                        <td style="table-layout:fixed;width:40px;"><?php echo $r1->cat_id;?></td>
                                        <td style="table-layout:fixed;width:120px;"><?php echo $r1->cat_name;?></td>
                                        <td style="table-layout:fixed;width:120px;"><?php echo $r1->parent_id;?></td>
                                        <td style="table-layout:fixed;width:120px;"><?php echo $r1->is_show;?></td>
                                        <td style="table-layout:fixed;width:50px;"><?php echo $r1->sort_order;?></td>
                                        <td style="table-layout:fixed;"><?php echo $r1->filter_attr;?></td>
                                        <td style="table-layout:fixed;width:145px;">
                                            <a class="btn mini green" href="<?php echo base_url('mall_category/edit/'.$r1->cat_id); ?>"><i class="icon-edit"></i> 编辑</a>
                                            <a class="btn mini green" href="<?php echo base_url('mall_category/delete/'.$r1->cat_id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
                                        </td>
                                    </tr>
                                    <tr class="p_cat3" style="display:none;"><td colspan="8" style="padding-left: 25px"><table class="table-striped table-bordered table-hover">
                                        <?php foreach ($res as $r2) : ?>
                                        <?php if($r1->cat_id == $r2->parent_id) :?>
                                        <tr>
                                            <td style="table-layout:fixed;width:40px;"><?php echo $r2->cat_id;?></td>
                                            <td style="table-layout:fixed;width:120px;"><?php echo $r2->cat_name;?></td>
                                            <td style="table-layout:fixed;width:120px;"><?php echo $r2->parent_id;?></td>
                                            <td style="table-layout:fixed;width:120px;"><?php echo $r2->is_show;?></td>
                                            <td style="table-layout:fixed;width:50px;"><?php echo $r2->sort_order;?></td>
                                            <td style="table-layout:fixed;"><?php echo $r2->filter_attr;?></td>
                                            <td style="table-layout:fixed;width:137px;">
                                                <a class="btn mini green" href="<?php echo base_url('mall_category/edit/'.$r2->cat_id); ?>"><i class="icon-edit"></i> 编辑</a>
                                                <a class="btn mini green" href="<?php echo base_url('mall_category/delete/'.$r2->cat_id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
                                            </td>
                                        </tr>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                    </table></td></tr>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </table></td></tr>
                                <?php endif;?>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<script>
;$(function(){
	$('.portlet-body .p_cat').each(function(){
		if($(this).next('.p_cat1').find('tr').length == 0) $(this).find('i.icon-plus').remove();
	});
	
	$('.p_cat').on('click','i.icon-plus',function(){
		$(this).parents('.p_cat').next('.p_cat1').show();
		$(this).addClass('icon-minus').removeClass('icon-plus');
		$(this).parents('.p_cat').next('.p_cat1').find('.p_cat2').each(function(){ 
			if($(this).next('.p_cat3').find('tr').length == 0) $(this).find('i.icon-plus').remove();
		});
	});
	
	$('.p_cat2').on('click','i.icon-plus',function(){
		$(this).parents('.p_cat2').next('.p_cat3').show();
		$(this).addClass('icon-minus').removeClass('icon-plus');
	});

	$('.p_cat').on('click','i.icon-minus',function(){
		$(this).addClass('icon-plus').removeClass('icon-minus');
		$(this).parents('tr.p_cat').next('tr').hide();
	});
	$('.p_cat2').on('click','i.icon-minus',function(){
		$(this).addClass('icon-plus').removeClass('icon-minus');
		$(this).parents('tr.p_cat2').next('tr').hide();
	});
});


</script>
<?php $this->load->view('layout/footer');?>