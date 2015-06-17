/**
 * Created by gibson on 14-10-23.
 */
define(['backbone.marionette', 'mustache', 'templates'], function(Marionette, Mustache, templates) {
    'use strict';
    console.log('Load PageItemView');

    return Marionette.ItemView.extend({
        template: function(serializeModel) {
            Mustache.parse(templates.pageItemView);
            return Mustache.render(templates.pageItemView, serializeModel);
        },

        tagName: 'li',

        ui: {
            deletePage: '#delete_page',
            edit: '.edit',
            label: 'label'
        },

        events: {
            'click @ui.label': 'onSelectPage',
            'dblclick @ui.label': 'onEditPage',
            'keydown @ui.edit' : 'onEditKeydown',
            'focusout @ui.edit': 'onEditFocusout'
        },

        modelEvents: {
           'change': 'render'
        },

        onSelectPage: function() {
            console.log('Select '+this.model.get('title'));

            this.model.set('selected', 1);
            this.$el.addClass('selecting');
        },

        onEditPage: function() {
            console.log('Edit '+this.model.get('title'));

            this.$el.addClass('editing');
            this.ui.edit.focus();
        },

        onEditFocusout: function () {
            var todoText = this.ui.edit.val().trim();

            if (todoText) {
                this.model.set('title', todoText);
                this.$el.removeClass('editing');
            } else {
                this._restore();
            }
        },

        onEditKeydown: function(e) {
            var ENTER_KEY = 13, ESC_KEY = 27;

            switch(e.which)
            {
                case ENTER_KEY:
                    this.onEditFocusout();
                    break;
                case ESC_KEY:
                    this._restore();
                    break;
            }
        },

        _restore: function() {
            this.ui.edit.val(this.model.get('title'));
            this.$el.removeClass('editing');
        }
    });
});