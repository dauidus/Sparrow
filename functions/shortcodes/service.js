// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.service', {
        init : function(ed, url) {
            ed.addButton('service', {
                title : 'Service',
                image : url+'/images/service.png',
                onclick : function() {
                     ed.selection.setContent('[service link="" icon="" title=""]Your content goes here' + ed.selection.getContent() + '[/service]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('service', tinymce.plugins.service);
})();