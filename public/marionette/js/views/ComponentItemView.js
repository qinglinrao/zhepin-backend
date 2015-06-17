/**
 * Created by gibson on 14-10-23.
 */
define(['backbone.marionette', 'mustache', 'templates', 'jquery-ui'], function(Marionette, Mustache, templates) {
    'use strict';

    console.log('Load ComponentItemView');

    return Marionette.ItemView.extend({
        template: function(serializeModel) {
            Mustache.parse(templates.componentItemView);
            return Mustache.render(templates.componentItemView, serializeModel);
        },

        tagName: 'div',

        className: 'item',

        ui: {
            'component': '.component'
        },

        events: {

        },

        onRender: function() {
            this.ui.component.draggable({
                connectToSortable: '#preview-region .region-warp',
                helper: 'clone',
                revert: 'invalid'
            });
        }
    });
});