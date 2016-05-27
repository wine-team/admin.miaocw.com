<div class="page-sidebar nav-collapse collapse">
    <ul class="page-sidebar-menu">
        <li><div class="sidebar-toggler hidden-phone"></div></li>
        <li>
            <form class="sidebar-search">
                <div class="input-box">
                    <a class="remove" href="javascript:;"></a>
                    <input type="text" placeholder="搜索...">
                    <input type="button" value=" " class="submit">
                </div>
            </form>
        </li>
        <li class="start">
            <a href="<?php echo site_url('account/dashboard');?>">
                <i class="icon-home"></i> 
                <span class="title">我的主页</span>
                <span class="selected"></span>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <i class="icon-money"></i> 
                <span class="title">财务部</span>
                <span class="selected"></span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="javascript:;">
                        <span class="title">财务管理</span>
                        <span class="selected "></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo base_url('useraccount/index');?>">虚拟充值</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="icon-user"></i>
                <span class="title">用户管理</span>
                <span class="selected "></span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="javascript:;">
                        <span class="title">用户账号管理</span>
                        <span class="selected "></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo base_url('user/grid');?>">账号列表</a></li>
                        <li><a href="<?php echo base_url('supplier/grid');?>">供应商管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <span class="title">权限菜单管理</span>
                        <span class="selected "></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo base_url('adminuser/grid');?>">员工管理</a></li>
                        <li><a href="<?php echo base_url('adminrole/grid');?>">角色管理</a></li>
                        <li><a href="<?php echo base_url('adminaction/grid');?>">菜单管理</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="icon-barcode"></i>
                <span class="title">妙网商城</span>
                <span class="selected "></span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="javascript:;">
                        <span class="title">商品管理</span>
                        <span class="selected "></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="javascript:;">商品列表</a></li>
                        <li><a href="<?php echo base_url('mall_category/grid');?>">类别管理</a></li>
                        <li><a href="<?php echo base_url('mall_goods_type/grid');?>">商品类型</a></li>
                        <li><a href="<?php echo base_url('mall_brand/grid');?>">品牌管理</a></li>
                        <li><a href="<?php echo base_url('mall_freight/grid');?>">运费模板</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <span class="title">商品订单</span>
                        <span class="selected "></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="javascript:;">订单管理</a></li>
                        <li><a href="javascript:;">评价管理</a></li>
                        <li><a href="javascript:;">退款审核</a></li>
                        <li><a href="javascript:;">换货审核</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url('keyword_search/grid');?>">热门搜索</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="icon-bullhorn"></i>
                <span class="title">新闻管理</span>
                <span class="selected"></span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu" style="display: none;">
                <li><a href="<?php //echo base_url('keyword_search/grid');?>">新闻（公告）列表</a></li>
                <li><a href="<?php //echo base_url('keyword_search/grid');?>">新闻（公告）分类</a></li>
                <li><a href="<?php //echo base_url('keyword_search/grid');?>">代理商申请</a></li>
                <li><a href="<?php //echo base_url('keyword_search/grid');?>">供应商申请</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="icon-cogs"></i> 
                <span class="title">网站设置</span>
                <span class="selected "></span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li><a href="<?php echo base_url('advert/grid');?>">幻灯片广告管理</a></li>
                <li><a href="<?php echo base_url('cmsblock/grid');?>">区块广告设置</a></li>
                <li><a href="<?php echo base_url('ewm/grid');?>">二维码编辑器</a></li>
                <li><a href="<?php echo base_url('link/grid');?>">友情链接</a></li>
                <li><a href="<?php echo base_url('cacheclear/grid');?>">缓存管理</a></li>
                <li><a href="<?php echo base_url('userfeedback/grid');?>">用户反馈</a></li>
                <li><a href="<?php echo base_url('help_category/grid');?>">帮助中心</a></li>
            </ul>
        </li>
    </ul>
</div>