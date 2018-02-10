$('.m').on("click",function(){
    // console.log($(this).data('href'));
    $.ajax({
        // type: 'GET',
        url: $(this).data('href'),
        success: function(msg){
            var obj = JSON.parse(msg);
            $("#modalTitle").html(obj.titleSK);
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
            if (obj.annotationSK){
                $( "#modalAnotDiv" ).removeClass( "defHide" );
                $("#modalAnot").html(obj.annotationSK);
            }

        }
    });
});