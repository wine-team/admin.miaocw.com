<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="color-panel hidden-phone">
                <div class="color-mode-icons icon-color"></div>
                <div class="color-mode-icons icon-color-close"></div>
                <div class="color-mode"><p>THEME COLOR</p>
                    <ul class="inline">
                        <li data-style="default" class="color-black current color-default"></li>
                        <li data-style="blue" class="color-blue"></li>
                        <li data-style="brown" class="color-brown"></li>
                    </ul>
                    <label>
                        <span>Layout</span>
                        <select class="layout-option m-wrap small">
                            <option selected="selected" value="fluid">Fluid</option>
                            <option value="boxed">Boxed</option>
                        </select>
                    </label>
                </div>
            </div>
            <h3 class="page-title">主页管理 <small>主页详细信息</small></h3>
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="<?php echo base_url('account/dashboard') ?>">我的主页</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4 responsive">
            <div class="dashboard-stat yellow">
                <div class="visual">
                    <i class="icon-bar-chart"></i>
                </div>
                <div class="portfolio-info"><span><?php echo '12312';?></span></div>
                <a href="<?php echo base_url('');?>" class="more">查看详情 <i class="m-icon-swapright m-icon-white"></i></a>
            </div>
        </div>
        <div class="span4 responsive">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="icon-bar-chart"></i>
                </div>
                <div class="portfolio-info"><span><?php echo '12312';?></span></div>
                <a href="<?php echo base_url('');?>" class="more">查看详情 <i class="m-icon-swapright m-icon-white"></i></a>
            </div>
        </div>
        <div class="span4 responsive">
            <div class="dashboard-stat yellow">
                <div class="visual">
                    <i class="icon-bar-chart"></i>
                </div>
                <div class="portfolio-info"><span><?php echo '';?></span></div>
                <a href="<?php echo base_url('');?>" class="more">查看详情 <i class="m-icon-swapright m-icon-white"></i></a>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4 responsive">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="icon-bar-chart"></i>
                </div>
                <div class="portfolio-info"><span><?php echo '';?></span></div>
                <a href="<?php echo base_url('');?>" class="more">查看详情 <i class="m-icon-swapright m-icon-white"></i></a>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>