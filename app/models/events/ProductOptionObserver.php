<?php

class ProductOptionObserver {

    public function saved($model)
    {
        $this->syncOptionValue($model);
    }

    public function deleted($model)
    {
        foreach($model->values as $value) $value->delete();
    }

    protected function syncOptionValue($entity)
    {
        $old_values = (array) Input::get('values');

        $records = $entity->values;

        // 当前values的Ids
        $current = $records->lists('id');

        // 获取已经删除的选项值Ids并删除
        $detach = array_diff($current, array_keys($old_values));
        if(count($detach) > 0)
        {
            foreach($records as $record)
            {
                if(in_array($record->id, $detach)) $record->delete();
            }
        }

        foreach($old_values as $id => $values) ProductDefaultOptionValue::where('id', $id)->update($values);

        // 储存新增的选项值
        if($new_values = Input::get('new_values'))
        {
            $values = [];
            foreach($new_values['name'] as $value)
            {
                if(!empty($value))
                {
                    $values[] = ['name' => $value];
                }
            }
            $entity->values()->createMany($values);
        }
    }
}