<?php
    $this->load->model('region_model', 'region');
    $provinces = $this->region->children_of(1);

    $province_selected = isset($province_id) ? (int)$province_id : 0;
    $city_selected     = isset($city_id) ? (int)$city_id : 0;
    $district_selected = isset($district_id) ? (int)$district_id : 0;
?>

<script type="text/javascript">
$(document).ready(function() {
    var province_selected = <?php echo $province_selected;?>;
    var city_selected     = <?php echo $city_selected;?>;
    var district_selected = <?php echo $district_selected;?>;
    var change_city = function(){
        $.ajax({
            url: '<?php echo base_url();?>region/select_children/'+$('#province_id').val(),
            type: 'GET',
            dataType: 'json',
            success: function(city_json){
                var city = document.getElementById('city_id');
                city.options.length = 0;
                city.options[0] = new Option('城市', '');
                for (var i=0; i<city_json.length; i++) {
                    var len = city.length;
                    city.options[len] = new Option(city_json[i].region_name, city_json[i].region_id); 
                    if (city.options[len].value == city_selected) {
                        city.options[len].selected = true;
                    }
                }
                //change_district();//重置地区
            }
        });
    }

    change_city();//初始化城市

    $('#province_id').change(function(){
        change_city();
    });

    var change_district = function(){
        $.ajax({
            url: '<?php echo base_url()?>region/select_children/'+$('#city_id').val(),
            type: 'GET',
            dataType: 'json',
            success: function(district_json){
                var district = document.getElementById('district_id');
                district.options.length = 0;
                district.options[0] = new Option('县/区', '');
                for (var i=0; i<district_json.length; i++) {
                    var len = district.length;
                    district.options[len] = new Option(district_json[i].region_name, district_json[i].region_id); 
                    if (district.options[len].value == district_selected){
                        district.options[len].selected = true;
                    }
                }
            }
        });
    }

    $('#city_id').change(function(){
        //change_district();
    });
});
</script>

<select id="province_id" class="required" name="province_id" style="width:110px;">
    <option value="" >省份</option>
    <?php foreach($provinces as $key => $province): ?>
    <option value="<?php echo $province['region_id'];?>" <?php if ( $province['region_id'] == $province_selected):?>selected="selected"<?php endif;?> ><?php echo $province['region_name']; ?></option>
    <?php endforeach; ?>
</select>

<select id="city_id" class="required" name="city_id" style="width:110px;">
    <option value="">城市</option>
</select>