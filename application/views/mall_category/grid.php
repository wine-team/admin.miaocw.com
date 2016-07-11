<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理<small> 类别管理</small></h3>
            <?php echo breadcrumb(array('商品管理', 'mall_category/grid'=>'类别管理'));?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid inbox">
        <div class="span3">
            <div class="margin-bottom-10">
                <button type="button" class="btn" id="tree_1_collapse">Expand All</button>
                <button type="button" class="btn" id="tree_1_expand">Collapse All</button>
            </div>
            <ul class="tree" id="tree_1">
                <li>
                    <a href="#" data-role="branch" class="tree-toggle" data-toggle="branch">
                        <i class="icon-folder-open"></i> Bootstrap Tree
                    </a>
                    <ul class="branch in">
                        <li>
                            <a href="#" class="tree-toggle closed" data-toggle="branch">
                                <i class="icon-folder-close"></i> Documents
                            </a>
                            <ul class="branch">
                                <li>
                                    <a href="#" class="tree-toggle closed" data-toggle="branch">
                                        <i class="icon-folder-close"></i> Finance
                                    </a>
                                    <ul class="branch">
                                        <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Sale Revenue</a></li>
                                        <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Promotions</a></li>
                                        <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> IPO</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> ICT</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Human Resources</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="tree-toggle closed" data-toggle="branch">
                                <i class="icon-folder-close"></i> Projects
                            </a>
                            <ul class="branch">
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Internal</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Client Base</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Product Base</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="tree-toggle closed" data-toggle="branch">
                                <i class="icon-folder-close"></i> Tasks
                            </a>
                            <ul class="branch">
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Internal Projects</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Outsourcing</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Bug Tracking</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="tree-toggle closed" data-toggle="branch">
                                <i class="icon-folder-close"></i> Customers
                            </a>
                            <ul class="branch">
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Finance</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> ICT</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Human Resources</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="tree-toggle closed" data-toggle="branch">
                                <i class="icon-folder-close"></i> Reports
                            </a>
                            <ul class="branch">
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Finance</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> ICT</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-close"></i> Human Resources</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="span9">
            <div id="accordion1-1" class="accordion in collapse">
                <form action="#">
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
                        <input type="text" class="span8 m-wrap" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Alabama&quot;,&quot;Alaska&quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;US&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]">
                        <p class="help-block"><span class="muted">Start typing to auto complete!. E.g: US</span></p>
                    </div>
                    <div class="controls">
                        <label class="control-label">About</label>
                        <textarea class="span8 m-wrap" rows="3"></textarea>
                    </div>
                    <div class="submit-btn">
                        <a href="#" class="btn green">Save Changes</a>
                        <a href="#" class="btn">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $("#tree_1").on('click', '[data-toggle=branch]', function (event) {
        $this = $(this);
        if ($this.hasClass('closed')) {
            $.ajax({
                type: 'get',
                async: false,
                dataType : 'json',
                url: hostUrl()+'/mall_attribute_set/ajaxAttributeSet',
                data: $('.ajaxSearch').serialize(),
                success: function(json) {
                    if (json.status) {
                        $('#attribute-responsive').html(json.html);
                    }
                    $this.removeClass('closed').children('i').removeClass('icon-folder-close').addClass('icon-folder-open').parent('a.tree-toggle').next('ul .branch').addClass('in');
                }
            });
        } else {
            $this.addClass('closed').children('i').removeClass('icon-folder-open').addClass('icon-folder-close').parent('a.tree-toggle').next('ul .branch').removeClass('in');
        }
        event.preventDefault();
    });
});
</script>
