var FormDropzone = function () {


    return {
        //main function to initiate the module
        init: function () {

            Dropzone.options.myDropzone = {
                dictDefaultMessage: "",
                serverFileName : "",
                init: function() {
                    this.on("addedfile", function(file) {
                        console.log('asd');
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>Remove</a>");

                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                          // Make sure the button click doesn't submit the form:
                          e.preventDefault();
                          e.stopPropagation();

                          // Remove the file preview.
                          _this.removeFile(file);
                          //Ajax request to remove file on server.

                            $.ajax({
                                url: "removeFile/file/"+_this.serverFileName,
                                cache: false
                            }).done(function( json ) {

                            });
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });
                },

                success: function(file, response){
                    this.serverFileName = response.fileName;
                },

                error: function(file, response){
                    alert('Invalid File');
                }
            }
        }
    };
}();

jQuery(document).ready(function() {
   FormDropzone.init();
});
