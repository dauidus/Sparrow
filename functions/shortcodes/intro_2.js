// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.intro_2', {
        init : function(ed, url) {
            ed.addButton('intro_2', {
                title : 'Intro 2',
                image : url+'/images/intro.png',
                onclick : function() {
                     ed.selection.setContent('[intro_2]Your contents here' + ed.selection.getContent() + '[/intro_2]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('intro_2', tinymce.plugins.intro_2);
})();