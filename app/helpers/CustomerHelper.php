<?php
class CustomerHelper
{
    public static function render_last_login_time($customer)
    {
        return $customer->last_sign_in_at ? '' : '从未登陆';
    }

    public static function render_groups($customer)
    {
		return implode('，', array_pluck($customer->groups, 'name'));
    }

    public static function render_region($customer)
    {
    	return '广州市 天河区';
    }

    public static function render_status($customer)
    {
    	return "<span class=\"status status-online\">在线</span>";
    }

    public static function render_img($custoemr){

    }
}