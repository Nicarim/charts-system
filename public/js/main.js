/**
 * Created by Marcin on 02.02.14.
 */

//function used for votings in chart
function VoteFunc(element,type, map, chart, mode){
    if(type == "add"){
        $.get("/charts/vote/add/"+map+"/"+chart+"/"+mode, function (data){
            if (data != "false"){
                $(element).addClass("btn-danger");
                $(element).addClass("unvote");
                $(element).removeClass("vote");
                $(element).text("Unvote");
                $(element).attr("onclick","VoteFunc(this,'remove',"+data+")");
                var votes = parseInt($("#votes_available").text());
                $("#votes_available").text(votes - 1);
                checkIfFull();
            }
        });
    }
    else if (type == "remove"){
        $.get("/charts/vote/remove/"+map, function (data){
            $(element).removeClass("btn-danger");
            $(element).text("Vote");
            $(element).removeClass("unvote");
            $(element).addClass("vote");
            var splitted = data.split(",");
            $(element).attr("onclick","VoteFunc(this,'add',"+splitted[1]+","+splitted[0]+",'"+splitted[2]+"')");
            var votes = parseInt($("#votes_available").text());
            $("#votes_available").text(votes + 1);
            checkIfFull();
        });
    }
}
function checkIfFull(){
    var votes = parseInt($("#votes_available").text());
    if (votes == 0){
        $(".vote").each(function(){
            $(this).attr("disabled",true);
        });
    }else{
        $(".vote").each(function(){
            $(this).attr("disabled",false);
        });
    }
}
