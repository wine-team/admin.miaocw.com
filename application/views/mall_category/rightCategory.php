
<form action="#">
    <div class="tabbable tabbable-custom tabbable-custom-profile">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab">基本信息</a>
            </li>
            <li><a href="#tab_1_2" data-toggle="tab">显示设置</a></li>
            <li><a href="#tab_1_3" data-toggle="tab">分类产品</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane row-fluid active" id="tab_1_1">

                <div class="controls">
                    <label class="control-label">分类名称：</label>
                    <input type="text" placeholder="John" class="m-wrap span8">
                </div>
                <div class="control-group">
                    <label class="control-label">激活状态：</label>
                    <div class="controls">
                        <select name="attr_type" class="m-wrap large required">
                            <option value="text">是</option>
                            <option value="textarea">否</option>
                        </select>
                    </div>
                </div>
                <div class="controls">
                    <label class="control-label">Mobile Number：</label>
                    <input type="text" placeholder="+1 646 580 DEMO (6284)" class="m-wrap span8">
                </div>
                <div class="controls">
                    <label class="control-label">Mobile Number</label>
                    <input type="text" placeholder="+1 646 580 DEMO (6284)" class="m-wrap span8">
                </div>
                <div class="controls">
                    <label class="control-label">Mobile Number</label>
                    <input type="text" placeholder="+1 646 580 DEMO (6284)" class="m-wrap span8">
                </div>
                <div class="controls">
                    <label class="control-label">About</label>
                    <textarea class="span8 m-wrap" rows="3"></textarea>
                </div>
            </div>
            <div class="tab-pane profile-classic row-fluid" id="tab_1_2">

            </div>
            <div class="tab-pane row-fluid profile-account" id="tab_1_3">

            </div>
        </div>
    </div>
    <div class="submit-btn">
        <a href="#" class="btn green">Save Changes</a>
        <a href="#" class="btn">Cancel</a>
    </div>
</form>