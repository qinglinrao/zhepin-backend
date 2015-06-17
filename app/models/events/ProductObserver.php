<?php

class ProductObserver {

    public function saving($model)
    {
        if(!$model->par_price) $model->par_price = $model->sale_price;
    }

    public function saved($model)
    {
        $value_mapping = self::syncOptionValue($model);
        self::syncEntity($model, $value_mapping);
    }

    public function deleted($model)
    {
        foreach ($model->entities as $entity) $entity->delete();
        foreach ($model->options as $option) $option->delete();

        $model->options()->detach();
        $model->services()->detach();
        $model->images()->detach();
//        $model->folders()->detach();
    }

    protected function syncEntity($product, $value_mapping)
    {
        $records = $product->entities;

        // 当前values的Ids
        $current = $records->lists('mapping_option_set');

        // 转换格式, 用ID做下标
        foreach ($records as $attributes)
        {
            $results[$attributes->mapping_option_set] = $attributes;
        }

        if($entities = Input::get('entities'))
        {
            // 获取已经删除的选项值Ids并删除
            $detach = array_diff($current, array_keys($entities));

            if(count($detach) > 0)
            {
                foreach($records as $record)
                {
                    if(in_array($record->mapping_option_set, $detach)) $record->delete();
                }
            }

            foreach($entities as $combination_str => $entity)
            {
                $combinations = explode('|', $combination_str);

                // 处理新的键值映射
                $values = [];
                foreach($combinations as $key => $combination)
                {
                    $combinations[$key] = $value_mapping[$combination]['id'];
                    $values[] = $value_mapping[$combination]['name'];
                }

                sort($combinations);
                $option_set = '|'.implode('|', $combinations).'|';

                if($entity['sale_price'])
                {
                    $attributes = [
                        'sku' => $entity['sku'],
                        'sale_price' => $entity['sale_price'],
                        'stock' => $entity['stock'],
                        'option_set' => $option_set,
                        'option_set_values' => implode("\n", $values),
                        'mapping_option_set' => $combination_str,
                        'product_id' => $product->id,
                    ];

                    if ( ! in_array($combination_str, $current))
                    {
                        ProductEntity::create($attributes);
                    } else {
                        $product_entity = $results[$combination_str];
                        $product_entity->update($attributes);
                    }
                }
            }
        }
    }

    protected function syncOptionValue($product)
    {
        // 进行选项复制操作，并保存新的键值映射,
        // 需要返回后期使用
        $value_mapping = [];

        $records = $product->options;

        // 当前values的Ids
        $current = $records->lists('mapping_value_id');

        // 转换格式, 用ID做下标
        foreach ($records as $attributes)
        {
            $results[$attributes->mapping_value_id] = $attributes;
        }

        if($options = Input::get('options'))
        {
            // 获取已经删除的选项值Ids并删除
            $value_ids = [];
            foreach ($options as $option) {
                if(!isset($option['values'])) continue;
                $value_ids = array_merge($value_ids, array_keys($option['values']));
            }

            $detach = array_diff($current, $value_ids);

            if(count($detach) > 0)
            {
                foreach($records as $record)
                {
                    if(in_array($record->mapping_value_id, $detach)) $record->delete();
                }
            }

            // 更新
            $sync = [];
            foreach($options as $option_id => $option)
            {
                if(!isset($option['values'])) continue;

                foreach($option['values'] as $value)
                {
                    $attributes = [
                        'option_id' => $option_id,
                        'mapping_value_id' => $value['id'],
                        'name' => $value['name']
                    ];

                    if ( ! in_array($value['id'], $current))
                    {
                        $product_option_value = ProductOptionValue::create($attributes);
                    } else {
                        $product_option_value = $results[$value['id']];
                        $product_option_value->update($attributes);
                    }

                    $value_mapping[$value['id']] = [
                        'id' => $product_option_value->id,
                        'name' => $option['name'].':'.$product_option_value->name
                    ];
                    $sync[$product_option_value->id] = ['option_id'=>$option_id];
                }
            }
            if($sync) $product->options()->sync($sync);
        }

        return $value_mapping;
    }
}