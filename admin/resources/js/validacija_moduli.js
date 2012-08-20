function menjava() {
	var tipi=document.getElementById("tip")
	if (tipi.options[0].selected==true){
		document.getElementById("vsebine").style.display="none"
		document.getElementById("meniji").style.display="none"
		document.getElementById("aplikacije").style.display="none"
		document.getElementById("nimodula").style.display=""
	}
	if (tipi.options[1].selected==true){
		document.getElementById("vsebine").style.display=""
		document.getElementById("meniji").style.display="none"
		document.getElementById("aplikacije").style.display="none"
		document.getElementById("nimodula").style.display="none"
	}
	if (tipi.options[2].selected==true){
		document.getElementById("meniji").style.display=""
		document.getElementById("vsebine").style.display="none"
		document.getElementById("aplikacije").style.display="none"
		document.getElementById("nimodula").style.display="none"
	}
	if (tipi.options[3].selected==true){
		document.getElementById("meniji").style.display="none"
		document.getElementById("vsebine").style.display="none"
		document.getElementById("nimodula").style.display="none"
		document.getElementById("aplikacije").style.display=""
	}
}

function izberiVse(id)	{
	var ref = document.getElementById(id);
	
	for(i=0; i<ref.options.length; i++)
	ref.options[i].selected = true;
}

function odstraniVse(id) {
	var ref=document.getElementById(id);
	
	for(i=0; i<ref.options.length; i++)
	ref.options[i].selected = false;
}

function senci(){
	if(document.obrazec.vsi.checked==true) {
		document.getElementById("postavke").disabled=true
		document.getElementById("izberi").disabled=true
		document.getElementById("odstrani").disabled=true
		odstraniVse('postavke');
	}
	else {
		document.getElementById("izberi").disabled=false
		document.getElementById("odstrani").disabled=false
		document.getElementById("postavke").disabled=false
	}
}

function uredi(){
	senci();
	menjava();
}
	
function validate_form ( )
{
	text = "Vsebina";
    valid = true;
    if ( document.obrazec.naziv.value == "" )
    {
        hscroll ( "Prosim vnesite naziv modula!" );
		document.obrazec.naziv.focus();
        valid = false;
		return valid;
    }
	if ( document.obrazec.tip.selectedIndex == 0 )
    {
        hscroll ( "Prosim izberite tip modula!" );
		document.obrazec.tip.focus();
        valid = false;
		return valid;
    }
	if ( document.obrazec.pozicija.selectedIndex < 0 )
    {
        hscroll ( "Prosim izberite pozicijo modula!" );
		document.obrazec.pozicija.focus();
        valid = false;
		return valid;
    }
    return valid;
}