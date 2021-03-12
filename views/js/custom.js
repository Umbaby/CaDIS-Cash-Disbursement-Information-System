$(document).ready(function(){
	$(document).on('click', '.buttons-4', function(){
		var id=$(this).val();
		var fund_type=$('#fund_type'+id).text();
		var payment_type=$('#payment_type'+id).text();
		var payee_type=$('#payee_type'+id).text();
		var encoded_by=$('#encoded_by'+id).text();
		var warrant_num=$('#warrant_num'+id).text();
		var date_released=$('#date_released'+id).text();
		var released_tagger=$('#released_tagger'+id).text();
		var or_num=$('#or_num'+id).text();
		var date_issue=$('#date_issue'+id).text();
		var date_claimed=$('#date_claimed'+id).text();
		var claimed_by=$('#claimed_by'+id).text();
		var claimed_tagger=$('#claimed_tagger'+id).text();
		var cancelled_tagger=$('#cancelled_tagger'+id).text();
		var date_cancelled=$('#date_cancelled'+id).text();
		var cancel_remarks=$('#cancel_remarks'+id).text();
		var re_issued_by=$('#re_issued_by'+id).text();
		var date_re_issued=$('#date_re_issued'+id).text();
		var date_expire=$('#date_expire'+id).text();
	
		$('#edit').modal('show');
		$('#efund_type').val(fund_type);
		$('#epayment_type').val(payment_type);
		$('#epayee_type').val(payee_type);
		$('#eencoded_by').val(encoded_by);
		$('#ewarrant_num').val(warrant_num);
		$('#edate_released').val(date_released);
		$('#ereleased_tagger').val(released_tagger);
		$('#eor_num').val(or_num);
		$('#edate_issue').val(date_issue);
		$('#edate_claimed').val(date_claimed);
		$('#eclaimed_by').val(claimed_by);
		$('#eclaimed_tagger').val(claimed_tagger);
		$('#ecancelled_tagger').val(cancelled_tagger);
		$('#edate_cancelled').val(date_cancelled);
		$('#ecancel_remarks').val(cancel_remarks);
		$('#ere_issued_by').val(re_issued_by);
		$('#edate_re_issued').val(date_re_issued);
		$('#edate_expire').val(date_expire);
	});
});