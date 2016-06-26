<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"><i class="icon-reorder"></i>商品运费信息</div>
        <div class="tools">
            <a class="collapse" href="javascript:;"></a>
            <a class="remove" href="javascript:;"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="control-group">
            <label class="control-label"><em>* </em>配送地址</label>
            <div class="controls">
                <?php $this->load->view('commonhtml/districtSelect'); ?>
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label"> 详细地址</label>
            <div class="controls">
                <input type="text" class="m-wrap span8 required" placeholder="用于根据地址搜索您的产品" name="address" value="<?php echo trim(mb_strrchr($mallgoods->address, ' ')); ?>"/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><em>* </em>支付方式</label>
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" class="required" value="1" name="payments[]" checked="checked"/>在线支付
                </label>
                <label class="checkbox">
                    <input type="checkbox" class="required" value="2" name='payments[]'/>货到付款
                </label>
            </div>
        </div>
        <div class="control-group search-choice">
            <label class="control-label">运费</label>
            <div class="controls transport">
                <label class="checkbox">
                    <input type="radio" value="1" name="transport_type" class="<?php if($mallgoods->freight_id>0):?>required<?php endif;?>" <?php if($mallgoods->freight_id>0):?>checked="checked"<?php endif;?>/>
                </label>
                <select name="freight_id" id="freight_id" class="medium <?php if($mallgoods->freight_id>0):?>required<?php endif;?>" <?php if($mallgoods->freight_id==0):?>style="display:none;"<?php endif;?>>
                    <?php if($freight->num_rows()>0):?>
                        <?php foreach($freight->result() as $item):?>
                            <option value="<?php echo $item->freight_id;?>" <?php if($item->freight_id==$mallgoods->freight_id):?>selected="selected"<?php endif;?>><?php echo $item->name;?></option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
                <label class="checkbox">使用运费模板</label>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls transport">
                <label class="checkbox">
                    <input type="radio" value="2" name="transport_type" class="<?php if($mallgoods->freight_id==0):?>required<?php endif;?>"    <?php if($mallgoods->freight_id==0):?>checked="checked"<?php endif;?> />
                </label>
                <input type="text" name="freight_cost" id="freight_cost" class="<?php if($mallgoods->freight_id==0):?>required<?php endif;?>" <?php if($mallgoods->freight_id>0):?>style="display:none;"<?php endif;?>  value="<?php echo $mallgoods->freight_cost;?>"/>
                <label class="checkbox">自定义运费价格</label>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn green step4" type="submit"><i class="icon-ok"></i> 保存</button>
            <a class="btn step3" href="<?php echo base_url('mall_goods_base/addstep1')?>">返回上一步</a>
        </div>
    </div>
</div>