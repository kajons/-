<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script>

$(document).ready(function(){

    $(".ajax_btn").click(function(){

     $.post("http://lenovo.goolink.org/g_token_get.php",{devid:"12345678"},//��ȡ����Ϊ"name"�ı���ֵ����NAME�첽��ֵ

     function(data){//dataΪ����ֵ��function���з���ֵ����

           $("#content").val(data);//��õ÷���ֵ�󣬽������뵽����Ϊ"content"���ı�����

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

//post֮�󷵻�����

<div id="content"></div>
