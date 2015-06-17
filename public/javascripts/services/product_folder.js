'use strict';

angular.module('mcmoreApp')
    .factory('ProductFolder', ['$rootScope', '$http', function($rootScope, $http) {
        return {
            'create': function(folder) {
                return $http.post('/folders', folder);
            },

            'products': function(products, folders) {
                $http.post('/folders/products', {'products':products,'folders':folders});
            }
        }
    }]);