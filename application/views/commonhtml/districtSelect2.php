<?php
    $this->load->model('region_model', 'region');
    $provinces = $this->region->children_of(0);

    $country_selected  = isset($country_id) ? (int)$country_id : 1;
    $province_selected = isset($province_id) ? (int)$province_id : 0;
    $city_selected     = isset($city_id) ? (int)$city_id : 0;
    $district_selected = isset($district_id) ? (int)$district_id : 0;
?>

<script type="text/javascript">
$(document).ready(function() {
    var country_selected  = <?php echo $country_selected;?>;
    var province_selected = <?php echo $province_selected;?>;
    var city_selected     = <?php echo $city_selected;?>;
    var district_selected = <?php echo $district_selected;?>;
    var change_province = function(){
        $.ajax({
            url: '<?php echo base_url();?>region/select_children/'+$('#country_id').val(),
            type: 'GET',
            dataType: 'json',
            success: function(province_json){
                var province = document.getElementById('province_id');
                province.options.length = 0;
                province.options[0] = new Option('省份', '');
                for (var i=0; i<province_json.length; i++) {
                    var len = province.length;
                    province.options[len] = new Option(province_json[i].region_name, province_json[i].region_id); 
                    if (province.options[len].value == province_selected) {
                        province.options[len].selected = true;
                    }
                }
                change_city();//重置城市
            }
        });
    }
    
    change_province();//初始化省份
    $('#country_id').change(function(){
        change_province();
    });
    
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
                change_district();//重置地区
            }
        });
    }

    //change_city();//初始化城市

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
        change_district();
    });
});
</script>

<select id="country_id" class="required" name="country_id" style="width:85px;">
    <?php foreach($provinces as $key => $province): ?>
    <option value="<?php echo $province['region_id'];?>" <?php if ($province['region_id'] == $country_selected):?>selected="selected"<?php endif;?> ><?php echo $province['region_name']; ?></option>
    <?php endforeach; ?>
</select>

<select id="province_id" class="required" name="province_id" style="width:85px;">
    <option value="" >省份</option>
</select>

<select id="city_id" name="city_id" style="width:88px;">
    <option value="">城市</option>
</select>

<select id="district_id" name="district_id" style="width:85px;">
    <option value="">县/区</option>
</select>