/*
 * jQuery File Upload Plugin JS Example 6.5
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

/*
            // The following option limits the number of files that are
            // allowed to be uploaded using this widget:
            maxNumberOfFiles: undefined,
            // The maximum allowed file size:
            maxFileSize: undefined,
*/

$(function () {
    'use strict';

	window.locale = {
		"fileupload": {
			"errors": {
				"maxFileSize": "File is too big",
				"minFileSize": "File is too small",
				"acceptFileTypes": "Filetype not allowed",
				"maxNumberOfFiles": "Max number of files exceeded",
				"uploadedBytes": "Uploaded bytes exceed file size",
				"emptyResult": "Empty file upload result"
			},
			"error": "Error",
			"start": "Start",
			"cancel": "Cancel",
			"destroy": "Delete",
			"coverImage": "Set as a cover image"
		}
	};

    // Initialize the jQuery File Upload widget:
    $('#frmImg').fileupload({
    maxFileSize: 30720000, // Size in Bytes - 300 kB
    minFileSize: 1, // 
    maxNumberOfFiles: 10,
    // German localization:
    locale: {
        'File is too big': 'Datei ist zu groß',
        'File is too small': 'Datei ist zu klein',
        'Filetype not allowed': 'Dateityp nicht erlaubt',
        'Max number exceeded': 'Maximalanzahl überschritten'
    },
    // Accept only image file types:
    acceptFileTypes: /(png)|(jpe?g)|(gif)$/i
});

        // Load existing files:
        $('#frmImg').each(function () {
            var that = this;
			
            $.getJSON(this.action, function (result) {
				
                if (result && result.length) {
                    $(that).fileupload('option', 'done')
                        .call(that, null, {result: result});
                }
            });
        });
});