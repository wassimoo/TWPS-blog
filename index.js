//const ClassicEditor = require( '@ckeditor/ckeditor5-build-classic' );
//const InlineEditor = require( '@ckeditor/ckeditor5-build-inline' );
const BaloonEditor = require('@ckeditor/ckeditor5-build-balloon');

const Editorconfig = require('./src/assets/js/CKEditorConfig.js')


BaloonEditor
    .create(document.querySelector('#info'), Editorconfig.info)

BaloonEditor
    .create(document.querySelector('#main_text'), Editorconfig.mainText)

BaloonEditor
    .create(document.querySelector('#title'), Editorconfig.blogTitle)

BaloonEditor
    .create(document.querySelector('#cover'), Editorconfig.Cover)
