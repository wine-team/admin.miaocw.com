<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">新闻管理 <small>新闻管理 </small></h3>
            <?php echo breadcrumb(array('新闻管理', 'news/grid'=>'新闻列表', '添加妙处网公告')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加贝竹公告</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('newscontent/addPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>公告标题</label>
                            <div class="controls">
                                <input type="text" name="title" class="m-wrap large required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>公告内容</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit required" name="content"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>所属分类</label>
                            <div class="controls">
                                <select name="class_id" class="medium m-wrap">
                                    <?php foreach ($newsclass->result() as $item): ?>
                                    <option value="<?php echo $item->class_id;?>"><?php echo $item->class_name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>来源</label>
                            <div class="controls">
                                <input type="text" name="author" placeholder="本站原创" class="m-wrap large required" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否发布</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" checked="checked" name="status" value="1">是
                                </label>
                                <label class="radio">
                                    <input type="radio" name="status" value="2">否
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('newscontent/grid') ?>">
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