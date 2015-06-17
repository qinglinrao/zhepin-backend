/**
 * Created by gibson on 14-10-29.
 */
define(function(require){
    'use strict';

    var ComponentList = require('collections/ComponentList');
    var PageElementList = require('collections/PageElementList');
    var PageList = require('collections/PageList');

    return {
        componentList   : new ComponentList,
        pageElementList : new PageElementList,
        pageList        : new PageList
    };
});