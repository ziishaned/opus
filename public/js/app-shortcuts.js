/**
 * Global Shortcuts
 */
key('h', function(){ 
	document.location = '/help';
});
key.sequence(["g","d"], function () {
	document.location = '/';
});
key.sequence(["g","p"], function () {
	document.location = '/users/' + userSlug;
});
key.sequence(["g","o"], function () {
	document.location = '/users/'+userSlug+'/organizations';
});
key('[', function () {
	$('#menu-toggle').click();
});
key.sequence(["c","w"], function () {
	document.location = '/wikis/create';
});
key.sequence(["c","o"], function () {
	document.location = '/organizations/create';
});