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
                    <div class="caption"><i class="icon-search"></i>搜索</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal form-search" action="<?php echo base_url('advert/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">标题</label>
                                    <div class="controls">
                                        <input type="text" name="title" value="<?php echo @$title?>" placeholder="标题" class="m-wrap medium">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">所属广告位</label>
                                    <div class="controls">
                                        <select name="source_state" class="medium m-wrap valid">
                                            <option value="">请选择广告位</option>
                                            <?php foreach ($advertArray as $key=>$value) : ?>
                                                <option value="<?php echo $key;?>" <?php if (isset($source_state) && $key == $source_state): ?>selected="selected"<?php endif?>><?php echo $value; ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">状态</label>
                                    <div class="controls">
                                        <select name="flag" class="m-wrap medium">
                                            <option value="">请选择</option>
                                            <?php foreach (array('1'=>'上架', '2'=>'下架') as $key=>$value) :?>
                                            <option value="<?php echo $key;?>" <?php if ($key == $this->input->get('flag')):?> selected="selected"<?php endif;?>><?php echo $value;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit">搜索</button>
                            <button class="btn reset_button_search" type="button">重置条件</button>
                        </div>
                    </form>
                </div>
            </div>
            
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
                            <a href="<?php echo base_url('advert/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th width="15"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>标题</th>
                                    <th>所属广告位</th>
                                    <th>网址</th>
                                    <th>排序</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($line_list->result() as $item) : ?>
                                <tr>
                                    <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $item->advert_id;?></td>
                                    <td><?php echo $item->title;?></td>
                                    <td><?php echo $advertArray[$item->source_state];?></td>
                                    <td><?php echo $item->url;?></td>
                                    <td><?php echo $item->sort;?></td>
                                    <td>
                                        <a href="javascript:;" class="modify-advert-flag glyphicons no-js <?php if ($item->flag == 1):?>ok_2<?php else :?>remove_2<?php endif;?>" data-advert-id="<?php echo $item->advert_id;?>" data-flag="<?php echo $item->flag ?>">
                                            <i></i>
                                        </a>
                                    </td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('advert/edit/'.$item->advert_id) ?>"><i class="icon-edit"></i> 编辑</a>
                                        <a class="btn mini green" href="<?php echo base_url('advert/delete/'.$item->advert_id).'?picture='.$item->picture ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="dataTables_info">
                                    <span>当前第</span><span style="color: red"><?php echo $pg_now?></span>页 
                                    <span>共</span><span style="color: red"><?php echo $all_rows?></span>条数据
                                    <span>每页显示20条 </span>
                                    <?php echo $pg_link ?>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                            <div class="alert"><p>未找到数据。<p></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
<script type="text/javascript">
$(function(){
    $('.modify-advert-flag').click(function(){
        var status = '下线';
        if ($(this).hasClass('remove_2')) {
            status = '上线';
        }
        if (confirm('确定要'+status+'?')) {
            var obj = $(this);
            var advertId = $(this).attr('data-advert-id');
            var flag = $(this).attr('data-flag');
            $.ajax({
                url:hostUrl()+'/advert/toggle',
                type:'POST',
                dataType:'json',
                data: {advert_id:advertId, flag:flag},
                success: function(data) {
                    if (data.flag == 2) {
                        obj.attr('data-flag', data.flag).addClass('remove_2').removeClass('ok_2');
                    } else if(data.flag == 1) {
                        obj.attr('data-flag', data.flag).addClass('ok_2').removeClass('remove_2');
                    } else {
                        alert('操作失败');
                    }
                }
            });
        }
    });
});
</script>