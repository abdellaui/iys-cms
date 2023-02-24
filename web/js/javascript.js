+function(a){"use strict";function b(b){return b.is('[type="checkbox"]')?b.prop("checked"):b.is('[type="radio"]')?!!a('[name="'+b.attr("name")+'"]:checked').length:b.val()}function c(b){return this.each(function(){var c=a(this),e=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b),f=c.data("bs.validator");(f||"destroy"!=b)&&(f||c.data("bs.validator",f=new d(this,e)),"string"==typeof b&&f[b]())})}var d=function(c,e){this.options=e,this.validators=a.extend({},d.VALIDATORS,e.custom),this.$element=a(c),this.$btn=a('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]')),this.update(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",a.proxy(this.onInput,this)),this.$element.on("submit.bs.validator",a.proxy(this.onSubmit,this)),this.$element.on("reset.bs.validator",a.proxy(this.reset,this)),this.$element.find("[data-match]").each(function(){var c=a(this),d=c.data("match");a(d).on("input.bs.validator",function(){b(c)&&c.trigger("input.bs.validator")})}),this.$inputs.filter(function(){return b(a(this))}).trigger("focusout"),this.$element.attr("novalidate",!0),this.toggleSubmit()};d.VERSION="0.11.5",d.INPUT_SELECTOR=':input:not([type="hidden"], [type="submit"], [type="reset"], button)',d.FOCUS_OFFSET=100,d.DEFAULTS={delay:500,html:!1,disable:!0,focus:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},d.VALIDATORS={"native":function(a){var b=a[0];return b.checkValidity?!b.checkValidity()&&!b.validity.valid&&(b.validationMessage||"error!"):void 0},match:function(b){var c=b.data("match");return b.val()!==a(c).val()&&d.DEFAULTS.errors.match},minlength:function(a){var b=a.data("minlength");return a.val().length<b&&d.DEFAULTS.errors.minlength}},d.prototype.update=function(){return this.$inputs=this.$element.find(d.INPUT_SELECTOR).add(this.$element.find('[data-validate="true"]')).not(this.$element.find('[data-validate="false"]')),this},d.prototype.onInput=function(b){var c=this,d=a(b.target),e="focusout"!==b.type;this.$inputs.is(d)&&this.validateInput(d,e).done(function(){c.toggleSubmit()})},d.prototype.validateInput=function(c,d){var e=(b(c),c.data("bs.validator.errors"));c.is('[type="radio"]')&&(c=this.$element.find('input[name="'+c.attr("name")+'"]'));var f=a.Event("validate.bs.validator",{relatedTarget:c[0]});if(this.$element.trigger(f),!f.isDefaultPrevented()){var g=this;return this.runValidators(c).done(function(b){c.data("bs.validator.errors",b),b.length?d?g.defer(c,g.showErrors):g.showErrors(c):g.clearErrors(c),e&&b.toString()===e.toString()||(f=b.length?a.Event("invalid.bs.validator",{relatedTarget:c[0],detail:b}):a.Event("valid.bs.validator",{relatedTarget:c[0],detail:e}),g.$element.trigger(f)),g.toggleSubmit(),g.$element.trigger(a.Event("validated.bs.validator",{relatedTarget:c[0]}))})}},d.prototype.runValidators=function(c){function d(a){return c.data(a+"-error")}function e(){var a=c[0].validity;return a.typeMismatch?c.data("type-error"):a.patternMismatch?c.data("pattern-error"):a.stepMismatch?c.data("step-error"):a.rangeOverflow?c.data("max-error"):a.rangeUnderflow?c.data("min-error"):a.valueMissing?c.data("required-error"):null}function f(){return c.data("error")}function g(a){return d(a)||e()||f()}var h=[],i=a.Deferred();return c.data("bs.validator.deferred")&&c.data("bs.validator.deferred").reject(),c.data("bs.validator.deferred",i),a.each(this.validators,a.proxy(function(a,d){var e=null;(b(c)||c.attr("required"))&&(c.data(a)||"native"==a)&&(e=d.call(this,c))&&(e=g(a)||e,!~h.indexOf(e)&&h.push(e))},this)),!h.length&&b(c)&&c.data("remote")?this.defer(c,function(){var d={};d[c.attr("name")]=b(c),a.get(c.data("remote"),d).fail(function(a,b,c){h.push(g("remote")||c)}).always(function(){i.resolve(h)})}):i.resolve(h),i.promise()},d.prototype.validate=function(){var b=this;return a.when(this.$inputs.map(function(){return b.validateInput(a(this),!1)})).then(function(){b.toggleSubmit(),b.focusError()}),this},d.prototype.focusError=function(){if(this.options.focus){var b=a(".has-error:first :input");0!==b.length&&(a("html, body").animate({scrollTop:b.offset().top-d.FOCUS_OFFSET},250),b.focus())}},d.prototype.showErrors=function(b){var c=this.options.html?"html":"text",d=b.data("bs.validator.errors"),e=b.closest(".form-group"),f=e.find(".help-block.with-errors"),g=e.find(".form-control-feedback");d.length&&(d=a("<ul/>").addClass("list-unstyled").append(a.map(d,function(b){return a("<li/>")[c](b)})),void 0===f.data("bs.validator.originalContent")&&f.data("bs.validator.originalContent",f.html()),f.empty().append(d),e.addClass("has-error has-danger"),e.hasClass("has-feedback")&&g.removeClass(this.options.feedback.success)&&g.addClass(this.options.feedback.error)&&e.removeClass("has-success"))},d.prototype.clearErrors=function(a){var c=a.closest(".form-group"),d=c.find(".help-block.with-errors"),e=c.find(".form-control-feedback");d.html(d.data("bs.validator.originalContent")),c.removeClass("has-error has-danger has-success"),c.hasClass("has-feedback")&&e.removeClass(this.options.feedback.error)&&e.removeClass(this.options.feedback.success)&&b(a)&&e.addClass(this.options.feedback.success)&&c.addClass("has-success")},d.prototype.hasErrors=function(){function b(){return!!(a(this).data("bs.validator.errors")||[]).length}return!!this.$inputs.filter(b).length},d.prototype.isIncomplete=function(){function c(){var c=b(a(this));return!("string"==typeof c?a.trim(c):c)}return!!this.$inputs.filter("[required]").filter(c).length},d.prototype.onSubmit=function(a){this.validate(),(this.isIncomplete()||this.hasErrors())&&a.preventDefault()},d.prototype.toggleSubmit=function(){this.options.disable&&this.$btn.toggleClass("disabled",this.isIncomplete()||this.hasErrors())},d.prototype.defer=function(b,c){return c=a.proxy(c,this,b),this.options.delay?(window.clearTimeout(b.data("bs.validator.timeout")),void b.data("bs.validator.timeout",window.setTimeout(c,this.options.delay))):c()},d.prototype.reset=function(){return this.$element.find(".form-control-feedback").removeClass(this.options.feedback.error).removeClass(this.options.feedback.success),this.$inputs.removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var b=a(this),c=b.data("bs.validator.timeout");window.clearTimeout(c)&&b.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var b=a(this),c=b.data("bs.validator.originalContent");b.removeData("bs.validator.originalContent").html(c)}),this.$btn.removeClass("disabled"),this.$element.find(".has-error, .has-danger, .has-success").removeClass("has-error has-danger has-success"),this},d.prototype.destroy=function(){return this.reset(),this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$inputs.off(".bs.validator"),this.options=null,this.validators=null,this.$element=null,this.$btn=null,this};var e=a.fn.validator;a.fn.validator=c,a.fn.validator.Constructor=d,a.fn.validator.noConflict=function(){return a.fn.validator=e,this},a(window).on("load",function(){a('form[data-toggle="validator"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery);

(function () {
  'use strict';

  if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
      document.createTextNode(
        '@-ms-viewport{width:auto!important}'
      )
    )
    document.querySelector('head').appendChild(msViewportStyle)
  }

})();
function getViewportHeight() {
        var height = window.innerHeight;
        var mode = document.compatMode;

        if ( (mode || !$.support.boxModel) ) {
            height = (mode == 'CSS1Compat') ?
            document.documentElement.clientHeight :
            document.body.clientHeight;
        }

        return height;
}

function previewDel(i){
	$('#'+i).fadeOut('fast',function(){
		$(this).remove();
	});
	if($('#preview_Ankauf_Bilder .row .col-sm-6').length<=1){
		$('#preview_Ankauf_Bilder>.row').append('<div class="col-md-12" id="keineBilderiysCms"><div class="paddingBottomBild">Sie können bis zur 6 Bilder Ihres Autos hinzufügen!</div></div>');
	}
}
function modalAlles(e,i){
$(".modal-title").html(e);
$(".modal-body").html(i);
$("#modalAlles").modal('show');
}

$(document).ready(function () {

    $(window).scroll(function () {
        var vpH = getViewportHeight(),
            scrolltop = (document.documentElement.scrollTop ?
                document.documentElement.scrollTop :
                document.body.scrollTop),
            elems = [];

        $.each($.cache, function () {
            if (this.events && this.events.inview) {
                elems.push(this.handle.elem);
            }
			
        });

        if (elems.length) {
            $(elems).each(function () {

                var $el = $(this),
                    top = $el.offset().top,
                    height = $el.height(),
                    inview = $el.data('inview') || false;

                if (scrolltop > (top + height) || scrolltop + vpH < top) {
                    if (inview) {
                        $el.data('inview', false);
                        $el.trigger('inview', [ false ]);                        
                    }
                } else if (scrolltop < (top + height)) {
                    if (!inview) {
                        $el.data('inview', true);
                        $el.trigger('inview', [ true ]);
                    }
                }
			 });
        }
		

    });
$('select[name=marke]').on('change', function() {
$.get( "/interaktion/1&id="+$(this).val(), function( data ) {
	$('select[name=modell]').html('<option selected="selected" value="">Bitte wählen</option>');
$.each(data.ad.model.options, function(i, item) {
	$('select[name=modell]').append("<option>"+item[0]+"</option>");
});
}).fail(function(e) {
   modalAlles('Fehler!','<span class="alert alert-danger">Es ist leider ein Fehler entstanden! Wählen Sie bitte erneuert die Marke Ihres Fahrzeugs!</span>');
  });
});
$('#ankaufFormular').validator().on('submit', function (e) {
  if (!e.isDefaultPrevented()) {
	   modalAlles('Sendevorgang','<img src="/img/content/loadinganimation.gif" class="img-responsive center-block">');
	  $.ajax({
   type: "POST",
   url: "/interaktion/2",
   data: $("#ankaufFormular").serialize(),
   success: function(msg) {
	   $(".modal-body").html(msg);
   },
   error: function(XMLHttpRequest, textStatus, errorThrown) {
        modalAlles('Fehler!','<span class="alert alert-danger">Es ist leider ein Fehler entstanden! '+errorThrown+'</span>');
  }
 });
  }
  return false;
});

$('#kontaktFormular').validator().on('submit', function (e) {
  if (!e.isDefaultPrevented()) {
	   modalAlles('Sendevorgang','<img src="/img/content/loadinganimation.gif" class="img-responsive center-block">');
	  $.ajax({
   type: "POST",
   url: "/interaktion/3",
   data: $("#kontaktFormular").serialize(),
   success: function(msg) {
	   $(".modal-body").html(msg);
   },
   error: function(XMLHttpRequest, textStatus, errorThrown) {
        modalAlles('Fehler!','<span class="alert alert-danger">Es ist leider ein Fehler entstanden! '+errorThrown+'</span>');
  }
 });
  }
  return false;
});
 
$("input[id=ankauf_bilder]").on('change',function(){
  		r = '';
		for(var i=0;i < $(this).get(0).files.length;++i){
		if($(this).get(0).files[i].type.match('image.*')){
			if($('#preview_Ankauf_Bilder .row .col-sm-6').length==0){
					$('#keineBilderiysCms').remove();
			}
		if(parseInt($('#preview_Ankauf_Bilder .row .col-sm-6').length+i)<=5){
		(function(file) {
			var name1 = file.name;
			if(name1.length<=15){
				var name = name1;
			}else{
				var name = name1.substr(0,25)+'[...]';
			}
			if(file.size < 4194304){
			var reader = new FileReader();  
			reader.onload = function(e) {
				uniqueid= 'preview_iysCms_automobile_'+Math.floor((Math.random() * 100000) + 1)+'_'+file.lastModified;
					$('#preview_Ankauf_Bilder>.row').append('<div class="col-sm-6 col-md-4" id="'+uniqueid+'"><div class="thumbnail"><div class="previewAnkaufHolder"><span class="btn btn-danger previewiysCmsDel" onclick="previewDel(\''+uniqueid+'\')"><i class="bx bx-trash"></i></span><img src="'+e.target.result+'" alt="'+name+'" class="img-responsive previewAnkauf"></div><div class="caption"><p>'+name+'</p><p></p></div><input type="hidden" name="bild['+uniqueid+'][base64]" class="hidden" value="'+e.target.result+'"><input name="bild['+uniqueid+'][name]" class="hidden" type="hidden" value="'+name1+'"><input name="bild['+uniqueid+'][type]" class="hidden" type="hidden" value="'+file.type+'"><input name="bild['+uniqueid+'][size]" class="hidden" type="hidden" value="'+file.size+'"></div>');
			}
			reader.readAsDataURL(file);
		}else{
			r = r+'<li>Bild <b>'+name+'</b> ist <b>größer als 4MB!</b></li>';
			
		}
		})($(this).get(0).files[i]);
		
		}else{
			r = r+'<li><b>Maximale Bildanzahl (6) erreicht!</b> Bild:'+$(this).get(0).files[i].name+' konnte daher nicht hochgeladen werden!</li>';
		}
		}
	
    }
	if(r!=''){
	 modalAlles('Fehler!','<div class="alert alert-danger">Es ist/sind leider folgende/s Fehler entstanden! <ul>'+r+'</ul></div>');
	}
});
  document.onscroll = scroll;
});

$(window).on("load", (function() {
   if (window.applicationCache && window.applicationCache.status && window.applicationCache.status == window.applicationCache.UPDATEREADY) {
	   console.log('CACHE MANIFEST UPDATED');
      window.applicationCache.swapCache();
      window.location.reload();
    }
});

function modalAlles(e, i) {
  $(".modal-title").html(e), $(".modal-body").html(i), $("#modalAlles").modal("show")
}

function previewDel(e) {
  $("#" + e).fadeOut("fast", function() {
      $(this).remove()
  }), $("#preview_Angebot_Bilder .row .col-sm-6").length <= 1 && $("#preview_Angebot_Bilder>.row").append('<div class="col-md-12" id="keineBilderResidence"><div class="paddingBottomBild">Sie kÃ¶nnen bis zur 6 Dateien anhÃ¤ngen!</div></div>')
}
$(document).ready(function() {
   $("#kontaktFormular").validator().on("submit", function(e) {
      return e.isDefaultPrevented() || (modalAlles("Sendevorgang", '<img src="/img/background/loadinganimation.gif" class="img-responsive center-block">'), $.ajax({
          type: "POST",
          url: "/interaktion/2",
          data: $("#kontaktFormular").serialize(),
          success: function(e) {
              $(".modal-body").html(e)
          },
          error: function(e, i, n) {
              modalAlles("Fehler!", '<div class="alert alert-danger">Es ist leider ein Fehler entstanden! ' + n + "</div>")
          }
      })), !1
  }), $("#angebotFormular").validator().on("submit", function(e) {
      return e.isDefaultPrevented() || (modalAlles("Sendevorgang", '<img src="/img/background/loadinganimation.gif" class="img-responsive center-block">'), $.ajax({
          type: "POST",
          url: "/interaktion/1",
          data: $("#angebotFormular").serialize(),
          success: function(e) {
              $(".modal-body").html(e)
          },
          error: function(e, i, n) {
              modalAlles("Fehler!", '<span class="alert alert-danger">Es ist leider ein Fehler entstanden! ' + n + "</span>")
          }
      })), !1
  });
  $("#bewerbungsFormular").validator().on("submit", function(e) {
      return e.isDefaultPrevented() || (modalAlles("Sendevorgang", '<img src="/img/background/loadinganimation.gif" class="img-responsive center-block">'), $.ajax({
          type: "POST",
          url: "/interaktion/3",
          data: $("#bewerbungsFormular").serialize(),
          success: function(e) {
              $(".modal-body").html(e)
          },
          error: function(e, i, n) {
              modalAlles("Fehler!", '<span class="alert alert-danger">Es ist leider ein Fehler entstanden! ' + n + "</span>")
          }
      })), !1
  });
  $("input[id=angebot_bilder]").on("change", function() {
      for (var e = "", i = 0; i < $(this).get(0).files.length; ++i) 0 == $("#preview_Angebot_Bilder .row .col-sm-6").length && $("#keineBilderResidence").remove(), parseInt($("#preview_Angebot_Bilder .row .col-sm-6").length + i) <= 5 ? ! function(i) {
          var n = i.type.match("image.*"),
              a = i.name;
          if (a.length <= 15) var l = a;
          else var l = a.substr(0, 25) + "[...]";
          if (i.size < 5242880) {
              var t = new FileReader;
              t.onload = function(e) {
                  var t = "preview_residence_service_" + Math.floor(1e5 * Math.random() + 1) + "_" + i.lastModified,
                      s = '<div class="col-sm-6 col-md-4" id="' + t + '"><div class="thumbnail"><div class="previewAngebotHolder">';
                  s = s + '<span class="btn btn-danger previewResidenceDel" onclick="previewDel(\'' + t + '\')"><i class="bx bx-trash"></i></span>', s = n ? s + '<img src="' + e.target.result + '" alt="' + l + '" class="img-responsive previewAngebot">' : s + '<img src="/img/file.png" alt="' + l + '" class="img-responsive previewAngebot">', s = s + '</div><div class="caption"><p>' + l + "</p><p></p></div>", s = s + '<textarea name="bild[' + t + '][base64]" class="hidden">' + e.target.result + "</textarea>", s = s + '<input name="bild[' + t + '][name]" class="hidden" type="hidden" value="' + a + '">', s = s + '<input name="bild[' + t + '][type]" class="hidden" type="hidden" value="' + i.type + '">', s = s + '<input name="bild[' + t + '][size]" class="hidden" type="hidden" value="' + i.size + '"></div>', $("#preview_Angebot_Bilder>.row").append(s)
              }, t.readAsDataURL(i)
          } else e = e + "<li>Datei <b>" + l + "</b> ist <b>grÃ¶ÃŸer als 5MB!</b></li>"
      }($(this).get(0).files[i]) : e = e + "<li><b>Maximale Anhanganzahl (6) erreicht!</b> Datei:" + $(this).get(0).files[i].name + " konnte daher nicht hochgeladen werden!</li>";
      "" != e && modalAlles("Fehler!", '<div class="alert alert-danger">Es ist/sind leider folgende/s Fehler entstanden! <ul>' + e + "</ul></div>")
  })
});