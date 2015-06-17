/**
 * Created by gibson on 14-10-23.
 */
define(['backbone.marionette'], function(Marionette) {
    'use strict';

    console.log('Load PageElementView');

    return Marionette.CompositeView.extend({
        className: 'region-warp',

        initialize: function() {
            console.log('PageElementView Collection', this.collection)
        },

        render: function() {
            console.log(this.collection);
            //this.collection.each(this.addElement,this)
            //console.log(this.collection.models.length)
            var length = this.collection.models.length;
            if(this.collection.models.length > 0) {
                this.addElement(this,this.collection.models[0], 0, length)
            }
        },

        addElement: function(self,model,i,length) {
            var componentType = model.get('componentType');
            console.log(componentType,model,this);
            require(['components/' + componentType + '/main'], function (componentClass) {

                console.log('Instance of ' + componentType + ' Component');
                // 实例化
                var component = new componentClass.Controller({
                    model: model
                });

                console.log('component.cid', component.cid, 'model.cid', model.cid)
                var previewView = component.getPreviewView();
                var $wrap = $('<div id="model_'+model.cid+'" class="component '+componentType+'"></div>');
                var $el = $(previewView.render().el)

                $wrap.append($el);

                $('#preview-region .region-warp').append($wrap);

                if(++i < length){
                    self.addElement(self,self.collection.models[i], i, length)
                }
            });
        }
    });
});