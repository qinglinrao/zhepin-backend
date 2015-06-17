/**
 * Created by gibson on 14-10-29.
 */
define(['backbone.wreqr'], function(Wreqr) {
    'use strict';

    return {
        reqres: new Wreqr.RequestResponse(),
        commands: new Wreqr.Commands(),
        events: new Wreqr.EventAggregator()
    };
});