/**
 * Created by gibson on 14-10-23.
 */
define(['backbone','models/Component'], function(Backbone, Component) {
    'use strict';

    return Backbone.Collection.extend({
        model: Component
    })
});