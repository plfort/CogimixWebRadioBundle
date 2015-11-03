var scrollBarOptionsWebRadio ={
		theme:'dark-thin',
		
		};

$(document).ready(function(){
	$pane.webradio = {
			content:$("#webRadioPane"),
			menuLink:$("#webRadioMenuItem"),
			searchForm:$("#searchWebRadio"),
            shown:function(){
                currentFilterFunction=filterWebradioResults
            }
			};
	
	$pane.webradio.menuLink.click(function(){
		 showWebRadio();
		 historyPushWebRadio();
		 
		 return false;
	});
	
	
	$("#searchFormContainer").on('submit','#searchWebRadio',function(event){

		postForm($(this),function(response){
			
			renderResult(response.data.webRadios,{
				tpl:'trackNoSortTpl',
				alias:'webradio-tracks',
				tabName:'webradio-tracks',
				emptyMessage: render('webradiosEmptyList'),
				tooltip:true});
			historyPushWebRadio();
			
		});
		return false;
	});
});

function showWebRadio(){

	if($("#webradio-results").children().length == 0){
		$.get(Routing.generate('_webradio_popular'),function(response){
			if(response.success == true){		
				renderResult(response.data.webRadios,{
					tpl:'trackNoSortTpl',
					alias:'webradio-tracks',
					tabName:'webradio-tracks',
					emptyMessage: render('webradiosEmptyList'),
					tooltip:true});
				
			}
		},'json');
	}
	setCurrentSongMap('webradio-tracks');
	showPanel($pane.webradio);
}

