<div class="col-lg-3 col-md-4">
    <div class="myaccount-tab-menu nav" role="tablist">
        <a href="{{ URL('account') }}" class="<?php echo (isset($segment[0]) AND $segment[0] == 'account')  ? 'active' : '' ?>"><i class="fa fa-dashboard"></i>
            Dashboard</a>
        
        
        {{--@if(Auth::user()->user_type != '2')--}}
        <a href="{{ URL('orders') }}" class="<?php echo (isset($segment[0]) AND $segment[0] == 'orders')  ? 'active' : '' ?>"><i class="fa fa-cart-arrow-down"></i> Orders History</a>
        {{--@endif--}}
        
        
        
        <a href="{{ URL('account-detail') }}" class="<?php echo (isset($segment[0]) AND $segment[0] == 'account-detail')  ? 'active' : '' ?>"><i class="fa fa-user"></i> Account Details</a>

        <a href="{{ URL('signout') }}"><i class="fa fa-sign-out"></i> Logout</a>
    </div>
</div>


<style type="text/css">
.myaccount-tab-menu a {
    width: 100%!important;
}
</style>