<?php
require("../../../autoload.php");
header("Content-type: application/javascript; charset=utf-8");
?>
function BrowseServer( elementId ) {
	CKFinder.popup( {
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
			} );
			finder.on( 'file:choose:resizedImage', function( evt ) {
				$('#'+elementId).val(evt.data.resizedUrl);
				$('#vorschau'+elementId).attr('data-content', '<img src=\''+evt.data.resizedUrl+'\' class=\'img-responsive center-block\' alt=\'Bitte einen gültigen Bild laden!\'/>');
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
	$('.ckeditorGenerator').each(function(){
	var thisId = $(this).attr('abdullahValue');
	if(isMobile.any()){
	$('#ckeditorFrame'+thisId).html('<div class="alert alert-danger" role="alert">Dieser Bereich ist nur mit einem Computer bearbeitbar!</div>');
	} else {
    var editorCKeditor = CKEDITOR.replace('ckeditor'+thisId,{skin:'moono',toolbarGroups:[
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' }
	], 		filebrowserBrowseUrl: '/adm/plugins/ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl: '/adm/plugins/ckfinder/ckfinder.html?type=Images',
			filebrowserUploadUrl: '/adm/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl: '/adm/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'});
	editorCKeditor.on( 'change', function( evt ) {
   var textCKeditor = evt.editor.getData();
   $('#ckeditorInhalt'+thisId).text(textCKeditor).val();
	});
	}
  });
	if(document.getElementById("boxSource")){
		var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("boxSource"), { lineNumbers: true, mode: "htmlmixed", tabSize:4, indentWithTabs:true, autofocus:true});
		myCodeMirror.setSize("auto", "70vh");
		myCodeMirror.on( 'change', function( evts ) {var benaedittext = myCodeMirror.getValue();$('#boxSourceInhalt').text(benaedittext).html();});
		}
	if(document.getElementById("panelSource")){
		var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("panelSource"), { lineNumbers: true, mode: "htmlmixed", tabSize:4, indentWithTabs:true, autofocus:true});
		myCodeMirror.setSize("auto", "70vh");
		myCodeMirror.on( 'change', function( evts ) {var benaedittext = myCodeMirror.getValue();$('#panelSourceInhalt').text(benaedittext).html();});
		}
		
	if(document.getElementById("pageConfig")){
		var tpyeMirror = $('#pageConfigInhalt').attr('abdullahValue');
		var myCodeMirror = CodeMirror.fromTextArea(document.getElementById("pageConfig"), { lineNumbers: true, mode: tpyeMirror, tabSize:4, indentWithTabs:true, autofocus:true});
		myCodeMirror.setSize("auto", "70vh");
		myCodeMirror.on( 'change', function( evts ) {var benaedittext = myCodeMirror.getValue();$('#pageConfigInhalt').text(benaedittext).val();});
		}
};

bearbeitungsModus = false;
editable=true;
$(document).ready(function() {
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
var r = confirm("Du brichst den Entwurf des Parameters ab!");
if (r == true) {
	resetParametersHinzufugen();
}
return false;
});

$('#abbrechenEgalWas').on('click', function(e){
window.location.href = location.pathname+'&reload';
});

$('#configPageSpeichern').on('click', function(e){
	var getConfigId = $('#pageConfigInhalt').attr('abdullahValueIki');
	var getConfigInhalt = $('#pageConfigInhalt').val();
		$.post("/adm/interface/6", { pageconfigid: getConfigId, pageconfiginhalt: getConfigInhalt}).done(function(data) {
			if($.isNumeric(data) && data>0 && data<8){
				//Todo alert
			}
		});
});

$('#parameterHinzufuegen').on('click', function(e){
var paraName = leerzeichenErsetzen($('#parameterName').val());
var paraTyp = $('#parameterTyp').val();
var paraTypName = $("#parameterTyp option[value='"+paraTyp+"']").text();
var id=Date.now();
var parameterNamen = gibAlleParameterNamen();
console.log(parameterNamen);
if(paraName==""){
	$('#paraNameGroup').before('<div class="alert alert-danger" id="paraNameAlert" role="alert"><strong>FEHLER!</strong> Bitte einen Parameter Namen eingeben!</div>');
}else{
	loescheAlleDivs('div#paraNameAlert');
}
if(paraName!="" && $.inArray(paraName, parameterNamen) !='-1'){
	loescheAlleDivs('div#paraNameAlertBenutz');
	$('#paraNameGroup').before('<div class="alert alert-info" id="paraNameAlertBenutz" role="alert"><strong>ACHTUNG!</strong> Bitte einen unbenutzten Parameter Namen eingeben!</div>');
}else{
	loescheAlleDivs('div#paraNameAlertBenutz');
}
if(paraTyp=="0"){
	loescheAlleDivs('div#paraTypAlert');
	$('#paraTypGroup').before('<div class="alert alert-danger" id="paraTypAlert" role="alert"><strong>FEHLER!</strong> Bitte einen Typ wählen!</div>');
}else{
	loescheAlleDivs('div#paraTypAlert');
}
if(paraName!="" && paraTyp!="0" && $.inArray(paraName, parameterNamen)=="-1"){
	loescheAlleDivs('div#paraTypAlert');
	loescheAlleDivs('div#paraNameAlert');
	loescheAlleDivs('div#paraNameAlertBenutz');
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
if(editable==true && bearbeitungsModus==false){
var boxName = leerzeichenErsetzen($('#boxName').val());
var boxSource = $('#boxSourceInhalt').html();
var alleBoxNamen = gibAlleBoxNamen();
if(boxName==""){
	loescheAlleDivs('div#boxNameAlert');
	$('#boxNameWrapAlert').before('<div class="alert alert-danger" id="boxNameAlert" role="alert"><strong>FEHLER!</strong> Bitte einen Box Namen eingeben!</div>');
}else{
	loescheAlleDivs('div#boxNameAlert');
}
if(boxName!="" && $.inArray(boxName, alleBoxNamen) !="-1"){
	loescheAlleDivs('div#boxNameAlertBenutz');
	$('#boxNameWrapAlert').before('<div class="alert alert-info" id="boxNameAlertBenutz" role="alert"><strong>ACHTUNG!</strong> Bitte einen Boxnamen eingeben, der weder bei einem Box noch bei einem Panel vergeben wurde!</div>');
}else{
	loescheAlleDivs('div#boxNameAlertBenutz');
}
if(boxSource==""){
	loescheAlleDivs('div#boxSourceAlert');
	$('#boxSource').before('<div class="alert alert-danger" id="boxSourceAlert" role="alert"><strong>FEHLER!</strong> Bitte einen HTML-Inhalt eingeben!</div>');
}else{
	loescheAlleDivs('div#boxSourceAlert');
}
if(boxName!="" && boxSource!="" && $.inArray(boxName, alleBoxNamen)=="-1"){
	editable = false;
	bearbeitungsModus = true;
	loescheAlleDivs('div#boxNameAlert');
	loescheAlleDivs('div#boxSourceAlert');
	loescheAlleDivs('div#boxNameAlertBenutz');
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
			}else{
			$('#boxVerwaltungListePunkt_'+getData.boxid+' > a').html(getData.boxname);
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
		//Todo alert success
		}
    });
	editable = true;
	bearbeitungsModus = false;
}
}else{
	alert('Ein Parameter wird noch bearbeitet!');
}
});

$('#panelHinzufuegen').on('click', function(e){
if(editable==true && bearbeitungsModus==false){
var panelName = leerzeichenErsetzen($('#panelName').val());
var panelSource = $('#panelSourceInhalt').html();
var allePanelNamen = gibAllePanelNamen();
if(panelName==""){
	loescheAlleDivs('div#panelNameAlert');
	$('#panelNameWrapAlert').before('<div class="alert alert-danger" id="panelNameAlert" role="alert"><strong>FEHLER!</strong> Bitte einen Box Namen eingeben!</div>');
}else{
	loescheAlleDivs('div#panelNameAlert');
}
if(panelName!="" && $.inArray(panelName, allePanelNamen) !="-1"){
	loescheAlleDivs('div#panelNameAlertBenutz');
	$('#panelNameWrapAlert').before('<div class="alert alert-info" id="panelNameAlertBenutz" role="alert"><strong>ACHTUNG!</strong> Bitte einen Panelnamen eingeben, der weder bei einem Box noch bei einem Panel vergeben wurde!</div>');
}else{
	loescheAlleDivs('div#panelNameAlertBenutz');
}
if(panelSource==""){
	loescheAlleDivs('div#panelSourceAlert');
	$('#panelSource').before('<div class="alert alert-danger" id="panelSourceAlert" role="alert"><strong>FEHLER!</strong> Bitte einen HTML-Inhalt eingeben!</div>');
}else{
	loescheAlleDivs('div#panelSourceAlert');
}
if(panelName!="" && panelSource!="" && $.inArray(panelName, allePanelNamen)=="-1"){
	editable = false;
	bearbeitungsModus = true;
	loescheAlleDivs('div#panelNameAlert');
	loescheAlleDivs('div#panelSourceAlert');
	loescheAlleDivs('div#panelNameAlertBenutz');
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
			}else{
			$('#panelVerwaltungListePunkt_'+getData.panelid+' > a').html(getData.panelname);
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
		//Todo alert success
		}
    });
	editable = true;
	bearbeitungsModus = false;
}
}else{
	alert('Ein Parameter wird noch bearbeitet!');
}
});

$('#parameterInhaltSpeichern').on('click', function(e){
if(editable==true && bearbeitungsModus==false){
var idBox = $('#parameterInhaltBoxId').val();
if(idBox!=""){
	editable = false;
	bearbeitungsModus = true;
	var bParameter = arrayParameterInhalt();
	if(bParameter===null){
		bParameter = 'noParameters';
	}
	$.post("/adm/interface/5", {boxId: idBox, parameterInhalt: bParameter}).done(function(data) {
	if(!$.isNumeric(data) && data !=1){
		//Todo alert success
			$('#alleParameterBearbeitungsModus').html(data);
	}
    });
	editable = true;
	bearbeitungsModus = false;
}
}else{
	alert('Etwas wird noch bearbeitet!');
}
});


});

function loescheBox(id){
	if(editable==true && bearbeitungsModus==false){
		var r = confirm("Du löschst einen Box!");
		if (r == true) {
		editable = false;
		bearbeitungsModus = true;
		var idBox=$('#boxID').val();
		$.post("/adm/interface/2", {boxId:idBox}).done(function(data) {
			if(data=='deleted'){
					location.pathname = "/adm/startseite";
			}
		});
		}
	}
	else{
	alert('Ein Parameter wird noch bearbeitet!');
	}
	editable = true;
	bearbeitungsModus = false;
}

function loeschePanel(id){
	if(editable==true && bearbeitungsModus==false){
		var r = confirm("Du löschst einen Panel!");
		if (r == true) {
		editable = false;
		bearbeitungsModus = true;
		var idPanel=$('#panelID').val();
		$.post("/adm/interface/4", {panelId:idPanel}).done(function(data) {
			if(data=='deleted'){
					location.pathname = "/adm/startseite";
			}
		});
		}
	}
	else{
	alert('Ein Parameter wird noch bearbeitet!');
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
	alert('Du bearbeitest momentan einen Parameter, breche diese ab um eine anderen Parameter bearbeiten zu können!');
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
var r = confirm("Du löschst einen Parameter!");
if (r == true) {
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
}

function showBearbeitetePara(i){
	bearbeitungsModus = false;
	$('#bearbeiteParameter').remove();
	$('#paraBox_'+i).css("display","block");
}
function abbrechenParameter(i){
var r = confirm("Du brichst grad die Bearbeitung eines Parameters ab!");
if (r == true) {
showBearbeitetePara(i)
}
}
function speicherParameter(i){
	var paraName = leerzeichenErsetzen($('#parameterNameBearbeitung').val());
	var paraTyp = $('#parameterTypBearbeitung').val();
	var paraStatus = $('#paraName_'+i).attr('abdullahValue');
	var statusBearbeitetBox;
	if(paraStatus=="new"){statusBearbeitetBox="new";}else{statusBearbeitetBox="update";}
	if(paraName==""){
	loescheAlleDivs('div#paraNameAlert');
	$('#paraNameGroupBearbeitung').before('<div class="alert alert-danger" id="paraNameAlertBearbeitung" role="alert"><strong>FEHLER!</strong> Bitte einen Parameter Namen eingeben!</div>');
	}
	if(paraTyp=="0"){
		loescheAlleDivs('div#paraTypAlert');
		$('#paraTypGroupBearbeitung').before('<div class="alert alert-danger" id="paraTypAlertBearbeitung" role="alert"><strong>FEHLER!</strong> Bitte einen Typ wählen!</div>');
	}
	if(paraName!="" && paraTyp!="0"){
	loescheAlleDivs('div#paraNameAlertBearbeitung');
	loescheAlleDivs('div#paraTypAlertBearbeitung');
	var paraTypName = $("#parameterTypBearbeitung option[value='"+paraTyp+"']").text();
	$('#paraBox_'+i).html('<div class="btn-group btn-group-justified" role="group" id="paraBox_'+i+'"><div class="btn-group" role="group"><button type="button" class="btn btn-default" abdullahValue="'+statusBearbeitetBox+'" id="paraName_'+i+'">'+paraName+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_'+i+'" abdullahValue="'+paraTyp+'">'+paraTypName+'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion<span class="caret"></span></button><ul class="dropdown-menu"><li onclick="bearbeitePara('+i+');"><a>Bearbeiten</a></li><li onclick="loeschePara('+i+');"><a>Löschen</a></li></ul></div></div>');
	showBearbeitetePara(i)
	//Todo alert success
	}
}


function arrayParameterInhalt(){
var reg = /<div class="hided" paraarbeit="(new|update)" parasuche="(var|html)" paranick="(input|image|textarea|ckeditorInhalt)" paraid="([0-9]+)" parafremdid="([0-9]+)" paratype="([0-9_]+)" parafremdsorte="([0-9]+)" paraparent="([0-9_]+)"><\/div>/gi;
var str = $("#alleParameterBearbeitungsModus").html();
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