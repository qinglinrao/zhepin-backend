<?php
class ProductHelper
{
    public static function render_status($product)
    {
        switch ($product->visible)
        {
            case 0:
            default:
                $status = '<span class="status status-offline">已下架</span>';
                break;
            case 1:
                $status = '<span class="status status-online">已上架</span>';
                break;
        }
        return $status;
    }

    public static function render_folders($folders)
    {
        return implode(',', array_pluck($folders, 'name'));
    }

    public static function render_image($image)
    {
        return HTML::image(Config::get('app.image_domain').$image->url, null, ['width'=>50, 'height'=>50]);
    }

    public static function status($selected=NULL)
    {
        $status = [
            'online' => '已上架',
            'offline' => '已下架'
        ];

        return Form::select('status', $status, $selected, ['class'=>'form-control input-sm']);
    }

    public static function invoice()
    {
        $invoices = [
            '0' => '无',
            '1' => '有'
        ];

        $invoice_label = '';
        foreach($invoices as $val => $invoice) {
            $invoice_label .= '<label class="radio-inline">';
            $invoice_label .= Form::radio('invoice', $val) . $invoice;
            $invoice_label .= '</label>';
        }

        return $invoice_label;
    }

    public static function counting_method()
    {
        $methods = [
            '0' => '拍下减库存',
            '1' => '付款减库存'
        ];

        $method_label = '';
        foreach($methods as $val => $method) {
            $method_label .= '<div class="radio">';
            $method_label .= '<label class="radio-inline">';
            $method_label .= Form::radio('counting_method', $val) . $method;
            $method_label .= '</label>';
            $method_label .= '</div>';
        }

        return $method_label;
    }

    public static function services()
    {
        $services = ProductService::all();

        $service_label = '';
        foreach($services as $service) {
            $service_label .= '<label class="checkbox-inline">';
            $service_label .= Form::checkbox('services[]', $service->id) . $service->name;
            $service_label .= '</label>';
        }

        return $service_label;
    }
}