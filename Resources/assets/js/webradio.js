var scrollBarOptionsWebRadio ={
		theme:'dark-thin',
		
		};

$(document).ready(function(){
	$pane.webradio = {content:$("#webRadioPane"),menuLink:$("#webRadioMenuItem")};
	$pane.webradio.menuLink.click(function(){
		 showWebRadio();
		
	});
	
	
	$pane.webradio.content.on('submit','#searchWebRadio',function(event){
		
		postForm($(this),function(response){
			//renderWebRadioResult(response.data.webradios,$("#webradio-results"));
			renderResult(response.data.webRadios,{
				tpl:'webradioTpl',
				alias:'webradio-tracks',
				tabName:'webradio-tracks',
				tooltip:false});
			$("#webradio-results").mCustomScrollbar(scrollBarOptionsWebRadio);
		});
		return false;
	});
});

function showWebRadio(){
	/*$.get(Routing.generate('_webradio_index'),function(response){
		if(response.success == true){		
			$pane.webradio.content.html(response.html);
			renderResult(response.data.webRadios,{
				tpl:'webradioTpl',
				alias:'webradio-tracks',
				tabName:'webradio-tracks',
				tooltip:true});
		}
	},'json');*/
	if($("#webradio-results").children().length == 0){
		$.get(Routing.generate('_webradio_popular'),function(response){
			if(response.success == true){		
				renderResult(response.data.webRadios,{
					tpl:'webradioTpl',
					alias:'webradio-tracks',
					tabName:'webradio-tracks',
					tooltip:true});
				$("#webradio-results").mCustomScrollbar(scrollBarOptionsWebRadio);
			}
		},'json');
	}
	showPanel($pane.webradio);
}

