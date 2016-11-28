<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script>

$(document).ready(function(){

    $(".ajax_btn").click(function(){

     $.post("http://lenovo.goolink.org/g_token_get.php",{devid:"12345678"},//获取类名为"name"文本的值，以NAME异步传值

     function(data){//data为反回值，function进行反回值处理

           $("#content").val(data);//获得得反回值后，将其填入到类名为"content"的文本框中

      });

    })

})

</script>

<form id="ajaxform" name="ajaxform" method="post" action="test.php">
    <p>
    email<input type="text" name="name" id="name"/>
    
    </p>
    <p>
    address<input type="text" name="address" id="address"/>
    </p>
    <p id="msg"></p>
    <p>    
        <input name="ajax_btn" type="button" value="submit"/>
    </p>
</form>

//post之后返回内容

<div id="content"></div>
