/**
 * Created by gibson on 14-10-28.
 */
define(['components/base', 'components/products/assets'], function(ComponentBase, assets) {
    'use strict';
    console.log('Load Product Component');
    var ProductsApp = {};
    var templates = assets.templates;

    ProductsApp.defaults = McMore.componentDefault.products;
    
    ProductsApp.tpls = {
        tpl_1:templates.tpl_1,
        tpl_2:templates.tpl_2
    };
    
    ProductsApp.PreviewView = ComponentBase.PreviewView.extend({
        template: function(serializeModel) {
            var $component = $(_.template(templates.preview,serializeModel));
            var datas = []
            _(serializeModel.data).each(function(data, i) {
                if (i >= serializeModel.dataLimit)
                    return;
                datas.push(_.template(ProductsApp.tpls[serializeModel.templateId],data))
            })
            $component.find('.component-data').html(datas.join(''))
            return $component;
        }
    });

    ProductsApp.ConfigView = ComponentBase.ConfigView.extend({
        template: function(serializeModel) {
            var $config = $(_.template(templates.config,serializeModel));
            return $config
        },

        ui: {
            add_item: '.add-product',
            delete_item: '.delete-item',
            update_data: '.update-data'
        },

        events: {
            'click @ui.add_item': 'addProducts',
            'click @ui.delete_item': 'deleteItem',
            'click @ui.update_data': 'updateProductsData'
        },


        _onRender:function(){
            var self = this
            //int sortable
            window.productsList = this.$el.find('ul.sortable-list').sortable({
                axis: 'y',
                placeholder: "ui-state-highlight",
                update: function() {
                    self.updateProductsData()
                }
            })
        },
        
        updateProductsData: function(){
            //var sort = $('#products-list ol').sortable("serialize")
            var prods = [];
            this.$el.find('ul.sortable-list li').each(function() {
                var prod = {
                    id: $(this).data('id'),
                    name: $(this).find('.prod-name').text(),
                    sale_price: $(this).find('.prod-name').data('saleprice'), 
                    par_price: $(this).find('.prod-name').data('parprice'), 
                    sale_count: $(this).find('.prod-name').data('sale'),
                    thumb: {url: $(this).find('.prod-img').attr('src')}
                }
                prods.push(prod)
            })
            this.model.set('data', prods)
        },

        deleteItem:function(click){
            var $target = $(click.currentTarget)
            var self = this
            $target.closest('li').slideUp(300,function(){
                $(this).remove()
                self.updateProductsData()
            })
        },

        addProducts:function(click){
            var $target = $(click.currentTarget);
            var pIds = [];
            $('#products-list li').each(function(){
                pIds.push($(this).data('id'));
            });
            var pidstring = pIds.join(',');
            if(pidstring === ''){
                pidstring = 'null'
            }
            $.fancybox.open({
                href: '/products-select?pIds='+pidstring,
                type: 'iframe',
                fitToView: true,
                width: '90%',
                height: '80%',
                autoSize: true,
                closeClick: false
            })
        }
        
    });

    ProductsApp.Controller = ComponentBase.Controller.extend({
        configView: ProductsApp.ConfigView,
        previewView: ProductsApp.PreviewView
    });

    return ProductsApp;
});
