function textNumber(point){
	document.getElementById(point).value=formatNumber(document.getElementById(point).value);
}

function formatNumber(number){
	number=number+'';
	return number.replace(/[^\d\.\-]/g, '')
	.replace(/(\.\d{2})[\W\w]+/g,'$1').split('').reverse().join('')
	.replace(/(\d{3})/g,'$1,').split('').reverse().join('')
	.replace(/^([\-]{0,1}),/,'$1');
	//.replace(/(\.\d)$/,'$1'+'0');
	//.replace(/\.$/,'.00');
}