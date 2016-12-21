<?php
class Capture extends MJ_Controller
{
    public function _init()
    {
        $this->load->model('region_model', 'region');
        $this->load->model('mall_goods_base_model', 'mall_goods_base');
        $this->load->model('mall_attribute_set_model','mall_attribute_set');
        $this->load->model('mall_brand_model','mall_brand');
        $this->load->model('mall_goods_from_model','mall_goods_from');
        $this->load->model('mall_category_model', 'mall_category');
        $this->load->model('mall_category_product_model', 'mall_category_product');
    }

    /**
     * 更新现有产品ID
     */
    public function upDateExsit()
    {
        $this->db->select('goods_id, goods_note, goods_sku');
        $this->db->where('from_id', 5);
        $result = $this->db->get('mall_goods_base');
        $goodsBase = $result->result();
        foreach ($goodsBase as $item) {
            $data = array(
                'goods_sku'   => 'QUW'.preg_replace('/\D/s', '', $item->goods_note),
                'goods_note'  => $item->goods_note.'===='.$item->goods_sku,
            );
            $this->db->where('goods_id', $item->goods_id);
            $update = $this->db->update('mall_goods_base', $data);
            if ($update) {
                echo $item->goods_id.'更新成功<br />';
            } else {
                echo $item->goods_id.'更新失败<br />';
            }
        }
        
    }

    /**
     * $page 起始页
     * $pageNum 总页数
     * $goodsType array(2=>'women', 1=>'man', 5=>'runhua', 4=>'neiyi', 3=>'qingqu', 7=>'biyuntao')
     */
    public function list()
    {
        $page = $this->input->get_post('page') ? $this->input->get_post('page') : 1;
        $pageNum = $this->input->get_post('pageNum') ? $this->input->get_post('pageNum') : 12;
        $goodsType = $this->input->get_post('goodsType');
        $typeArray = array(2=>'women', 1=>'man', 5=>'runhua', 4=>'neiyi', 3=>'qingqu', 7=>'biyuntao');
        if (in_array($goodsType, $typeArray)) {
            $topCatId = array_search($goodsType, $typeArray);
        } else {
            die('抓取类型参数值（goodsType）有误');
        }

        require_once APPPATH.'libraries/phpQuery.php';
        $productUrl = array();
        for ($i=$page; $i<=$pageNum; $i++) {
            phpQuery::newDocumentFile('http://www.taohv.cn/category.php?top_cat_id='.$topCatId.'&page='.$i);
            $items = pq('.plist ul li');
            foreach ($items as $key=>$item) {
                $productUrl[$i][$key]['provide_price'] = preg_replace('/[^\.0123456789]/s', '', pq($item)->find('.pxinxi .xinxileft .xxjiage')->text());
                $productUrl[$i][$key]['url'] = 'http://www.taohv.cn'.pq($item)->find('.ptupian a')->attr('href');
            }
        }
        if (!empty($productUrl)) {
            $item = array();
            foreach ($productUrl as $valueArray) {
                foreach ($valueArray as $value) {
                    phpQuery::newDocumentFile($value['url']);
                    $goods_id = pq('#wrap_con #goods_id')->val();
                    $goods_sku = 'THW' . $goods_id;
                    if (!$goods_id) {
                        continue;
                    }
                    //获取产品属性
                    $attrValues = pq('#wrap_con .basic_con dl');
                    $attrItem = array();
                    foreach ($attrValues as $k => $v) {
                        $attrItem['group_name'] = '女性用品-主体';
                        $attrItem['group_value'][$k]['attr_name'] = trim(pq($v)->find('dt')->text(), '：');
                        $attrItem['group_value'][$k]['attr_value'] = pq($v)->find('dd')->text();
                    }
                    $attr_value = array($attrItem);

                    //获取产品图片
                    $goodsimgs = pq('#wrap_con .mat_js_img dd');
                    $imgItem = array();
                    foreach ($goodsimgs as $kk => $vv) {
                        $imgItem[] = str_replace(array('changeImage(\'', '\');return false;'), array('', ''), pq($vv)->find('a')->attr('onclick'));
                    }
                    $goods_img = implode('|', $imgItem);

                    $item['goods_name'] = mb_convert_encoding(pq('#wrap_con ul.title li:eq(1)')->html(), 'UTF-8', 'GBK');
                    $item['goods_sku'] = $goods_sku;
                    $item['from_id'] = 4; //商品来源
                    //$item['brand_id']             = 0;
                    $item['goods_weight'] = 100;
                    $item['market_price'] = trim(pq('.cpjiage .shijia em')->text(), '￥');
                    $item['shop_price'] = $this->rePrice($value['provide_price']);
                    $item['provide_price'] = $value['provide_price'];
                    $item['promote_start_date'] = 0;
                    $item['promote_end_date'] = 0;
                    $item['attr_set_id'] = 5;
                    $item['goods_brief'] = mb_convert_encoding(pq('#wrap_con ul.title li:eq(0)')->html(), 'UTF-8', 'GBK');
                    $item['goods_desc'] = mb_convert_encoding(trim(pq('.brands_con .brands_middle')->html(), ' '), 'UTF-8', 'GBK');
                    $item['wap_goods_desc'] = mb_convert_encoding(trim(pq('.brands_con .brands_middle')->html(), ' '), 'UTF-8', 'GBK');
                    $item['goods_note'] = $value['url'];
                    $item['attr_spec'] = array();
                    $item['attr_value'] = $attr_value;
                    $item['goods_img'] = '';
                    $item['extension_code'] = 'simple';
                    $item['is_on_sale'] = 1;
                    $item['is_check'] = 2;
                    $item['in_stock'] = 100;
                    $item['booking_limit'] = 0;
                    $item['limit_num'] = 0;
                    $item['minus_stock'] = 1;
                    $item['integral'] = 0;
                    $item['supplier_id'] = 15;
                    $item['freight_id'] = 0;
                    $item['freight_cost'] = 0;
                    $item['province_id'] = 12;
                    $item['city_id'] = 123;
                    $item['district_id'] = 1363;
                    $item['address'] = '浙江省 杭州市 下城区 新天地跨贸小镇';
                    $item['auto_cancel'] = 720;
                    //$item['sale_count']           = 0;
                    //$item['review_count']         = 0;
                    //$item['tour_count']           = 0;
                    //$item['sort_order']           = 50;
                    //$item['created_at']           = date('Y-m-d H:i:s');
                    //$item['updated_at']           = date('Y-m-d H:i:s');

                    $result = $this->mall_goods_base->findByGoodsSku($goods_sku);
                    if ($result->num_rows() > 0) {
                        $mallGoodsBase = $result->row(0);
                        $goods_id = $mallGoodsBase->goods_id;
                        $item['goods_id'] = $goods_id;
                        $item['goods_note'] = $value['url'] . '====' . $goods_sku;
                        $item['attr_value'] = $value['attr_value'];
                        if (empty($mallGoodsBase->goods_img)) {
                            $item['goods_img'] = $goods_img;
                        }
                        $update = $this->mall_goods_base->updateCopy($item);
                        $note = '产品ID（' . $goods_id . '）更新';
                    } else {
                        $item['is_check'] = 1;
                        $item['goods_img'] = $goods_img;
                        $goodsId = $this->mall_goods_base->insert($item);
                        $categoryIds = $this->getcategoryIds($goodsType);
                        $isInsert = $this->mall_category_product->insertBatchByGoodsId($goodsId, $categoryIds);
                        $note = '产品ID（' . $goods_id . '）添加';
                    }

                    if ((isset($update) && $update)
                        || (isset($goods_id, $isInsert) && $goods_id
                            && $isInsert)
                    ) {
                        echo $note . '成功<br />';
                    } else {
                        echo $note . '失败<br />';
                    }
                    /*
                    if ( $goods_sku != 'THW3682' && $goods_sku != 'THW4772' && $goods_sku != 'THW1153' && $goods_sku != 'THW2979') {
                        pr($item);
                        exit('成功'.$goods_sku);
                    }*/
                }
            }
        }
    }

    public function rePrice($provide_price)
    {
        $shop_price = $provide_price + 10;

        switch ($provide_price) {
            case  $provide_price <= 100 :
                $shop_price = $provide_price + 10;
                break;
            case  $provide_price <= 200 :
                $shop_price = $provide_price + 15;
                break;
            case  $provide_price <= 300 :
                $shop_price = $provide_price + 20;
                break;
            case  $provide_price <= 400 :
                $shop_price = $provide_price + 25;
                break;
            case  $provide_price <= 500 :
                $shop_price = $provide_price + 30;
                break;
            case  $provide_price <= 600 :
                $shop_price = $provide_price + 40;
                break;
            case  $provide_price <= 700 :
                $shop_price = $provide_price + 50;
                break;
            case  $provide_price <= 800 :
                $shop_price = $provide_price + 60;
                break;
            case  $provide_price <= 900 :
                $shop_price = $provide_price + 80;
                break;
            case  $provide_price <= 1000 :
                $shop_price = $provide_price + 100;
                break;
            case  $provide_price <= 1500 :
                $shop_price = $provide_price + 150;
                break;
            case  $provide_price <= 2000 :
                $shop_price = $provide_price + 200;
                break;
            case  $provide_price <= 3000 :
                $shop_price = $provide_price + 300;
                break;
            case  $provide_price <= 5000 :
                $shop_price = $provide_price + 400;
                break;
            case  $provide_price <= 10000 :
                $shop_price = $provide_price + 500;
                break;
            case  $provide_price > 10000 :
                $shop_price = $provide_price + 600;
                break;
        }
        return $shop_price;
    }

    /**
     * @param string $goodsType
     * @return arrayarray(2=>'women', 1=>'man', 5=>'runhua', 4=>'neiyi', 3=>'qingqu', 7=>'biyuntao')
     */
    public function getcategoryIds($goodsType = 'women')
    {
        switch ($goodsType) {
            case 'women' :
                return array(2, 13, 14, 15, 16, 17, 18, 19, 20);
                break;
            case 'man' :
                return array(1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
                break;
            case 'runhua' :
                return array(24, 46, 50, 94, 95);
                break;
            case 'neiyi' :
                return array(22, 33, 34, 35, 36, 37, 38, 93);
                break;
            case 'qingqu' :
                return array(23, 39, 40, 41, 42, 43, 44, 45);
                break;
            case 'biyuntao' :
                return array(25, 51, 52, 53, 54, 55, 56, 57, 58, 59);
                break;
            default :
                return array(2, 13, 14, 15, 16, 17, 18, 19, 20);
                break;
        }
    }
}
