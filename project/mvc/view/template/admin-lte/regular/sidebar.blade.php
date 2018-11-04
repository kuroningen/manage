<?php
    /** @var \project\core\bl\toolLogin\blRights $oUser */
    $oUser = app()->make(\project\core\bl\toolLogin\blRights::class);
    $oUser->user(session('user'));
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">ACCOUNT SETTINGS</li>
    <li>
        <a href="{{ url('account-settings') }}">
            <i class="fa fa-user-cog"></i> <span>Account Settings</span>
        </a>
    </li>
    <li class="header">MAIN NAVIGATION</li>
    @if ($oUser->hasRight($oUser::ACCOUNTING))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i> <span>Accounting</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('accounting/wallets') }}"><i class="fa fa-wallet"></i> Wallets</a></li>
                <li><a href="{{ url('accounting/record-new-expense') }}"><i class="fa fa-dollar-sign"></i> Record new expense</a></li>
                <li><a href="{{ url('accounting/record-new-income') }}"><i class="fa fa-hand-holding-usd"></i> Record new income</a></li>
                <li><a href="{{ url('accounting/transfer-new-balance') }}"><i class="fa fa-funnel-dollar"></i> Transfer balance</a></li>
            </ul>
        </li>
    @endif
    @if ($oUser->hasRight($oUser::ACCOUNTING_ADMIN))
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i>
                <span>Accounting Admin</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('accounting/admin/register-new-currency') }}"><i class="fa fa-money-bill-wave"></i> Register new currency</a></li>
                <li><a href="{{ url('accounting/admin/create-new-wallet') }}"><i class="fa fa-wallet"></i> Create new wallet</a></li>
            </ul>
        </li>
    @endif
    @if ($oUser->hasRight($oUser::USER_AND_RIGHTS_MANAGEMENT))
        <li>
            <a href="{{ url('users/admin') }}">
                <i class="fa fa-users-cog"></i> <span>User and Rights Management</span>
            </a>
        </li>
    @endif
</ul>
