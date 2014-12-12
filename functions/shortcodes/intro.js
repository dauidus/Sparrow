// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.intro', {
        init : function(ed, url) {
            ed.addButton('intro', {
                title : 'Intro',
                image : url+'/images/intro.png',
                onclick : function() {
                     ed.selection.setContent('[intro]Your contents here' + ed.selection.getContent() + '[/intro]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('intro', tinymce.plugins.intro);
})();