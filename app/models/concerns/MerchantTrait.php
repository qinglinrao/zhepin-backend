<?php namespace concerns;

trait MerchantTrait {

    protected $system_template;
    protected $system_page;
    protected $system_site_id;

    protected $mapping = [];

    protected $_merchant_detail;
    protected $_site;
    protected $_page;
    protected $_product_categories;
    protected $_image_folders;
    protected $_images;
    protected $_product_services;
    protected $_products;
    protected $_product_images_products;
    protected $_product_services_products;
    protected $_product_options;
    protected $_product_default_option_values;
    protected $_product_option_values;
    protected $_product_options_products;
    protected $_product_entities;

    public function runCopy()
    {
        // 获取模板的相关信息
        $this->getSite();

        // 开始复制内容
        // $this->setMerchantDetail();
        $this->setSite();
        $this->setPage();
        $this->setProductCategory();
        //$this->setImageFolder();
        $this->setImage();
        $this->setProductService();
        $this->setProduct();
        $this->setProductImagesProduct();
        $this->setProductProductsServices();
        $this->setProductOption();
        $this->setProductDefaultOptionValue();
        $this->setProductOptionValue();
        $this->setProductOptionsProduct();
        $this->setProductEntity();
    }

    protected function getSite()
    {
        $this->system_template  = Template::with('page')->find(10051);
        $this->system_page      = $this->system_template->page;
        $this->system_site_id   = $this->system_page->site_id;
    }

    protected function setMerchantDetail()
    {
        $this->_merchant_detail = new MerchantDetail;
    }

    protected function setSite()
    {
        $site = Site::find($this->system_site_id);

        $this->_site = $site->replicate();
        $this->_site->merchant_id = $this->id;
        $this->_site->save();
    }

    protected function setPage()
    {
        $this->_page = $this->system_page->replicate();
        $this->_page->site_id = $this->_site->id;
        $this->_page->home = 1;
        $this->_page->name = '首页';
        $this->_page->save();
    }

    protected function setProductCategory()
    {
        $categories = ProductCategory::roots()->whereSiteId($this->system_site_id)->get();

        foreach($categories as $category)
        {
            $new_category = $category->replicate();
            $new_category->site_id = $this->_site->id;
            $new_category->save();

            if(count($category->children))
            {
                foreach($category->children as $children)
                {
                    $new_children = $children->replicate();
                    $new_children->parent_id = $new_category->id;
                    $new_children->site_id = $this->_site->id;
                    $new_children->save();

                    $this->mapping['product_categories'][$children->id] = $new_children->id;
                }
            }

            $this->_product_categories[] = $new_category;
            $this->mapping['product_categories'][$category->id] = $new_category->id;
        }
    }

    protected function setImageFolder()
    {
        $image_folders = ImageFolder::whereSiteId($this->system_site_id)->get();

        foreach($image_folders as $image_folder)
        {
            $new_image_folder = $image_folder->replicate();
            $new_image_folder->site_id = $this->_site->id;
            $new_image_folder->save();

            $this->_image_folders[] = $new_image_folder;
            $this->mapping['image_folders'][$image_folder->id] = $new_image_folder->id;
        }
    }

    protected function setImage()
    {
        $images = Image::whereSiteId($this->system_site_id)->get();

        foreach($images as $image)
        {
            $new_image = $image->replicate();
            $new_image->site_id = $this->_site->id;
            $new_image->folder_id = $this->mapping['image_folders'][$image->folder_id];
            $new_image->save();

            $this->_images[] = $new_image;
            $this->mapping['images'][$image->id] = $new_image->id;
        }
    }

    protected function setProductService()
    {
        $services = ProductService::whereSiteId($this->system_site_id)->get();

        foreach($services as $service)
        {
            $new_service = $service->replicate();
            $new_service->site_id = $this->_site->id;
            $new_service->save();

            $this->_product_services[] = $new_service;
            $this->mapping['product_services'][$service->id] = $new_service->id;
        }
    }

    protected function setProduct()
    {
        $products = Product::whereSiteId($this->system_site_id)->get();

        foreach($products as $product)
        {
            $new_product = $product->replicate();
            $new_product->site_id = $this->_site->id;
            $new_product->category_id = $this->mapping['product_categories'][$product->category_id];
            $new_product->save();

            $this->_products[] = $new_product;
            $this->mapping['products'][$product->id] = $new_product->id;
        }
    }

    protected function setProductImagesProduct()
    {
        $product_images_products = ProductImagesProduct::whereIn('product_id', array_keys($this->mapping['products']))->get();

        foreach($product_images_products as $product_images_product)
        {
            $new_product_images_product = $product_images_product->replicate();
            $new_product_images_product->image_id = $this->mapping['images'][$product_images_product->image_id];
            $new_product_images_product->product_id = $this->mapping['products'][$product_images_product->product_id];
            $new_product_images_product->save();

            $this->_product_images_products[] = $new_product_images_product;
        }
    }

    protected function setProductProductsServices()
    {
        $product_services_products = ProductProductsService::whereIn('product_id', array_keys($this->mapping['products']))->get();

        foreach($product_services_products as $product_products_service)
        {
            $new_product_products_service = $product_products_service->replicate();
            $new_product_products_service->service_id = $this->mapping['product_services'][$product_products_service->service_id];
            $new_product_products_service->product_id = $this->mapping['products'][$product_products_service->product_id];
            $new_product_products_service->save();

            $this->_product_services_products[] = $new_product_products_service;
        }
    }

    protected function setProductOption()
    {
        $options = ProductOption::whereSiteId($this->system_site_id)->get();

        foreach($options as $option)
        {
            $new_option = $option->replicate();
            $new_option->site_id = $this->_site->id;
            $new_option->save();

            $this->_product_options[] = $new_option;
            $this->mapping['product_options'][$option->id] = $new_option->id;
        }
    }

    protected function setProductDefaultOptionValue()
    {
        $option_values = ProductDefaultOptionValue::whereIn('option_id', array_keys($this->mapping['product_options']))->get();

        foreach($option_values as $option_value)
        {
            $new_option_value = $option_value->replicate();
            $new_option_value->option_id = $this->mapping['product_options'][$option_value->option_id];
            $new_option_value->save();

            $this->_product_default_option_values[] = $new_option_value;
            $this->mapping['product_default_option_values'][$option_value->id] = $new_option_value->id;
        }
    }

    protected function setProductOptionValue()
    {
        $option_values = ProductOptionValue::whereSiteId($this->system_site_id)->get();

        foreach($option_values as $option_value)
        {
            $new_option_value = $option_value->replicate();
            $new_option_value->option_id = $this->mapping['product_options'][$option_value->option_id];
            $new_option_value->mapping_value_id = $this->mapping['product_default_option_values'][$option_value->mapping_value_id];
            $new_option_value->site_id = $this->_site->id;
            $new_option_value->save();

            $this->_product_options[] = $new_option_value;
            $this->mapping['product_option_values'][$option_value->id] = $new_option_value->id;
        }
    }

    protected function setProductOptionsProduct()
    {
        $product_options_products = ProductOptionsProduct::whereIn('option_id', array_keys($this->mapping['product_options']))->get();

        foreach($product_options_products as $product_options_product)
        {
            $new_product_options_product = $product_options_product->replicate();
            $new_product_options_product->product_id = $this->mapping['products'][$product_options_product->product_id];
            $new_product_options_product->option_id = $this->mapping['product_options'][$product_options_product->option_id];
            $new_product_options_product->option_value_id = $this->mapping['product_option_values'][$product_options_product->option_value_id];
            $new_product_options_product->save();

            $this->_product_options_products[] = $new_product_options_product;
        }
    }

    protected function setProductEntity()
    {
        $product_entities = ProductEntity::whereIn('product_id', array_keys($this->mapping['products']))->get();

        if(!count($product_entities)) return;

        foreach($product_entities as $product_entity)
        {
            $new_product_entity = $product_entity->replicate();
            $new_product_entity->product_id = $this->mapping['products'][$product_entity->product_id];
            $new_product_entity->option_set = $this->mappingOptionSet($product_entity->option_set, $this->mapping['product_option_values']);
            $new_product_entity->mapping_option_set = $this->mappingOptionSet($product_entity->mapping_option_set, $this->mapping['product_default_option_values']);
            $new_product_entity->save();
            $this->_product_entities[] = $new_product_entity;
        }
    }

    protected function mappingOptionSet($option_set, $mapping)
    {
        $options = explode('|', trim($option_set, '|'));
        $new_options = [];
        foreach($options as $option)
        {
            $new_options[] = $mapping[$option];
        }

        $new_option_set = implode('|', $new_options);

        return strpos($option_set, '|') === 0 ? ('|'.$new_option_set.'|') : $new_option_set;
    }
}
