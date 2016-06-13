<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
    <h3>快递信息</h3>
</div>
<div class="modal-body">
  
    <?php if ($delivery->num_rows() > 0) :?>
        <table class="table table-striped table-bordered table-hover">
            <thead class="flip-content">
                <tr>
                    <th>快递编号</th>
                    <th>快递名称</th>
                    <th>快递单号</th>
                    <th>快递状态</th>
                    <th>快递内容</th>
                    <th>更新时间</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $delivery->row()->deliver_order_id;?></td>
                    <td><?php echo $delivery->row()->deliver_name;?></td>
                    <td><?php echo $delivery->row()->deliver_number;?></td>
                    <td><?php switch ($delivery->row()->state) {
                                            case 0 : echo '在途中';break; 
                                            case 1 : echo '已揽收';break;
                                            case 2 : echo '疑难';break;
                                            case 3 : echo '已签收';break;
                                            case 4 : echo '退签';break;
                                            case 5 : echo '同城派送中';break;
                                            case 6 : echo '退回';break;
                                            case 7 : echo '转单';break;
                                        }?></td>
                    <td><?php echo json_decode($delivery->row()->context);?></td>
                    <td><?php echo $delivery->row()->update_at;?></td>
                </tr>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert"><p>未找到数据。<p></div>
    <?php endif;?>
</div>
<div class="modal-footer"></div>