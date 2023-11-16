ClassicEditor
    .create(document.querySelector('#editor'), {
    contentsCss: [
        'src/textbox.css'
    ]
    })
    .catch(error => {
        console.log(error);
    });