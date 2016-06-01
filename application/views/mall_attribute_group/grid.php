<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small> 属性组管理</small></h3>
            <?php echo breadcrumb(array('mall_attribute_set/grid'=>'商品类型',  '属性组管理')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid inbox">
        <div class="span2">
            <ul class="inbox-nav margin-bottom-10">
                <li class="compose-btn">
                    <a class="btn green" data-title="Compose" href="javascript:;">
                        <i class="icon-edit"></i> 添加属性组
                    </a>
                </li>
                <li class="inbox">
                    <a data-title="Inbox" class="btn" href="javascript:;">主体(3)</a>
                    <b></b>
                </li>
                <li class="sent active"><a data-title="Sent" href="javascript:;" class="btn">网络</a><b></b></li>
                <li class="draft"><a data-title="Draft" href="javascript:;" class="btn">存储</a><b></b></li>
                <li class="trash"><a data-title="Trash" href="javascript:;" class="btn">显示</a><b></b></li>
            </ul>
        </div>
        <div class="span10">
            <div class="inbox-header">
                <h1 class="pull-left">网络</h1>
                <form class="form-search pull-right" action="#">
                    <div class="input-append">
                        <input type="text" placeholder="Search Mail" class="m-wrap">
                        <button type="button" class="btn green">Search</button>
                    </div>
                </form>
            </div>
            <div class="inbox-loading" style="display: block;">Loading...</div>
            <div class="inbox-content">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th colspan="3">
                            <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                            <div class="btn-group">
                                <a class="btn mini blue" href="#" data-toggle="dropdown">
                                    More
                                    <i class="icon-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="icon-pencil"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="icon-ban-circle"></i> Spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </th>
                        <th class="text-right" colspan="3">
                            <ul class="unstyled inline inbox-nav">
                                <li><span>1-30 of 789</span></li>
                                <li><i class="icon-angle-left  pagination-left"></i></li>
                                <li><i class="icon-angle-right pagination-right"></i></li>
                            </ul>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="unread">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message  hidden-phone">Petronas IT</td>
                        <td class="view-message ">New server for datacenter needed</td>
                        <td class="view-message  inbox-small-cells"><i class="icon-paper-clip"></i></td>
                        <td class="view-message  text-right">16:30 PM</td>
                    </tr>
                    <tr class="unread">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">Daniel Wong</td>
                        <td class="view-message">Please help us on customization of new secure server</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">Facebook</td>
                        <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 14</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star inbox-started"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star inbox-started"></i></td>
                        <td class="view-message hidden-phone">Facebook</td>
                        <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                        <td class="view-message inbox-small-cells"><i class="icon-paper-clip"></i></td>
                        <td class="view-message text-right">March 14</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star inbox-started"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"><i class="icon-paper-clip"></i></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">Facebook</td>
                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 14</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">Facebook</td>
                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 14</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star inbox-started"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star inbox-started"></i></td>
                        <td class="hidden-phone">Facebook</td>
                        <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                        <td class="view-message inbox-small-cells"><i class="icon-paper-clip"></i></td>
                        <td class="view-message text-right">March 14</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"><i class="icon-paper-clip"></i></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="hidden-phone">Facebook</td>
                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 14</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">Facebook</td>
                        <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 14</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star inbox-started"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">Facebook</td>
                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                        <td class="view-message inbox-small-cells"><i class="icon-paper-clip"></i></td>
                        <td class="view-message text-right">March 14</td>
                    </tr>
                    <tr class="">
                        <td class="inbox-small-cells">
                            <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="inbox-small-cells"><i class="icon-star"></i></td>
                        <td class="view-message hidden-phone">John Doe</td>
                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                        <td class="view-message inbox-small-cells"><i class="icon-paper-clip"></i></td>
                        <td class="view-message text-right">March 15</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>