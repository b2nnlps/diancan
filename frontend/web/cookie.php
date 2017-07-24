
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="js/jquery.cookie.js"></script> 
<script>
    function update(id,num,price){	//输入商品id,数量，价格即可
        var has=false;
        var data=$.cookie('cart');
		document.write("cookie:"+data+"<br>");
		if(data){
			data=JSON.parse(data);
			for(var x=0;x<999;x++){
				if(data.cart[x]==undefined)break;
				document.write( data.cart[x].id);
				if(data.cart[x].id==id){data.cart[x].num+=num; has=true;}
			}
			data=JSON.stringify(data);
		}
		if(!has && data==null){
			data='{\"cart\":[{\"id\":'+id+',\"num\":'+num+',\"price\":'+price+'}]}';
		}else{
			if(!has){
			temp=',{\"id\":'+id+',\"num\":'+num+',\"price\":'+price+'}]}';  //从后面插入位移两位
		    data=data.replace("]}",temp);
			}
		}
		$.cookie('cart', data, { expires: 1, path: '/' }); 
    }

</script>

<button onclick="update(1,1,5)">1 1 5</button>
<button onclick="update(1,-1,5)">1 -1 5</button>

<button onclick="update(2,2,5)">2 2 5</button>
<button onclick="update(2,-2,5)">2 -2 5</button>