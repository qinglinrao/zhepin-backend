/**
 * Created by gibson on 14-10-23.
 */
define(['backbone','models/Page'], function(Backbone, Page) {
    'use strict';

    return Backbone.Collection.extend({
        model: Page
    })
});