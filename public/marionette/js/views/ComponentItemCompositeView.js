/**
 * Created by gibson on 14-10-23.
 */
define(['backbone.marionette', 'mustache', 'views/ComponentItemView', 'templates', 'jquery-ui'], function(Marionette, Mustache, ComponentItemView, templates) {
    'use strict';

    console.log('Load ComponentItemCompositeView');

    return Marionette.CompositeView.extend({
        template: function(serializeModel) {
            Mustache.parse(templates.componentItemCompositeView);
            return Mustache.render(templates.componentItemCompositeView, serializeModel);
        },
        
        className: 'region-warp',

        childView: ComponentItemView,

        childViewContainer: '#component-list',

        ui: {

        },

        events: {

        },

        onRender: function() {

        }
    });
});