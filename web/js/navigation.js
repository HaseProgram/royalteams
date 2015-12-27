jQuery.extend({dobPicker:function(e){if(typeof e.dayDefault==="undefined")e.dayDefault="Day";if(typeof e.monthDefault==="undefined")e.monthDefault="Month";if(typeof e.yearDefault==="undefined")e.yearDefault="Year";if(typeof e.minimumAge==="undefined")e.minimumAge=12;if(typeof e.maximumAge==="undefined")e.maximumAge=80;$(e.daySelector).append('<option value="">'+e.dayDefault+"</option>");$(e.monthSelector).append('<option value="">'+e.monthDefault+"</option>");$(e.yearSelector).append('<option value="">'+e.yearDefault+"</option>");for(i=1;i<=31;i++){if(i<=9){var t="0"+i}else{var t=i}$(e.daySelector).append('<option value="'+t+'">'+i+"</option>")}var n=["January","February","March","April","May","June","July","August","September","October","November","December"];for(i=1;i<=12;i++){if(i<=9){var t="0"+i}else{var t=i}$(e.monthSelector).append('<option value="'+t+'">'+n[i-1]+"</option>")}var r=new Date;var s=r.getFullYear();var o=s-e.minimumAge;var u=o-e.maximumAge;for(i=o;i>=u;i--){$(e.yearSelector).append('<option value="'+i+'">'+i+"</option>")}$(e.daySelector).change(function(){$(e.monthSelector)[0].selectedIndex=0;$(e.yearSelector)[0].selectedIndex=0;$(e.yearSelector+" option").removeAttr("disabled");if($(e.daySelector).val()>=1&&$(e.daySelector).val()<=29){$(e.monthSelector+" option").removeAttr("disabled")}else if($(e.daySelector).val()==30){$(e.monthSelector+" option").removeAttr("disabled");$(e.monthSelector+' option[value="02"]').attr("disabled","disabled")}else if($(e.daySelector).val()==31){$(e.monthSelector+" option").removeAttr("disabled");$(e.monthSelector+' option[value="02"]').attr("disabled","disabled");$(e.monthSelector+' option[value="04"]').attr("disabled","disabled");$(e.monthSelector+' option[value="06"]').attr("disabled","disabled");$(e.monthSelector+' option[value="09"]').attr("disabled","disabled");$(e.monthSelector+' option[value="11"]').attr("disabled","disabled")}});$(e.monthSelector).change(function(){$(e.yearSelector)[0].selectedIndex=0;$(e.yearSelector+" option").removeAttr("disabled");if($(e.daySelector).val()==29&&$(e.monthSelector).val()=="02"){$(e.yearSelector+" option").each(function(e){if(e!==0){var t=$(this).attr("value");var n=!(t%4||!(t%100)&&t%400);if(n===false){$(this).attr("disabled","disabled")}}})}})}})

$(document).ready(function(){
    $('#country-selector').selectToAutocomplete();
    $.dobPicker({
        daySelector: '#dobday',
        monthSelector: '#dobmonth',
        yearSelector: '#dobyear',
        dayDefault: 'Day',
        monthDefault: 'Month',
        yearDefault: 'Year',
        minimumAge: 16,
        maximumAge: 100
    });
});

$(document).on('click', ".njax", function(){
    $('#top-main-menu').find(".active").removeClass("active");
    $(this).addClass("active");
    $('#hidden-navigation').attr('href',$(this).find("a").attr('href'));
    $('#hidden-navigation').click();
    return false;
});

$(document).on('pjax:send',function(){
    $('.logo-image').addClass('spinner');
    $('.logo').css('height','100px');
    $('.loading-text').css('opacity','1')
});

$(document).on('pjax:success',function(){
    $('.loading-text').css('opacity','0');
    $('.logo-image').removeClass('spinner');
    $('.logo').css('height','75px');
});

$(document).on('pjax:error',function(event,xhr,textStatus,errorThrown,options){
    //location.reload();
})

$(document).on('click', ".btn-change-lr", function(){
    var displayOne =  $('#login_form_block').css('display');
    var displayTwo =  $('#registration_form_block').css('display');

    if($('.modal-dialog').hasClass("modal-lg")){
        $('.modal-dialog').removeClass('modal-lg');
        $('.modal-dialog').addClass('modal-md');
    }
    else {
        $('.modal-dialog').removeClass('modal-md');
        $('.modal-dialog').addClass('modal-lg');
    }
    $('#login_form_block').css('display', displayTwo);
    $('#registration_form_block').css('display', displayOne);
});

function checkCountry(){
    var country = $("#country-selector :selected").val();
    if(country == "") {
        $(".field-registrationform-country").addClass("has-error");
        $(".field-registrationform-country").removeClass("has-success");
        return false;
    } else {
        $(".field-registrationform-country").addClass("has-success");
        $(".field-registrationform-country").removeClass("has-error");
        return true;
    }
}

function checkBDay(){
    var day = $("#dobday :selected").val();
    var month = $("#dobmonth :selected").val();
    var year = $("#dobyear :selected").val();
    if((day == 0) || (month == 0) || (year == 0)) {
        $(".field-registrationform-birth_day").addClass("has-error");
        $(".field-registrationform-birth_day").removeClass("has-success");
        return false;
    } else {
        $(".field-registrationform-birth_day").addClass("has-success");
        $(".field-registrationform-birth_day").removeClass("has-error");
        return true;
    }
}

$('#dobday').on('blur', function(){
    checkBDay();
});
$('#dobmonth').on('blur', function(){
    checkBDay();
});
$('#dobyear').on('blur', function(){
    checkBDay();
});


$('#registration-form').on('submit', function(){
    var c1 = checkBDay();
    var c2 = checkCountry();
    if((!c1) || (!c2)) {
        $("#registration_all_valid").val('0');
        return false;
    } else {
        $("#registration_all_valid").val('1');
    }
});

