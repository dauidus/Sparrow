// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.highlight_link', {
        init : function(ed, url) {
            ed.addButton('highlight_link', {
                title : 'Highlight Link',
                image : url+'/images/link.png',
                onclick : function() {
                     ed.selection.setContent('[highlight_link link="" target=""]Your contents here' + ed.selection.getContent() + '[/highlight_link]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('highlight_link', tinymce.plugins.highlight_link);
})();