var userId = localStorage.getItem('user-id');

let $userId = $('#user-id');

if (!userId)
{
	if ($userId.length && $userId.val().length)
	{
		localStorage.setItem('user-id', $userId.val());
		userId = $userId.val();
	}
	else if (window.location.href.indexOf('user') === -1)
	{
		window.location = '/user';
	}
}

$userId.val(userId);

$('.alert.user-msg').delay(2000).fadeOut();
$('#mine-link').attr('href', `/mine?id=${userId}`);

$('.check-all').on('change', (e) => 
{
	let value = $(e.target).is(':checked');
	
	$(e.target).closest('table').find('input:not(.check-all)').prop('checked', value);
});