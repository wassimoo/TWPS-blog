let mainText = {
    heading: {
        options: [
            {modelElement: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
            {modelElement: 'heading1', viewElement: 'h1', title: 'Taille 1', class: 'ck-heading_heading1'},
            {modelElement: 'heading2', viewElement: 'h2', title: 'Taille 2', class: 'ck-heading_heading2'}
        ]
    },
    image: {
        // You need to configure the image toolbar too, so it uses the new style buttons.
        toolbar: ['imageTextAlternative', '|', 'imageStyleAlignLeft', 'imageStyleFull', 'imageStyleAlignRight'],

        styles: [
            // This option is equal to a situation where no style is applied.
            'imageStyleFull',

            // This represents an image aligned to left.
            'imageStyleAlignLeft',

            // This represents an image aligned to right.
            'imageStyleAlignRight'
        ]
    }
}

let coverImage = {
    image: {
        // You need to configure the image toolbar too, so it uses the new style buttons.
        toolbar: [],

        styles: [
            // This option is equal to a situation where no style is applied.
            'imageStyleFull',
        ]
    }
}

let blogTitle = {
    removePlugins: ['Bold', 'Italic', 'List', 'Block Quote'],
    heading: {
        options: [
            {modelElement: 'heading2', viewElement: 'h2', title: 'Taille 2', class: 'ck-heading_heading2'}
        ]
    }
}

let info = {toolbar: []}


/*Exporting Configurations*/
exports.info = info;
exports.blogTitle = blogTitle;
exports.Cover = coverImage;
exports.mainText = mainText;
