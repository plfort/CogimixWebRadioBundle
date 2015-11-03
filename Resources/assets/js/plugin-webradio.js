function webRadioPlayer(musicPlayer) {
	this.name = "Webradio";
	this.cancelRequested=false;
	this.musicPlayer = musicPlayer;
	this.currentState = null;
	this.soundmanagerPlayer = soundManager;

	this.currentSoundObject=null;
	var self = this;
	self.musicPlayer.cursor.progressbar();
	this.widgetElement =$("#cogimix-widget");
	this.requestCancel=function(){
		self.cancelRequested=true;
		if(self.currentSoundObject){
			self.currentSoundObject.destruct();
			self.cancelRequested=false;
		}
		
	}
	
	this.play = function(item) {
		
		self.currentSoundObject=this.soundmanagerPlayer.createSound({
			  id: item.id.toString(),
			  url: item.pluginProperties.url,
			  autoLoad: true,
			  autoPlay: true,
			  multiShot : false,
			  volume: self.musicPlayer.volume,
			  onload: function(success) {
				  if(success == false && item.pluginProperties.confirmed == false){
					  if(item.pluginProperties.url.indexOf(';', item.pluginProperties.url.length - 1) == -1){
						  //try shoutcast url "/;"
						  if(item.pluginProperties.url.indexOf('/', item.pluginProperties.url.length - 1) !== -1){
							  item.pluginProperties.url = item.pluginProperties.url+';';
						  }else{
							  item.pluginProperties.url = item.pluginProperties.url+'/;';
						  }
						  this.destruct();
						  self.play(item);
					  }

				  }else{
					 
					  var data={'url':item.pluginProperties.url};
					  $.post(Routing.generate('_webradio_increase_play',{'id':item.id}),data,function(response){});
					  self.musicPlayer.enableControls();
					  self.musicPlayer.cursor.slider("option", "max", this.duration/1000).progressbar();			  
					  self.musicPlayer.bindCursorStop(function(value) {
						  self.currentSoundObject.setPosition(value*1000);
						});
				  }


			  },

			  onstop: function(){
				 this.destruct();
				  self.musicPlayer.cursor.slider("option", "max", 0).progressbar('value',0);
			  },

			  onfinish: function(){
				  this.destruct();
				  self.musicPlayer.next();
			  },
			  whileplaying: function(){
				 self.musicPlayer.cursor.progressbar("value", false);
				 if(self.cancelRequested == true){
					 self.cancelRequested = false;
					 this.destruct();
				 }
			  },
			  
			  
			});
	
	};
	this.stop = function(){
		logger.debug('call stop soundmanager');	
		if(self.currentSoundObject !=null){
			self.currentSoundObject.stop();	
		}
	}
	
	this.pause = function(){
		logger.debug('call pause soundmanager');
		if(self.currentSoundObject !=null){
			self.currentSoundObject.pause();
		}
		
	}
	this.resume = function(){
		logger.debug('call resume soundmanager');
		if(self.currentSoundObject !=null){
			self.currentSoundObject.resume();
		}
	}
	
	this.setVolume = function(value){
		logger.debug('call setvolume soundmanager');
		if(self.currentSoundObject!=null){
			self.currentSoundObject.setVolume(value);
		}
	}
	

}

$("body").on('musicplayerReady',function(event){
	event.musicPlayer.addPlugin('webradio',new webRadioPlayer(event.musicPlayer));
});


