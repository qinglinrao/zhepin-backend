'use strict';

angular.module('mcmoreApp')
    .directive('selectAll', ['$rootScope', function ($rootScope) {
        return {
            restrict: 'A',
            link: function( scope, element, attrs ) {
                element.bind("click", function() {
                    $('input:checkbox').attr('checked', element.is(':checked'));
                    $('input[name="id[]"]').each(function () {
                        $(this).is(':checked')
                    })
                });
            }
        }
    }])
    .controller('ProductCtrl', ['$rootScope', '$http', '$scope', '$modal', '$resource', function($rootScope, $http, $scope, $modal, $resource) {
        $scope.openFolderModal = function() {
            console.log($rootScope.chooseProducts);
            $modal.open({
                templateUrl: '/javascripts/modal/folder.html',
                controller: 'FolderModalCtrl'
            })
        };

        var Products = $resource('/api/products/:productId', {
            productId: '@id'
        });
        $scope.products = Products.get();

        $('.action-bar').delegate('.selectAll', 'click', function() {
            var flag = $(this).is(':checked');
            $('input[name="id[]"]').attr('checked', flag);
        });

        $scope.changeStatus = function(status) {

        };

        var secondCategory;
        $http.get('/ajax/categories').success(function(data) {
            $scope.categories = data;

            _($scope.categories).forEach(function(category) {
                secondCategory = _.findWhere(category.children, {'id': $scope.category})
                if(secondCategory)
                {
                    $scope.rootCategory = category;
                    $scope.secondCategories = category.children;
                    $scope.secondCategory = secondCategory;
                }
            });
        });

        $scope.updateSecondCategory = function(category) {
            $scope.secondCategories = category.children;
            $scope.category = category.id
        };
        $scope.chooseSecondCategory = function(category) {
            $scope.category = category.id
        };
    }])
    .controller('SearchBarCtrl', ['$scope', '$http', function ($scope, $http) {
        $scope.isCollapsed = true;

        $http.get('/ajax/categories').success(function(data) {
            $scope.categories = data;
        });

        $scope.updateSecondCategory = function(category) {
            $scope.secondCategories = category.children;
            $scope.category = category.id
        };
        $scope.chooseSecondCategory = function(category) {
            $scope.category = category.id
        }
    }])
    .controller('FolderModalCtrl', ['$scope', '$http', '$modalInstance', 'ProductFolder', function($scope, $http, $modalInstance, ProductFolder) {
        var folders = $scope.folders = [];
        var selected_folder = [];

        $http.get('/ajax/folders').success(function(data) {
            folders = $scope.folders = data;
        });

        $scope.add = function() {
            var folder = {'name': '新建文件夹', 'note': ''};
            ProductFolder.create(folder);
            $scope.folders.unshift(folder);
        };

        $scope.select = function(folder) {
            angular.forEach(folders, function(folder) {
                folder.selected = false;
            });
            folder.selected = true;
            selected_folder = folder;
        };

        $scope.confirm = function () {
            if(!$(selected_folder).size())
            {
                alert('需要选择一个文件夹');
            } else {
                ProductFolder.products([], []);
                $modalInstance.close();
            }
        };

        $scope.dismiss = function() {
            $modalInstance.dismiss();
        };
    }]);
