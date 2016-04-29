<?php
    $this->load->model('tourism_goods_category_model', 'tourism_goods_category');
    $categoryLevel = $this->tourism_goods_category->getCategoryLevel(0);

    $class_a = isset($class_a) ? (int)$class_a : 0;
    $class_b = isset($class_b) ? (int)$class_b : 0;
    $class_c = isset($class_c) ? (int)$class_c : 0;
?>
<script type="text/javascript">
$(document).ready(function() {
    var class_a = <?php echo $class_a;?>;
    var class_b = <?php echo $class_b;?>;
    var class_c = <?php echo $class_c;?>;
    var change_class_b = function(){
        $.ajax({
            url: '<?php echo base_url();?>tourismgoodscategory/select_children/'+$('#class_a').val(),
            type: 'GET',
            dataType: 'json',
            success: function(city_json){
                var classb = document.getElementById('class_b');
                classb.options.length = 0;
                classb.options[0] = new Option('请选择二级分类', '');
                for (var i=0; i<city_json.length; i++) {
                    var len = classb.length;
                    classb.options[len] = new Option(city_json[i].name, city_json[i].id); 
                    if (classb.options[len].value == class_b) {
                        classb.options[len].selected = true;
                    }
                }
                change_class_c();//重置地区
            }
        });
    }

    change_class_b();//初始化分类

    $('#class_a').change(function(){
        change_class_b();
    });
});
</script>

<select id="class_a" name="class_a" style="width:165px;">
    <option value="">请选择一级分类</option>
    <?php foreach($categoryLevel as $key => $item): ?>
    <option value="<?php echo $item['id'];?>" <?php if ($item['id'] == $class_a):?>selected="selected"<?php endif;?> ><?php echo $item['name']; ?></option>
    <?php endforeach; ?>
</select>

<select id="class_b" name="class_b" style="width:165px;">
    <option value="">请选择二级分类</option>
</select>
