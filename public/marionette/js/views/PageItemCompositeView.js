/**
 * Created by gibson on 14-10-23.
 */
define(['backbone.marionette', 'mustache', 'views/PageItemView', 'templates', 'jquery-ui'], function(Marionette, Mustache, PageItemView, templates) {
    'use strict';

    console.log('Load PageItemCompositeView');

    return Marionette.CompositeView.extend({
        template: function(serializeModel) {
            Mustache.parse(templates.pageItemCompositeView);
            return Mustache.render(templates.pageItemCompositeView, serializeModel);
        },

        className: 'region-warp',

        childView : PageItemView,

        childViewContainer : '#page-list',

        ui: {
            addButton: '#add-page',
            moveUpButton: '#move-up-page',
            moveDownButton: '#move-down-page',
            deleteButton: '#delete-page',
            pages: '#page-list'
        },

        events: {
            'click @ui.addButton' : 'addPage',
            'click @ui.moveUpButton' : 'sortPage',
            'click @ui.moveDownButton' : 'sortPage',
            'click @ui.deleteButton': 'deletePage'
        },

        onRender: function() {
            this.ui.pages.sortable({ 
                axis: 'y' ,
                forcePlaceholderSize: true,
                placeholder: "ui-sortable-placeholder"
                
            });
        },

        addPage: function() {
            this.collection.add({'title': '新建页面'});
            console.log(this.collection.toJSON());
        },

        sortPage: function() {
            this.collection.sort();
            console.log(this.collection);
        },

        deletePage: function() {
            console.log('Delete Page ↓');
            console.log(this.collection.where({'selected': 1}).toJSON());

            this.collection.remove(
                this.collection.where({'selected': 1})
            );
        }
    });
});