<div class="row-fluid">
    <div class="span6">
        <div class="dataTables_info">
            <span>当前第</span><span class="text-info"><?php echo $pg_now?></span>页
            <span>共</span><span class="text-info"><?php echo $all_rows?></span>条数据
            <span>每页显示<span class="text-info"><?php echo $page_num;?></span>条</span>
        </div>
    </div>
    <div class="span6">
        <div class="dataTables_paginate paging_bootstrap pagination">
            <?php echo $pg_link ?>
        </div>
    </div>
</div>