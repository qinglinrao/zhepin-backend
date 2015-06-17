/**
 * Created by gibson on 14-10-23.
 */
define(['backbone'], function(Backbone) {
    'use strict';

    return Backbone.Model.extend({
        // Model Constructor
        initialize: function() {

        },

        // Default values for all of the Model attributes
        defaults: {
            componentId: '',
            componentName: '组件名',
            free: true,
            templateId: '',
            themeId: '',
            hasMarginTop: 'no'
        },

        // Get's called automatically by Backbone when the set and/or save methods are called (Add your own logic)
        validate: function(attrs) {

        }
    })
});