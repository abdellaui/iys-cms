<?php
require("../../php/autoload.php");
header("Content-type: application/javascript; charset=utf-8");
if(!isset($_SESSION['login'])){
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
echo '
/*
IYS-CMS
(c) '.date("Y").' by Abdullah Sahin. All rights reserved.
*/';

?>
bearbeitungsModus = false;
editable=true;
hasChanged = false;

$(window).bind('beforeunload', function() {
	if(hasChanged){
		return "Diese Seite bittet Sie zu bestätigen, dass Sie die Seite verlassen möchten – Daten, die Sie eingegeben haben, werden unter Umständen nicht gespeichert.";
	}
});

function BrowseServer( elementId ) {
	CKFinder.modal( {
		chooseFiles: true,
		width: 800,
		height: 600,
		rememberLastFolder: true,
		startupFolderExpanded: true,
		onInit: function( finder ) {
			finder.on( 'files:choose', function( evt ) {
				var file = evt.data.files.first();
				$('#'+elementId).val(file.getUrl());
				$('#vorschau'+elementId).attr('data-content', '<img src=\''+file.getUrl()+'\' class=\'img-responsive center-block\' alt=\'Bitte einen gültigen Bild laden!\'/>');
				hasChanged = true;
			} );
			finder.on( 'file:choose:resizedImage', function( evt ) {
				$('#'+elementId).val(evt.data.resizedUrl);
				$('#vorschau'+elementId).attr('data-content', '<img src=\''+evt.data.resizedUrl+'\' class=\'img-responsive center-block\' alt=\'Bitte einen gültigen Bild laden!\'/>');
				hasChanged = true;
			} );
		}
	} );
}
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};
window.onload = function(){
	reloadCkeditor();
	if(document.getElementById("boxSource")){
		var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("boxSource"), { lineNumbers: true, lineWrapping: true, mode: "htmlmixed", tabSize:4, indentWithTabs:true, autofocus:true});
		myCodeMirror.setSize("auto", "70vh");
		myCodeMirror.on( 'change', function( evts ) {var benaedittext = myCodeMirror.getValue();$('#boxSourceInhalt').text(benaedittext).html(); hasChanged = true;});
		}
	if(document.getElementById("panelSource")){
		var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("panelSource"), { lineNumbers: true, lineWrapping: true, mode: "htmlmixed", tabSize:4, indentWithTabs:true, autofocus:true});
		myCodeMirror.setSize("auto", "70vh");
		myCodeMirror.on( 'change', function( evts ) {var benaedittext = myCodeMirror.getValue();$('#panelSourceInhalt').text(benaedittext).html(); hasChanged = true;});
		}
		
	if(document.getElementById("pageConfig")){
		var tpyeMirror = $('#pageConfigInhalt').attr('abdullahValue');
		var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("pageConfig"), { lineNumbers: true, lineWrapping: true, mode: tpyeMirror, tabSize:4, indentWithTabs:true, autofocus:true});
		myCodeMirror.setSize("auto", "70vh");
		myCodeMirror.on( 'change', function( evts ) {var benaedittext = myCodeMirror.getValue();$('#pageConfigInhalt').text(benaedittext).val(); hasChanged = true;});
		}
};
$(document).ready(function() {
$('input, textarea').on( 'change', function( evts ) {hasChanged = true;});
$('#logoutpanel').on('click', function(e){
		$.post("/adm/interface/7", { doing : 'logout'}).done(function(data) {
			if($.isNumeric(data)){
			window.location.pathname = '/adm/';
			}
		});
	e.preventDefault(); return false;
});

$('[data-toggle="popover"]').popover({ trigger: "hover" });
$('[data-toggle="popover"]').on('click', function(e){e.preventDefault(); return false;});
function resetParametersHinzufugen(){
	$('#parameterTyp').val('0');
	$('#parameterName').val('');
}
$('#parameterAbbrechen').on('click', function(e){
$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du brichst den Entwurf des Parameters ab!", function(e) {
	if(e == true){
	resetParametersHinzufugen();
	}
});
return false;
});

$('#abbrechenEgalWas').on('click', function(e){
	$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du brichst etwas ab!", function(e) {
	if(e == true){
	hasChanged = false;
	window.location.href = location.pathname+'&reload';
	}
	});
});

$('#configPageSpeichern').on('click', function(e){
	hasChanged = false;
	var getConfigId = $('#pageConfigInhalt').attr('abdullahValueIki');
	var getConfigInhalt = $('#pageConfigInhalt').val();
		$.post("/adm/interface/6", { pageconfigid: getConfigId, pageconfiginhalt: getConfigInhalt}).done(function(data) {
			if($.isNumeric(data) && data>0 && data<8){
				alertToast('success', 'Erfolgreich bearbeitet !', 'Du hast eine Konfigurationsdatei erfolgreich bearbeitet!');
			}else{
				alertToast('info', 'Information !', 'Du solltest eine Änderung vornehmen bevor du speicherst!');
			}
		});
});

$('#parameterHinzufuegen').on('click', function(e){
hasChanged = true;
var paraName = leerzeichenErsetzen($('#parameterName').val());
var paraTyp = $('#parameterTyp').val();
var paraTypName = $("#parameterTyp option[value='"+paraTyp+"']").text();
var id=Date.now();
var parameterNamen = gibAlleParameterNamen();
if(paraName==""){
	alertToast('error', 'Fehler !', 'Bitte einen Parameter-Namen eingeben!');
}
if(paraName!="" && $.inArray(paraName, parameterNamen) !='-1'){
	alertToast('warning', 'Achtung !', 'Bitte einen unbenutzten Parameter Namen eingeben!');
}
if(paraTyp=="0"){
	alertToast('error', 'Fehler !', 'Bitte einen Parameter-Typ wählen!');
}
if(paraName!="" && paraTyp!="0" && $.inArray(paraName, parameterNamen)=="-1"){
	resetParametersHinzufugen();
	if($.trim($('#parameterInhalt').html())=='<div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>'){
		$('#parameterInhalt').html('<div class="btn-group btn-group-justified" role="group" id="paraBox_'+id+'"><div class="btn-group" role="group"><button type="button" class="btn btn-default" abdullahValue="new" id="paraName_'+id+'">'+paraName+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_'+id+'" abdullahValue="'+paraTyp+'">'+paraTypName+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion<span class="caret"></span></button><ul class="dropdown-menu"><li onclick="bearbeitePara('+id+');"><a>Bearbeiten</a></li><li onclick="loeschePara('+id+');"><a>Löschen</a></li></ul></div></div>');
	}else{
		$('#parameterInhalt').append('<div class="btn-group btn-group-justified" role="group" id="paraBox_'+id+'"><div class="btn-group" role="group"><button type="button" class="btn btn-default" abdullahValue="new" id="paraName_'+id+'">'+paraName+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_'+id+'" abdullahValue="'+paraTyp+'">'+paraTypName+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion<span class="caret"></span></button><ul class="dropdown-menu"><li onclick="bearbeitePara('+id+');"><a>Bearbeiten</a></li><li onclick="loeschePara('+id+');"><a>Löschen</a></li></ul></div></div>');
	}
}
return false;
});

$('#boxHinzufuegen').on('click', function(e){
hasChanged = false;
if(editable==true && bearbeitungsModus==false){
var boxName = leerzeichenErsetzen($('#boxName').val());
var boxSource = $('#boxSourceInhalt').html();
var alleBoxNamen = gibAlleBoxNamen();
if(boxName==""){
	alertToast('error', 'Fehler !', 'Bitte einen Box-Namen eingeben!');
}
if(boxName!="" && $.inArray(boxName, alleBoxNamen) !="-1"){
	alertToast('warning', 'Achtung !', 'Bitte einen unbenutzten Box-Namen eingeben!');
}
if(boxSource==""){
	alertToast('error', 'Fehler !', 'Bitte einen HTML-Inhalt eingeben!');
}
if(boxName!="" && boxSource!="" && $.inArray(boxName, alleBoxNamen)=="-1"){
	editable = false;
	bearbeitungsModus = true;
	var bParameter = gibAlleParameter();
	if(bParameter===null){
		bParameter = 'noParameters';
	}
	var idBox=$('#boxID').val();
	var typBox=$('#boxTYPE').val();
	$.post("/adm/interface/1", { statusBox: typBox, boxId: idBox, name: boxName, source: boxSource , parameters: bParameter}).done(function(data) {
	var getData = $.parseJSON(data);
		if($.isNumeric(getData.boxid)){
			if(typBox=='new'){
			$('#boxButtonBereich').append('<br><br><div class="btn btn-danger col-md-12 col-sm-12 col-xs-12" onclick="loescheBox('+getData.boxid+');">Box löschen</div>');
			if(!$('#boxVerwaltungListeTree').length){
				$('#boxErstellenListeTree').after('<li class="treeview" id="boxVerwaltungListeTree"><a href="#"><i class="fa fa-cubes"></i> <span>Box verwalten</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu" id="boxVerwaltungListe"></ul></li>');
			}
			$('#boxErstellenListeTree').removeAttr('class');
			$('#boxVerwaltungListeTree').addClass('active');
			$('#boxVerwaltungListe').append('<li class="active" id="boxVerwaltungListePunkt_'+getData.boxid+'"><a href="/adm/boxupdate/'+getData.boxid+'">'+getData.boxname+'</a></li>');
			alertToast('success', 'Super !', 'Du hast einen Box erfolgreich hinzugefügt!');
			}else{
			$('#boxVerwaltungListePunkt_'+getData.boxid+' > a').html(getData.boxname);
			alertToast('success', 'Super !', 'Du hast einen Box erfolgreich bearbeitet!');
			}
			$('#parameterListeMenu').html(getData.menuparameter.vars);
			$('#boxHinzufuegen').html('Box speichern');
			$('#boxID').val(getData.boxid);
			$('#boxTYPE').val('update');
			$('#boxName').val(getData.boxname);
			$('#nameBoxHeader1').html('Box bearbeiten: ' + getData.boxname);
			$('#nameBoxHeader2').html('Box bearbeiten: ' + getData.boxname);
					if(getData.parameters.length>0){
						$('#parameterInhalt').html('');
					$.each(getData.parameters, function(i, item) {
						$('#parameterInhalt').append('<div class="btn-group btn-group-justified" role="group" id="paraBox_'+item.id+'"><div class="btn-group" role="group"><button type="button" class="btn btn-default" abdullahValue="old" id="paraName_'+item.id+'">'+item.name+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_'+item.id+'" abdullahValue="'+item.type+'">'+item.typename+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion<span class="caret"></span></button><ul class="dropdown-menu"><li onclick="bearbeitePara('+item.id+');"><a>Bearbeiten</a></li><li onclick="loeschePara('+item.id+');"><a>Löschen</a></li></ul></div></div>');
					});
					}
		}
    });
	editable = true;
	bearbeitungsModus = false;
}
}else{
	alertToast('error', 'Vorsicht !', 'Ein Parameter wird noch bearbeitet!');
}
});

$('#panelHinzufuegen').on('click', function(e){
hasChanged = false;
if(editable==true && bearbeitungsModus==false){
var panelName = leerzeichenErsetzen($('#panelName').val());
var panelSource = $('#panelSourceInhalt').html();
var allePanelNamen = gibAllePanelNamen();
if(panelName==""){
	alertToast('error', 'Fehler !', 'Bitte einen Panel-Namen eingeben!');
}
if(panelName!="" && $.inArray(panelName, allePanelNamen) !="-1"){
	alertToast('warning', 'Achtung !', 'Bitte einen unbenutzten Panel-Namen eingeben!');
}
if(panelSource==""){
	alertToast('error', 'Fehler !', 'Bitte einen HTML-Inhalt eingeben!');
}
if(panelName!="" && panelSource!="" && $.inArray(panelName, allePanelNamen)=="-1"){
	editable = false;
	bearbeitungsModus = true;
	var bParameter = gibAlleParameter();
	if(bParameter===null){
		bParameter = 'noParameters';
	}
	var idPanel=$('#panelID').val();
	var typPanel=$('#panelTYPE').val();
	$.post("/adm/interface/3", { statusPanel: typPanel, panelId: idPanel, name: panelName, source: panelSource , parameters: bParameter}).done(function(data) {
	var getData = $.parseJSON(data);
		if($.isNumeric(getData.panelid)){
			if(typPanel=='new'){
			$('#panelButtonBereich').append('<br><br><div class="btn btn-danger col-md-12 col-sm-12 col-xs-12" onclick="loeschePanel('+getData.panelid+');">Panel löschen</div>');
			if(!$('#panelVerwaltungListeTree').length){
				$('#panelErstellenListeTree').after('<li class="treeview" id="panelVerwaltungListeTree"><a href="#"><i class="fa fa-cogs"></i> <span>Panel verwalten</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu" id="panelVerwaltungListe"></ul></li>');
			}
			$('#panelErstellenListeTree').removeAttr('class');
			$('#panelVerwaltungListeTree').addClass('active');
			$('#panelVerwaltungListe').append('<li class="active" id="panelVerwaltungListePunkt_'+getData.panelid+'"><a href="/adm/panelupdate/'+getData.panelid+'">'+getData.panelname+'</a></li>');
			alertToast('success', 'Super !', 'Du hast einen Panel erfolgreich hinzugefügt!');
			}else{
			$('#panelVerwaltungListePunkt_'+getData.panelid+' > a').html(getData.panelname);
			alertToast('success', 'Super !', 'Du hast einen Panel erfolgreich bearbeitet!');
			}
			$('#panelHinzufuegen').html('Panel speichern');
			$('#panelID').val(getData.panelid);
			$('#panelTYPE').val('update');
			$('#panelName').val(getData.panelname);
			$('#namePanelHeader1').html('Panel bearbeiten: ' + getData.panelname);
			$('#namePanelHeader2').html('Panel bearbeiten: ' + getData.panelname);
					if(getData.parameters.length>0){
						$('#parameterInhalt').html('');
					$.each(getData.parameters, function(i, item) {
						$('#parameterInhalt').append('<div class="btn-group btn-group-justified" role="group" id="paraBox_'+item.id+'"><div class="btn-group" role="group"><button type="button" class="btn btn-default" abdullahValue="old" id="paraName_'+item.id+'">'+item.name+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_'+item.id+'" abdullahValue="'+item.type+'">'+item.typename+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion<span class="caret"></span></button><ul class="dropdown-menu"><li onclick="bearbeitePara('+item.id+');"><a>Bearbeiten</a></li><li onclick="loeschePara('+item.id+');"><a>Löschen</a></li></ul></div></div>');
					});
					}
		}
    });
	editable = true;
	bearbeitungsModus = false;
}
}else{
	alertToast('error', 'Vorsicht !', 'Ein Parameter wird noch bearbeitet!');
}
});

$('#parameterInhaltSpeichern').on('click', function(e){
hasChanged = false;
if(editable==true && bearbeitungsModus==false){
var idBox = $('#parameterInhaltBoxId').val();
if(idBox!=""){
	editable = false;
	bearbeitungsModus = true;
	var bParameter = arrayParameterInhalt("#alleParameterBearbeitungsModus");
	if(bParameter===null){
		bParameter = 'noParameters';
	}
	$.post("/adm/interface/5", {boxId: idBox, parameterInhalt: bParameter}).done(function(data) {
	if(!$.isNumeric(data) && data !=0){
			alertToast('success', 'Super !', 'Du hast erfolgreich die Parameters bearbeitet!');
			$('#alleParameterBearbeitungsModus').html(data);
			reloadCkeditor();
	}
    });
	editable = true;
	bearbeitungsModus = false;
}
}else{
	alertToast('error', 'Vorsicht !', 'Etwas wird noch bearbeitet!');
}
});


$('#einstellung_passwort_aendern').on('click', function(e){
var psw1 = $('#einstellung_password_1').val();
var psw2 = $('#einstellung_password_2').val();
var psw3 = $('#einstellung_password_3').val();
if(psw1.length>0&&psw2.length>0&&psw3.length>0){
	if(psw2==psw3){
		$.post("/adm/interface/8", {alte: psw1, neue: psw2}).done(function(data) {
		if($.isNumeric(data) && data ==1){
				alertToast('success', 'Super !', 'Du hast erfolgreich dein Passwort geändert!');
		}else{
			alertToast('error', 'Leider !', data);
		}
		});
		
	}else{
		alertToast('warning', 'Achtung !', 'deine Passwörter stimmen nicht überein!');
	}
}else{
	alertToast('warning', 'Achtung !', 'einer der Passwörter wurde ausgelassen!');
}
	editable = true;
	bearbeitungsModus = false;
});


$('#einstellung_email_aendern').on('click', function(e){
	var email = $('#einstellung_email').val();
	if(email.length>0){
	$.post("/adm/interface/9", {neue: email}).done(function(data) {
	if($.isNumeric(data) && data ==1){
			alertToast('success', 'Super !', 'Du hast erfolgreich deine E-Mail geändert!');
			$('#e-mail-geaendert').html(email);
	}else{
		alertToast('error', 'Leider !', data);
	}
    });
	}else{
		alertToast('warning', 'Achtung !', 'Du musst eine E-Mail Adresse eingeben!');
	}
	editable = true;
	bearbeitungsModus = false;
});



$("#seiten_bodytag, #seiten_headtag ,#seiten_urls, #seiten_names").change(function(){
  var b = $(this).parent(".form-group").parent("div").parent(".row").attr('abdullahSeitenId');
   $('#seite_'+b).html('<div class="btn-group" role="group" onclick="pageSpeichern('+b+');"><button type="button" class="btn btn-success">Speichern</button></div><div class="btn-group" role="group" onclick="seiteAbbrechen();"><button type="button" class="btn btn-danger">Abbrechen</button></div>');
});
$('#pageHinzufuegen').on('click',function(e){
	var a = $('#seiteErstellen > div > div > #seiten_urls').val().toLowerCase();
	var b = $('#seiteErstellen > div > div > #seiten_names').val();
	var c = $('#seiteErstellen > div > div > #seiten_headtag').val();
	var d = $('#seiteErstellen > div > div > #seiten_bodytag').val();
	$.checkSeitenDaten(a,b,c,d,function(e){
		if(e==5){
		$.post("/adm/interface/10", { tool:'ins', urls : a, names : b, hbox: c, bbox: d}).done(function(data) {
			if(data==1){
			alertToast('success', 'Super !', 'Du hast eine Seite erfolgreich hinzugefügt!');
			hasChanged = false;
			window.location.href = location.pathname+'&reload';
			}else{
			alertToast('error', 'Fehler !', 'Unerklärlicher Fehler!');
			}
		});
		}
	});
});



});


$.extend({
  confirmToast : function(text, callbackFnk){
	   toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": false,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": true,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": 0,
	  "extendedTimeOut": 0,
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut",
	  "tapToDismiss": false
	  }
	  
		var $toast = toastr['warning'](text+"<br><br><div class=\"btn-group btn-group-justified\"><div class=\"btn-group\"><button type=\"button\" class=\"btn btn-default confirmOk\"><i class=\"fa fa-check\"></i> Ok</button></div><div class=\"btn-group\"><button type=\"button\" class=\"btn btn-danger confirmAbbruch\"><i class=\"fa fa-times\"></i> Abbruch</button></div></div>", 'Achtung !');
		$toast.on('click', '.confirmOk', function () {
					if(typeof callbackFnk == 'function'){
					callbackFnk.call(this, true);
					}
					$toast.remove();
				 });
		$toast.on('click', '.confirmAbbruch', function () {
					if(typeof callbackFnk == 'function'){
					callbackFnk.call(this, false);
					}
					$toast.remove();
				 });
  }
});


$.extend({
  checkSeitenDaten : function(a,b,c,d , callbackFnk){
  var error;
	if(a==''){
	error=1;
	}else if(b==''){
	error=2;
	}else if(c=='0'){
	error=3;
	}else if(d=='0'){
	error=4;
	}else{
	error=5;
	}
	switch(error) {
		case 1:
        err = 'URL der Seite fehlt!';
        break;
		case 2:
        err = 'Name der Seite fehlt!';
        break;
		case 3:
        err = 'Head-Tag Box der Seite fehlt!';
        break;
		case 4:
        err = 'Box-Tag Box der Seite fehlt!';
        break;
		case 5:
        err = 'Du hast einen Panel erfolgreich hinzugefügt!';
        break;
    default:
		err = 'Unerklärlicher Fehler';
		}
		
		if(error!=5){
		alertToast('error', 'Fehler !', err);
		}
	if(typeof callbackFnk == 'function'){
	callbackFnk.call(this, error);
	}
  }
});

function loescheBox(id){
	hasChanged = false;
	if(editable==true && bearbeitungsModus==false){
		$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du löschst einen Box!", function(e) {
		if(e == true){
		editable = false;
		bearbeitungsModus = true;
		var idBox=$('#boxID').val();
		$.post("/adm/interface/2", {boxId:idBox}).done(function(data) {
			if($.trim(data)=='deleted'){
					window.location.pathname = "/adm/startseite";
			}
		});
		}
		});
	}
	else{
	alertToast('error', 'Vorsicht !', 'Ein Parameter wird noch bearbeitet!');
	}
	editable = true;
	bearbeitungsModus = false;
}

function loeschePanel(id){
	hasChanged = false;
	if(editable==true && bearbeitungsModus==false){
		$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du löschst einen Panel!", function(e) {
		if(e == true){
		editable = false;
		bearbeitungsModus = true;
		var idPanel=$('#panelID').val();
		$.post("/adm/interface/4", {panelId:idPanel}).done(function(data) {
			if($.trim(data)=='deleted'){
					window.location.pathname = "/adm/startseite";
			}
		});
		}
		});
	}
	else{
	alertToast('error', 'Vorsicht !', 'Ein Parameter wird noch bearbeitet!');
	}
	editable = true;
	bearbeitungsModus = false;
}

String.prototype.matchAll = function(regexp) {
  var matches = [];
  this.replace(regexp, function() {
    var arr = ([]).slice.call(arguments, 1);
    var extras = arr.splice(-2);
    matches.push(arr);
  });
  return matches.length ? matches : null;
};

function gibAlleParameterNamen(){
	if($('#parameterInhalt').length && $.trim($('#parameterInhalt').html()) != '<div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>'){
		var reg = /<button type="button" class="btn btn-default" abdullahvalue="[old|new|update|delete]+" id="paraName_[0-9]+">([a-zA-Z0-9.+\W]+)<\/button>/gi;
		var str = $("#parameterInhalt").html();
		var arr = str.matchAll(reg);
		if(arr!=null){
		var b = [];
			$.each(arr, function( index, value ) {
					b.push(arr[index][0]);
			});
		return b;
		}else{
	return [];
	}
	}else{
		return [];
		}
}
function gibAlleBoxNamen(){
	if($('#boxVerwaltungListe').length){
		var reg = /<li id="boxVerwaltungListePunkt_[0-9]+"><a href="\/adm\/boxupdate\/[0-9]+">([a-zA-Z0-9.+\W]+)<\/a><\/li>/gi;
		var str = $("#boxVerwaltungListe").html();
		var arr = str.matchAll(reg);
		if(arr!=null){
		var b = [];
			$.each(arr, function( index, value ) {
					b.push(arr[index][0]);
			});
		return b;
		}else{
	return [];
	}
	}else{
	return [];
	}
}
function gibAllePanelNamen(){
	if($('#panelVerwaltungListe').length){
		var reg = /<li id="panelVerwaltungListePunkt_[0-9]+"><a href="\/adm\/panelupdate\/[0-9]+">([a-zA-Z0-9.+\W]+)<\/a><\/li>/gi;
		var str = $("#panelVerwaltungListe").html();
		var arr = str.matchAll(reg);
		if(arr!=null){
		var b = [];
			$.each(arr, function( index, value ) {
					b.push(arr[index][0]);
			});
		return b;
		}else{
	return [];
	}
	}else{
	return [];
	}
}
function gibAlleParameter(){
	if($('#parameterInhalt').length && $.trim($('#parameterInhalt').html()) != '<div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>'){
	var reg = /<button type="button" class="btn btn-default" abdullahValue="([new|update|delete]+)" id="paraName_([0-9]+)\">([a-zA-Z0-9.+\W]+)<\/button><\/div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_[0-9]+" abdullahValue="([{0-9_}]+)">[a-zA-Z0-9.+\W]+<\/button>/gi;
	var str = $("#parameterInhalt").html();
	var arr = str.matchAll(reg);
	return arr;
	}else{
	return [];
	}
}
function bearbeitePara(i){
if(!bearbeitungsModus){
hasChanged = true;
bearbeitungsModus = true;
var paraName = $('#paraName_'+i).html();
var paraTyp = $('#paraTyp_'+i).attr('abdullahValue');
var c = $('#paramBearbeitenBox').html();
var c = c.replace('parameterTyp', 'parameterTypBearbeitung');
var c = c.replace('parameterName', 'parameterNameBearbeitung');
var c = c.replace('paraNameGroup', 'paraNameGroupBearbeitung');
var c = c.replace('paraTypGroup', 'parameterTypBearbeitungBearbeitung');
$('#paraBox_'+i).before('<div id="bearbeiteParameter"><br><div class="box box-solid box-default"><div class="box-header with-border"><h3 class="box-title">Parameter bearbeiten:</h3></div><div class="box-body">'+c+'<p><br><div class="row"><div class="col-md-6 col-sm-6"><div class="btn btn-success col-md-12" onclick="speicherParameter('+i+');">Speichern</div></div><div class="col-md-6 col-sm-6"><div class="btn btn-danger col-md-12" onclick="abbrechenParameter('+i+');">Abbrechen</div></div></div></p></div><script>$(\'#parameterTypBearbeitung\').val(\''+paraTyp+'\');$(\'#parameterNameBearbeitung\').val(\''+paraName+'\');</script></div></div>');
$('#paraBox_'+i).css("display","none");
}else{
	alertToast('error', 'Vorsicht !', 'Du bearbeitest momentan einen Parameter, breche diese ab um eine anderen Parameter bearbeiten zu können!');
}
}

function leerzeichenErsetzen(v){
	v=v.replace(/\s/g, '.');
	v=v.replace(/\W+/g, ".");
	v=v.replace(/ü/g, "ue");
	v=v.replace(/ö/g, "oe");
	v=v.replace(/ä/g, "ae");
	v=v.replace(/ß/g, "ss");
	return v;
}

function loescheAlleDivs(div){
	if($(div)){
	$(div).each(function() {$(this).remove();});
	}
}

function loeschePara(i){
$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du löschst einen Parameter!", function(e) {
	if(e == true){
	hasChanged = true;
	var anzahlDivs = $("#parameterInhalt > div:not([style])").length;
	var anzahlDifferenz = anzahlDivs-1;
	var paraStatus = $('#paraName_'+i).attr('abdullahValue');
	if(paraStatus=="new"){
	$('#paraBox_'+i).remove();
	}else{
	$('#paraName_'+i).attr('abdullahValue','delete');
	$('#paraBox_'+i).css('display','none');
	}
	if(anzahlDifferenz<=0){
		$("#parameterInhalt").append('<div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>');
	}
}
});
}

function showBearbeitetePara(i){
	bearbeitungsModus = false;
	$('#bearbeiteParameter').remove();
	$('#paraBox_'+i).css("display","block");
}
function abbrechenParameter(i){
$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du brichst grad die Bearbeitung eines Parameters ab!", function(e) {
	if(e == true){
	hasChanged = true;
	showBearbeitetePara(i)
	}
});
}
function speicherParameter(i){
	hasChanged = true;
	var paraName = leerzeichenErsetzen($('#parameterNameBearbeitung').val());
	var paraTyp = $('#parameterTypBearbeitung').val();
	var paraStatus = $('#paraName_'+i).attr('abdullahValue');
	var statusBearbeitetBox;
	if(paraStatus=="new"){statusBearbeitetBox="new";}else{statusBearbeitetBox="update";}
	if(paraName==""){
	alertToast('error', 'Fehler !', 'Bitte einen Parameter Namen eingeben!');
	}
	if(paraTyp=="0"){
	alertToast('error', 'Fehler !', 'Bitte einen Parameter-Typ wählen!');
	}
	if(paraName!="" && paraTyp!="0"){
	var paraTypName = $("#parameterTypBearbeitung option[value='"+paraTyp+"']").text();
	$('#paraBox_'+i).html('<div class="btn-group btn-group-justified" role="group" id="paraBox_'+i+'"><div class="btn-group" role="group"><button type="button" class="btn btn-default" abdullahValue="'+statusBearbeitetBox+'" id="paraName_'+i+'">'+paraName+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_'+i+'" abdullahValue="'+paraTyp+'">'+paraTypName+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion<span class="caret"></span></button><ul class="dropdown-menu"><li onclick="bearbeitePara('+i+');"><a>Bearbeiten</a></li><li onclick="loeschePara('+i+');"><a>Löschen</a></li></ul></div></div>');
	showBearbeitetePara(i)
	alertToast('success', '', 'Du hast erfolgreich die Parameter bearbeitet!');
	}
}


function arrayParameterInhalt(div){
var reg = /<div class="hidden" paraarbeit="(new|update)" parasuche="(var|html)" paranick="(input|image|textarea|ckeditorInhalt)" paraid="([0-9]+)" parafremdid="([0-9]+)" paratype="([0-9_]+)" parafremdsorte="([0-9]+)" paraparent="([0-9_]+)"><\/div>/gi;
var str = $(div).html();
var b = str.matchAll(reg);
var d = new Array();
	$.each(b, function( index, value ) {
		if(b[index][1]=='var'){
			var c = new Array();
			c.push(b[index][0]);
			c.push(b[index][3]);
			c.push(b[index][4]);
			c.push(b[index][5]);
			c.push(b[index][6]);
			c.push(b[index][7]);
			c.push($('#'+b[index][2]+b[index][3]+'_'+b[index][4]+'_'+b[index][5]+'_'+b[index][7]).val());
			d.push(c);
		}else if(b[index][1]=='html'){
			var c = new Array();
			c.push(b[index][0]);
			c.push(b[index][3]);
			c.push(b[index][4]);
			c.push(b[index][5]);
			c.push(b[index][6]);
			c.push(b[index][7]);
			c.push($('#'+b[index][2]+b[index][3]+'_'+b[index][4]+'_'+b[index][5]+'_'+b[index][7]).val());
			d.push(c);
		}
	});
return d;
}
function reloadCkeditor(){
$('[data-toggle="popover"]').popover({ trigger: "hover" });
$('[data-toggle="popover"]').on('click', function(e){e.preventDefault(); return false;});
$('input, textarea').on( 'change', function( evts ) {hasChanged = true;});
  $('.ckeditorGenerator').each(function(){
	var thisId = $(this).attr('abdullahValue');
	$('#ckeditorFrame'+thisId).fadeIn('fast');
	if(isMobile.any()){
	$('#ckeditorFrame'+thisId).html('<div class="alert alert-danger" role="alert">Dieser Bereich ist nur mit einem Computer bearbeitbar!</div>');
	} else {
    var editorCKeditor = CKEDITOR.replace('ckeditor'+thisId,{skin:'office2013',allowedContent:true,contentsCss:[ '/css/bootstrap.min.css', '/css/style.css' ],
			filebrowserBrowseUrl: '/adm/plugins/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl: '/adm/plugins/ckfinder/ckfinder.html?type=Images',
			filebrowserUploadUrl: '/adm/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl: '/adm/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'});
	editorCKeditor.on( 'change', function( evt ) {
		hasChanged = true;
   var textCKeditor = evt.editor.getData();
   $('#ckeditorInhalt'+thisId).val(textCKeditor);
	});
	}
  });
}
function alertToast(typ, title, content){
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "6000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
toastr[typ](content, title);
}
function pageLoeschen(h){
	$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du löschst eine Seite!", function(e) {
	if(e == true){
		$.post("/adm/interface/10", { tool:'del', id:h}).done(function(data) {
			if(data==1){
			$('[abdullahSeitenId="'+h+'"]').parent('li').remove();
			}else{
			alertToast('error', 'Fehler !', 'Unerklärlicher Fehler!');
			}
		});
	
	}
	});
}
function pageSpeichern(e){
	var a = $('[abdullahSeitenId="'+e+'"] > div > div > #seiten_urls').val().toLowerCase();
	var b = $('[abdullahSeitenId="'+e+'"] > div > div > #seiten_names').val();
	var c = $('[abdullahSeitenId="'+e+'"] > div > div > #seiten_headtag').val();
	var d = $('[abdullahSeitenId="'+e+'"] > div > div > #seiten_bodytag').val();
	$.checkSeitenDaten(a,b,c,d,function(h){
		if(h==5){
		$.post("/adm/interface/10", { tool:'upd', id:e , urls : a, names : b, hbox: c, bbox: d}).done(function(data) {
			if(data==1){
			hasChanged = false;
			$('[abdullahSeitenId="'+e+'"] > div > div > #seiten_urls').val(a)
			$('[abdullahSeitenId="'+e+'"] > div > div > #seite_'+e).html('<div class="btn-group" role="group" onclick="pageLoeschen('+e+');"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Löschen</button></div>');
			alertToast('success', 'Super !', 'Du hast eine Seite erfolgreich bearbeitet!');
			}else{
			alertToast('error', 'Fehler !', 'Unerklärlicher Fehler!');
			}
		});
		}
	});
}

function seiteAbbrechen(){
$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du brichst die Seiteneinstellung ab!", function(e) {
	if(e == true){
	hasChanged = false;
	window.location.href = location.pathname+'&reload';
	}
	});
}

function panelitemhinzufuegen(id){
	hasChanged = true;
	if($('#abdullahBoxBody_'+id+' > ul > li').length==1 && $('#abdullahBoxBody_'+id+' > ul > li').html()=='Panel hat keinen Item'){
		$('#abdullahBoxBody_'+id+' > ul > li:first-child').remove();
	}
	var itemCurrentId ='new_'+id+'_'+$.now();
	$('#abdullahBoxBody_'+id+' > ul').append('<li class="list-group-item list-group-item-warning" id="item_controller_'+itemCurrentId+'"><div class="row"><div class="col-md-8 col-sm-6"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-plus"></span></span><input type="text" class="form-control" id="item_name_'+itemCurrentId+'" placeholder="Bitte einen Item Namen angeben" aria-describedby="item_name"></div></div><div class="col-md-4 col-sm-6"><div class="btn-group btn-group-justified" role="group"><div class="btn-group" role="group" onclick="panelItemSpeichern('+id+',\''+itemCurrentId+'\');"><button type="button" class="btn btn-success">Hinzufügen</button></div><div class="btn-group" role="group" onclick="panelItemLoeschen('+id+',\''+itemCurrentId+'\');"><button type="button" class="btn btn-danger">Abbrechen</button></div></div></div></div></li>');
	
}

function panelItemSpeichern(i, a){
var c = $('#item_name_'+a).val();
if(c.length!=0){
	if(a.substr(0, 3)=='new'){
		$.post("/adm/interface/11", { tool:'ins', panel_id:i, name:c}).done(function(data) {
			if(data>=1){
			itemCurrentId = parseInt(data);
			hasChanged = false;
			$('#item_controller_'+a).replaceWith('<li class="list-group-item list-group-item-info" id="item_controller_'+itemCurrentId+'"><div class="row"><div class="col-md-6 col-sm-4"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span><input type="text" class="form-control" id="item_name_'+itemCurrentId+'" placeholder="Bitte einen Item Namen angeben" value="'+c+'" aria-describedby="item_name"></div></div><div class="col-md-6 col-sm-8"><div class="btn-group btn-group-justified" role="group"><div class="btn-group" role="group" onclick="panelItemBearbeiten(\'Item bearbeiten: '+c+'\',\''+itemCurrentId+'\');"><button type="button" class="btn btn-default">Ansehen</button></div><div class="btn-group" role="group" onclick="panelItemSpeichern('+i+',\''+itemCurrentId+'\');"><button type="button" class="btn btn-success">Speichern</button></div><div class="btn-group" role="group" onclick="panelItemLoeschen('+i+',\''+itemCurrentId+'\');"><button type="button" class="btn btn-danger">Löschen</button></div></div></div></div></li>');
			alertToast('success','Super !','Du hast erfolgreich einen Item zugefügt!');
			}else{
			alertToast('error', 'Fehler !', 'Unerklärlicher Fehler!');
			}
		});
	}else{
		$.post("/adm/interface/11", { tool:'upd', id:a , name : c}).done(function(data) {
			if(data==1){
			hasChanged = false;
			alertToast('success', 'Super !', 'Du hast einen Item erfolgreich bearbeitet!');
			}else{
			alertToast('error', 'Fehler !', 'Unerklärlicher Fehler!');
			}
		});
	}
	hasChanged = false;
}else{
	alertToast('error','Fehler !','Du musst dem Item einen Namen geben!');
}
}
function panelItemLoeschen(i, a){
	$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du löschst einen Item!", function(e) {
	if(e == true){
	if(a.substr(0, 3)=='new'){
		hasChanged = false;
			$('#item_controller_'+a).remove();
				if($('#abdullahBoxBody_'+i+' > ul > li').length==0){
					$('#abdullahBoxBody_'+i+' > ul').append('<li class="list-group-item list-group-item-danger">Panel hat keinen Item</li>');
				}
	}else{
		$.post("/adm/interface/11", { tool:'del', id:a}).done(function(data) {
			if(data==1){
			hasChanged = false;
				$('#item_controller_'+a).remove();
				if($('#abdullahBoxBody_'+i+' > ul > li').length==0){
					$('#abdullahBoxBody_'+i+' > ul').append('<li class="list-group-item list-group-item-danger">Panel hat keinen Item</li>');
				}
			}else{
			alertToast('error', 'Fehler !', 'Unerklärlicher Fehler!');
			}
		});
	}
	}
	});
}

function panelItemBearbeiten(e,i){
$(".modal-title").html(e);
$.post("/adm/interface/12", { id:i}).done(function(data) {
	$(".modal-body").attr('abdullah',i).html(data);
	$("#modalAlles").modal({"backdrop" :"static",show:!0});
});
}

function modalReloadEditor(){
	$('[data-toggle="popover"]').popover({ trigger: "hover" });
$('[data-toggle="popover"]').on('click', function(e){e.preventDefault(); return false;});
$('input, textarea').on( 'change', function( evts ) {hasChanged = true;});

  $('#modalAlles .ckeditorGenerator').each(function(){
	var thisId = $(this).attr('abdullahValue');
	$('#ckeditorFrame'+thisId).fadeIn('fast');
	if(isMobile.any()){
	$('#ckeditorFrame'+thisId).html('<div class="alert alert-danger" role="alert">Dieser Bereich ist nur mit einem Computer bearbeitbar!</div>');
	} else {
    var editorCKeditor = CKEDITOR.replace('ckeditor'+thisId,{skin:'office2013',allowedContent:true,contentsCss:[ '/css/bootstrap.min.css', '/css/style.css' ],
			filebrowserBrowseUrl: '/adm/plugins/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl: '/adm/plugins/ckfinder/ckfinder.html?type=Images',
			filebrowserUploadUrl: '/adm/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl: '/adm/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'});
	editorCKeditor.on( 'change', function( evt ) {
		hasChanged = true;
   var textCKeditor = evt.editor.getData();
   $('#ckeditorInhalt'+thisId).val(textCKeditor);
	});
	}
  });
  
	
}
$(document).ready(function(){
$(document).on("click", "#btnModalSpeichern", function(event){
	var id = $(".modal-body").attr('abdullah');
	var bParameter = arrayParameterInhalt(".modal-body");
	if(bParameter===null){
		bParameter = 'noParameters';
	}
	$.post("/adm/interface/5", {itemId: id, parameterInhalt: bParameter}).done(function(data) {
	if(!$.isNumeric(data) && data !=0){
			alertToast('success', 'Super !', 'Du hast erfolgreich die Parameters des Items bearbeitet!');
			$('.modal-body').html(data);
			$('#btnModalAbbrechen.btn.btn-danger').removeClass('btn-danger').addClass('btn-warning').html('Schießen');
			modalReloadEditor();
			hasChanged = false;
	}
    });
});
$(document).on("click", "#btnModalAbbrechen", function(event){
		if(hasChanged){
	$.confirmToast("<span class=\"hide\">"+$.now()+"</span>Du brichst die Bearbeitung eines Item ab!", function(e) {
	if(e == true){
		$("#modalAlles").modal('hide');
		$('#btnModalAbbrechen.btn').removeClass('btn-warning').addClass('btn-danger').html('Abbrechen');
	}
	});
		}else{
			$("#modalAlles").modal('hide');
			$('#btnModalAbbrechen.btn').removeClass('btn-warning').addClass('btn-danger').html('Abbrechen');
		}
});
	$('#modalAlles').on('hidden.bs.modal', function () {
	$(".modal-title").html('');
	$(".modal-body").removeAttr('abdullah').html('');
});
$('#modalAlles').on('shown.bs.modal', function () {
	modalReloadEditor();
});

});