$(function(){
    $("table.list:not(table.noDatatable)").dataTable({"sPaginationType": "full_numbers"});
    $(".dataTables_paginate").after($(".dataTables_info"));
    $("table.form table.nested .add").click(function(){
        var tr= $(this).closest("tr").clone();
        var value= $(this).closest("tr").find("select").val();
        tr.find("select").attr("name",tr.find("select").attr("id")+"[]");
        tr.find("select").removeAttr("id");
        tr.find("select").val(value);
        tr.find("button.button.add").html("-");
        tr.find("button.button.add").removeClass("add").addClass("remove");
        $(this).closest("table").find("tr.hr").before(tr);
        return false;
    });
    $("table.form table.nested .remove").click(function(){
        $(this).closest("tr").remove();
        return false;
    });
    $("input[type=date]")
});

function edit(employee_id){
	alert(employee_id);
	window.location=window.location+"?id=" + employee_id;
}

function imgChanged(){
	$("#url_img").remove();
}

