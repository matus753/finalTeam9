$('.m').on("click",function(){
    // console.log($(this).data('href'));
    $.ajax({
        type: 'POST',
        url: $(this).data('href'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(msg){
            var obj = JSON.parse(msg);
            if ($('#lang').html() === 'sk') {
                $("#modalTitle").html(obj.titleSK);
            } else {
                $("#modalTitle").html(obj.titleEN);
            }
            $("#modalType").html(obj.projectType);
            $("#modalNumber").html(obj.number);
            $("#modalDuration").html(obj.duration);
            $("#modalCoordinator").html(obj.coordinator);
            if (obj.partners){
                $( "#modalPartnersDiv" ).removeClass( "defHide" );
                $("#modalPartners").html(obj.partners);
            }
            if (obj.web){
                $( "#modalWebDiv" ).removeClass( "defHide" );
                $("#modalWeb").html(obj.web);
            }
            if (obj.internalCode){
                $( "#modalCodeDiv" ).removeClass( "defHide" );
                $("#modalCode").html(obj.internalCode);
            }
            if (obj.annotationSK && $('#lang').html() === 'sk' ){
                $( "#modalAnotDiv" ).removeClass( "defHide" );
                $("#modalAnot").html(obj.annotationSK);
            }
            if (obj.annotationEN && $('#lang').html() === 'en' ){
                $( "#modalAnotDiv" ).removeClass( "defHide" );
                $("#modalAnot").html(obj.annotationEN);
            }

        }
    });
});