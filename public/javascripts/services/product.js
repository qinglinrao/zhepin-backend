'use strict';

angular.module('mcmoreApp')
    .factory('Product', ['$rootScope', function($rootScope) {
        return {
            'choose': function() {
                $rootScope.chooseProducts = [];
            },
            'cancelChoose': function() {

            }
        }
    }]);