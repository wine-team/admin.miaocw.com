<p><a href="#" class="btn red mini">添加主目录</a></p>
<p><a href="#" class="btn blue mini">添加子目录</a></p>
<?php if (!empty($categorys)) : ?>
    <div class="margin-bottom-10">
        <button type="button" class="btn mini" id="tree_1_collapse">Expand All</button>
        <button type="button" class="btn mini" id="tree_1_expand">Collapse All</button>
    </div>
    <?php echo getCategoryHtml($categorys); ?>
<?php endif;?>
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