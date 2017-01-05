<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">编辑分类 </h3>
            <?php echo breadcrumb(array('salestopic/index'=>'促销管理', 'salestopiccategory/index?sales_id='. $detail->sales_id=>'促销分类管理', '编辑分类')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑分类</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form add-hotelfacilitie-html" action="<?php echo base_url('salestopiccategory/editPost') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="category_id" value="<?php echo $detail->category_id; ?>" >
                        <input type="hidden" name="sales_id" value="<?php echo $detail->sales_id; ?>" >
                        <div class="row-fluid">
                            <div class="control-group">
                                <label class="control-label"><em>* </em>标题</label>
                                <div class="controls">
                                    <input type="text" class="m-wrap medium required" name="title" value="<?php echo $detail->title; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>标题备注</label>
                            <div class="controls">
                                <input type="text" class="m-wrap medium required" name="note"  value="<?php echo $detail->note; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>分类链接</label>
                            <div class="controls">
                                <input type="text" class="m-wrap span6 url" name="link_url" value="<?php echo $detail->link_url; ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>产品类型</label>
                            <div class="controls">
                                <?php echo $types[$detail->type]; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="text" class="m-wrap medium required digits" name="topic_sort" value="<?php echo $detail->sort;?>">
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="control-group">
                                <label class="control-label"><em>* </em>上下架</label>
                                <div class="controls">
                                    <select class="medium m-wrap required" name="status">
                                        <?php foreach ($status as $key=>$value) :?>
                                            <option <?php echo ($key == $detail->status) ? 'selected="selected"' : ''; ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-success">促销产品更新</div>
                        <div class="row-fluid">
                            <div class="span12 pricing pricing-active hover-effect">
                                <ul class="pricing-content unstyled add-tourism-goods-html">
                                    <?php if ( $salesCategoryProduct->num_rows() > 0 ) : ?>
                                    <?php foreach($salesCategoryProduct->result() as $key=>$value) : ?>
                                        <li><i class="icon-tags"></i>
                                            <input type="hidden"  name="list[<?php echo $key; ?>][id]" value="<?php echo $value->id; ?>" />
                                            产品编号<input class="m-wrap span3 digits required goods-id" type="text" name="list[<?php echo $key; ?>][product_id]" value="<?php echo $value->product_id; ?>"/>
                                            排序(从小到大) <input class="m-wrap span3 required digits" type="text" name="list[<?php echo $key; ?>][sort]" value="<?php echo $value->sort; ?>">
                                            <a href="javascript:void(0);" data-id="<?php echo $value->id; ?>" class="btn mini product-ajax-delete">删除</a>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <div class="pricing-footer">
                                    <a id="product-add" class="btn green" href="javascript:void(0);">添加产品 <i class="m-icon-swapright m-icon-white "></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('salestopiccategory/index?sales_id='.$detail->sales_id); ?>">
                                <button class="btn" type="button">返回</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#product-add").click(function () {
        var _val = '<li><i class="icon-tags"></i> ' +
            '产品编号<input class="m-wrap span3 digits required goods-id" type="text" name="product_id[]"/> ' +
            '排序(从小到大) <input class="m-wrap span3 required digits" type="text" name="sort[]" value="127"> ' +
            '<a href="javascript:void(0);" class="btn mini product-delete">删除</a></li>';
        $(this).parent('.pricing-footer').prev().append(_val);
    });
    $('ul.pricing-content').on('click', ".product-delete", function () {
        $(this).parent('li').remove();
    });

    $('.product-ajax-delete').click(function(){
        var obj = $(this);
        var id = obj.attr('data-id');
        $.ajax({
            type:'post',
            dataType:'json',
            async : true,
            url:hostUrl() + '/salestopiccategory/ajaxDeleteProduct',
            data: {'id': id},
            success: function (data) {
                if (data.status) {
                    obj.parent('li').remove();
                } else {
                    alert(data.messages);
                }
            }
        });
    });
</script>
<?php $this->load->view('layout/footer');?>