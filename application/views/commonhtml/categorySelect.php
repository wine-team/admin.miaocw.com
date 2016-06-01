<?php
    $categoryLevel = $this->mall_category->getCategoryLevel(0);
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
            url: '<?php echo base_url();?>mall_category/select_children/'+$('#class_a').val(),
            type: 'GET',
            dataType: 'json',
            success: function(city_json){
                var classb = document.getElementById('class_b');
                classb.options.length = 0;
                classb.options[0] = new Option('请选择二级分类', '');
                for (var i=0; i<city_json.length; i++) {
                    var len = classb.length;
                    classb.options[len] = new Option(city_json[i].cat_name, city_json[i].cat_id); 
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

    var change_class_c = function(){
        $.ajax({
            url: '<?php echo base_url()?>mall_category/select_children/'+$('#class_b').val(),
            type: 'GET',
            dataType: 'json',
            success: function(district_json){
                var classc = document.getElementById('class_c');
                classc.options.length = 0;
                classc.options[0] = new Option('请选择三级分类', '');
                for (var i=0; i<district_json.length; i++) {
                    var len = classc.length;
                    classc.options[len] = new Option(district_json[i].cat_name, district_json[i].cat_id); 
                    if (classc.options[len].value == class_c){
                        classc.options[len].selected = true;
                    }
                }
            }
        });
    }

    $('#class_b').change(function(){
        change_class_c();
    });
});
</script>

<select id="class_a" class="required" name="class_a" style="width:150px;">
    <?php foreach($categoryLevel as $key => $item): ?>
    <option value="<?php echo $item['cat_id'];?>" <?php if ($item['cat_id'] == $class_a):?>selected="selected"<?php endif;?> ><?php echo $item['cat_name']; ?></option>
    <?php endforeach; ?>
</select>

<select id="class_b" class="" name="class_b" style="width:150px;">
    <option value="">请选择二级分类</option>
</select>

<select id="class_c" class="" name="class_c" style="width:150px;">
    <option value="">请选择三级分类</option>
</select>