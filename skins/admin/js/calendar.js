;var  forbid=true;
$(function(){
      /* status为状态位 */
      var  status = false;
      var  date_status='';
      var  ctrl = false;
      /*  鼠标在td按住不放，启用  */
      $(".hotel-table td").mousedown(function() {
            var flag = false;
            var stop;
            if(forbid==true){
                  var inherit = $(this);
                  stop = setTimeout(function() {
                      flag = true;
                      status=true;
                      date_status=parseInt(inherit.find(".day").html());
                  }, 100);
                  $(".hotel-table td").mouseup(function() {
                      if (!flag) {
                          clearTimeout(stop);
                      }
                  });
            }
      });
      /* 双击事件 */
      $('.hotel-table').on('dblclick','td.ul-nextday',function(event){
            if(forbid==true){
                  new_calendar();
                  $(this).addClass("atcle-mousedown");
                  addonnter();
            }

            event.stopPropagation(); 
      });
      /*  鼠标在页面放开后，禁止  */
      $(document).mouseup(function(){
              status=false;
              if($(".atcle-mousedown").size()>0){
                  var atcle_mousedown=$(".atcle-mousedown");
                  var atcle_append=atcle_mousedown.eq(atcle_mousedown.length-1);
                  if(atcle_append.is("atcle-append")==false&&forbid == true){
                         $(".td-color  .atcle-append").remove(); 
                        addonnter();
                  }
              }
      });
      /* Ctrl按住点击 */
      $('.hotel-table').on('click','td.ul-nextday',function(event){
            if(ctrl==true){
                  $(this).toggleClass("atcle-mousedown");
                  $(".td-color  .atcle-append").remove();
                  $(".hotel-table td").removeClass("parseInt_r");
                  addonnter();
                  if($(".atcle-mousedown").size()==0){
                        $(".hotel-table td").removeClass("parseInt_r");
                        $(".td-color .atcle-append").remove();
                        forbid=true;
                  }
            }
            event.stopPropagation(); 
      });
      /* Ctrl */
      $(window).keydown(function(event){
            if(event.keyCode==17){
                  ctrl=true;
            }
      });
      $(window).keyup(function(event){
            if(event.keyCode==17){
                  ctrl=false;
            }
      });
      /* 经过td */
      $(".hotel-table td").hover(
        function () {
            if(status==true && $(this).hasClass("ul-nextday")){
                  var date_status_two = parseInt($(this).find(".day").html());
                  calendar_verify(date_status,date_status_two);
            }
        },
        function () {}
      );

      //取消
      $(".ul-nextday").delegate(".cancelButton","click",function(event){
          forbid=new_calendar();
          event.stopPropagation(); 
      });

});
/* 验证 */
function calendar_verify(start,end){
            if(start-end>0){
                  calendar_for(end,start);
            }else{
                  calendar_for(start,end);
            }
}
/* 循环日历 传进 开始时间  结束时间 */
function  calendar_for(start,end){
      var ul_nextday=$("td.ul-nextday");
      ul_nextday.removeClass("atcle-mousedown");
      for (var num=1;num<=ul_nextday.length;num++) {
            var calendar= parseInt(ul_nextday.eq(num-1).find(".day").html());
            if(calendar>=start&&calendar<=end){
                  ul_nextday.eq(num-1).addClass("atcle-mousedown");
            }
      };
}
/* 初始化 */
function new_calendar(){
      status=false;
      date_status="";
      forbid=true;
      $(".hotel-table td").removeClass("atcle-mousedown");
      $(".hotel-table td").removeClass("parseInt_r");
      $(".td-color .atcle-append").remove();
      $('.fen-two').addClass('fen-none');
      $('.fen-one').removeClass('fen-none');
      return true
}

/*  添加  */
function addonnter(){
      var atcle_mousedown=$(".atcle-mousedown");
      settle(atcle_mousedown);
      var atcle_append=atcle_mousedown.eq(atcle_mousedown.length-1);
      atcle_append.find("ul.td-color").append($(".hotel-geiyed").html());
      atcle_append.addClass("parseInt_r");
      forbid = false;
      if(atcle_append.index()>=4){
            atcle_append.find(".atcle-append").addClass("atcle-lefter");
            var append = $(".atcle-append").width()-atcle_append.width();
            $(".atcle-append").css({
                  position:"absolute",
                  left:"-"+append
            });
      }
}

/* 结算  */
function settle(atcle_mousedown){
      var atcle_append_frids=atcle_mousedown.eq(0);
      var atcle_append_end=atcle_mousedown.eq(atcle_mousedown.length-1);
      $(".atcle-date-to").html(atcle_append_frids.children('ul.td-color').attr("data-date")+" to "+atcle_append_end.children('ul.td-color').attr('data-date'));
      var date= atcle_append_frids.children('ul.td-color').attr("data-date");
      for(var i=1;i<atcle_mousedown.length;i++){
    	  date +=","+atcle_mousedown.eq(i).children('ul.td-color').attr('data-date');
      }
      $("input[name=date]").val(date); 
}



