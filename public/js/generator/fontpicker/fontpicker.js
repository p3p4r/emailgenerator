function inputedit(i) {
    if (wdvar.editor == true) {
        var fsClass = '.font-picker' + i;
        var fontSizeGenerator = '<div id="fsContainer' + i + '" class="fontEditor"><div class="col-lg-3"><label>'+wdvar.lang_color+'</label><div id="pallete' + i + '" class="pallete"><input id="clrpallete' + i + '" type="hidden"></div></div><input type="hidden" id="valft' + i + '"><div class="col-lg-3 fs"><label>'+wdvar.lang_fontSize+'</label><span id="output' + i + '" class="output"></span><input id="fs' + i + '" class="slider" type="range" min="10" max="50"></div><div class="col-lg-3 weight"><label>'+wdvar.lang_weight+'</label><div class="active" style="font-weight:normal">'+wdvar.lang_normal+'</div><div style="font-weight:bold">'+wdvar.lang_bold+'</div></div><div class="col-lg-3 align"><label>'+wdvar.lang_align+'</label><div class="active" style="text-align: left">'+wdvar.lang_left+'</div><div style="text-align:center">'+wdvar.lang_center+'</div><div style="text-align: right">'+wdvar.lang_right+'</div></div></div>';
        var fsContainer = $('#fsContainer' + i);
        $(fsClass).before('<div id="fa_cont' + i + '" class="fa-container"></div>');
        $("#fa_cont" + i).prepend('<i id="font' + i + '" class="fa fa-font"></i>');
        var faCont = '#fa_cont' + i;
        var fafont = $('#font' + i);
        $(fsClass).appendTo(faCont);
        fafont.hide();
        $(fsClass).focus(function() {
            fafont.show();
        });
        $(document).mouseup(function(e) {
            var dscontainer = $('.font-picker' + i);
            if (!dscontainer.is(e.target) && $('.fontEditor').has(e.target).length === 0 && !fafont.is(e.target) && dscontainer.has(e.target).length === 0) {
                fafont.hide();
                $('.fontEditor').attr('style', 'display:none;');
            }
        });
        fafont.one('click', function() {
            var dvstyle = $(fsClass).attr('style');
            var $content = $(fontSizeGenerator).insertAfter(faCont);
            $(fsClass).css('padding-right', '40px');
            $(this).click(function() {
                $content.toggle();
            });
            var getInpName = $('.font-picker' + i).attr('name');
            $('#valft' + i).attr('name', getInpName.replace(/content/g, 'styles'));
            // Update the current slider 
            var slider = document.getElementById('fs' + i);
            var output = document.getElementById('output' + i);
            output.innerHTML = slider.value + 'px';
            slider.oninput = function() {
                output.innerHTML = this.value + 'px';
                var fsz = $('#fs' + i).val();
                $(fsClass).css('font-size', fsz + 'px');
                dvstyle = $(fsClass).attr('style');
                $('#valft' + i).val(dvstyle);
            }
            // Change Color
            var pallete = $('#pallete' + i);
            pallete.click(function() {
                $('.colorpallete' + i).show();
                pallete.colorpicker({
                    container: true,
                    customClass: 'colorpallete' + i,
                    colorSelectors: {
                        'Grey': '#9fa4a4',
                        'Light Cyan': '#3aa0b9',
                        'Dark Cyan': '#26acaf',
                        'Dark Red': '#a81d2a',
                        'Red': '#ec2227',
                        'Dark Green': '#197941',
                        'Green': '#239e47',
                        'Dark Blue': '#133053',
                        'Blue': '#0f5a9a',
                        'Orange': '#f24c00',
                        'Yellow': '#fcb301',
                        'Brown': '#a88477',
                        'Light Brown': '#d0c7bd',
                        'Rose': '#fa439d',
                        'Dark Rose': '#ad2a8b',
                    }
                });
                $('#pallete' + i + ' .colorpicker-saturation').remove();
                $('#pallete' + i + ' .colorpicker-hue').remove();
                $('#pallete' + i + ' .colorpicker-selectors-color').click(function() {
                    var clr = $('#clrpallete' + i).val();
                    $(fsClass).css('color', clr);
                    dvstyle = $(fsClass).attr('style');
                    $('#valft' + i).val(dvstyle);
                });
            });
            var mouse_is_inside = false;
            $('.colorpallete' + i).hover(function() {
                mouse_is_inside = true;
            }, function() {
                mouse_is_inside = false;
            });
            $("body").mouseup(function() {
                if (!mouse_is_inside) $('.colorpallete' + i).hide();
            });
            /* Weight */
            $('#fsContainer' + i + ' .weight div').click(function() {
                $(this).addClass('active').siblings().removeClass('active')
                var wgh_syl = $(this).attr('style').replace('font-weight:', '');
                $(fsClass).css('font-weight', wgh_syl);
                dvstyle = $(fsClass).attr('style');
                $('#valft' + i).val(dvstyle);
            });
            /* Align */
            $('#fsContainer' + i + ' .align div').click(function() {
                $(this).addClass('active').siblings().removeClass('active')
                var dec_syl = $(this).attr('style').replace('text-align:', '');
                $(fsClass).css('text-align', dec_syl);
                dvstyle = $(fsClass).attr('style');
                $('#valft' + i).val(dvstyle);
            });
        });
    }
}