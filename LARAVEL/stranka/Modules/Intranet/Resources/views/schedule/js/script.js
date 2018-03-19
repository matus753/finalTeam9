$(function() {
    $( "#subjectScheduleForm").submit(function( event ) { 
        if ($(this).find("input[type=submit]:focus" ).val()== "Náhľad") {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "content/addSchedule.php?postForm",
                data: $(this).serialize(),
                success: function(result){
                    $("#zatotodivko").after( result );
                }
            });
        }
    });
    $( "#selectSemester, #selectYear" ).change(function( event ) {
    	if($("#selectSemester").val()!=null && $("#selectYear").val()!=null){
	        $.ajax({
	            type: "POST",
	            url: "content/addSchedule.php?subjects",
	            data: {semester: $("#selectSemester").val(), year: $("#selectYear").val()},
	            success: function(result){
	                //console.log(result);
	                if ( !$('#subjectSelectForm').length ) {
	                    $("#semesterSelectForm").after( result );
	                }
	                else {
	                    if ($('#subjectSelectForm').val()!=result) {
	                        $('#subjectSelectForm').remove();
	                        $('#hiddenLecturesExercises').css("display","none");
	                        $("#semesterSelectForm").after( result );
	                    }
	                }
	            }
	        });
    	}
    });

    $(document).on('change', '#selectSubject', function() {
        $('#hiddenLecturesExercises').css("display","block");
    });
    
    $(document).on('change', '#selectExercisesNum', function() {
        $.ajax({
            type: "POST",
            url: "content/addSchedule.php?exercises",
            data: {execNumber: this.value},
            success: function(result){
                if (result!="") {
                $("#allExercises").remove();
                $("#exercisesNumSelectForm").after( result );
                $('.submitButton').css("display","block");}
            }
        });
    });
    
    
    
});