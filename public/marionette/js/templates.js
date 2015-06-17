/**
 * Created by gibson on 14-10-23.
 */
define(function(require){
    'use strict';

    return {
        pageItemView                : require('text!templates/pageItemView.tmpl'),
        pageItemCompositeView       : require('text!templates/pageItemCompositeView.tmpl'),
        pageElementView             : require('text!templates/pageElementView.tmpl'),
        componentItemView           : require('text!templates/componentItemView.tmpl'),
        componentItemCompositeView  : require('text!templates/componentItemCompositeView.tmpl')
    };
});