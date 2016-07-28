<p><a href="<?php echo base_url('mall_category/grid');?>" class="btn red mini">添加主目录</a></p>
<p><a href="<?php echo base_url('mall_category/grid').'?parent_id='.$this->input->get('cat_id');?>" class="btn blue mini">添加子目录</a></p>
<?php echo getCategoryHtml($categorys); ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#tree_1").on('click', '[data-toggle=branch]', function (event) {
            $this = $(this);
            if ($this.hasClass('closed')) {
                $this.removeClass('closed').nextAll('ul .branch').addClass('in');
            } else {
                if ($this.nextAll('ul .branch').size() > 0) {
                    $this.addClass('closed').nextAll('ul .branch').removeClass('in');
                }
            }
            event.preventDefault();
        });

        if ($('[data-cat-id='+<?php echo (int)$this->input->get('cat_id') ?>+']').parents('ul .branch').size() > 0) {
            $('[data-cat-id='+<?php echo (int)$this->input->get('cat_id') ?>+']').removeClass('closed').parents('ul .branch').addClass('in').nextAll('[data-toggle=branch]').removeClass('closed');
        }
    });
</script>