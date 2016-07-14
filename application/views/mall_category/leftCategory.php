<p><a href="#" class="btn red mini">添加主目录</a></p>
<p><a href="#" class="btn blue mini">添加子目录</a></p>
<?php echo getCategoryHtml($categorys); ?>
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
                        $this.removeClass('closed').next('ul .branch').addClass('in');
                    }
                });
            } else {
                if ($this.next('ul .branch').size() > 0) {
                    $this.addClass('closed').next('ul .branch').removeClass('in');
                }
            }
            event.preventDefault();
        });
    });
</script>