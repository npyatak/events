// var image = $('#image');

// image.cropper({
//     minCropBoxWidth: 540,
//     minCropBoxHeight: 290,
//     aspectRatio: 540 / 290,
//     crop: function(event) {
//         console.log(event.detail.x);
//         console.log(event.detail.y);
//         console.log(event.detail.width);
//         console.log(event.detail.height);
//         console.log(event.detail.rotate);
//         console.log(event.detail.scaleX);
//         console.log(event.detail.scaleY);
//     }
// });

// Get the Cropper.js instance after initialized
//var cropper = image.data('cropper');

console.log('ok');
var rows = $('.image-row');
for (var i = 0; i < rows.length; i++) {
    console.log(i);
    console.log(rows[i]);
}