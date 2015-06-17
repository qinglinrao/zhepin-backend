/**
 * Created by gibson on 14-10-22.
 */

require.config({

    //baseUrl: '../bower_components',

    paths: {
        'backbone': '../bower_components/backbone/backbone',
        'backbone.babysitter': '../bower_components/backbone.babysitter/lib/backbone.babysitter',
        'backbone.marionette': '../bower_components/backbone.marionette/lib/core/backbone.marionette',
        'backbone.wreqr': '../bower_components/backbone.wreqr/lib/backbone.wreqr',
        'jquery': '../bower_components/jquery/dist/jquery',
        'jquery-ui': '../bower_components/jquery-ui/jquery-ui',
        'mustache': '../bower_components/mustache/mustache',
        'ratchet': '../bower_components/ratchet/dist/js/ratchet',
        'css': '../bower_components/require-css/css.min',
        'text': '../bower_components/requirejs-text/text',
        'underscore': '../bower_components/underscore/underscore',
        'iCheck': '../bower_components/iCheck/icheck',
        'fancybox': '../bower_components/fancybox/source/jquery.fancybox',
        'owl_carousel': '../bower_components/owl.carousel/owl.carousel.min'
    },

    shim: {
        'backbone': {
            deps: ['mustache']
        }
    },

    waitSeconds: 15

});


require(['application','startup'], function(McMoreApp) {
    console.log('Application Start Load', McMoreApp);
    $('.cover').remove();
    McMoreApp.start();
});