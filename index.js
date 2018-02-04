//const ClassicEditor = require( '@ckeditor/ckeditor5-build-classic' );
//const InlineEditor = require( '@ckeditor/ckeditor5-build-inline' );
window.Editor = [];

const BaloonEditor = require('@ckeditor/ckeditor5-build-balloon');

const Editorconfig = require('./src/assets/js/CKEditorConfig.js');

BaloonEditor
    .create(document.querySelector('#main_text'), Editorconfig.mainText).then((a)=>{
    window.Editor.push(a);
});

BaloonEditor
    .create(document.querySelector('#title'), Editorconfig.blogTitle).then((a)=>{
    window.Editor.push(a);
});

BaloonEditor
    .create(document.querySelector('#cover'), Editorconfig.Cover).then((a)=>{
    window.Editor.push(a);
});