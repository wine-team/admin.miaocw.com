<?php
class CS_Controller extends MJ_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->uid) {
            $this->redirect('account/login');
        }
    }
    
    /**
     * 资金类型(type)
     * @return multitype:string
     */
    public function levelType()
    {
        return array(
            PAY             => '支付',
            CASH            => '提现',
            RECHARGE        => '银行充值',
            CANCEL          => '退票',
            VIR_RECH        => '虚拟充值',
            REBUT           => '提现驳回',
            DFPROFIT        => '到付反利',
            ZFPROFIT        => '在线利润',
            DEDUCTION       => '月结抵扣',
            REBUT_DEDUCTION => '抵扣驳回',
            MONTHLY         => '月结转余额',
            TOURISMFREIGHT  => '商品运费',
        );
    }
    
    /**
     * 账户类型
     * @return multitype:string
     */
    public function accountType()
    {
        return array(
            ACCOUNT_TYPE_CARRY      => '可提现',
            ACCOUNT_TYPE_SETTLEMENT => '冻结',
            ACCOUNT_TYPE_BONUS      => '游币',
            ACCOUNT_TYPE_RANK       => '积份',
            ACCOUNT_TYPE_MONTH      => '月结',
        );
    }
}