var config = {
	api_host: 'http://cam.figli-migli.net',
	//api_host: '',
};

var playerComponent = Vue.component('camera-player', {
	template: '#player-template',
	data: function() {
		return {
			frames: [],
			total_images: 0,
			images_loaded: 0,
			current_frame: 0,
			is_playing: false,
			play_speed: 200, // delay between frames switching
			settings: { // misc user settings
				day_time: 'day',
				period: '30',
			}, 
		}
	},
	
	methods: {
		frameLoaded: function(e) {
			this.images_loaded++;
		},
		
		play: function(force) {
			if (force) {
				this.is_playing = true;
			}
			
			this.next_frame(1);
			
			if (this.is_playing) {
				setTimeout(this.play, this.play_speed);
			}
		},
		
		stop: function() {
			this.is_playing = false;
		},
		
		next_frame: function(delta) {
			var new_val = parseInt(this.current_frame) + delta;
			if (new_val > 0 && new_val < this.total_images) {
				this.current_frame = new_val;
			}
		},
		
		callApi: function() {
			this.total_images = 0;
			this.images_loaded = 0;
			this.current_frame = 0;
			this.frames = [];
			
			this.$http.get(config.api_host + '/api/list?time=' + this.settings.day_time + '&period=' + this.settings.period).then(responce => {
				var i = 0;
				for (var frame of responce.body) {
					this.frames.push({
						no: i,
						url: config.api_host + '/upload/screenshots/' + frame.filename,
						timestamp: frame.timestamp
					});
					i++;
				}
				this.total_images = this.frames.length;
			}, console.error);
		}
	},
	
	created: function() {
		this.callApi();
	}
});

var textPageComponent = Vue.component('text-page', {
	template: "<div class='text-page'>Text page here<slot></slot></div>"
})

var router = new VueRouter({
	routes: [
		{ path: '/', component: playerComponent },
		{ path: '/about', component: textPageComponent },
		{ path: '/house', component: textPageComponent }
	]
})

var app = new Vue({
	el: '#app',
	router: router
});

