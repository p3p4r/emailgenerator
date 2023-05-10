/*!
 * bootstrap-fileinput v4.4.8
 * http://plugins.krajee.com/file-input
 *
 * Krajee Explorer theme configuration for bootstrap-fileinput. Load this theme file after loading `fileinput.js`.
 *
 * Author: Kartik Visweswaran
 * Copyright: 2014 - 2018, Kartik Visweswaran, Krajee.com
 *
 * Licensed under the BSD 3-Clause
 * https://github.com/kartik-v/bootstrap-fileinput/blob/master/LICENSE.md
 */
(function ($) {
    "use strict";
    var teTagBef = '<tr class="file-preview-frame {frameClass}" id="{previewId}" data-fileindex="{fileindex}"' +
        ' data-template="{template}"', teContent = '<td class="kv-file-content">\n';
    $.fn.fileinputThemes.explorer = {
      
        previewMarkupTags: {
            tagBefore1: teTagBef + '>' + teContent,
            tagBefore2: teTagBef + ' title="{caption}">' + teContent,
            tagAfter: '</td>\n{footer}</tr>\n'
        },
        previewSettings: {
            image: {height: "280px"}
        }
    };
})(window.jQuery);
