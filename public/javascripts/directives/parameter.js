'use strict';

angular.module('mcmoreApp')
    .directive('mcParameter', ['$http', '$interval', function($http, $interval) {
        return {
            restrict: 'E',
            replace: true,
            scope: {

            },
            templateUrl: '/javascripts/directives/templates/parameter.html',
            link: function($scope) {

            },
            controller: function($scope, $element, $attrs, $transclude) {
                // 获取选择组合情况(直积)
                function _createSKUMap(options, index, current) {
                    var optionsLength = options.length;

                    if (index >= optionsLength) return;
                    var currentOptions = options[index].values;
                    var currentOptionsIds = _.pluck(currentOptions, 'id'); // 当前选项,选项值的ID集
                    index++;

                    _(currentOptions).forEach(function(value) {
                        current = _.difference(current, currentOptionsIds); // 去除多余的ID

                        if(value.checked) current.push(value.id);
                        if(current.length == optionsLength) $scope.combinations.push(current);
                        _createSKUMap(options, index, current)
                    })
                };

                $scope.entities = {};
                function createSKUMap() {
                    $scope.combinations = [];

                    _createSKUMap(_.filter($scope.options, {'hadCheck': true}), 0);

                    // 设产品实例(选项组合后的价格、数量、编码)
                    _($scope.combinations).forEach(function(combination, key){
                        var combination_str = combination.join('|');

                        // 判断组合是存在,如果不存在就把组合实例添加到实例数组
                        if(!$scope.entities[combination_str])
                        {
                            $scope.entities[combination_str] = {
                                sale_price: null,
                                stock: null,
                                sku: null
                            };
                        }
                    });
                };

                // 用于判断可用数据是否都已经加载
                var option_data_loading = true,
                    entity_data_loading = true,
                    stopTime;

                // 获取已选列表
                var product = {options: null, entities: null};
                if($attrs.productId) {
                    $http.get('/api/products/'+$attrs.productId+'/options').success(function(data) {
                        entity_data_loading = false;

                        product.options = data.product.options;
                        product.entities = data.product.entities;
                    });
                } else {
                    entity_data_loading = false;
                }

                // 获取选项列表
                $scope.optionList = [];
                $http.get('/api/options').success(function(data) {
                    option_data_loading = false;

                    $scope.options = data.options;
                });

                function initialization() {
                    // 产品实例内容
                    _(product.entities).forEach(function(entity) {
                        $scope.entities[entity.mapping_option_set] = entity;
                    });

                    // 钩选已经选的选项,并重设名称
                    _($scope.options).forEach(function(option) {
                        _(option.values).forEach(function(value) {
                            $scope.optionList[value.id] = value;

                            var mapping_data = _.findWhere(product.options, {'mapping_value_id': value.id});

                            if(mapping_data)
                            {
                                value.name = mapping_data.name;
                                option.hadCheck = value.checked = true;
                            }
                        })
                    });

                    createSKUMap();
                }

                stopTime = $interval(function() {
                    if(!option_data_loading && !entity_data_loading)
                    {
                        $interval.cancel(stopTime);                        
                        initialization()
                    }
                }, 500);

                // 全选某个选项
                $scope.checkAll = function (group) {
                    _($scope.options).forEach(function(option) {
                        if(option.id === group)
                        {
                            option.hadCheck = option.checked;
                            _(option.values).forEach(function(value) {
                                value.checked = option.checked;
                            });
                        }
                    });

                    createSKUMap();
                };

                // 选择单个选项值
                $scope.checkValue = function (option) {
                    var checked_length = _.filter(option.values, {'checked': true}).length;
                    var values_length = option.values.length;

                    option.checked = values_length == checked_length;
                    option.hadCheck = checked_length ? true : false;
                    createSKUMap();
                };

                // 批量修改操作
                $scope.batchChange = function(type) {
                    var entities = $scope.entities;

                    if($scope.batch[type])
                    {
                        _(entities).forEach(function(entity) {
                            entity[type] = $scope.batch[type];
                        });

                        // 重设输入框
                        $scope.batch[type] = '';
                    }
                }
            }
        }
    }]);