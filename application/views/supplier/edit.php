<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">用户管理 <small>供应商管理</small></h3>
            <?php echo breadcrumb(array('用户管理', 'supplier/grid'=>'供应商管理', '编辑供应商')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑供应商</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form supplier-form" action="<?php echo base_url('supplier/addPost') ?>" method="post" enctype ="multipart/form-data" >
                        <input type="hidden" name="supplier_id" value="<?php echo $res->supplier_id;?>">
                        <div class="control-group add-pop-up-html">
                            <label class="control-label"><em>* </em>用户UID</label>
                            <div class="controls">
                                <input type="text" name="uid" value="<?php echo $res->uid;?>" class="m-wrap medium useruid tooltips number" data-original-title="双击可弹框选择用户" data-trigger="hover">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>供应商名称</label>
                            <div class="controls">
                                <input type="text" name="supplier_name" value="<?php echo $res->supplier_name;?>" class="m-wrap large required"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">供应商简介</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit" name="supplier_desc"><?php echo $res->supplier_desc;?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>状态</label>
                            <div class="controls">
                                <label class="radio">
                                	<input type="radio" class="required" name="is_check" value="1" <?php if($res->is_check==1) echo 'checked="checked"';?> /> 正常
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="is_check" value="2" <?php if($res->is_check==2) echo 'checked="checked"';?>/>冻结
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('supplier/grid') ?>">
                                <button class="btn" type="button">返回</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
<?php $this->load->view('user/ajaxUser/ajaxGet');?>
<script type="text/javascript" >
$('form.supplier-form').submit(function(){
    return false;
}).validate({
    rules: {
    	uid: {
            required: true,
            remote: {
                url:hostUrl()+'/supplier/validateUser',
                type: 'post',
                dataType: 'json',
                data: {
                	uid:function(json) {
                        return $('input[name=uid]').val();
                    },
                    supplier_id:function(json) {
                        return $('input[name=supplier_id]').val();
                    }
                }
            }
        },
    },
    messages: {
    	uid: {
    		required:'请输入用户id',
            remote: '此用户已经是供应商了'
        },
    },
    submitHandler: function(f) {
        $.ajax({
            type: 'post',
            async: true,
            dataType : 'json',
            url: hostUrl() + '/supplier/editPost',
            data: $('form.supplier-form').serialize(),
            success: function(data) {
                if (data.status) {
                    $('.alert-error').hide();
                    window.location.href = data.messages;
                } else {
                    $('.alert-error').show();
                    $('.remove_2 p').html(data.messages);
                    var body = (window.opera) ? (document.compatMode == 'CSS1Compat' ? $('html') : $('body')) : $('html,body');
                    body.animate({scrollTop: $('.page-container').offset().top}, 1000);
                }
            }
        });
    }
});
</script>