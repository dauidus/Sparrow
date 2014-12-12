// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.link_button', {
        init : function(ed, url) {
            ed.addButton('link_button', {
                title : 'Link Button',
                image : url+'/images/button.png',
                onclick : function() {
                     ed.selection.setContent('[link_button link="" target=""]Your contents here' + ed.selection.getContent() + '[/link_button]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('link_button', tinymce.plugins.link_button);
})();