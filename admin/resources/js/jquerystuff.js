function hscroll(text, speed, delay){
	if (speed==undefined||delay==undefined){
		speed=400;
		delay=2500;
	}
	$('#napaka').html('<div id="napaka_text">'+ text +'</div>');
	$('#napaka').slideToggle(speed).delay(delay).slideToggle(speed);
}

function hscroll_p(text, speed, delay){
	if (speed==undefined||delay==undefined){
		speed=400;
		delay=2500;
	}
	$('#napaka_p').html('<div id="napaka_text_p">'+ text +'</div>');
	$('#napaka_p').slideToggle(speed).delay(delay).slideToggle(speed);
}