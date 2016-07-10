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
            <ul class="tree" id="tree_1">
                <li>
                    <a href="#" data-role="branch" class="tree-toggle" data-toggle="branch">
                        <i class="icon-folder-open"></i> Bootstrap Tree
                    </a>
                    <ul class="branch in">
                        <li>
                            <a href="#" class="tree-toggle closed" data-toggle="branch">
                                <i class="icon-folder-open"></i> Documents
                            </a>
                            <ul class="branch">
                                <li>
                                    <a href="#" class="tree-toggle closed" data-toggle="branch">
                                        <i class="icon-folder-open"></i> Finance
                                    </a>
                                    <ul class="branch">
                                        <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Sale Revenue</a></li>
                                        <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Promotions</a></li>
                                        <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> IPO</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> ICT</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Human Resources</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="tree-toggle closed" data-toggle="branch">
                                <i class="icon-folder-open"></i> Projects
                            </a>
                            <ul class="branch">
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Internal</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Client Base</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Product Base</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="tree-toggle" data-toggle="branch">
                                <i class="icon-folder-open"></i> Tasks
                            </a>
                            <ul class="branch in">
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Internal Projects</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Outsourcing</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Bug Tracking</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="tree-toggle" data-toggle="branch">
                                <i class="icon-folder-open"></i> Customers
                            </a>
                            <ul class="branch in">
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Finance</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> ICT</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Human Resources</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="tree-toggle" data-toggle="branch">
                                <i class="icon-folder-open"></i> Reports
                            </a>
                            <ul class="branch in">
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Finance</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> ICT</a></li>
                                <li><a href="#" data-role="leaf"><i class="icon-folder-open"></i> Human Resources</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469" target="_blank" data-role="leaf">
                                <i class="icon-folder-open"></i> External Link
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="span9">
            <div id="accordion1-1" class="accordion in collapse">
                <form action="#">
                    <label class="control-label">First Name</label>
                    <input type="text" placeholder="John" class="m-wrap span8">
                    <label class="control-label">Last Name</label>
                    <input type="text" placeholder="Doe" class="m-wrap span8">
                    <label class="control-label">Mobile Number</label>
                    <input type="text" placeholder="+1 646 580 DEMO (6284)" class="m-wrap span8">
                    <label class="control-label">Interests</label>
                    <input type="text" placeholder="Design, Web etc." class="m-wrap span8">
                    <label class="control-label">Occupation</label>
                    <input type="text" placeholder="Web Developer" class="m-wrap span8">
                    <label class="control-label">Counrty</label>
                    <div class="controls">
                        <input type="text" class="span8 m-wrap" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Alabama&quot;,&quot;Alaska&quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;US&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]">
                        <p class="help-block"><span class="muted">Start typing to auto complete!. E.g: US</span></p>
                    </div>
                    <label class="control-label">About</label>
                    <textarea class="span8 m-wrap" rows="3"></textarea>
                    <label class="control-label">Website Url</label>
                    <input type="text" placeholder="http://www.mywebsite.com" class="m-wrap span8">
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