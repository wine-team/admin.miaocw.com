<p><a href="#" class="btn red mini">添加主目录</a></p>
<p><a href="#" class="btn blue mini">添加子目录</a></p>
<div class="margin-bottom-10">
    <button type="button" class="btn mini" id="tree_1_collapse">Expand All</button>
    <button type="button" class="btn mini" id="tree_1_expand">Collapse All</button>
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

        $('#tree_1_collapse').click(function () {
            $('.tree-toggle', $('#tree_1 > li > ul')).addClass("closed");
            $('.branch', $('#tree_1 > li > ul')).removeClass("in");
        });

        $('#tree_1_expand').click(function () {
            $('.tree-toggle', $('#tree_1 > li > ul')).removeClass("closed");
            $('.branch', $('#tree_1 > li > ul')).addClass("in");
        });
    });
</script>