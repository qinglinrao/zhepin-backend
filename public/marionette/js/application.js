/**
 * Created by gibson on 14-10-22.
 */
define(['backbone.marionette', 'msgbus', 'collections', 'views/PageItemCompositeView', 'views/ComponentItemCompositeView', 'views/PageElementView'], function(Marionette, msgBus, collections, PageItemCompositeView, ComponentItemCompositeView, PageElementView ) {
    'use strict';

    var mcMoreApp = new Marionette.Application({
        regions: {
            pageRegion: '#page-region',
            componentRegion: '#component-region',
            previewRegion: '#preview-region',
            configRegion: '#config-region'
        },
        collections : collections
    });

    mcMoreApp.addInitializer(function() {
        collections.pageList.add(McMore.page.itemList);
        console.log('Page List Data Load', collections.pageList);

        collections.pageElementList.add(McMore.page.pageElement);
        console.log('Page Element Data Load', collections.pageElementList);

        collections.componentList.add(McMore.components);
        console.log('Component List Data Load', collections.componentList);

        mcMoreApp.pageRegion.show(new PageItemCompositeView({
            collection : collections.pageList
        }));

        mcMoreApp.componentRegion.show(new ComponentItemCompositeView({
            collection: collections.componentList
        }));

        mcMoreApp.previewRegion.show(new PageElementView({
            collection: collections.pageElementList
        }));
    });

    mcMoreApp.on('start', function() {
        // Backbone.history.start();
        console.log('Application Start');

        mcMoreApp.sortResult = $('#preview-region .region-warp').sortable({
            forcePlaceholderSize: true,
            placeholder: 'place_holder',
            start: function(event,ui){

            },
            stop: function (event, ui) {
                console.log('Sortable UI Data', ui);
                console.log('Page Element Collection Data', collections.pageElementList);

                var ComponentClass = ui.item.attr('data-component');
                if(ComponentClass) msgBus.reqres.request('component:instance', ComponentClass, ui.item);
            }
        });
    });

    // 判定事件
    msgBus.events.on('component:config:show', function(view) {
        return mcMoreApp.configRegion.show(view);
    });
   
    msgBus.reqres.setHandlers({
        'component:instance': function (componentType, instance, copy) {

            require(['components/' + componentType + '/main'], function (Component) {

               console.log('Instance of ' + componentType + ' Component');
                // 实例化
                var model = typeof copy == 'undefined' ? Component.defaults : copy;
                var componentInstance = new Component.Controller({
                    model: collections.pageElementList.add(model)
                });

                var preview = componentInstance.getPreviewView();
                if(typeof copy == 'undefined')
                    preview.showConfig();

                instance.removeClass('ui-draggable ui-draggable-handle');
                instance.removeAttr('style');
                instance.removeAttr('data-component');
                instance.attr('id','model_'+componentInstance.model.cid)
                instance.html(preview.render().el);
            });
        }
    });

    mcMoreApp.resetPreviewView = function(pageElement){ //todo 可以加入参数，做到可取消使用该模板并返回之前状态
        collections.pageElementList.reset(pageElement);
        mcMoreApp.previewRegion.show(new PageElementView({
            collection: collections.pageElementList
        }));
        mcMoreApp.start();
    }

    McMore.collections = collections;

    return mcMoreApp;
});