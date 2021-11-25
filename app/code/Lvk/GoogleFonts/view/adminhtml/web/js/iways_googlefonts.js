var font_families = [];

function updatePreview(e)
{
    var mainField = e.parent().siblings('select.admin__control-select'),
        customFieldsContainer = mainField.siblings('.lvk-font-face-fields'),
        customFields = customFieldsContainer.children('input, select'),
        font_weight = customFields.eq(0).val(),
        font_style = (font_weight.substr(font_weight.length - 1) == 'i') ? 'italic' : 'normal',
        font_value = customFields.eq(1).val() * 1,
        font_size = font_value
                  ? font_value + customFields.eq(2).val()
                  : 'initial',
        name = mainField.attr('name'),
        hiddenField = jQuery(('[name="'
                    + ((name.substring(name.length - 1) == "]")
                      ? name.replace(/]$/, '_variant]')
                      : name + '_variant')
                    + '"]')),
        customResult = font_weight + ";" + font_value + ";" + customFields.eq(2).val()
                     + ";" + parseInt(font_weight) + ";" + font_style + ";" + font_size;

    e.css({
        'font-family': "'" + mainField.val().replace('+', ' ') + "'",
        'font-size': font_size,
        'font-style': font_style,
        'font-weight': parseInt(font_weight)
    });
    
    hiddenField.val(customResult).trigger('change');
}

function initFontFaceFields(e, data, font_family)
{
    var variants = [],
        container = e.parent(),
        control = container.siblings('select'),
        name = control.attr('name'),
        value = jQuery(('[name="'
              + ((name.substring(name.length - 1) == "]")
                ? name.replace(/]$/, '_variant]')
                : name + '_variant')
              + '"]')).val(),
        values = value.split(';');

    for (var property in data) {
        
        if (data.hasOwnProperty(property)) {
        
            variants.push(property);
            
            e.append('<option value="' + property + '">' + data[property] + '</option>');
        }
    }
    
    container.children('input, select').each(function (index)
    {
        if (values[index]) {
            
            jQuery(this).val(values[index]);
        }
    });
    
    if (!container.children('select.lvk-empty').val()) {
    	
    	container.children('select.lvk-empty').val(400); // "default" value, ATM always available
    }
    
    jQuery.get('https://fonts.googleapis.com/css?family=' + font_family + ':' + variants.join(','), function(data)
    {
        e.siblings('.lvk-preview').children('style').text(data);
        
        updatePreview(e.siblings('.lvk-preview'));
    });
    
    e.removeClass('loading');
}

function populateFontFaceFields(e, font_family)
{
    if (data = font_families[font_family]) {
        
        return initFontFaceFields(e, data, font_family);
    }
    
    jQuery.ajax({
        url: '/lvk_googlefonts/font/get/font_family/' + font_family + '/',
        async: false,
        dataType: 'json'
    }).done(function(data)
    {
        font_families[font_family] = data;
        
        initFontFaceFields(e, data, font_family);
    });
}

function resetFontFaceFields(e, font_family)
{
    if (!(e instanceof jQuery)) {
        
        e = jQuery(e);
    }
    
    e.addClass('loading').empty();
    
    e.siblings('.lvk-preview').children('style').empty();
    
    populateFontFaceFields(e, font_family);
}

function checkFontFaceFields(val, input, e)
{
    var element = jQuery(e).children('select.lvk-empty'),
        mainField = jQuery('.lvk-font-face select.admin__control-select'),
        customFieldsContainer = mainField.siblings('.lvk-font-face-fields'),
        customFields = customFieldsContainer.children('input, select');
  
    resetFontFaceFields(element, mainField.val());
    
    mainField.on('change', function ()
    {
        var customFieldsContainer = jQuery(this).siblings('.lvk-font-face-fields'),
            element = customFieldsContainer.children('select.lvk-empty');
            
        resetFontFaceFields(element, jQuery(this).val());
    });
    
    customFields.on('change keyup', function ()
    {
        updatePreview(jQuery(this).siblings('.lvk-preview'));
    });
}

