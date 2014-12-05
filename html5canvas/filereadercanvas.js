

$(function () {

    window.loadedFiles = {};
    window.activeFile = null;
    window.loadedFileList = $("#loadedFileList");
    window.editor = $("#editor");
    var toolbar = $("#toolbar");

    var FileReaderOpts = {
        dragClass: 'active',
        on: {
            load: function (e, file) {
                var filePre = $("#group_" + file.extra.groupID + "_file_" + file.extra.fileID).
                        addClass("done");

                if (file.type.indexOf("image/") != -1) {
                    addImage(file, e.target.result);
                }
            },
            groupstart: function (group) {
                $("#loadData").append("<div>" + groupTemplate(group.groupID, group.files) + "</div>");
            },
            groupend: function (group) {
                var end = document.createElement("div");
                end.innerHTML = "Ended: " + (new Date());
                document.getElementById("group_" + group.groupID).appendChild(end);
            }
        }
    };

    FileReaderJS.setupInput(document.getElementById('fileElem'), FileReaderOpts);
    FileReaderJS.setupDrop(document.body, FileReaderOpts);

    loadedFileList.delegate("li", "click", function () {
        loadedFileList.find(".active").removeClass("active");
        $(this).addClass("active");

        toolbar.show();

        editor.empty().append(getActiveFile().canvas);
    });


    toolbar.delegate("a", "click", function () {
        var cmd = this.id.substring("control-".length);
        var args = JSON.parse($(this).attr("data-args") || "{}");

        processImage(getActiveFile(), cmd, args);
        return false;
    });


});

function getActiveFile() {
    return loadedFiles[parseInt($(loadedFileList.find(".active")).attr("data-fileid"), 10)];
}

function processImage(loadedFile, cmd, args) {
    if (cmd == "restore") {
        Pixastic.revert(loadedFile.canvas);
    }
    else {
        loadedFile.canvas = Pixastic.process(loadedFile.canvas, cmd, args);
    }
}

function redrawImages() {
    for (var i in loadedFiles) {
        if (!loadedFiles[i].loadedOnce) {
            loadedFileList.append($("<li data-fileid='" + i + "' />").append(loadedFiles[i].thumb));
        }
        loadedFiles[i].loadedOnce = true;
    }
}

function addImage(file, src) {

    var canvas = document.createElement("canvas");

    // Load the data URL into a canvas
    loadImage(canvas, src, function () {

        // Now that the canvas has the image drawn on it, add it to our page 
        // collection of all files for further display
        loadedFiles[file.extra.fileID] = {
            file: file,
            canvas: canvas,
            thumb: createThumbnail(canvas, 100)
        };

        redrawImages();
    });

}

function loadImage(canvas, src, onload) {
    // Shortcut to load an src into a canvas

    var context = canvas.getContext("2d"),
            img = new Image();

    img.onload = function () {
        canvas.width = img.width;
        canvas.height = img.height;
        context.drawImage(img, 0, 0);
        onload();
    };

    img.src = src;
}

function createThumbnail(canvas, size) {
    // Create a thumbnail from an existing canvas, keeping original dimensions

    var thumb = document.createElement("canvas");
    var thumbContext = thumb.getContext("2d");
    var width, height;

    if (canvas.width <= size && canvas.height <= size) {
        width = canvas.width;
        height = canvas.height;
    }
    else if (canvas.width > canvas.height) {
        width = size;
        height = size * (canvas.height / canvas.width);
    }
    else {
        height = size;
        width = size * (canvas.width / canvas.height);
    }

    thumb.width = width;
    thumb.height = height;
    thumbContext.drawImage(canvas, 0, 0, width, height);
    return thumb;
}


function groupTemplate(groupID, files) {
    // Some markup to generate for logging file groups that get loaded
    var start = "<div id='group_" + groupID + "'>Group: " + groupID + " (" + files.length + " files)<br />Started: " + (new Date());

    var html = [];
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        html.push("<pre id='group_" + groupID + "_file_" + file.extra.fileID + "'>");
        html.push(JSON.stringify(file, null, '\t'));
        html.push("</pre>");
    }

    return  start + html.join('') + "</div>";
}

